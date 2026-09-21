@extends('layouts.app')

@section('title', 'Pembayaran - ' . $bill->title)
@section('page_title', 'Pembayaran SPP')
@section('breadcrumb', 'Pilih Metode Pembayaran')

@section('content')
<div style="max-width: 700px; margin: 0 auto;">

    {{-- Bill Detail Card --}}
    <div style="background: linear-gradient(135deg, #064e3b, #047857); border-radius: 20px; padding: 2rem; margin-bottom: 1.75rem; color: white;">
        <div style="font-size: 0.8rem; color: rgba(255,255,255,0.7); margin-bottom: 0.5rem;">Detail Tagihan</div>
        <h3 style="font-size: 1.2rem; font-weight: 800; margin-bottom: 0.25rem;">{{ $bill->title }}</h3>
        <div style="font-size: 0.8rem; color: rgba(255,255,255,0.7); margin-bottom: 1.5rem;">
            Kode: {{ $bill->bill_code }} · Jatuh tempo: {{ $bill->due_date->isoFormat('D MMMM YYYY') }}
        </div>
        <div style="font-size: 2.5rem; font-weight: 800; color: #fbbf24;">
            Rp {{ number_format($bill->amount, 0, ',', '.') }}
        </div>
        <div style="font-size: 0.8rem; color: rgba(255,255,255,0.7); margin-top: 0.25rem;">
            Atas nama: {{ $bill->student->name }}
        </div>
    </div>

    {{-- Payment Form --}}
    <div class="card">
        <div class="card-header">
            <h3>💳 Pilih Metode Pembayaran</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('payment.student.process', $bill->id) }}" method="POST" enctype="multipart/form-data" id="payForm">
                @csrf

                {{-- Payment Methods --}}
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.75rem; margin-bottom: 1.5rem;">
                    @foreach([
                        ['qris', '📱 QRIS Dinamis', 'Bayar via GoPay, OVO, ShopeePay, Dana, mBanking', '#10b981'],
                        ['bca_va', '🏦 Virtual Account BCA', 'Transfer ke nomor VA BCA otomatis', '#0056a4'],
                        ['bri_va', '🏦 Virtual Account BRI', 'Transfer ke nomor VA BRI otomatis', '#1da0dc'],
                        ['mandiri_va', '🏦 Virtual Account Mandiri', 'Transfer ke nomor VA Mandiri', '#003088'],
                        ['bsi_va', '🏦 Virtual Account BSI', 'Transfer ke nomor VA BSI Syariah', '#047857'],
                        ['manual_transfer', '📋 Transfer Manual', 'Upload bukti transfer ke rekening madrasah', '#7c3aed'],
                    ] as [$val, $label, $desc, $color])
                    <label style="display: flex; align-items: flex-start; gap: 0.75rem; padding: 1rem; border: 2px solid #e2e8f0; border-radius: 12px; cursor: pointer; transition: all 0.2s;" class="method-label" data-value="{{ $val }}">
                        <input type="radio" name="payment_method" value="{{ $val }}" style="accent-color: {{ $color }}; width: 18px; height: 18px; margin-top: 2px;" onchange="selectMethod('{{ $val }}')">
                        <div>
                            <div style="font-weight: 700; font-size: 0.875rem; color: #1e293b;">{{ $label }}</div>
                            <div style="font-size: 0.75rem; color: #94a3b8; line-height: 1.4; margin-top: 2px;">{{ $desc }}</div>
                        </div>
                    </label>
                    @endforeach
                </div>

                {{-- VA Info --}}
                <div id="va-info" style="display: none; background: #eff6ff; border: 1px solid #bfdbfe; border-radius: 12px; padding: 1.25rem; margin-bottom: 1.25rem;">
                    <div style="font-size: 0.82rem; font-weight: 700; color: #1d4ed8; margin-bottom: 0.4rem;">ℹ️ Informasi Virtual Account</div>
                    <p style="font-size: 0.8rem; color: #1e40af; line-height: 1.6;">Nomor Virtual Account akan di-generate secara otomatis setelah konfirmasi pembayaran. Silakan transfer tepat sesuai nominal tagihan. Pembayaran akan diverifikasi dalam 1x24 jam oleh bendahara madrasah.</p>
                </div>

                {{-- QRIS Info --}}
                <div id="qris-info" style="display: none; background: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 12px; padding: 1.25rem; margin-bottom: 1.25rem;">
                    <div style="font-size: 0.82rem; font-weight: 700; color: #166534; margin-bottom: 0.4rem;">📱 Petunjuk Pembayaran QRIS</div>
                    <p style="font-size: 0.8rem; color: #14532d; line-height: 1.6;">QRIS dinamis akan muncul setelah konfirmasi. Scan dengan aplikasi pembayaran favorit Anda (GoPay, OVO, Dana, LinkAja, ShopeePay, atau mBanking yang mendukung QRIS). Pembayaran terverifikasi otomatis dalam 1–5 menit.</p>
                </div>

                {{-- Proof Upload --}}
                <div id="proof-upload" style="display: none;" class="form-group">
                    <label class="form-label">📎 Upload Bukti Transfer</label>
                    <input type="file" name="proof_file" class="form-input" accept="image/*,.pdf">
                    <div style="font-size: 0.75rem; color: #94a3b8; margin-top: 0.35rem;">Format: JPG, PNG, atau PDF. Maks 5MB.</div>

                    {{-- Rekening Tujuan --}}
                    <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 10px; padding: 1rem; margin-top: 1rem; font-size: 0.82rem;">
                        <div style="font-weight: 700; color: #1e293b; margin-bottom: 0.75rem;">Rekening Tujuan Transfer:</div>
                        <div style="display: flex; flex-direction: column; gap: 0.4rem; color: #334155;">
                            <div>🏦 <strong>BSI (Bank Syariah Indonesia)</strong> — A/N MAN Pandanaran</div>
                            <div style="font-size: 1rem; font-weight: 800; color: #047857; letter-spacing: 2px;">711 - 0000 - 1234</div>
                            <div>🏦 <strong>BNI Syariah</strong> — A/N Madrasah Aliyah Negeri Pandanaran</div>
                            <div style="font-size: 1rem; font-weight: 800; color: #1d4ed8; letter-spacing: 2px;">012 - 388 - 9990</div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Catatan (Opsional)</label>
                    <textarea name="notes" class="form-input" rows="2" placeholder="Catatan tambahan untuk bendahara..."></textarea>
                </div>

                <button type="submit" class="btn btn-primary" style="width: 100%; padding: 0.875rem; font-size: 1rem;" id="submitBtn" disabled onclick="return confirmPay()">
                    <i class="bi bi-lock-fill"></i> Konfirmasi Pembayaran
                </button>
                <div style="text-align: center; font-size: 0.75rem; color: #94a3b8; margin-top: 0.75rem;">
                    🔒 Transaksi ini aman dan terenkripsi
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
function selectMethod(val) {
    document.querySelectorAll('.method-label').forEach(l => {
        l.style.borderColor = '#e2e8f0';
        l.style.background = 'white';
    });
    const selected = document.querySelector(`[data-value="${val}"]`);
    selected.style.borderColor = '#047857';
    selected.style.background = '#ecfdf5';

    document.getElementById('va-info').style.display = ['bca_va','bri_va','mandiri_va','bsi_va'].includes(val) ? 'block' : 'none';
    document.getElementById('qris-info').style.display = val === 'qris' ? 'block' : 'none';
    document.getElementById('proof-upload').style.display = val === 'manual_transfer' ? 'block' : 'none';
    document.getElementById('submitBtn').disabled = false;
}

function confirmPay() {
    const method = document.querySelector('input[name="payment_method"]:checked');
    if (!method) { alert('Pilih metode pembayaran terlebih dahulu.'); return false; }
    return confirm('Konfirmasi pembayaran Rp {{ number_format($bill->amount, 0, ",", ".") }} via ' + method.value.replace('_', ' ').toUpperCase() + '?');
}
</script>
@endsection
