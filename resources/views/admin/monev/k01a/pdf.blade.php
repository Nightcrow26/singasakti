<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekapitulasi Pengawasan Tertib Usaha Jasa Konstruksi Tahunan</title>
    <style>
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
        REKAPITULASI PENGAWASAN TERTIB USAHA JASA KONSTRUKSI TAHUNAN (USAHA RANTAI PASOK)<br>
        @if($status != 'k01a')
            PROVINSI KALIMANTAN SELATAN
        @endif
    </div>
    @if($status != 'rk01a')
    <div class="container">
        <!-- Konten Tabel Pertama -->
        <div class="content">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIB</th>
                        <th>Nama Usaha Rantai Pasok</th>
                        <th>PJBU</th>
                        <th>Kepemilikan dan keabsahan perizinan berusaha</th>
                        <th>Kepemilikan dan keabsahan perizinan penggunaan material, peralatan dan teknologi</th>
                        <th>Pencatatan dalam SIMPK</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dataK01a as $index => $k01a)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $k01a->nib }}</td>
                        <td>{{ $k01a->nm_usaha_rantai_pasok }}</td>
                        <td> {{$k01a->pjbu}} </td>
                        <td> {{$k01a->kep_keab_perizinan_berusaha}} </td>
                        <td> {{$k01a->kep_keab_perizinan_teknologi}} </td>
                        <td> {{$k01a->pencatatan_dalam_simpk}} </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @else
    <div class="container">
        <!-- Konten Tabel Pertama -->
        <div class="content">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kabupaten / Kota</th>
                        <th>NIB</th>
                        <th>Nama Usaha Rantai Pasok</th>
                        <th>PJBU</th>
                        <th>Kepemilikan dan keabsahan perizinan berusaha</th>
                        <th>Kepemilikan dan keabsahan perizinan penggunaan material, peralatan dan teknologi</th>
                        <th>Pencatatan dalam SIMPK</th>
                        
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dataK01a as $index => $k01a)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>Hulu Sungai Tengah</td>
                        <td>{{ $k01a->nib }}</td>
                        <td>{{ $k01a->nm_usaha_rantai_pasok }}</td>
                        <td> {{$k01a->pjbu}} </td>
                        <td> {{$k01a->kep_keab_perizinan_berusaha}} </td>
                        <td> {{$k01a->kep_keab_perizinan_teknologi}} </td>
                        <td> {{$k01a->pencatatan_dalam_simpk}} </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif
</body>
</html>
