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
            font-size: 17px;
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
    REKAPITULASI PENGAWASAN TERTIB USAHA JASA KONSTRUKSI UNTUK USAHA ORANG PERSEORANGAN TAHUNAN  <br>
        @if($status != 'k04')
            PROVINSI KALIMANTAN SELATAN
        @endif
    </div>
    @if($status != 'rk04')
    <div class="container">
        <!-- Konten Tabel Pertama -->
        <div class="content">
            <table>
                <thead>
                    <tr>
                        <th style="width:5%">No</th>
                        <th>NIB</th>
                        <th>Nama Usaha Orang Perseorangan</th>
                        <th>Nomer Sertifikat Standar yang telah terverifikasi</th>
                        <th>Alamat</th>
                        <th>Hasil Pengawasan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dataK04 as $index => $k04)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $k04->nib }}</td>
                        <td>{{ $k04->nama_usaha }}</td>
                        <td>{{ $k04->no_sertif }}</td>
                        <td>{{ $k04->alamat }}</td>
                        <td>{{ $k04->hasil }}</td>
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
                        <th style="width:5%">No</th>
                        <th>Kabupaten / Kota </th>
                        <th>NIB</th>
                        <th>Nama Usaha Orang Perseorangan</th>
                        <th>Nomer Sertifikat Standar yang telah terverifikasi</th>
                        <th>Alamat</th>
                        <th>Hasil Pengawasan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dataK04 as $index => $k04)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>Hulu Sungai Tengah</td>
                        <td>{{ $k04->nib }}</td>
                        <td>{{ $k04->nama_usaha }}</td>
                        <td>{{ $k04->no_sertif }}</td>
                        <td>{{ $k04->alamat }}</td>
                        <td>{{ $k04->hasil }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif
</body>
</html>
