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
        REKAPITULASI PENGAWASAN TERTIB USAHA JASA KONSTRUKSI TAHUNAN (BUJK) <br>
        @if($status != 'k01b')
            PROVINSI KALIMANTAN SELATAN
        @endif
    </div>
    @if($status != 'rk01b')
    <div class="container">
        <!-- Konten Tabel Pertama -->
        <div class="content">
            <table>
            <thead>
                    <tr>
                        <th rowspan="2" style="width:3%">No</th>
                        <th rowspan="2">NIB</th>
                        <th rowspan="2">Nama Badan Usaha</th>
                        <th rowspan="2">PJBU</th>
                        <th colspan="4">Kesesuaian Kegiatan Konstruksi</th>
                        <th colspan="2">Kesesuaian kegiatan usaha Jasa Konstruksi dan segmentasi pasar Jasa Konstruksi</th>
                        <th colspan="2">Pemenuhan persyaratan usaha</th>
                        <th rowspan="2">Pelaksanaan pengembangan usaha berkelanjutan</th>
                        
                    </tr>
                    <tr>
                        <th>Jenis</th>
                        <th>Sifat</th>
                        <th>Klasifikasi</th>
                        <th>Layanan</th>
                        <th>Bentuk</th>
                        <th>Kualifikasi</th>
                        <th>SBU</th>
                        <th>NIB</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dataK01b as $index => $k01b)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $k01b->nib }}</td>
                        <td>{{ $k01b->nm_badan_usaha }}</td>
                        <td>{{ $k01b->pjbu }}</td>

                        <td>
                            @if($k01b->jenis == NULL)
                                Tidak Tertib
                            @else
                                Tertib
                            @endif
                        </td>
                        <td>
                            @if($k01b->sifat == NULL)
                                Tidak Tertib
                            @else
                                Tertib
                            @endif
                        </td>
                        <td>
                            @if($k01b->klasifikasi == NULL)
                                Tidak Tertib
                            @else
                                Tertib
                            @endif
                        </td>
                        <td>
                            @if($k01b->layanan == NULL)
                                Tidak Tertib
                            @else
                                Tertib
                            @endif
                        </td>
                        <td>
                            @if($k01b->bentuk == NULL)
                                Tidak Tertib
                            @else
                                Tertib
                            @endif
                        </td>
                        <td>
                            @if($k01b->kualifikasi == NULL)
                                Tidak Tertib
                            @else
                                Tertib
                            @endif
                        </td>
                        <td>
                            @if($k01b->pm_sbu == NULL)
                                Tidak Tertib
                            @else
                                Tertib
                            @endif
                        </td>
                        <td>
                            @if($k01b->pm_nib == NULL)
                                Tidak Tertib
                            @else
                                Tertib
                            @endif
                        </td>
                        <td>
                            @if($k01b->pl_peng_usaha_berkelanjutan == NULL)
                                Tidak Tertib
                            @else
                                Tertib
                            @endif
                        </td>
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
                        <th rowspan="2" style="width:3%">No</th>
                        <th rowspan="2">Kabupaten/Kota</th>
                        <th rowspan="2">NIB</th>
                        <th rowspan="2">Nama Badan Usaha</th>
                        <th rowspan="2">PJBU</th>
                        <th colspan="4">Kesesuaian Kegiatan Konstruksi</th>
                        <th colspan="2">Kesesuaian kegiatan usaha Jasa Konstruksi dan segmentasi pasar Jasa Konstruksi</th>
                        <th colspan="2">Pemenuhan persyaratan usaha</th>
                        <th rowspan="2">Pelaksanaan pengembangan usaha berkelanjutan</th>
                    </tr>
                    <tr>
                        <th>Jenis</th>
                        <th>Sifat</th>
                        <th>Klasifikasi</th>
                        <th>Layanan</th>
                        <th>Bentuk</th>
                        <th>Kualifikasi</th>
                        <th>SBU</th>
                        <th>NIB</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dataK01b as $index => $k01b)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $k01b->nib }}</td>
                        <td>{{ $k01b->nm_badan_usaha }}</td>
                        <td>{{ $k01b->pjbu }}</td>
                        <td>
                            @if($k01b->jenis == NULL)
                                Tidak Tertib
                            @else
                                Tertib
                            @endif
                        </td>
                        <td>
                            @if($k01b->sifat == NULL)
                                Tidak Tertib
                            @else
                                Tertib
                            @endif
                        </td>
                        <td>
                            @if($k01b->klasifikasi == NULL)
                                Tidak Tertib
                            @else
                                Tertib
                            @endif
                        </td>
                        <td>
                            @if($k01b->layanan == NULL)
                                Tidak Tertib
                            @else
                                Tertib
                            @endif
                        </td>
                        <td>
                            @if($k01b->bentuk == NULL)
                                Tidak Tertib
                            @else
                                Tertib
                            @endif
                        </td>
                        <td>
                            @if($k01b->kualifikasi == NULL)
                                Tidak Tertib
                            @else
                                Tertib
                            @endif
                        </td>
                        <td>
                            @if($k01b->pm_sbu == NULL)
                                Tidak Tertib
                            @else
                                Tertib
                            @endif
                        </td>
                        <td>
                            @if($k01b->pm_nib == NULL)
                                Tidak Tertib
                            @else
                                Tertib
                            @endif
                        </td>
                        <td>
                            @if($k01b->pl_peng_usaha_berkelanjutan == NULL)
                                Tidak Tertib
                            @else
                                Tertib
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif
</body>
</html>