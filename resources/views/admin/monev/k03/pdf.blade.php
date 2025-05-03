<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekapitulasi Pengawasan</title>
    <style>
        @page {
            size: A4 landscape;
            margin: 10mm;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            height: 100%;
            word-wrap: break-word;
        }

        .page-title {
            margin-top: 0px;
            font-size: 20px;
            font-weight: bold;
            text-transform: uppercase;
            text-align: center;
            line-height: 1.5;
        }

        table {
            border: 1px solid black;
            border-collapse: collapse;
            width: 100%;
            table-layout: fixed;
            page-break-inside: auto; /* Untuk mencegah tabel terpotong */
        }

        th, td {
            text-align: center;
            vertical-align: top;
            padding: 4px; /* Menurunkan padding untuk mencegah potongan */
            color: rgb(0, 0, 0);
            font-size: 12px; /* Mengurangi ukuran font agar tabel tidak terpotong */
            border: 1px solid black; /* Menambahkan border pada setiap sel */
        }

        th {
            background-color: #f2f2f2;
        }

        .content {
            margin-top: 50px;
        }

        .page-break {
            page-break-after: always;
        }

        /* Untuk memastikan konten tetap muat dalam satu halaman */
        .container {
            max-width: 100%;
            overflow: auto;
        }
    </style>
</head>
<body>
    <!-- Halaman Judul -->
    <div class="page-title">
        REKAPITULASI PENGAWASAN TERTIB PEMANFAATAN JASA KONSTRUKSI TAHUNAN <br>
        @if($status != 'k03')
            PROVINSI KALIMANTAN SELATAN
        @endif
    </div>
    @if($status != 'rk03')
    <div class="container">
        <!-- Konten Tabel Pertama -->
        <div class="content">
            <table>
            <thead>
                    <tr>
                        <th rowspan="2" style="width:3%">No</th>
                        <th rowspan="2">Nama Bangunan Konstruksi</th>
                        <th rowspan="2">Nomor Kontrak (Pembangunan)</th>
                        <th rowspan="2">Lokasi</th>
                        <th rowspan="2">Tanggal dan Tahun Pembangunan</th>
                        <th rowspan="2">Tanggal dan Tahun Pembangunan</th>
                        <th rowspan="2">Umur Konstruksi</th>
                        <th colspan="2">Fungsi Peruntukannya</th>
                        <th rowspan="2">Rencana Umur Konstruksi</th>
                        <th rowspan="2">Kapasitas dan Beban</th>
                        <th colspan="2">Pemeliharaan Produk Konstruksi</th>
                        
                    </tr>
                    <tr>
                        <th >Kesesuaian Fungsi</th>
                        <th>Kesesuaian Lokasi</th>
                        <th>Pemeliharaan Bangunan</th>
                        <th>Program Pemeliharaan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dataK03 as $index => $k03)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $k03->nama_bangunan }}</td>
                        <td>{{ $k03->no_kontrak }}</td>
                        <td>{{ $k03->lokasi }}</td>
                        <td>{{ $k03->tgl_thn_pembangunan }}</td>
                        <td>{{ $k03->tgl_thn_pemanfaatan }}</td>
                        <td>{{ $k03->umur_konstruksi }}</td>
                        <td>{{ $k03->kesesuaian_fungsi }}</td>
                        <td>{{ $k03->kesesuaian_lokasi }}</td>
                        <td>{{ $k03->rencana_umur }}</td>
                        <td>{{ $k03->kapasitas_beban }}</td>
                        <td>{{ $k03->pemeliharaan_bangunan }}</td>
                        <td>{{ $k03->program_pemeliharaan }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @else
    <div class="container">
        <div class="content">
            <table>
                <thead>
                    <tr>
                        <th rowspan="2" style="width:3">No</th>
                        <th rowspan="2">Kabupaten / Kota</th>
                        <th rowspan="2">Nomor Kontrak (Pembangunan)</th>
                        <th rowspan="2">Lokasi</th>
                        <th rowspan="2">Tanggal dan Tahun Pembangunan</th>
                        <th rowspan="2">Tanggal dan Tahun Pembangunan</th>
                        <th rowspan="2">Umur Konstruksi</th>
                        <th colspan="2">Fungsi Peruntukannya</th>
                        <th rowspan="2">Rencana Umur Konstruksi</th>
                        <th rowspan="2">Kapasitas dan Beban</th>
                        <th colspan="2">Pemeliharaan Produk Konstruksi</th>
                        
                    </tr>
                    <tr>
                        <th>Kesesuaian Fungsi</th>
                        <th>Kesesuaian Lokasi</th>
                        <th>Pemeliharaan Bangunan</th>
                        <th>Program Pemeliharaan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dataK03 as $index => $k03)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>Hulu Sungai Tengah</td>
                        <td>{{ $k03->no_kontrak }}</td>
                        <td>{{ $k03->lokasi }}</td>
                        <td>{{ $k03->tgl_thn_pembangunan }}</td>
                        <td>{{ $k03->tgl_thn_pemanfaatan }}</td>
                        <td>{{ $k03->umur_konstruksi }}</td>
                        <td>{{ $k03->kesesuaian_fungsi }}</td>
                        <td>{{ $k03->kesesuaian_lokasi }}</td>
                        <td>{{ $k03->rencana_umur }}</td>
                        <td>{{ $k03->kapasitas_beban }}</td>
                        <td>{{ $k03->pemeliharaan_bangunan }}</td>
                        <td>{{ $k03->program_pemeliharaan }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif
</body>
</html>
