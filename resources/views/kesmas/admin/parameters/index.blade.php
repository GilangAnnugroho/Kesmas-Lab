@extends('layouts.app')

@section('title', 'Master Parameter Pemeriksaan')

@section('content')

<div class="card" style="margin-bottom:18px;">
    <div style="display:flex;justify-content:space-between;align-items:center;">
        <h3 style="font-size:20px;font-weight:600;">Parameter Pemeriksaan</h3>

        <a href="{{ route('admin.kesmas.parameters.create') }}"
           style="padding:8px 14px;background:#2563eb;color:white;border-radius:10px;font-weight:600;text-decoration:none;">
            + Tambah Parameter
        </a>
    </div>
</div>

<div class="card">
    <div style="overflow-x:auto;">
        <table style="width:100%;border-collapse:collapse;font-size:14px;">
            <thead>
                <tr style="background:#f1f5f9;color:#0f172a;">
                    <th style="padding:10px 14px;border-bottom:1px solid #e5e7eb;text-align:left;width:20%;">Jenis</th>
                    <th style="padding:10px 14px;border-bottom:1px solid #e5e7eb;text-align:left;width:35%;">Nama Parameter</th>
                    <th style="padding:10px 14px;border-bottom:1px solid #e5e7eb;text-align:left;width:20%;">Nilai Rujukan</th>
                    <th style="padding:10px 14px;border-bottom:1px solid #e5e7eb;text-align:left;width:15%;">Status</th>
                    <th style="padding:10px 14px;border-bottom:1px solid #e5e7eb;text-align:center;width:10%;">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($parameters as $p)
                    <tr style="border-bottom:1px solid #111827;">
                        {{-- Jenis --}}
                        <td style="padding:10px 14px;vertical-align:middle;">
                            @if($p->kategori == 'mikrobiologi')
                                <span style="background:#dbeafe;color:#1e3a8a;padding:4px 10px;border-radius:999px;font-size:12px;display:inline-block;">
                                    Mikrobiologi
                                </span>
                            @else
                                <span style="background:#fef3c7;color:#92400e;padding:4px 10px;border-radius:999px;font-size:12px;display:inline-block;">
                                    Kimia
                                </span>
                            @endif
                        </td>

                        <td style="padding:10px 14px;vertical-align:middle;color:#e5e7eb;">
                            {{ $p->nama_parameter }}
                        </td>

                        <td style="padding:10px 14px;vertical-align:middle;color:#e5e7eb;">
                            @if($p->nilai_rujukan)
                                {{ $p->nilai_rujukan }}
                            @else
                                <span style="color:#9ca3af;">-</span>
                            @endif
                        </td>

                        <td style="padding:10px 14px;vertical-align:middle;">
                            @if($p->aktif)
                                <span style="background:#dcfce7;color:#166534;padding:4px 10px;border-radius:999px;font-size:12px;display:inline-block;">
                                    Aktif
                                </span>
                            @else
                                <span style="background:#fee2e2;color:#b91c1c;padding:4px 10px;border-radius:999px;font-size:12px;display:inline-block;">
                                    Nonaktif
                                </span>
                            @endif
                        </td>

                        <td style="padding:10px 14px;text-align:center;vertical-align:middle;">
                            <a href="{{ route('admin.kesmas.parameters.edit', $p->id) }}"
                               style="padding:6px 12px;background:#2563eb;color:white;border-radius:8px;font-size:12px;text-decoration:none;margin-right:6px;">
                                Edit
                            </a>

                            <form action="{{ route('admin.kesmas.parameters.destroy', $p->id) }}"
                                  method="POST" style="display:inline;">
                                @csrf @method('DELETE')
                                <button onclick="return confirm('Hapus parameter ini?')"
                                        style="padding:6px 12px;background:#dc2626;color:white;border:none;border-radius:8px;font-size:12px;">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="padding:20px;text-align:center;color:#64748b;">
                            Tidak ada data parameter.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
