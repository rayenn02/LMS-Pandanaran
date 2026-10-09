@extends('layouts.app')

@section('title', 'Manajemen Pembayaran')
@section('page_title', 'Verifikasi Pembayaran Masuk')

@section('content')
{{-- Stats --}}
<div class="stats-grid" style="grid-template-columns: repeat(3, 1fr); margin-bottom: 1.75rem;">
    <div class="stat-card">
        <div class="stat-icon si-red"><i class="bi bi-hourglass-split"></i></div>
        <div class="stat-body">
            <div class="stat-num">{{ $stats['total_pending'] }}</div>
            <div class="stat-label">Menunggu Verifikasi</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon si-emerald"><i class="bi bi-graph-up-arrow"></i></div>
        <div class="stat-body">
            <div class="stat-num">Rp {{ number_format($stats['total_success'], 0, ',', '.') }}</div>
            <div class="stat-label">Total Pemasukan</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon si-gold"><i class="bi bi-calendar-month"></i></div>
        <div class="stat-body">
            <div class="stat-num">Rp {{ number_format($stats['this_month'], 0, ',', '.') }}</div>
            <div class="stat-label">Pemasukan Bulan Ini</div>
        </div>
    </div>
</div>

{{-- Filter --}}
<div class="card" style="margin-bottom: 1.25rem;">
    <div class="card-body" style="padding: 1rem 1.5rem;">
        <form method="GET" style="display: flex; gap: 0.75rem; align-items: center; flex-wrap: wrap;">
            <select name="status" class="form-input" style="width: auto; padding: 0.5rem 0.875rem;" onchange="this.form.submit()">
                <option value="">Semua Status</option>
                <option value="pending"  {{ request('status') === 'pending'  ? 'selected' : '' }}>⏳ Pending</option>
                <option value="success"  {{ request('status') === 'success'  ? 'selected' : '' }}>✅ Sukses</option>
                <option value="rejected" {{ request('status') === 'rejected' ? 'selected' : '' }}>❌ Ditolak</option>
            </select>
            <a href="{{ route('payment.finance.index') }}" class="btn btn-outline btn-sm">Reset</a>
            <a href="{{ route('payment.finance.report') }}" class="btn btn-gold btn-sm" style="margin-left: auto;"><i class="bi bi-bar-chart-fill"></i> Laporan</a>
            <a href="{{ route('payment.finance.generate') }}" class="btn btn-primary btn-sm"><i class="bi bi-plus-lg"></i> Generate Tagihan</a>
        </form>
    </div>
</div>

{{-- Payments Table --}}
<div class="card">
    <div class="card-header">
        <h3>💳 Daftar Pembayaran ({{ $payments->total() }} data)</h3>
    </div>
    <div class="card-body" style="padding: 0;">
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Siswa</th>
                        <th>Tagihan</th>
                        <th>Jumlah</th>
                        <th>Metode</th>
                        <th>Waktu Bayar</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($payments as $p)
                    <tr>
                        <td style="font-size: 0.72rem; color: #94a3b8; font-family: monospace;">{{ $p->payment_code }}</td>
                        <td>
                            <div style="font-weight: 700;">{{ $p->bill->student->name }}</div>
                            <div style="font-size: 0.72rem; color: #94a3b8;">{{ $p->bill->student->schoolClass?->name }}</div>
                        </td>
                        <td style="font-size: 0.82rem;">{{ Str::limit($p->bill->title, 30) }}</td>
                        <td style="font-weight: 800; color: #047857; white-space: nowrap;">Rp {{ number_format($p->amount_paid, 0, ',', '.') }}</td>
                        <td>
                            <span class="badge badge-info">{{ str_replace('_', ' ', strtoupper($p->payment_method)) }}</span>
                        </td>
                        <td style="font-size: 0.78rem; color: #64748b; white-space: nowrap;">{{ $p->paid_at?->isoFormat('D MMM YYYY HH:mm') }}</td>
                        <td>
                            <span class="badge badge-{{ $p->status === 'success' ? 'success' : ($p->status === 'rejected' ? 'danger' : 'warning') }}">
                                {{ $p->status === 'success' ? '✅ Sukses' : ($p->status === 'rejected' ? '❌ Ditolak' : '⏳ Pending') }}
                            </span>
                        </td>
                        <td>
                            @if($p->status === 'pending')
                            <div style="display: flex; gap: 0.35rem;">
                                <form action="{{ route('payment.finance.verify', $p->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="action" value="approve">
                                    <button type="submit" class="btn btn-primary btn-sm" onclick="return confirm('Verifikasi & setujui pembayaran ini?')">
                                        <i class="bi bi-check-lg"></i> Setujui
                                    </button>
                                </form>
                                <form action="{{ route('payment.finance.verify', $p->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="action" value="reject">
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tolak pembayaran ini?')">
                                        <i class="bi bi-x-lg"></i> Tolak
                                    </button>
                                </form>
                            </div>
                            @elseif($p->status === 'success')
                            <a href="{{ route('payment.student.receipt', $p->id) }}" class="btn btn-outline btn-sm" target="_blank">
                                <i class="bi bi-receipt"></i> Kwitansi
                            </a>
                            @else
                            <span style="font-size: 0.75rem; color: #dc2626;">Ditolak oleh {{ $p->verifier?->name }}</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" style="text-align: center; padding: 3rem; color: #94a3b8;">
                            <div style="font-size: 2.5rem; margin-bottom: 0.75rem;">✅</div>
                            Tidak ada pembayaran ditemukan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($payments->hasPages())
        <div style="padding: 1rem 1.5rem; display: flex; justify-content: center;">
            {{ $payments->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
