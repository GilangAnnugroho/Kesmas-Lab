@extends('layouts.app')

@section('title', 'Input / Edit Hasil Pemeriksaan')

@push('styles')
<style>
    .section-title {
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 14px;
        color:#0f172a;
    }

    .param-card {
        background: white;
        padding: 16px;
        border-radius: 14px;
        box-shadow: 0 10px 25px rgba(15,23,42,.08);
        border:1px solid #e5e7eb;
        margin-bottom: 20px;
    }

    .input-small {
        width:100%;
        padding:6px 8px;
        border-radius:8px;
        border:1px solid #d1d5db;
        font-size:13px;
    }

    .btn-save {
        padding:10px 20px;
        background:#2563eb;
        color:white;
        border-radius:10px;
        border:none;
        font-weight:600;
        cursor:pointer;
        box-shadow:0 12px 30px rgba(37,99,235,.35);
    }

    .btn-back {
        padding:10px 20px;
        background:#e5e7eb;
        color:#111827;
        border-radius:10px;
        border:none;
        font-weight:600;
        text-decoration:none;
        display:inline-block;
        margin-left:8px;
    }
</style>
@endpush

@section('content')

@php
    // Kelompokkan item pemeriksaan berdasarkan kategori parameter
    $itemsMikro = $registration->items->filter(function ($item) {
        return $item->parameter && $item->parameter->kategori === 'mikrobiologi';
    });

    $itemsKimia = $registration->items->filter(function ($item) {
        return $item->parameter && $item->parameter->kategori === 'kimia';
    });

    // Ambil satu record hasil yang punya catatan (jika ada) untuk prefill textarea
    $result_record = $registration->results()
        ->whereNotNull('catatan_petugas')
        ->first();
@endphp

<div class="card">
    <h3 style="font-size:20px;font-weight:600;margin-bottom:14px;">
        Hasil Pemeriksaan – {{ $registration->no_registrasi }}
    </h3>

    <p style="font-size:14px;margin-bottom:8px;">
        <strong>Nama Sampel:</strong> {{ $registration->client->nama }}
    </p>
    <p style="font-size:14px;margin-bottom:18px;">
        <strong>Jenis Pemeriksaan:</strong> {{ $registration->jenis_pemeriksaan }}
    </p>
</div>

<form action="{{ route('admin.kesmas.results.update', $registration->id) }}" method="POST">
    @csrf
    @if($itemsMikro->count() > 0)
        <div class="param-card">
            <div class="section-title">Mikrobiologi</div>

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
                        @foreach($itemsMikro as $item)
                            @php
                                $param  = $item->parameter;
                                $result = $item->result;
                                $selectedInterpretasi = old('results.'.$item->id.'.keterangan', $result->keterangan ?? '');
                            @endphp
                            <tr style="border-bottom:1px solid #111827;">
                                {{-- Parameter (sama seperti Ringkasan) --}}
                                <td style="padding:8px 12px;">
                                    {{ $param->nama_parameter }}
                                </td>

                                {{-- Input Hasil --}}
                                <td style="padding:8px 12px;">
                                    <input type="text"
                                           name="results[{{ $item->id }}][nilai_angka]"
                                           placeholder="Isi nilai hasil"
                                           class="input-small"
                                           value="{{ old('results.'.$item->id.'.nilai_angka', $result->nilai_angka ?? $result->hasil_text ?? '') }}">
                                </td>

                                {{-- Nilai Rujukan: hanya teks (tidak hidden) --}}
                                <td style="padding:8px 12px;">
                                    {{ $param->nilai_rujukan ?? '-' }}
                                </td>

                                {{-- Interpretasi --}}
                                <td style="padding:8px 12px;">
                                    <select name="results[{{ $item->id }}][keterangan]" class="input-small">
                                        <option value="">-- Pilih Interpretasi --</option>
                                        <option value="Normal" {{ $selectedInterpretasi === 'Normal' ? 'selected' : '' }}>Normal</option>
                                        <option value="Tidak Normal" {{ $selectedInterpretasi === 'Tidak Normal' ? 'selected' : '' }}>Tidak Normal</option>
                                    </select>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif

    @if($itemsKimia->count() > 0)
        <div class="param-card">
            <div class="section-title">Kimia</div>

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
                        @foreach($itemsKimia as $item)
                            @php
                                $param  = $item->parameter;
                                $result = $item->result;
                                $selectedInterpretasi = old('results.'.$item->id.'.keterangan', $result->keterangan ?? '');
                            @endphp
                            <tr style="border-bottom:1px solid #111827;">
                                {{-- Parameter --}}
                                <td style="padding:8px 12px;">
                                    {{ $param->nama_parameter }}
                                </td>

                                {{-- Input Hasil --}}
                                <td style="padding:8px 12px;">
                                    <input type="text"
                                           name="results[{{ $item->id }}][nilai_angka]"
                                           placeholder="Isi nilai hasil"
                                           class="input-small"
                                           value="{{ old('results.'.$item->id.'.nilai_angka', $result->nilai_angka ?? $result->hasil_text ?? '') }}">
                                </td>

                                {{-- Nilai Rujukan --}}
                                <td style="padding:8px 12px;">
                                    {{ $param->nilai_rujukan ?? '-' }}
                                </td>

                                {{-- Interpretasi --}}
                                <td style="padding:8px 12px;">
                                    <select name="results[{{ $item->id }}][keterangan]" class="input-small">
                                        <option value="">-- Pilih Interpretasi --</option>
                                        <option value="Normal" {{ $selectedInterpretasi === 'Normal' ? 'selected' : '' }}>Normal</option>
                                        <option value="Tidak Normal" {{ $selectedInterpretasi === 'Tidak Normal' ? 'selected' : '' }}>Tidak Normal</option>
                                    </select>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif

    <div class="card">
        <label style="font-weight:600;">Catatan Petugas:</label>
        <textarea name="catatan_petugas"
                  style="width:100%;min-height:90px;border-radius:10px;border:1px solid #d1d5db;padding:10px;">{{ old('catatan_petugas', $result_record->catatan_petugas ?? '') }}</textarea>
    </div>

    <div style="margin-top:16px;">
        <button class="btn-save">💾 Simpan Hasil Pemeriksaan</button>
        <a href="{{ route('admin.kesmas.registrations.show', $registration->id) }}" class="btn-back">
            Kembali 
        </a>
    </div>

</form>

@endsection

@push('scripts')
<script>
</script>
@endpush
