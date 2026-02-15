@extends('layouts.app')

@section('title', 'Edit Parameter')

@section('content')

<div class="card">
    <h3 style="font-size:20px;font-weight:600;margin-bottom:14px;">Edit Parameter Pemeriksaan</h3>

    {{-- Notifikasi error validasi --}}
    @if ($errors->any())
        <div style="margin-bottom:12px;padding:10px 12px;border-radius:10px;background:#fee2e2;color:#b91c1c;font-size:13px;">
            <ul style="margin:0;padding-left:18px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.kesmas.parameters.update', $parameter->id) }}">
        @csrf
        @method('PUT')

        <div style="display:grid;gap:14px;">

            <div>
                <label>Jenis Parameter</label>
                @php
                    $selectedKategori = old('kategori', $parameter->kategori);
                @endphp
                <select name="kategori" id="kategori" required
                        style="width:100%;padding:8px;border-radius:10px;border:1px solid #d1d5db;">
                    <option value="mikrobiologi" {{ $selectedKategori=='mikrobiologi' ? 'selected' : '' }}>Mikrobiologi</option>
                    <option value="kimia" {{ $selectedKategori=='kimia' ? 'selected' : '' }}>Kimia</option>
                </select>
            </div>

            <div>
                <label>Nama Parameter</label>
                <input type="text"
                       name="nama_parameter"
                       required
                       value="{{ old('nama_parameter', $parameter->nama_parameter) }}"
                       placeholder="Isi nama parameter"
                       style="width:100%;padding:8px;border-radius:10px;border:1px solid #d1d5db;">
                @error('nama_parameter')
                    <div style="margin-top:4px;color:#b91c1c;font-size:12px;">
                        {{ $message }}
                    </div>
                @enderror
                <small style="display:block;margin-top:4px;color:#9ca3af;font-size:12px;">
                    Kombinasi jenis + nama parameter harus unik. Jika sudah ada Mikrobiologi - Air Bersih, tidak bisa dibuat lagi yang sama.
                </small>
            </div>

            <div>
                <label>Nilai Rujukan (opsional)</label>
                <input type="text" name="nilai_rujukan"
                       value="{{ old('nilai_rujukan', $parameter->nilai_rujukan) }}"
                       placeholder="misal: <50, Negatif"
                       style="width:100%;padding:8px;border-radius:10px;border:1px solid #d1d5db;">
            </div>

            <div>
                <label style="display:flex;align-items:center;gap:8px;">
                    <input type="checkbox" name="aktif" value="1"
                           {{ old('aktif', $parameter->aktif) ? 'checked' : '' }}>
                    <span>Aktif digunakan</span>
                </label>
            </div>

        </div>

        <div style="margin-top:18px;display:flex;gap:10px;">
            <button type="submit"
                    style="padding:10px 18px;background:#2563eb;color:white;border:none;border-radius:10px;font-weight:600;">
                Update Parameter
            </button>

            <a href="{{ route('admin.kesmas.parameters.index') }}"
               style="padding:10px 18px;background:#e5e7eb;color:#111827;border-radius:10px;font-weight:600;text-decoration:none;">
                Kembali
            </a>
        </div>

    </form>
</div>

@endsection
