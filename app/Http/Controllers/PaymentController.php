<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\StudentBill;
use App\Models\Payment;
use App\Models\FeeType;
use App\Models\User;
use App\Models\SchoolClass;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    // ─── SISWA/WALI ──────────────────────────────────────────────────────────────

    public function studentBills()
    {
        $user = Auth::user();
        $bills = StudentBill::with(['feeType', 'payments'])
            ->where('student_id', $user->id)
            ->latest()
            ->get();

        return view('payments.student.bills', compact('bills', 'user'));
    }

    public function showPayForm($billId)
    {
        $user = Auth::user();
        $bill = StudentBill::with(['feeType', 'student', 'payments'])
            ->where('student_id', $user->id)
            ->findOrFail($billId);

        if ($bill->status === 'paid') {
            return redirect()->route('payment.student.bills')
                ->with('info', 'Tagihan ini sudah lunas.');
        }

        return view('payments.student.pay', compact('bill', 'user'));
    }

    public function processPayment(Request $request, $billId)
    {
        $user = Auth::user();
        $bill = StudentBill::where('student_id', $user->id)->findOrFail($billId);

        if ($bill->status === 'paid') {
            return redirect()->route('payment.student.bills')->with('info', 'Tagihan sudah lunas.');
        }

        $request->validate([
            'payment_method' => 'required|in:qris,bca_va,bri_va,mandiri_va,bsi_va,manual_transfer',
            'proof_file'     => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
        ]);

        $proofPath = null;
        if ($request->hasFile('proof_file')) {
            $proofPath = $request->file('proof_file')->store('proofs', 'public');
        }

        $vaNumber = null;
        $method = $request->payment_method;

        if (in_array($method, ['bca_va', 'bri_va', 'mandiri_va', 'bsi_va'])) {
            $prefix = match($method) {
                'bca_va'     => '80777',
                'bri_va'     => '26215',
                'mandiri_va' => '88808',
                'bsi_va'     => '91234',
                default      => '00000',
            };
            $vaNumber = $prefix . str_pad($bill->id, 10, '0', STR_PAD_LEFT);
        } elseif ($method === 'qris') {
            $vaNumber = 'QRIS-NMID-MAN-' . strtoupper(Str::random(10));
        }

        $paymentCode = 'PAY-' . now()->format('Ymd') . '-' . strtoupper(Str::random(6));

        $payment = Payment::create([
            'payment_code'   => $paymentCode,
            'bill_id'        => $bill->id,
            'amount_paid'    => $bill->amount,
            'payment_method' => $method,
            'va_number'      => $vaNumber,
            'proof_file'     => $proofPath,
            'notes'          => $request->notes,
            'status'         => 'pending',
            'paid_at'        => now(),
        ]);

        $bill->update(['status' => 'pending']);

        return redirect()->route('payment.student.confirmation', $payment->id)
            ->with('success', 'Pembayaran berhasil diajukan! Menunggu verifikasi bendahara.');
    }

    public function confirmation($paymentId)
    {
        $user = Auth::user();
        $payment = Payment::with(['bill.feeType', 'bill.student'])->findOrFail($paymentId);
        return view('payments.student.confirmation', compact('payment', 'user'));
    }

    public function receipt($paymentId)
    {
        $payment = Payment::with(['bill.student.schoolClass', 'bill.feeType', 'verifier'])->findOrFail($paymentId);

        if ($payment->status !== 'success') {
            return back()->with('error', 'Kwitansi hanya tersedia untuk pembayaran yang telah diverifikasi.');
        }

        return view('payments.student.receipt', compact('payment'));
    }

    // ─── BENDAHARA ───────────────────────────────────────────────────────────────

    public function financeIndex(Request $request)
    {
        $query = Payment::with(['bill.student', 'bill.feeType', 'verifier']);

        if ($request->status) {
            $query->where('status', $request->status);
        }

        $payments = $query->latest()->paginate(20);

        $stats = [
            'total_pending' => Payment::where('status', 'pending')->count(),
            'total_success' => Payment::where('status', 'success')->sum('amount_paid'),
            'this_month'    => Payment::where('status', 'success')
                ->whereMonth('verified_at', now()->month)->sum('amount_paid'),
        ];

        return view('payments.finance.index', compact('payments', 'stats'));
    }

    public function verifyPayment(Request $request, $paymentId)
    {
        $payment = Payment::with('bill')->findOrFail($paymentId);

        $request->validate([
            'action' => 'required|in:approve,reject',
        ]);

        if ($request->action === 'approve') {
            $payment->update([
                'status'      => 'success',
                'verified_at' => now(),
                'verified_by' => Auth::id(),
            ]);
            $payment->bill->update(['status' => 'paid']);

            return back()->with('success', "Pembayaran {$payment->payment_code} berhasil diverifikasi!");
        } else {
            $payment->update([
                'status'      => 'rejected',
                'verified_at' => now(),
                'verified_by' => Auth::id(),
            ]);
            $payment->bill->update(['status' => 'unpaid']);

            return back()->with('error', "Pembayaran {$payment->payment_code} telah ditolak.");
        }
    }

    public function generateBills(Request $request)
    {
        $classes = SchoolClass::all();
        $feeTypes = FeeType::all();
        return view('payments.finance.generate_bills', compact('classes', 'feeTypes'));
    }

    public function storeBills(Request $request)
    {
        $request->validate([
            'class_id'    => 'required|exists:classes,id',
            'fee_type_id' => 'required|exists:fee_types,id',
            'month'       => 'nullable|integer|min:1|max:12',
            'year'        => 'required|integer|min:2020',
            'amount'      => 'required|numeric|min:1000',
            'due_date'    => 'required|date',
        ]);

        $feeType = FeeType::findOrFail($request->fee_type_id);
        $students = User::where('role', 'siswa')
            ->where('class_id', $request->class_id)
            ->get();

        $count = 0;
        foreach ($students as $student) {
            $existing = StudentBill::where('student_id', $student->id)
                ->where('fee_type_id', $request->fee_type_id)
                ->when($request->month, fn($q) => $q->where('month', $request->month))
                ->where('year', $request->year)
                ->first();

            if (!$existing) {
                $billCode = 'INV-' . $request->year . str_pad($request->month ?? 0, 2, '0', STR_PAD_LEFT) . '-' . strtoupper(Str::random(6));
                $monthName = $request->month ? \Carbon\Carbon::create()->month($request->month)->isoFormat('MMMM') : '';
                StudentBill::create([
                    'bill_code'   => $billCode,
                    'student_id'  => $student->id,
                    'fee_type_id' => $request->fee_type_id,
                    'title'       => $feeType->name . ($monthName ? " - {$monthName} {$request->year}" : " {$request->year}"),
                    'month'       => $request->month,
                    'year'        => $request->year,
                    'amount'      => $request->amount,
                    'due_date'    => $request->due_date,
                    'status'      => 'unpaid',
                ]);
                $count++;
            }
        }

        return back()->with('success', "Berhasil membuat {$count} tagihan untuk siswa kelas yang dipilih.");
    }

    public function financeReport(Request $request)
    {
        $year  = $request->year ?? now()->year;
        $month = $request->month ?? now()->month;

        $payments = Payment::with(['bill.student', 'bill.feeType'])
            ->where('status', 'success')
            ->whereYear('verified_at', $year)
            ->when($month, fn($q) => $q->whereMonth('verified_at', $month))
            ->latest('verified_at')
            ->get();

        $totalIncome = $payments->sum('amount_paid');
        $byFeeType = $payments->groupBy('bill.feeType.name');

        return view('payments.finance.report', compact('payments', 'totalIncome', 'byFeeType', 'year', 'month'));
    }
}
