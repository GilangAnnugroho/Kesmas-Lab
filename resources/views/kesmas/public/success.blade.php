@extends('kesmas.public.layout')

@section('content')
<div class="kesmas-success-wrap">
    <div class="kesmas-success-card">
        <div class="kesmas-success-icon">✔</div>

        <h2 class="kesmas-success-title">
            Pendaftaran Berhasil!
        </h2>

        <p class="kesmas-success-subtitle">
            Terima kasih telah melakukan pendaftaran pemeriksaan laboratorium Kesmas.
        </p>

        <div class="kesmas-success-info">
            <div class="kesmas-info-label">Nomor Registrasi Anda</div>

            <div class="kesmas-info-value">{{ $registration->no_registrasi }}</div>

            <p class="kesmas-info-note">
                Simpan nomor ini untuk pengecekan status atau saat konfirmasi ke petugas loket.
            </p>
        </div>

        <a href="{{ route('kesmas.public.create') }}" class="kesmas-success-btn">
            Daftar Lagi
        </a>
    </div>
</div>
@endsection

@push('styles')
<style>
.kesmas-success-wrap{
    display:flex;
    align-items:center;
    justify-content:center;
    min-height:70vh;
    padding:20px;
}

.kesmas-success-card{
    max-width:480px;
    width:100%;
    background:var(--sheet-bg, #ffffff);
    padding:28px 26px 34px;
    border-radius:20px;
    text-align:center;
    border:1px solid rgba(148,163,184,.55);
    box-shadow:0 22px 65px rgba(15,23,42,.32);
    backdrop-filter:blur(14px);
    position:relative;
    overflow:hidden;
}
.kesmas-success-card::before{
    content:"";
    position:absolute;
    inset:-30%;
    background:
        radial-gradient(circle at top left,rgba(59,130,246,.20),transparent 55%),
        radial-gradient(circle at bottom right,rgba(45,212,191,.20),transparent 55%);
    pointer-events:none;
    opacity:.9;
}

.kesmas-success-icon{
    width:70px;
    height:70px;
    border-radius:999px;
    background:linear-gradient(135deg,#22c55e,#15803d);
    display:flex;
    align-items:center;
    justify-content:center;
    color:#fff;
    font-size:38px;
    margin:0 auto 14px;
    box-shadow:0 12px 30px rgba(34,197,94,.45);
    position:relative;
    z-index:1;
}

.kesmas-success-title{
    font-size:22px;
    font-weight:700;
    color:var(--text, #0f172a);
    margin-bottom:4px;
    font-family:'Poppins', sans-serif;
    position:relative;
    z-index:1;
}

.kesmas-success-subtitle{
    font-size:13px;
    color:var(--muted, #64748b);
    margin-bottom:20px;
    position:relative;
    z-index:1;
}

.kesmas-success-info{
    background:rgba(248,250,252,.75);
    padding:16px 18px;
    border-radius:14px;
    border:1px solid var(--border, #e5e7eb);
    margin-bottom:22px;
    position:relative;
    z-index:1;
}
[data-theme="dark"] .kesmas-success-info{
    background:rgba(15,23,42,.85);
}

.kesmas-info-label{
    font-size:11px;
    color:var(--muted, #64748b);
    margin-bottom:6px;
}

.kesmas-info-value{
    font-size:28px;
    font-weight:700;
    font-family:'Poppins', sans-serif;
    color:var(--text, #0f172a);
    margin-bottom:6px;
    letter-spacing:.06em;
}

.kesmas-info-note{
    font-size:11px;
    color:var(--muted, #64748b);
}

.kesmas-success-btn{
    display:inline-block;
    margin-top:8px;
    padding:10px 18px;
    font-size:13px;
    border-radius:999px;
    text-decoration:none;
    background:linear-gradient(90deg,var(--primary, #2563eb),var(--accent, #06b6d4));
    color:#fff;
    font-weight:600;
    box-shadow:0 12px 34px rgba(37,99,235,.35);
    position:relative;
    z-index:1;
}
.kesmas-success-btn:hover{
    filter:brightness(1.06);
}
</style>
@endpush
