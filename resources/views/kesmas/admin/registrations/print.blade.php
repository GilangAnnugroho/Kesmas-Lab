<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Print Registrasi - {{ $registration->no_registrasi }}</title>

    <style>
        @page { size: A4; margin: 20mm; }

        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 13px;
            color: #000;
            background: #fff;
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
            margin-bottom: 18px;
        }

        .header img {
            width: 68px;
            height: 68px;
            object-fit: contain;
        }

        .header-table {
            width: 100%;
            margin-bottom: 10px;
        }

        .title {
            font-size: 15px;
            font-weight: bold;
            margin-top: 4px;
        }

        .subtitle {
            font-size: 14px;
            font-weight: bold;
        }

        .address {
            font-size: 12px;
            margin-top: 2px;
        }

        .section-title {
            font-size: 14px;
            font-weight: bold;
            margin-top: 18px;
            margin-bottom: 6px;
            text-transform: uppercase;
        }

        table.data-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 6px;
        }

        table.data-table td {
            padding: 4px 6px;
            vertical-align: top;
        }

        .label {
            width: 180px;
            font-weight: bold;
        }

        ul {
            margin: 0;
            padding-left: 18px;
        }

        .footer {
            margin-top: 40px;
            display: flex;
            justify-content: space-between;
        }

        .sign-box {
            width: 200px;
            text-align: center;
        }

        .sign-line {
            margin-top: 50px;
            border-top: 1px solid #000;
            width: 100%;
        }

        @media print {
            .no-print { display: none !important; }
        }
    </style>
</head>
<body>

<div class="no-print" style="margin-bottom:12px;">
    <button onclick="window.print()" 
            style="padding:8px 14px;background:#2563eb;color:white;border:none;border-radius:6px;font-size:14px;cursor:pointer;">
        🖨️ Print / Download PDF
    </button>

    <a href="{{ url()->previous() }}" 
       style="padding:8px 14px;background:#6b7280;color:white;border:none;border-radius:6px;font-size:14px;text-decoration:none;margin-left:6px;">
        ⬅️ Kembali
    </a>
</div>

<table class="header-table">
    <tr>
        <td style="width:68px;text-align:left;">
            <img src="{{ public_path('/img/dinas.png') }}" alt="Logo Dinas">
        </td>

        <td class="header">
            <div class="subtitle">PEMERINTAH KABUPATEN CIREBON</div>
            <div class="subtitle">DINAS KESEHATAN</div>
            <div class="title">UPTD LABORATORIUM KESEHATAN DAERAH</div>
            <div class="address">Jl. R. Dewi Sartika No. 134 Telp (0231) 321516 Hp. 08112412155</div>
            <div class="title" style="margin-top:10px;text-decoration:underline;">
                FORMULIR REGISTRASI PEMERIKSAAN KESMAS
            </div>
        </td>

        <td style="width:68px;text-align:right;">
            <img src="{{ public_path('/img/lab.png') }}" alt="Logo Labkesda">
        </td>
    </tr>
</table>

<div class="section-title">DATA REGISTRASI</div>

<table class="data-table">
    <tr>
        <td class="label">No Registrasi</td>
        <td>: {{ $registration->no_registrasi }}</td>
    </tr>
    <tr>
        <td class="label">Nama Sampel / Pengguna</td>
        <td>: {{ $registration->client->nama }}</td>
    </tr>
    <tr>
        <td class="label">Identitas Pengirim</td>
        <td>: {{ $registration->identitas_pengirim }}</td>
    </tr>
    <tr>
        <td class="label">Lokasi Pengambilan</td>
        <td>: {{ $registration->lokasi_pengambilan }}</td>
    </tr>
    <tr>
        <td class="label">Jenis Sampel</td>
        <td>: {{ $registration->jenis_sampel }}</td>
    </tr>
    <tr>
        <td class="label">Jenis Pemeriksaan</td>
        <td>: {{ $registration->jenis_pemeriksaan }}</td>
    </tr>
    <tr>
        <td class="label">Status Pembayaran</td>
        <td>: {{ ucfirst($registration->status_pembayaran) }}</td>
    </tr>
</table>

<div class="section-title">PEMERIKSAAN DIMINTA</div>

<table class="data-table">
    <tr>
        <td class="label">Mikrobiologi</td>
        <td>
            @if($registration->mikrobiologi)
                <ul>
                    @foreach($registration->mikrobiologi as $m)
                        <li>{{ ucfirst(str_replace('_',' ', $m)) }}</li>
                    @endforeach
                </ul>
            @else
                : -
            @endif
        </td>
    </tr>

    <tr>
        <td class="label">Kimia</td>
        <td>
            @if($registration->kimia)
                <ul>
                    @foreach($registration->kimia as $k)
                        <li>{{ ucfirst(str_replace('_',' ', $k)) }}</li>
                    @endforeach
                </ul>
            @else
                : -
            @endif
        </td>
    </tr>
</table>

<div class="footer">
    <div class="sign-box">
        <div>Tanggal Cetak</div>
        <div>{{ now()->format('d/m/Y') }}</div>
    </div>

    <div class="sign-box">
        <div>Petugas Penerima</div>
        <div class="sign-line"></div>
    </div>
</div>

</body>
</html>
