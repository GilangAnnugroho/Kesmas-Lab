<!DOCTYPE html>
<html lang="id" data-theme="light">
<head>
    <meta charset="UTF-8">
    <title>Formulir Permintaan Pemeriksaan Kesmas</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@500;600;700&display=swap" rel="stylesheet">

    {{-- THEME CSS --}}
    <style>
        :root{
            --bg-body:#e0f2fe;
            --sheet-bg:rgba(255,255,255,0.96);
            --primary:#2563eb;
            --accent:#06b6d4;
            --border:#e5e7eb;
            --border-strong:#9ca3af;
            --text:#0f172a;
            --muted:#6b7280;
            --radius:20px;
            --shadow:0 22px 60px rgba(15,23,42,.32);
            --blur:16px;
            --chip-bg:#eff6ff;
            --chip-text:#1d4ed8;
        }

        [data-theme="dark"]{
            --bg-body:#020617;
            --sheet-bg:rgba(15,23,42,0.96);
            --primary:#6366f1;
            --accent:#22d3ee;
            --border:#1f2937;
            --border-strong:#4b5563;
            --text:#e5e7eb;
            --muted:#9ca3af;
            --chip-bg:#1d2755;
            --chip-text:#e0e7ff;
            --shadow:0 28px 80px rgba(0,0,0,.9);
        }

        *{box-sizing:border-box;margin:0;padding:0;}
        body{
            background:radial-gradient(circle at top,#bfdbfe,#eff6ff);
            display:flex;
            justify-content:center;
            align-items:center;
            padding:16px;
            min-height:100vh;
            font-family:'Inter',sans-serif;
            color:var(--text);
            transition:.25s ease;
        }

        .sheet{
            width:100%;
            max-width:960px;
            background:var(--sheet-bg);
            border-radius:var(--radius);
            padding:22px;
            box-shadow:var(--shadow);
            border:1px solid var(--border-strong);
            position:relative;
            overflow:hidden;
            backdrop-filter:blur(var(--blur));
        }

        .theme-btn{
            position:absolute;
            top:12px;
            right:12px;
            padding:6px 12px;
            font-size:12px;
            border-radius:999px;
            border:1px solid var(--border);
            background:rgba(255,255,255,.7);
            cursor:pointer;
            color:#0f172a;
        }
        [data-theme="dark"] .theme-btn{
            background:rgba(0,0,0,.4);
            color:#ffffff;
        }

        .header{
            display:flex;
            align-items:center;
            justify-content:space-between;
            gap:12px;
            border-bottom:2px solid var(--border-strong);
            padding-bottom:12px;
            margin-bottom:16px;
        }
        .header img{
            width:60px;
            height:60px;
            object-fit:contain;
        }
        .header-center{
            text-align:center;
        }
        .header-center div{
            margin:2px 0;
        }
        .title-main{
            display:inline-block;
            margin-top:6px;
            padding:6px 14px;
            background:linear-gradient(90deg,#dbeafe33,#ccfbf122);
            border:1px solid var(--border);
            border-radius:999px;
            font-weight:700;
            letter-spacing:.12em;
            font-size:11px;
        }

        .info-grid{
            display:grid;
            grid-template-columns:1fr;
            gap:14px;
        }
        @media(min-width:850px){
            .info-grid{ grid-template-columns:1fr 1fr; }
        }
        .field-row{
            display:flex;
            align-items:start;
            gap:6px;
            margin-bottom:6px;
        }
        .field-label{
            min-width:150px;
            font-size:12px;
            font-weight:600;
        }
        .field-colon{ flex-shrink:0; }
        .field-input{ flex:1; }
        .field-input input,
        .field-input select,
        .field-input textarea{
            width:100%;
            padding:7px 9px;
            border-radius:8px;
            background:rgba(248,250,252,.9);
            border:1px solid var(--border);
            color:var(--text);
            font-size:12px;
        }
        [data-theme="dark"] .field-input input,
        [data-theme="dark"] .field-input textarea,
        [data-theme="dark"] .field-input select{
            background:#111827;
        }

        .status-row{
            margin-top:16px;
            padding:12px;
            background:linear-gradient(90deg,#dbeafe33,#bfdbfe22);
            border-radius:12px;
            border:1px dashed var(--border);
            display:flex;
            align-items:center;
            gap:12px;
            font-size:12px;
            flex-wrap:wrap;
        }

        .section-title{
            margin-top:20px;
            font-weight:700;
            text-transform:uppercase;
            font-size:11px;
            letter-spacing:.16em;
            border-top:1px solid var(--border-strong);
            padding-top:8px;
        }
        .section-subtitle{
            margin-bottom:6px;
            color:var(--muted);
            font-size:12px;
        }

        .exam-grid{
            display:grid;
            grid-template-columns:1fr;
            gap:16px;
        }
        @media(min-width:850px){
            .exam-grid{ grid-template-columns:1fr 1fr; }
        }
        .exam-card{
            padding:12px;
            border-radius:14px;
            border:1px solid var(--border-strong);
            background:linear-gradient(135deg,#ffffffdd,#dbeafeaa);
        }
        [data-theme="dark"] .exam-card{
            background:linear-gradient(135deg,#1e3a8a55,#0f172abb);
        }

        .exam-title{
            font-size:13px;
            font-weight:700;
            display:flex;
            justify-content:space-between;
            align-items:center;
        }
        .badge{
            font-size:10px;
            background:var(--chip-bg);
            padding:2px 6px;
            border-radius:999px;
            border:1px solid var(--border);
        }

        .checkbox-row{
            margin-top:4px;
            display:flex;
            align-items:center;
            gap:7px;
            font-size:12px;
        }
        .checkbox-row input{
            width:14px;
            height:14px;
        }

        .footer{
            margin-top:26px;
            display:flex;
            justify-content:space-between;
            gap:24px;
        }
        @media(max-width:700px){
            .footer{ flex-direction:column; }
        }

        .footer-left textarea{
            width:100%;
            padding:7px 9px;
            border-radius:8px;
            border:1px solid var(--border);
            font-size:12px;
            background:rgba(248,250,252,.9);
            color:var(--text);
            min-height:60px;
        }

        .footer-right{
            margin-left:auto;
            text-align:right;
        }

        .footer-right input[type="date"]{
            padding:6px 9px;
            border-radius:8px;
            border:1px solid var(--border);
            font-size:12px;
            background:rgba(248,250,252,.9);
            color:var(--text);
        }

        [data-theme="dark"] .footer-left textarea,
        [data-theme="dark"] .footer-right input[type="date"]{
            background:#111827;
            color:var(--text);
            border-color:var(--border-strong);
        }

        .sign-line{
            border-top:1px solid var(--border-strong);
            width:180px;
            margin-top:36px;
            margin-left:auto;
        }

        .submit-box{
            margin-top:24px;
            text-align:center;
        }
        .submit-btn{
            padding:10px 26px;
            background:linear-gradient(90deg,#2563eb,#06b6d4);
            border:none;
            border-radius:999px;
            box-shadow:0 10px 24px rgba(0,0,0,.25);
            color:white;
            cursor:pointer;
            font-size:14px;
            font-weight:600;
        }
    </style>
</head>
<body>
<div class="sheet">

    {{-- ERROR GLOBAL (VALIDASI / EXCEPTION) --}}
    @if($errors->any())
        <div style="
            margin-bottom:14px;
            padding:10px 12px;
            border-radius:10px;
            background:#fee2e2;
            color:#991b1b;
            border:1px solid #fecaca;
            font-size:12px;
        ">
            @foreach($errors->all() as $error)
                <div>- {{ $error }}</div>
            @endforeach
        </div>
    @endif

    {{-- THEME TOGGLE --}}
    <button class="theme-btn" id="themeToggle">
        🌙 Dark Mode
    </button>

    {{-- HEADER --}}
    <header class="header">
        <img src="/img/dinas.png" alt="Dinas Kesehatan">
        <div class="header-center">
            <div>PEMERINTAH KABUPATEN CIREBON</div>
            <div>DINAS KESEHATAN</div>
            <div>UPTD LABKESDA</div>
            <div style="font-size:11px;color:var(--muted);">
                Jl. R. Dewi Sartika No. 134 Telp (0231) 321516 Hp. 08112412155
            </div>
            <div class="title-main">FORMULIR PERMINTAAN PEMERIKSAAN KESMAS</div>
        </div>
        <img src="/img/lab.png" alt="Labkesda">
    </header>

    {{-- FORM --}}
    <form action="{{ route('kesmas.public.store') }}" method="POST">
        @csrf

        {{-- BLOK INFORMASI PENGIRIM --}}
        <div class="info-grid">

            {{-- KIRI --}}
            <div>
                @include('components.field', [
                    'label'=>'Nama Sampel/Pengguna',
                    'name'=>'nama_sampel'
                ])

                @include('components.field', [
                    'label'=>'Identitas Pengirim / No Hp',
                    'name'=>'identitas_pengirim'
                ])

                @include('components.field', [
                    'label'=>'Lokasi Pengambilan',
                    'name'=>'lokasi_pengambilan'
                ])

                @include('components.field', [
                    'label'=>'Jenis Sampel',
                    'name'=>'jenis_sampel'
                ])

                @include('components.field', [
                    'label'=>'Jenis Pemeriksaan',
                    'name'=>'jenis_pemeriksaan'
                ])
            </div>

            {{-- KANAN --}}
            <div>
                @include('components.field', [
                    'label'=>'Petugas Sampling',
                    'name'=>'petugas_sampling'
                ])

                @include('components.field', [
                    'label'=>'Alamat Petugas Sampling',
                    'name'=>'alamat_petugas_sampling'
                ])

                @include('components.field-date', [
                    'label'=>'Tanggal & Jam Pengambilan Sampel',
                    'date_name'=>'tgl_pengambilan',
                    'time_name'=>'jam_pengambilan'
                ])

                @include('components.field-date', [
                    'label'=>'Tanggal Permintaan',
                    'date_name'=>'tgl_permintaan',
                    'time_name'=>null
                ])

                @include('components.field-date', [
                    'label'=>'Tanggal & Jam Penerimaan Sampel',
                    'date_name'=>'tgl_penerimaan',
                    'time_name'=>'jam_penerimaan'
                ])

                @include('components.field', [
                    'label'=>'Volume Sampel',
                    'name'=>'volume_sampel'
                ])
            </div>

        </div>

        {{-- STATUS PEMBAYARAN --}}
        <div class="status-row">
            <label>Status Pembayaran:</label>
            <select name="status_pembayaran">
                <option value="">-- pilih status --</option>
                <option value="lunas" {{ old('status_pembayaran')=='lunas' ? 'selected' : '' }}>Lunas</option>
                <option value="belum_lunas" {{ old('status_pembayaran')=='belum_lunas' ? 'selected' : '' }}>Belum Lunas</option>
            </select>
            <span style="font-size:12px;color:var(--muted);">
                * diverifikasi petugas loket
            </span>
        </div>

        {{-- PEMERIKSAAN --}}
        <div class="section-title">Pemeriksaan yang diminta harap diberi tanda</div>
        <div class="section-subtitle">Boleh memilih lebih dari satu kategori</div>

        <div class="exam-grid">

            {{-- Mikrobiologi --}}
            <div class="exam-card">
                <div class="exam-title">
                    <span>Mikrobiologi</span>
                    <span class="badge">Multi pilih</span>
                </div>

                @include('kesmas.public.partials.mikrobiologi')
            </div>

            {{-- Kimia --}}
            <div class="exam-card">
                <div class="exam-title">
                    <span>Kimia</span>
                    <span class="badge">Multi pilih</span>
                </div>

                @include('kesmas.public.partials.kimia')
            </div>

        </div>

        {{-- FOOTER --}}
        <div class="footer">
            <div class="footer-right">
                <label>Tanggal:</label>
                <input type="date" name="tanggal_footer" value="{{ old('tanggal_footer') }}">
                <div class="sign-line"></div>
                <div style="text-align:right;margin-top:4px;">Paraf Petugas</div>
            </div>
        </div>

        {{-- SUBMIT --}}
        <div class="submit-box">
            <button type="submit" class="submit-btn">
                ✔ Submit Pendaftaran
            </button>
        </div>

    </form>
</div>

<script src="/js/kesmas-theme.js"></script>
</body>
</html>
