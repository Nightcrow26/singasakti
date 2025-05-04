<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekapitulasi Pengawasan</title>
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
        REKAPITULASI PENGAWASAN TERTIB PENYELENGARAAN JASA KONSTRUKSI TAHUNAN <br>
        KEGIATAN KONSTRUKSI YANG DIBIAYAI DENGAN DANA DARI {{ $anggaran }}
        @if($status != 'k02')
            <br>
            PROVINSI KALIMANTAN SELATAN
        @endif
    </div>
    @if($status != 'rk02')
    <div class="container">
        <!-- Konten Tabel Pertama -->
        <div class="content">
            <table>
                <thead>
                    <tr>
                        <th rowspan="2">No</th>
                        <th rowspan="2">Kegiatan konstruksi (nama naket)</th>
                        <th rowspan="2">Nomor Kontrak</th>
                        <th rowspan="2">Nama BUJK</th>
                        <th rowspan="2">Proses pemilihan penyedia jasa</th>
                        <th colspan="3">Pengawasan terhadap kontrak kerja konstruksi </th>
                        <th colspan="3"> Pengawasan terhadap Penerapan Standar Keamanan, Keselamatan, Kesehatan, dan Keberlanjutan Konstruksi</th>
                        
                    </tr>
                    <tr>
                        <th>Penerapan Standar Kontrak</th>
                        <th>Penggunaan tenaga kerja konstruksi bersertifikat</th>
                        <th>Pemberian pekerjaan utama dan/atau penunjang kepada subpenyedia jasa</th>
                        <th>Ketersediaan dokumen standar K4</th>
                        <th>Penerapan SMKK</th>
                        <th>Kegiatan antisipasi kecelakaan kerja</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dataK02 as $index => $k02)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td style="white-space: nowrap;">{{ $k02->kegiatan_konstruksi }}</td>
                        <td style="white-space: nowrap;">{{ $k02->no_kontrak }}</td>
                        <td style="white-space: nowrap;">{{ $k02->nm_bujk }}</td>
                        <td>{{ $k02->proses_pemilihan_penyedia_jasa }}</td>
                        <td>{{ $k02->penerapan_standar_kontrak }}</td>
                        <td>{{ $k02->penggunaan_tenaga_kerja_bersertifikat }}</td>
                        <td>{{ $k02->pemberian_pekerjaan_utama_subpenyedia }}</td>
                        <td>{{ $k02->ketersediaan_dokumen_standar_k4 }}</td>
                        <td>{{ $k02->penerapan_smkk }}</td>
                        <td>{{ $k02->kegiatan_antisipasi_kecelakaan_kerja }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="page-break"></div>

        <!-- Konten Tabel Kedua -->
        <div class="content">
            <table>
                <thead>
                    <tr>
                        <th rowspan="2">No</th>
                        <th rowspan="2">Kegiatan konstruksi (nama naket)</th>
                        <th rowspan="2">Nomor Kontrak</th>
                        <th rowspan="2">Nama BUJK</th>
                        <th rowspan="2">Penerapan sistem manajemen mutu konstruksi</th>
                        <th colspan="3">Pengelolaan dan penggunaan material, peralatan dan teknologi konstruksi</th>
                        <th colspan="3">Pengelolaan dan pemanfaatan sumber material konstruksi</th>
                    </tr>
                    <tr>
                        <th>Pemenuhan penyediaan peralatan dalam pelaksanaan proyek konstruksi</th>
                        <th>Penggunaan material standar (SNI dan standar lain)</th>
                        <th>Penggunaan produk dalam negeri untuk teknologi dan MPK (material, peralatan konstruksi) sesuai dengan ketentuan perundang-undangan tentang pemberdayaan industri nasional</th>
                        <th>Pemenuhan terhadap standar mutu material</th>
                        <th>Pemenuhan terhadap standar teknis lingkungan</th>
                        <th>Pemenuhan terhadap standar keselamatan dan kesehatan kerja</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dataK02 as $index => $k02)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td style="white-space: nowrap;">{{ $k02->kegiatan_konstruksi }}</td>
                        <td style="white-space: nowrap;">{{ $k02->no_kontrak }}</td>
                        <td style="white-space: nowrap;">{{ $k02->nm_bujk }}</td>
                        <td>{{ $k02->penerapan_sistem_manajemen_mutu_konstruksi }}</td>
                        <td>{{ $k02->pemenuhan_peralatan_pelaksanaan_proyek }}</td>
                        <td>{{ $k02->penggunaan_material_standar }}</td>
                        <td>{{ $k02->penggunaan_produk_dalam_negeri }}</td>
                        <td>{{ $k02->pemenuhan_standar_mutu_material }}</td>
                        <td>{{ $k02->pemenuhan_standar_teknis_lingkungan }}</td>
                        <td>{{ $k02->pemenuhan_standar_k3 }}</td>
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
                        <th rowspan="2">No</th>
                        <th rowspan="2">Kabupaten / Kota</th>
                        <th rowspan="2">Nomor Kontrak</th>
                        <th rowspan="2">Nama BUJK</th>
                        <th rowspan="2">Proses pemilihan penyedia jasa</th>
                        <th colspan="3">Pengawasan terhadap kontrak kerja konstruksi </th>
                        <th colspan="3"> Pengawasan terhadap Penerapan Standar Keamanan, Keselamatan, Kesehatan, dan Keberlanjutan Konstruksi</th>
                        
                    </tr>
                    <tr>
                        <th>Penerapan Standar Kontrak</th>
                        <th>Penggunaan tenaga kerja konstruksi bersertifikat</th>
                        <th>Pemberian pekerjaan utama dan/atau penunjang kepada subpenyedia jasa</th>
                        <th>Ketersediaan dokumen standar K4</th>
                        <th>Penerapan SMKK</th>
                        <th>Kegiatan antisipasi kecelakaan kerja</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dataK02 as $index => $k02)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td style="white-space: nowrap;">Hulu Sungai Tengah</td>
                        <td style="white-space: nowrap;">{{ $k02->no_kontrak }}</td>
                        <td style="white-space: nowrap;">{{ $k02->nm_bujk }}</td>
                        <td>{{ $k02->proses_pemilihan_penyedia_jasa }}</td>
                        <td>{{ $k02->penerapan_standar_kontrak }}</td>
                        <td>{{ $k02->penggunaan_tenaga_kerja_bersertifikat }}</td>
                        <td>{{ $k02->pemberian_pekerjaan_utama_subpenyedia }}</td>
                        <td>{{ $k02->ketersediaan_dokumen_standar_k4 }}</td>
                        <td>{{ $k02->penerapan_smkk }}</td>
                        <td>{{ $k02->kegiatan_antisipasi_kecelakaan_kerja }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="page-break"></div>

        <!-- Konten Tabel Kedua -->
        <div class="content">
            <table>
                <thead>
                    <tr>
                        <th rowspan="2">No</th>
                        <th rowspan="2">Kegiatan konstruksi (nama naket)</th>
                        <th rowspan="2">Nomor Kontrak</th>
                        <th rowspan="2">Nama BUJK</th>
                        <th rowspan="2">Penerapan sistem manajemen mutu konstruksi</th>
                        <th colspan="3">Pengelolaan dan penggunaan material, peralatan dan teknologi konstruksi</th>
                        <th colspan="3">Pengelolaan dan pemanfaatan sumber material konstruksi</th>
                    </tr>
                    <tr>
                        <th>Pemenuhan penyediaan peralatan dalam pelaksanaan proyek konstruksi</th>
                        <th>Penggunaan material standar (SNI dan standar lain)</th>
                        <th>Penggunaan produk dalam negeri untuk teknologi dan MPK (material, peralatan konstruksi) sesuai dengan ketentuan perundang-undangan tentang pemberdayaan industri nasional</th>
                        <th>Pemenuhan terhadap standar mutu material</th>
                        <th>Pemenuhan terhadap standar teknis lingkungan</th>
                        <th>Pemenuhan terhadap standar keselamatan dan kesehatan kerja</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dataK02 as $index => $k02)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td style="white-space: nowrap;">{{ $k02->kegiatan_konstruksi }}</td>
                        <td style="white-space: nowrap;">{{ $k02->no_kontrak }}</td>
                        <td style="white-space: nowrap;">{{ $k02->nm_bujk }}</td>
                        <td>{{ $k02->penerapan_sistem_manajemen_mutu_konstruksi }}</td>
                        <td>{{ $k02->pemenuhan_peralatan_pelaksanaan_proyek }}</td>
                        <td>{{ $k02->penggunaan_material_standar }}</td>
                        <td>{{ $k02->penggunaan_produk_dalam_negeri }}</td>
                        <td>{{ $k02->pemenuhan_standar_mutu_material }}</td>
                        <td>{{ $k02->pemenuhan_standar_teknis_lingkungan }}</td>
                        <td>{{ $k02->pemenuhan_standar_k3 }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif
</body>
</html>
