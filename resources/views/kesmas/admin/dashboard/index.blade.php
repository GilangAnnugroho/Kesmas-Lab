@extends('layouts.app')

@section('title', 'Dashboard Kesmas')

@section('content')

<div class="card" style="border-radius:20px; padding:22px 24px;">
    <h2 style="margin-bottom:18px;font-weight:700;font-size:20px;color:#e5e7eb;">
        Ringkasan Pemeriksaan
    </h2>

    <div style="display:grid;grid-template-columns:repeat(auto-fit, minmax(220px,1fr));gap:18px;">
        <div class="card"
             style="
                background:linear-gradient(135deg,#2563eb,#06b6d4);
                color:white;
                border-radius:18px;
                padding:18px 20px;
                box-shadow:0 20px 35px rgba(37,99,235,.55);
             ">
            <div style="font-size:14px; opacity:.9;">🧾 Registrasi Hari Ini</div>
            <div style="font-size:34px;font-weight:700;margin-top:4px;">
                {{ $totalHariIni ?? 0 }}
            </div>
        </div>

        <div class="card"
             style="
                border-radius:18px;
                padding:18px 20px;
                background:radial-gradient(circle at top,#0f172a,#020617);
                box-shadow:0 16px 32px rgba(15,23,42,.9);
             ">
            <div style="font-size:14px; color:#cbd5e1;">🧫 Pemeriksaan Mikrobiologi</div>
            <div style="font-size:30px;font-weight:700;color:#38bdf8;margin-top:6px;">
                {{ $totalMikro ?? 0 }}
            </div>
        </div>

        <div class="card"
             style="
                border-radius:18px;
                padding:18px 20px;
                background:radial-gradient(circle at top,#0f172a,#020617);
                box-shadow:0 16px 32px rgba(15,23,42,.9);
             ">
            <div style="font-size:14px; color:#cbd5e1;">⚗️ Pemeriksaan Kimia</div>
            <div style="font-size:30px;font-weight:700;color:#f97316;margin-top:6px;">
                {{ $totalKimia ?? 0 }}
            </div>
        </div>

        <div class="card"
             style="
                border-radius:18px;
                padding:18px 20px;
                background:radial-gradient(circle at top,#022c22,#020617);
                box-shadow:0 16px 32px rgba(15,23,42,.9);
             ">
            <div style="font-size:14px; color:#bbf7d0;">💳 Status Pembayaran</div>
            <div style="display:flex;justify-content:space-between;align-items:flex-end;margin-top:6px;gap:10px;">
                <div>
                    <div style="font-size:12px;color:#a7f3d0;">Lunas</div>
                    <div style="font-size:24px;font-weight:700;color:#6ee7b7;">
                        {{ $totalLunas ?? 0 }}
                    </div>
                </div>
                <div>
                    <div style="font-size:12px;color:#fed7aa;">Belum Lunas</div>
                    <div style="font-size:24px;font-weight:700;color:#fdba74;text-align:right;">
                        {{ $totalBelum ?? 0 }}
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection
