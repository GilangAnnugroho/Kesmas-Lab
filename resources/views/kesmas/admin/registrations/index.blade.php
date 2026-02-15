@extends('layouts.app')

@section('title', 'Data Registrasi Kesmas')

@section('content')
<div class="card" style="margin-bottom:22px;">
    <h3 style="font-weight:600;margin-bottom:12px;">Filter Pencarian</h3>

    <form method="GET"
          style="display:flex;flex-wrap:wrap;gap:10px;align-items:center;">
        <input type="text" name="q" placeholder="Cari nama / No Reg"
               value="{{ request('q') }}"
               style="padding:8px 10px;
                      border-radius:10px;
                      border:1px solid #4b5563;
                      background:#020617;
                      color:#e5e7eb;
                      min-width:180px;">

        <select name="status_pembayaran"
                style="padding:8px 10px;
                       border-radius:10px;
                       border:1px solid #4b5563;
                       background:#020617;
                       color:#e5e7eb;">
            <option value="">Semua Status Pembayaran</option>
            <option value="lunas" {{ request('status_pembayaran')=='lunas' ? 'selected' : '' }}>Lunas</option>
            <option value="belum_lunas" {{ request('status_pembayaran')=='belum_lunas' ? 'selected' : '' }}>Belum Lunas</option>
        </select>

        <button type="submit"
                style="padding:8px 16px;
                       border:none;
                       border-radius:10px;
                       background:#2563eb;
                       color:white;
                       font-weight:600;
                       cursor:pointer;">
            Cari
        </button>
    </form>
</div>

<div class="card">
    <h3 style="font-weight:600;margin-bottom:10px;">Daftar Registrasi</h3>

    <div style="overflow-x:auto;">
        <table style="width:100%;border-collapse:collapse;font-size:14px;">
            <thead>
                <tr style="background:#e5e7eb;">
                    <th style="padding:10px;
                               border-bottom:1px solid #cbd5e1;
                               text-align:left;
                               color:#0f172a;
                               font-weight:600;">
                        No. Reg
                    </th>
                    <th style="padding:10px;
                               border-bottom:1px solid #cbd5e1;
                               text-align:left;
                               color:#0f172a;
                               font-weight:600;">
                        Identitas Pengirim / No Hp
                    </th>
                    <th style="padding:10px;
                               border-bottom:1px solid #cbd5e1;
                               text-align:left;
                               color:#0f172a;
                               font-weight:600;">
                        Jenis Sampel
                    </th>
                    <th style="padding:10px;
                               border-bottom:1px solid #cbd5e1;
                               text-align:left;
                               color:#0f172a;
                               font-weight:600;">
                        Tanggal Penerimaan
                    </th>
                    <th style="padding:10px;
                               border-bottom:1px solid #cbd5e1;
                               text-align:left;
                               color:#0f172a;
                               font-weight:600;">
                        Status Pembayaran
                    </th>
                    <th style="padding:10px;
                               border-bottom:1px solid #cbd5e1;
                               text-align:center;
                               color:#0f172a;
                               font-weight:600;">
                        Aksi
                    </th>
                </tr>
            </thead>

            <tbody>
                @forelse($registrations as $r)
                    <tr style="border-bottom:1px solid #111827;">
                        {{-- No Reg --}}
                        <td style="padding:10px;
                                   font-weight:600;">
                            <a href="{{ route('admin.kesmas.registrations.show', $r->id) }}"
                               style="color:#60a5fa;text-decoration:none;">
                                {{ $r->no_registrasi }}
                            </a>
                        </td>

                        {{-- Nama --}}
                        <td style="padding:10px;text-align:left;">
                            {{ $r->client->nama ?? '-' }}
                        </td>

                        {{-- Jenis sampel --}}
                        <td style="padding:10px;text-align:left;">
                            {{ $r->jenis_sampel ?? '-' }}
                        </td>

                        {{-- Tanggal Penerimaan Sampel --}}
                        <td style="padding:10px;text-align:left;">
                            @if($r->tgl_penerimaan)
                                {{ $r->tgl_penerimaan->format('d/m/Y') }}
                            @else
                                <span style="color:#9ca3af;">-</span>
                            @endif
                        </td>

                        {{-- Status pembayaran: cuma Lunas / Belum Lunas --}}
                        <td style="padding:10px;text-align:left;">
                            @if($r->status_pembayaran === 'lunas')
                                <span style="
                                    display:inline-block;
                                    padding:4px 10px;
                                    border-radius:999px;
                                    background:#bbf7d0;
                                    color:#166534;
                                    font-size:12px;
                                    font-weight:600;
                                ">
                                    Lunas
                                </span>
                            @else
                                <span style="
                                    display:inline-block;
                                    padding:4px 10px;
                                    border-radius:999px;
                                    background:#fee2e2;
                                    color:#b91c1c;
                                    font-size:12px;
                                    font-weight:600;
                                ">
                                    Belum Lunas
                                </span>
                            @endif
                        </td>

                        {{-- Aksi --}}
                        <td style="padding:10px;text-align:center;">
                            <a href="{{ route('admin.kesmas.registrations.show', $r->id) }}"
                               style="padding:6px 14px;
                                      background:#2563eb;
                                      color:white;
                                      border-radius:999px;
                                      font-size:12px;
                                      text-decoration:none;
                                      font-weight:600;">
                                Detail
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6"
                            style="padding:20px;text-align:center;color:#64748b;">
                            Tidak ada data
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div style="margin-top:18px;">
        {{ $registrations->links() }}
    </div>
</div>

@endsection
