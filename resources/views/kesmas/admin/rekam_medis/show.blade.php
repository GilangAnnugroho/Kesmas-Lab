@extends('layouts.app')

@section('title', 'Detail Rekam Medis')

@section('content')

{{-- IDENTITAS CLIENT --}}
<div class="card" style="margin-bottom:18px;">
    <h3 style="font-size:20px;font-weight:600;margin-bottom:10px;">
        Rekam Medis – {{ $client->nama }}
    </h3>

    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:10px;font-size:14px;">
        <div>
            <p><strong>Nama</strong><br>{{ $client->nama }}</p>
            <p><strong>NIK</strong><br>{{ $client->nik ?? '-' }}</p>
        </div>
        <div>
            <p><strong>No HP</strong><br>{{ $client->no_hp ?? '-' }}</p>
            <p><strong>Jenis Pemohon</strong><br>{{ ucfirst($client->jenis ?? 'perorangan') }}</p>
        </div>
        <div>
            <p><strong>Alamat</strong><br>{{ $client->alamat ?? '-' }}</p>
            <p><strong>Total Pemeriksaan</strong><br>{{ $client->registrations->count() }} kali</p>
        </div>
    </div>
</div>

{{-- RIWAYAT PEMERIKSAAN --}}
<div class="card">
    <h3 style="font-size:18px;font-weight:600;margin-bottom:10px;">
        Riwayat Pemeriksaan
    </h3>

    @if($client->registrations->isEmpty())
        <p style="color:#64748b;font-size:14px;">
            Belum ada riwayat pemeriksaan untuk pemohon ini.
        </p>
    @else
        <div style="overflow-x:auto;">
            <table style="width:100%;border-collapse:collapse;font-size:13px;">
                <thead>
                    <tr style="background:#f1f5f9;">
                        <th style="padding:8px;border-bottom:1px solid #e5e7eb;text-align:left;">No. Reg</th>
                        <th style="padding:8px;border-bottom:1px solid #e5e7eb;">Tgl Permintaan</th>
                        <th style="padding:8px;border-bottom:1px solid #e5e7eb;">Jenis Sampel</th>
                        <th style="padding:8px;border-bottom:1px solid #e5e7eb;">Pemeriksaan</th>
                        <th style="padding:8px;border-bottom:1px solid #e5e7eb;">Status Proses</th>
                        <th style="padding:8px;border-bottom:1px solid #e5e7eb;">Status Pembayaran</th>
                        <th style="padding:8px;border-bottom:1px solid #e5e7eb;text-align:center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($client->registrations as $reg)
                        <tr style="border-bottom:1px solid #f3f4f6;">
                            <td style="padding:8px;font-weight:600;color:#2563eb;">
                                {{ $reg->no_registrasi }}
                            </td>
                            <td style="padding:8px;">
                                {{ $reg->tgl_permintaan ? \Carbon\Carbon::parse($reg->tgl_permintaan)->format('d/m/Y') : '-' }}
                            </td>
                            <td style="padding:8px;">
                                {{ $reg->jenis_sampel ?? '-' }}
                            </td>
                            <td style="padding:8px;">
                                {{ $reg->jenis_pemeriksaan ?? '-' }}
                            </td>
                            <td style="padding:8px;">
                                @php
                                    $status = $reg->status_proses ?? 'baru';
                                @endphp

                                @if($status === 'baru')
                                    <span style="background:#e5e7eb;color:#374151;padding:3px 8px;border-radius:999px;font-size:11px;">
                                        Baru
                                    </span>
                                @elseif($status === 'diterima')
                                    <span style="background:#dbeafe;color:#1d4ed8;padding:3px 8px;border-radius:999px;font-size:11px;">
                                        Diterima
                                    </span>
                                @elseif($status === 'sedang_diperiksa')
                                    <span style="background:#fef3c7;color:#92400e;padding:3px 8px;border-radius:999px;font-size:11px;">
                                        Sedang Diperiksa
                                    </span>
                                @elseif($status === 'selesai')
                                    <span style="background:#dcfce7;color:#166534;padding:3px 8px;border-radius:999px;font-size:11px;">
                                        Selesai
                                    </span>
                                @else
                                    <span style="background:#e5e7eb;color:#374151;padding:3px 8px;border-radius:999px;font-size:11px;">
                                        {{ ucfirst($status) }}
                                    </span>
                                @endif
                            </td>
                            <td style="padding:8px;">
                                @if($reg->status_pembayaran === 'lunas')
                                    <span style="background:#dcfce7;color:#166534;padding:3px 8px;border-radius:999px;font-size:11px;">
                                        Lunas
                                    </span>
                                @else
                                    <span style="background:#fee2e2;color:#b91c1c;padding:3px 8px;border-radius:999px;font-size:11px;">
                                        Belum Lunas
                                    </span>
                                @endif
                            </td>
                            <td style="padding:8px;text-align:center;">
                                <div style="display:flex;gap:6px;justify-content:center;flex-wrap:wrap;">
                                    <a href="{{ route('admin.kesmas.registrations.show', $reg->id) }}"
                                       style="padding:5px 10px;border-radius:999px;background:#2563eb;color:white;font-size:11px;text-decoration:none;">
                                        Detail
                                    </a>

                                    <a href="{{ route('admin.kesmas.registrations.print', $reg->id) }}"
                                       style="padding:5px 10px;border-radius:999px;background:#10b981;color:white;font-size:11px;text-decoration:none;">
                                        Print
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>

@endsection
