@extends('layouts.app')

@section('title', 'Verifikasi Hasil Pemeriksaan')

@section('content')

<div class="card" style="margin-bottom:18px;">
    <h3 style="font-size:20px;font-weight:600;margin-bottom:8px;">
        Verifikasi Hasil Pemeriksaan – {{ $registration->no_registrasi }}
    </h3>

    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:10px;font-size:14px;">
        <div>
            <p><strong>Nama Sampel / Pengguna</strong><br>{{ $registration->client->nama ?? '-' }}</p>
            <p><strong>Identitas Pengirim</strong><br>{{ $registration->identitas_pengirim ?? '-' }}</p>
        </div>
        <div>
            <p><strong>Jenis Sampel</strong><br>{{ $registration->jenis_sampel ?? '-' }}</p>
            <p><strong>Jenis Pemeriksaan</strong><br>{{ $registration->jenis_pemeriksaan ?? '-' }}</p>
        </div>
        <div>
            <p><strong>Status Proses</strong><br>{{ ucfirst($registration->status_proses ?? 'baru') }}</p>
            <p><strong>Status Pembayaran</strong><br>{{ ucfirst($registration->status_pembayaran ?? '-') }}</p>
        </div>
    </div>
</div>

@php
    // Ambil item + relasi yang sudah diload dari controller
    $items = $registration->items;
    $hasAnyResult = $items->contains(fn($i) => !is_null($i->result));
@endphp

{{-- RINGKASAN HASIL --}}
<div class="card" style="margin-bottom:18px;">
    <h3 style="font-size:18px;font-weight:600;margin-bottom:10px;">
        Ringkasan Hasil Pemeriksaan
    </h3>

    @if($items->isEmpty())
        <p style="color:#b91c1c;font-size:14px;">
            Tidak ada parameter pemeriksaan pada registrasi ini.
        </p>
    @elseif(!$hasAnyResult)
        <p style="color:#b91c1c;font-size:14px;margin-bottom:10px;">
            Belum ada hasil pemeriksaan yang diinput.
            Silakan pastikan petugas lab sudah mengisi hasil sebelum verifikasi.
        </p>
    @endif

    @if($items->isNotEmpty())
        <div style="overflow-x:auto;">
            <table style="width:100%;border-collapse:collapse;font-size:13px;">
                <thead>
                    <tr style="background:#f1f5f9;color:#0f172a;">
                        <th style="padding:8px;border-bottom:1px solid #e5e7eb;text-align:left;">Jenis</th>
                        <th style="padding:8px;border-bottom:1px solid #e5e7eb;text-align:left;">Parameter</th>
                        <th style="padding:8px;border-bottom:1px solid #e5e7eb;text-align:left;">Hasil</th>
                        <th style="padding:8px;border-bottom:1px solid #e5e7eb;text-align:left;">Nilai Rujukan</th>
                        <th style="padding:8px;border-bottom:1px solid #e5e7eb;text-align:left;">Interpretasi</th>
                        <th style="padding:8px;border-bottom:1px solid #e5e7eb;text-align:left;">Status Hasil</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($items as $item)
                        @php
                            $p = $item->parameter;
                            $r = $item->result;
                            $jenis = optional($p)->kategori;
                            $hasilValue = $r ? ($r->nilai_angka ?? $r->hasil_text ?? '-') : null;
                            $nilaiRujukan = $r && $r->nilai_rujukan
                                ? $r->nilai_rujukan
                                : optional($p)->nilai_rujukan;
                            $interpretasi = $r->keterangan ?? null;
                            $status = $r->status_hasil ?? 'draft';
                        @endphp
                        <tr style="border-bottom:1px solid #f3f4f6;">
                            {{-- Jenis --}}
                            <td style="padding:8px;">
                                @if($jenis === 'mikrobiologi')
                                    <span style="background:#dbeafe;color:#1d4ed8;padding:3px 8px;border-radius:999px;font-size:11px;">
                                        Mikrobiologi
                                    </span>
                                @elseif($jenis === 'kimia')
                                    <span style="background:#fef3c7;color:#92400e;padding:3px 8px;border-radius:999px;font-size:11px;">
                                        Kimia
                                    </span>
                                @else
                                    -
                                @endif
                            </td>

                            {{-- Parameter --}}
                            <td style="padding:8px;">
                                {{ $p->nama_parameter ?? '-' }}
                            </td>

                            {{-- Hasil --}}
                            <td style="padding:8px;">
                                @if($hasilValue)
                                    {{ $hasilValue }}
                                @else
                                    <span style="background:#fee2e2;color:#b91c1c;padding:3px 8px;border-radius:999px;font-size:11px;">
                                        Belum diisi
                                    </span>
                                @endif
                            </td>

                            {{-- Nilai Rujukan --}}
                            <td style="padding:8px;">
                                {{ $nilaiRujukan ?? '-' }}
                            </td>

                            {{-- Interpretasi --}}
                            <td style="padding:8px;">
                                @if($interpretasi)
                                    {{ $interpretasi }}
                                @else
                                    <span style="color:#9ca3af;font-size:12px;">Belum diisi</span>
                                @endif
                            </td>

                            {{-- Status Hasil --}}
                            <td style="padding:8px;">
                                @if($status === 'draft')
                                    <span style="background:#e5e7eb;color:#374151;padding:3px 8px;border-radius:999px;font-size:11px;">
                                        Draft
                                    </span>
                                @elseif($status === 'menunggu_verifikasi')
                                    <span style="background:#dbeafe;color:#1d4ed8;padding:3px 8px;border-radius:999px;font-size:11px;">
                                        Siap Verifikasi
                                    </span>
                                @elseif($status === 'terverifikasi')
                                    <span style="background:#dcfce7;color:#166534;padding:3px 8px;border-radius:999px;font-size:11px;">
                                        Terverifikasi
                                    </span>
                                @else
                                    <span style="background:#fee2e2;color:#b91c1c;padding:3px 8px;border-radius:999px;font-size:11px;">
                                        {{ ucfirst($status) }}
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>

{{-- FORM VERIFIKASI --}}
<div class="card">
    <h3 style="font-size:18px;font-weight:600;margin-bottom:10px;">
        Form Verifikasi
    </h3>

    <form method="POST" action="{{ route('admin.kesmas.registrations.verify', $registration->id) }}">
        @csrf

        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:12px;font-size:14px;">

            <div>
                <label style="font-weight:500;">Nama Penandatangan</label>
                <input type="text" name="nama_pejabat" required
                       value="{{ old('nama_pejabat', optional($registration->verification)->nama_pejabat) }}"
                       style="width:100%;padding:8px;border-radius:10px;border:1px solid #d1d5db;">
            </div>

            <div>
                <label style="font-weight:500;">Jabatan</label>
                <input type="text" name="jabatan" required
                       value="{{ old('jabatan', optional($registration->verification)->jabatan) }}"
                       style="width:100%;padding:8px;border-radius:10px;border:1px solid #d1d5db;">
            </div>

            <div>
                <label style="font-weight:500;">NIP</label>
                <input type="text" name="nip"
                       value="{{ old('nip', optional($registration->verification)->nip) }}"
                       style="width:100%;padding:8px;border-radius:10px;border:1px solid #d1d5db;">
            </div>

        </div>

        <div style="margin-top:16px;padding:10px;border-radius:10px;background:#eff6ff;border:1px solid #bfdbfe;font-size:13px;color:#000;">
            Dengan menekan tombol <strong>Verifikasi &amp; Sahkan Hasil</strong>, Anda menyatakan bahwa:
            <ul style="margin-top:4px;">
                <li>Hasil pemeriksaan sudah diperiksa dan sesuai standar.</li>
                <li>Data akan dikunci sebagai hasil resmi Labkesda.</li>
            </ul>
        </div>

        <button type="submit"
                style="margin-top:16px;padding:10px 18px;border:none;border-radius:10px;background:#16a34a;color:white;font-weight:600;cursor:pointer;">
            ✅ Verifikasi &amp; Sahkan Hasil
        </button>
    </form>
</div>

@endsection
