<!DOCTYPE html>
<html>

<head>
    <title>Laporan Pengawasan Teknis</title>
</head>

<body>
    <table class="table table-bordered table-striped table-responsive  header-fixed">
        <thead class="bg bg-primary">
            <tr>
                <th> No</th>
                <th>
                    SOPD</th>
                <th>
                    Paket Pekerjaan
                </th>
                <th>
                    Latitude
                </th>
                <th>
                    Longitude
                </th>
                <th>
                    Fisik (%)</th>
                <th>
                    Keuangan</th>
                <th>
                    Sumber Dana</th>
                <th>
                    Nilai Pagu (Rp)</th>
                <th>
                    Pagu Kontrak (Rp)</th>
                <th>
                    Tanggal Kontrak</th>
                <th>
                    Nama Perusahaan Pelaksana
                </th>
                <th>
                    Nama Direktur Pelaksana
                </th>
                <th>
                    Alamat Perusahaan Pelaksana
                </th>
                <th>
                    No Telpon Pelaksana
                </th>
                <th>
                    Nama Perusahaan Perencana
                </th>
                <th>
                    Nama Direktur Perencana
                </th>
                <th>
                    Alamat Perusahaan Perencana
                </th>
                <th>
                    No Telpon Perencana
                </th>
                <th>
                    Nama Perusahaan Pengawas
                </th>
                <th>
                    Nama Direktur Pengawas
                </th>
                <th>
                    Alamat Perusahaan Pengawas
                </th>
                <th>
                    No Telpon Pengawas
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $a)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $a->skpd->nama }}</td>
                    <td>{{ $a->paket }}</td>
                    <td>{{ $a->latitude }}</td>
                    <td>{{ $a->longitude }}</td>
                    <td>{{ number_format($a->realisasi->realisasi_fisik, 0, ',', '.') }}</td>
                    <td>Rp. {{ number_format($a->realisasi->realisasi, 0, ',', '.') }}</td>
                    <td>{{ $a->sumber_dana }}</td>
                    <td>Rp. {{ number_format($a->pagu, 0, ',', '.') }}</td>
                    <td>Rp. {{ number_format($a->pagu_kontrak, 0, ',', '.') }}</td>
                    <td>{{ date('d-m-Y', strtotime($a->tgl_kontrak)) }}</td>
                    <td>{{ $a->nama_perusahaan }}</td>
                    <td>{{ $a->nama_direktur }}</td>
                    <td>{{ $a->alamat_perusahaan }}</td>
                    <td>{{ $a->telpon }}</td>
                    <td>{{ $a->nama_perusahaan_perencana }}</td>
                    <td>{{ $a->nama_direktur_perencana }}</td>
                    <td>{{ $a->alamat_perusahaan_perencana }}</td>
                    <td>{{ $a->telpon_perencana }}</td>
                    <td>{{ $a->nama_perusahaan_pengawas }}</td>
                    <td>{{ $a->nama_direktur_pengawas }}</td>
                    <td>{{ $a->alamat_perusahaan_pengawas }}</td>
                    <td>{{ $a->telpon_pengawas }}</td>
                </tr>
            @endforeach
        </tbody>

    </table>
</body>

</html>
