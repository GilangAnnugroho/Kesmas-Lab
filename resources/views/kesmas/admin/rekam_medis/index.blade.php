@extends('layouts.app')

@section('title', 'Rekam Medis Kesmas')

@section('content')

<div class="card" style="margin-bottom:18px;">
    <div style="display:flex;justify-content:space-between;align-items:center;gap:10px;flex-wrap:wrap;">
        <h3 style="font-size:20px;font-weight:600;">Rekam Medis Pemeriksaan Kesmas</h3>

        <form method="GET" style="display:flex;gap:8px;flex-wrap:wrap;align-items:center;">
            <input type="text"
                   name="q"
                   placeholder="Cari nama / NIK / No HP..."
                   value="{{ request('q') }}"
                   style="padding:8px 10px;border-radius:10px;border:1px solid #d1d5db;min-width:220px;">

            <button style="padding:8px 14px;border-radius:10px;border:none;background:#2563eb;color:white;font-weight:600;cursor:pointer;">
                🔍 Cari
            </button>
        </form>
    </div>
</div>

<div class="card">
    <div style="overflow-x:auto;">
        <table style="width:100%;border-collapse:collapse;font-size:14px;">
            <thead>
                <tr style="background:#f1f5f9;">
                    <th style="padding:10px;border-bottom:1px solid #e5e7eb;text-align:left;">Nama</th>
                    <th style="padding:10px;border-bottom:1px solid #e5e7eb;">NIK</th>
                    <th style="padding:10px;border-bottom:1px solid #e5e7eb;">No HP</th>
                    <th style="padding:10px;border-bottom:1px solid #e5e7eb;">Alamat</th>
                    <th style="padding:10px;border-bottom:1px solid #e5e7eb;text-align:center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($clients as $client)
                    <tr style="border-bottom:1px solid #f3f4f6;">
                        <td style="padding:10px;font-weight:500;">
                            {{ $client->nama }}
                        </td>
                        <td style="padding:10px;">
                            {{ $client->nik ?? '-' }}
                        </td>
                        <td style="padding:10px;">
                            {{ $client->no_hp ?? '-' }}
                        </td>
                        <td style="padding:10px;">
                            {{ $client->alamat ?? '-' }}
                        </td>
                        <td style="padding:10px;text-align:center;">
                            <a href="{{ route('admin.kesmas.rekam_medis.show', $client->id) }}"
                               style="padding:6px 12px;border-radius:999px;background:#2563eb;color:white;font-size:12px;font-weight:600;text-decoration:none;">
                                Lihat Rekam Medis
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="padding:20px;text-align:center;color:#64748b;">
                            Belum ada data rekam medis.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div style="margin-top:16px;">
        {{ $clients->links() }}
    </div>
</div>

@endsection
