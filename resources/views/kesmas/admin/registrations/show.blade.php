@extends('layouts.app')

@section('title', 'Detail Registrasi')

@section('content')
<div class="card" style="margin-bottom:18px;">
    <h3 style="font-weight:600;margin-bottom:14px;">Data Registrasi</h3>

    <div style="display:grid;grid-template-columns:1fr 1fr;gap:18px;">
        <div style="font-size:14px;line-height:1.7;">
            <p>
                <span style="color:#9ca3af;">Nama Sampel/Pengguna</span><br>
                <strong>{{ $registration->nama_sampel ?? ($registration->client->nama ?? '-') }}</strong>
            </p>
            <p>
                <span style="color:#9ca3af;">No. Registrasi</span><br>
                <strong>{{ $registration->no_registrasi }}</strong>
            </p>
            <p>
                <span style="color:#9ca3af;">Identitas Pengirim / No Hp</span><br>
                <strong>
                    {{ $registration->identitas_pengirim ?? '-' }}
                    {{ $registration->client && $registration->client->no_hp ? ' / '.$registration->client->no_hp : '' }}
                </strong>
            </p>
            <p>
                <span style="color:#9ca3af;">Lokasi Pengambilan</span><br>
                <strong>{{ $registration->lokasi_pengambilan ?? '-' }}</strong>
            </p>
            <p>
                <span style="color:#9ca3af;">Jenis Sampel</span><br>
                <strong>{{ $registration->jenis_sampel ?? '-' }}</strong>
            </p>
            <p>
                <span style="color:#9ca3af;">Jenis Pemeriksaan</span><br>
                <strong>{{ $registration->jenis_pemeriksaan ?? '-' }}</strong>
            </p>
        </div>

        <div style="font-size:14px;line-height:1.7;">
            <p>
                <span style="color:#9ca3af;">Petugas Sampling</span><br>
                <strong>{{ $registration->petugas_sampling ?? '-' }}</strong>
            </p>
            <p>
                <span style="color:#9ca3af;">Alamat Petugas Sampling</span><br>
                <strong>{{ $registration->alamat_petugas_sampling ?? '-' }}</strong>
            </p>
            <p>
                <span style="color:#9ca3af;">Tanggal &amp; Jam Pengambilan Sampel</span><br>
                <strong>
                    {{ $registration->tgl_pengambilan ? $registration->tgl_pengambilan->format('d/m/Y') : '-' }}
                    @if($registration->jam_pengambilan)
                        &nbsp;{{ $registration->jam_pengambilan }}
                    @endif
                </strong>
            </p>
            <p>
                <span style="color:#9ca3af;">Tanggal Permintaan</span><br>
                <strong>
                    {{ $registration->tgl_permintaan ? $registration->tgl_permintaan->format('d/m/Y') : '-' }}
                </strong>
            </p>
            <p>
                <span style="color:#9ca3af;">Tanggal &amp; Jam Penerimaan Sampel</span><br>
                <strong>
                    {{ $registration->tgl_penerimaan ? $registration->tgl_penerimaan->format('d/m/Y') : '-' }}
                    @if($registration->jam_penerimaan)
                        &nbsp;{{ $registration->jam_penerimaan }}
                    @endif
                </strong>
            </p>
            <p>
                <span style="color:#9ca3af;">Volume Sampel</span><br>
                <strong>{{ $registration->volume_sampel ?? '-' }}</strong>
            </p>
        </div>

    </div>
</div>

<div class="card" style="margin-bottom:18px;">
    <h3 style="font-weight:600;margin-bottom:10px;">Status Pembayaran</h3>

    @if($registration->status_pembayaran === 'lunas')
        <span style="display:inline-block;padding:6px 14px;border-radius:999px;background:#bbf7d0;color:#166534;font-weight:700;font-size:14px;">
            LUNAS
        </span>
    @else
        <span style="display:inline-block;padding:6px 14px;border-radius:999px;background:#fee2e2;color:#b91c1c;font-weight:700;font-size:14px;">
            BELUM LUNAS
        </span>
    @endif
</div>

@php
    $items = $registration->items()->with('parameter','result')->get();
    $mikroItems = $items->filter(fn($i) => optional($i->parameter)->kategori === 'mikrobiologi');
    $kimiaItems = $items->filter(fn($i) => optional($i->parameter)->kategori === 'kimia');
@endphp

<div class="card" style="margin-bottom:18px;">
    <h3 style="font-weight:600;margin-bottom:14px;">Pemeriksaan Diminta</h3>

    <div style="display:flex;gap:40px;flex-wrap:wrap;">

        {{-- MIKROBIOLOGI --}}
        <div style="min-width:220px;">
            <h4 style="font-size:15px;margin-bottom:6px;color:#e5e7eb;font-weight:600;">Mikrobiologi</h4>
            @if($mikroItems->count())
                <ul style="margin:0;padding-left:18px;font-size:13px;color:#e5e7eb;">
                    @foreach($mikroItems as $item)
                        <li>{{ optional($item->parameter)->nama_parameter ?? 'Tanpa nama' }}</li>
                    @endforeach
                </ul>
            @else
                <p style="font-size:13px;color:#cbd5e1;">Tidak ada pemeriksaan mikrobiologi.</p>
            @endif
        </div>

        {{-- KIMIA --}}
        <div style="min-width:220px;">
            <h4 style="font-size:15px;margin-bottom:6px;color:#e5e7eb;font-weight:600;">Kimia</h4>
            @if($kimiaItems->count())
                <ul style="margin:0;padding-left:18px;font-size:13px;color:#e5e7eb;">
                    @foreach($kimiaItems as $item)
                        <li>{{ optional($item->parameter)->nama_parameter ?? 'Tanpa nama' }}</li>
                    @endforeach
                </ul>
            @else
                <p style="font-size:13px;color:#cbd5e1;">Tidak ada pemeriksaan kimia.</p>
            @endif
        </div>

    </div>
</div>

@php
    $hasAnyResult = $items->contains(fn($i) => !is_null($i->result));
    $verification = $registration->verification ?? null; // relasi hasOne KesmasVerification (jika ada)

    // Cari satu result yang punya catatan_petugas dari semua item pemeriksaan
    $result_record = $items
        ->pluck('result')          // kumpulkan semua relasi result
        ->filter()                 // buang yang null
        ->first(function ($r) {
            return !empty($r->catatan_petugas);
        });
@endphp

@if($items->count())
<div class="card" style="margin-bottom:18px;">
    <h3 style="font-weight:600;margin-bottom:10px;">Ringkasan Hasil Pemeriksaan</h3>

    {{-- CAP VERIFIKASI (jika sudah diverifikasi) --}}
    @if($verification)
        <div style="margin-bottom:12px;padding:10px 12px;border-radius:10px;background:#ecfdf5;border:1px solid #bbf7d0;">
            <div style="font-weight:700;color:#15803d;font-size:14px;">
                SUDAH DIVERIFIKASI
            </div>
            <div style="font-size:13px;color:#166534;margin-top:2px;">
                Oleh: {{ $verification->nama_pejabat ?? '-' }}
                @if(!empty($verification->jabatan))
                    ({{ $verification->jabatan }})
                @endif
                @if(!empty($verification->nip))
                    – NIP: {{ $verification->nip }}
                @endif
                @if(!empty($verification->verified_at))
                    pada {{ now()->format('d/m/Y H:i') }}
                @endif

            </div>
        </div>
    @endif

    {{-- Info kalau semua hasil masih kosong --}}
    @if(!$hasAnyResult)
        <p style="font-size:13px;color:#9ca3af;margin-bottom:10px;">
            Belum ada hasil yang diinput. Semua parameter masih menunggu pengisian.
        </p>
    @endif

    @if($mikroItems->count())
        <div style="margin-top:8px;">
            <div style="font-weight:700;margin-bottom:6px;">Mikrobiologi</div>
            <div style="overflow-x:auto;">
                <table style="width:100%;border-collapse:collapse;font-size:14px;">
                    <thead>
                        <tr style="background:#f1f5f9;color:#0f172a;">
                            <th style="padding:8px 12px;border-bottom:1px solid #e2e8f0;text-align:left;width:30%;">Parameter</th>
                            <th style="padding:8px 12px;border-bottom:1px solid #e2e8f0;text-align:left;width:20%;">Hasil</th>
                            <th style="padding:8px 12px;border-bottom:1px solid #e2e8f0;text-align:left;width:25%;">Nilai Rujukan</th>
                            <th style="padding:8px 12px;border-bottom:1px solid #e2e8f0;text-align:left;width:25%;">Interpretasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($mikroItems as $item)
                            @php
                                $param = $item->parameter;
                                $r = $item->result;
                                $hasResultRow = $r && (
                                    !is_null($r->nilai_angka) ||
                                    !is_null($r->hasil_text) ||
                                    !is_null($r->keterangan)
                                );
                            @endphp
                            <tr style="border-bottom:1px solid #111827;">
                                <td style="padding:8px 12px;">
                                    {{ optional($param)->nama_parameter ?? '-' }}
                                </td>
                                <td style="padding:8px 12px;">
                                    @if($hasResultRow)
                                        {{ $r->nilai_angka ?? $r->hasil_text ?? '-' }}
                                    @else
                                        <span style="display:inline-block;padding:2px 10px;border-radius:999px;background:#fee2e2;color:#b91c1c;font-size:12px;font-weight:600;">
                                            Belum diisi
                                        </span>
                                    @endif
                                </td>
                                <td style="padding:8px 12px;">
                                    @if($hasResultRow)
                                        {{ $r->nilai_rujukan ?? optional($param)->nilai_rujukan ?? '-' }}
                                    @else
                                        {{ optional($param)->nilai_rujukan ?? '-' }}
                                    @endif
                                </td>
                                <td style="padding:8px 12px;">
                                    @if($hasResultRow)
                                        {{ $r->keterangan ?? '-' }}
                                    @else
                                        <span style="color:#9ca3af;font-size:12px;">Belum diisi</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif

    @if($kimiaItems->count())
        <div style="margin-top:18px;">
            <div style="font-weight:700;margin-bottom:6px;">Kimia</div>
            <div style="overflow-x:auto;">
                <table style="width:100%;border-collapse:collapse;font-size:14px;">
                    <thead>
                        <tr style="background:#f1f5f9;color:#0f172a;">
                            <th style="padding:8px 12px;border-bottom:1px solid #e2e8f0;text-align:left;width:30%;">Parameter</th>
                            <th style="padding:8px 12px;border-bottom:1px solid #e2e8f0;text-align:left;width:20%;">Hasil</th>
                            <th style="padding:8px 12px;border-bottom:1px solid #e2e8f0;text-align:left;width:25%;">Nilai Rujukan</th>
                            <th style="padding:8px 12px;border-bottom:1px solid #e2e8f0;text-align:left;width:25%;">Interpretasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($kimiaItems as $item)
                            @php
                                $param = $item->parameter;
                                $r = $item->result;
                                $hasResultRow = $r && (
                                    !is_null($r->nilai_angka) ||
                                    !is_null($r->hasil_text) ||
                                    !is_null($r->keterangan)
                                );
                            @endphp
                            <tr style="border-bottom:1px solid #111827;">
                                <td style="padding:8px 12px;">
                                    {{ optional($param)->nama_parameter ?? '-' }}
                                </td>
                                <td style="padding:8px 12px;">
                                    @if($hasResultRow)
                                        {{ $r->nilai_angka ??
                                           $r->hasil_text ?? '-' }}
                                    @else
                                        <span style="display:inline-block;padding:2px 10px;border-radius:999px;background:#fee2e2;color:#b91c1c;font-size:12px;font-weight:600;">
                                            Belum diisi
                                        </span>
                                    @endif
                                </td>
                                <td style="padding:8px 12px;">
                                    @if($hasResultRow)
                                        {{ $r->nilai_rujukan ?? optional($param)->nilai_rujukan ?? '-' }}
                                    @else
                                        {{ optional($param)->nilai_rujukan ?? '-' }}
                                    @endif
                                </td>
                                <td style="padding:8px 12px;">
                                    @if($hasResultRow)
                                        {{ $r->keterangan ?? '-' }}
                                    @else
                                        <span style="color:#9ca3af;font-size:12px;">Belum diisi</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif

    {{-- CATATAN PETUGAS (opsional) --}}
    @if(!empty($result_record?->catatan_petugas))
        <div style="margin-top:16px;padding-top:10px;border-top:1px dashed #e5e7eb;">
            <div style="font-weight:600;font-size:14px;margin-bottom:4px;">Catatan Petugas</div>
            <div style="font-size:13px;white-space:pre-line;color:#e5e7eb;">
                {{ $result_record->catatan_petugas }}
            </div>
        </div>
    @endif

</div>
@endif
<div class="card">
    <h3 style="font-weight:600;margin-bottom:12px;">Aksi</h3>

    <div style="display:flex;gap:12px;flex-wrap:wrap;">
        <a href="{{ route('admin.kesmas.results.edit', $registration->id) }}"
           style="padding:8px 14px;background:#2563eb;color:white;border-radius:10px;text-decoration:none;font-weight:600;">
            Input / Edit Hasil Pemeriksaan
        </a>

        <a href="{{ route('admin.kesmas.registrations.verify_form', $registration->id) }}"
           style="padding:8px 14px;background:#f59e0b;color:white;border-radius:10px;text-decoration:none;font-weight:600;">
            Verifikasi Hasil
        </a>

        <a href="{{ route('admin.kesmas.registrations.print', $registration->id) }}"
           style="padding:8px 14px;background:#10b981;color:white;border-radius:10px;text-decoration:none;font-weight:600;">
            Print Lembar Registrasi
        </a>
    </div>
</div>
@endsection
