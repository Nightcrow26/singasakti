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
                <th>
                    U1
                </th>
                <th>
                    U2
                </th>
                <th>
                    U3
                </th>
                <th>
                    U4
                </th>
                <th>
                    U5
                </th>
                <th>
                    U6
                </th>
                <th>
                    U7
                </th>
                <th>
                    U8
                </th>
                <th>
                    U9
                </th>
                <th>
                    Status
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
                    <td>
                        @if ($a->berkas->up_1 == null)
                            x
                        @else
                            √
                        @endif
                    </td>
                    <td>
                        @if ($a->berkas->up_2 == null)
                            x
                        @else
                            √
                        @endif
                    </td>
                    <td>
                        @if ($a->berkas->up_3 == null)
                            x
                        @else
                            √
                        @endif
                    </td>
                    <td>
                        @if ($a->berkas->up_4 == null)
                            x
                        @else
                            √
                        @endif
                    </td>
                    <td>
                        @if ($a->berkas->up_5 == null)
                            x
                        @else
                            √
                        @endif
                    </td>
                    <td>
                        @if ($a->berkas->up_6 == null)
                            x
                        @else
                            √
                        @endif
                    </td>
                    <td>
                        @if ($a->berkas->up_7 == null)
                            x
                        @else
                            √
                        @endif
                    </td>
                    <td>
                        @if ($a->berkas->up_8 == null)
                            x
                        @else
                            √
                        @endif
                    </td>
                    <td>
                        @if ($a->berkas->up_9 == null)
                            x
                        @else
                            √
                        @endif
                    </td>
                    <td>
                        @php
                            $uploads = [
                                $a->berkas->up_1,
                                $a->berkas->up_2,
                                $a->berkas->up_3,
                                $a->berkas->up_4,
                                $a->berkas->up_5,
                                $a->berkas->up_6,
                                $a->berkas->up_7,
                                $a->berkas->up_8,
                                $a->berkas->up_9,
                            ];
                        @endphp
                        @if (in_array(null, $uploads, true))
                            <span class="badge rounded-pill bg-danger">Tidak Lengkap</span>
                        @else
                            <span class="badge rounded-pill bg-success">Lengkap</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>

    </table>
</body>

</html>
