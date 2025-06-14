@extends('layouts.app')

@section('custom_css')
    <link href='https://fonts.googleapis.com/css?family=Battambang' rel='stylesheet'>
    <link rel="stylesheet" href="{{ asset('leaflet-search/src/leaflet-search.css') }}" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
        integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
        crossorigin="" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-geosearch@3.0.0/dist/geosearch.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.css" />
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <style>
        table.dataTable td {
            padding: 10px;
            font-family: 'Battambang';
            font-size: 14px;
        }

        table.dataTable th {
            padding: 14px;
            font-family: 'Battambang';
            font-size: 16px;
        }

        .modal.fade.show {
            backdrop-filter: blur(8px);
        }
    </style>
@endsection

@section('content')
<!-- Pastikan sudah include SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Ini untuk SweetAlert dari session -->
@if (session('success'))
    <script>
        Swal.fire({
            title: 'Sukses!',
            text: '{{ session('success') }}',
            icon: 'success',
            confirmButtonText: 'OK'
        });
    </script>
@endif
@if (session('error'))
    <script>
        Swal.fire({
            title: 'Gagal!',
            text: '{{ session('error') }}',
            icon: 'error',
            confirmButtonText: 'Coba Lagi'
        });
    </script>
@endif
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-12">
                    <div class="alert alert-primary" role="alert">
                        PENGAWASAN PENYELENGARAAN JASA KONSTRUKSI 
                        @if (auth()->user()->hasRole('admin'))
                        <div class="btn-group" style="float: right; margin-right:10px;"  role="group">
                            <button id="btnGroupDrop1" type="button"
                                class="btn btn-sm btn-secondary dropdown-toggle"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Download (K.02)
                            </button>
                            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1" style="">
                                <a class="dropdown-item"
                                href="{{ route('admin.monev.k02.download', ['anggaran' => 'APBD', 'skpd_id' => $selectedSkpdId ?? 'all','status'=>'k02']) }}"
                                style="float: right; margin-right:10px;"
                                target="_blank">
                                APBD
                                </a>
                                <a class="dropdown-item"
                                href="{{ route('admin.monev.k02.download', ['anggaran' => 'MASYARAKAT', 'skpd_id' => $selectedSkpdId ?? 'all','status'=>'k02']) }}"
                                style="float: right; margin-right:10px;"
                                target="_blank">
                                MASYARAKAT
                                </a>

                                <a class="dropdown-item"
                                href="{{ route('admin.monev.k02.download', ['anggaran' => 'SWASTA', 'skpd_id' => $selectedSkpdId ?? 'all','status'=>'k02']) }}"
                                style="float: right; margin-right:10px;"
                                target="_blank">
                                SWASTA
                                </a>

                                <a class="dropdown-item"
                                href="{{ route('admin.monev.k02.download', ['anggaran' => 'BADAN USAHA', 'skpd_id' => $selectedSkpdId ?? 'all','status'=>'k02']) }}"
                                style="float: right; margin-right:10px;"
                                target="_blank">
                                BADAN USAHA
                                </a>

                            </div>
                        </div>
                        <div class="btn-group" style="float: right; margin-right:10px;"  role="group">
                            <button id="btnGroupDrop1" type="button"
                                class="btn btn-sm btn-secondary dropdown-toggle"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Download (P.02)
                            </button>
                            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1" style="">
                                <a class="dropdown-item"
                                href="{{ route('admin.monev.k02.download', ['anggaran' => 'APBD', 'skpd_id' => $selectedSkpdId ?? 'all','status'=>'p02']) }}"
                                style="float: right; margin-right:10px;"
                                target="_blank">
                                APBD
                                </a>
                                <a class="dropdown-item"
                                href="{{ route('admin.monev.k02.download', ['anggaran' => 'MASYARAKAT', 'skpd_id' => $selectedSkpdId ?? 'all','status'=>'p02']) }}"
                                style="float: right; margin-right:10px;"
                                target="_blank">
                                MASYARAKAT
                                </a>

                                <a class="dropdown-item"
                                href="{{ route('admin.monev.k02.download', ['anggaran' => 'SWASTA', 'skpd_id' => $selectedSkpdId ?? 'all','status'=>'p02']) }}"
                                style="float: right; margin-right:10px;"
                                target="_blank">
                                SWASTA
                                </a>

                                <a class="dropdown-item"
                                href="{{ route('admin.monev.k02.download', ['anggaran' => 'BADAN USAHA', 'skpd_id' => $selectedSkpdId ?? 'all','status'=>'p02']) }}"
                                style="float: right; margin-right:10px;"
                                target="_blank">
                                BADAN USAHA
                                </a>

                            </div>
                        </div>
                        <div class="btn-group" style="float: right; margin-right:10px;"  role="group">
                            <button id="btnGroupDrop1" type="button"
                                class="btn btn-sm btn-secondary dropdown-toggle"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Download (RK.02)
                            </button>
                            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1" style="">
                                <a class="dropdown-item"
                                href="{{ route('admin.monev.k02.download', ['anggaran' => 'APBD', 'skpd_id' => $selectedSkpdId ?? 'all','status'=>'rk02']) }}"
                                style="float: right; margin-right:10px;"
                                target="_blank">
                                APBD
                                </a>
                                <a class="dropdown-item"
                                href="{{ route('admin.monev.k02.download', ['anggaran' => 'MASYARAKAT', 'skpd_id' => $selectedSkpdId ?? 'all','status'=>'rk02']) }}"
                                style="float: right; margin-right:10px;"
                                target="_blank">
                                MASYARAKAT
                                </a>

                                <a class="dropdown-item"
                                href="{{ route('admin.monev.k02.download', ['anggaran' => 'SWASTA', 'skpd_id' => $selectedSkpdId ?? 'all','status'=>'rk02']) }}"
                                style="float: right; margin-right:10px;"
                                target="_blank">
                                SWASTA
                                </a>

                                <a class="dropdown-item"
                                href="{{ route('admin.monev.k02.download', ['anggaran' => 'BADAN USAHA', 'skpd_id' => $selectedSkpdId ?? 'all','status'=>'rk02']) }}"
                                style="float: right; margin-right:10px;"
                                target="_blank">
                                BADAN USAHA
                                </a>

                            </div>
                        </div>
                        @else 
                        <button style="float: right;margin-right:10px;" type="button" data-bs-toggle="modal"
                            data-bs-target="#modal-tambah-foto" class="btn btn-sm btn-primary">
                            Tambah
                        </button>
                         <div class="btn-group" style="float: right; margin-right:10px;"  role="group">
                            <button id="btnGroupDrop1" type="button"
                                class="btn btn-sm btn-secondary dropdown-toggle"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Download (K.02)
                            </button>
                            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1" style="">
                                <a  class="dropdown-item" href="{{ route('admin.monev.k02.download', ['anggaran' => 'APBD', 'status'=>'k02']) }}" 
                                    style="float: right; margin-right:10px;" 
                                    class="btn btn-sm btn-secondary" target="_blank">
                                    APBD
                                </a>
                                <a  class="dropdown-item" href="{{ route('admin.monev.k02.download',['anggaran' => 'MASYARAKAT', 'status'=>'k02']) }}" 
                                    style="float: right; margin-right:10px;" 
                                    class="btn btn-sm btn-secondary" target="_blank">
                                    MASYARAKAT
                                </a>
                                <a  class="dropdown-item" href="{{ route('admin.monev.k02.download',['anggaran' => 'SWASTA', 'status'=>'k02']) }}" 
                                    style="float: right; margin-right:10px;" 
                                    class="btn btn-sm btn-secondary" target="_blank">
                                    SWASTA
                                </a>
                                <a  class="dropdown-item" href="{{ route('admin.monev.k02.download',['anggaran' => 'BADAN USAHA', 'status'=>'k02']) }}" 
                                    style="float: right; margin-right:10px;" 
                                    class="btn btn-sm btn-secondary" target="_blank">
                                    BADAN USAHA
                                </a>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body ">
            @if (auth()->user()->hasRole('admin'))
                <label for="skpdFilter">Filter SOPD:</label>
                <select id="skpdFilter" class="form-control select2" onchange="filterBySkpd(this.value)">
                    <option value="">Pilih SOPD</option>
                    @foreach ($skpd as $skpd2)
                        <option value="{{ $skpd2->id }}" {{ $selectedSkpdId == $skpd2->id ? 'selected' : '' }}>
                            {{ $skpd2->name }}
                        </option>
                    @endforeach
                </select>
                <br>
            @endif
            <div class="table-responsive">
                <table class="table  table-striped" id="table">
                    <thead class="bg bg-primary">
                        <tr>
                            <th style="color: white; text-align:center; vertical-align: top;">Aksi</th>
                            <th style="color: white; text-align:center; vertical-align: top;">No</th>
                            <th style="color: white; text-align:center; vertical-align: top;">Kegiatan Konstruksi</th>
                            <th style="color: white; text-align:center; vertical-align: top;">Nomor Kontrak</th>
                            <th style="color: white; text-align:center; vertical-align: top;">Nama BUJK</th>
                            <th style="color: white; text-align:center; vertical-align: top;">Proses pemilihan Penyedia Jasa</th>
                            <th style="color: white; text-align:center; vertical-align: top;">Penerapan standar kontrak</th>
                            <th style="color: white; text-align:center; vertical-align: top;">Penggunaan tenaga kerja bersertifikat</th>
                            <th style="color: white; text-align:center; vertical-align: top;">Pemberian pekerjaan utama subpenyedia</th>
                            <th style="color: white; text-align:center; vertical-align: top;">Ketersediaan dokumen standar K4</th>
                            <th style="color: white; text-align:center; vertical-align: top;">Penerapan SMKK</th>
                            <th style="color: white; text-align:center; vertical-align: top;">Kegiatan antisipasi kecelakaan kerja</th>
                            <th style="color: white; text-align:center; vertical-align: top;">Status</th>
                            
                        </tr>
                        
                    </thead>
                    <tbody>
                       
                        @foreach ($dataK02 as $index => $k02)
                        @php
                            $statusAkhir = (
                                $k02->proses_pemilihan_penyedia_jasa != NULL &&
                                $k02->penerapan_standar_kontrak != NULL &&
                                $k02->penggunaan_tenaga_kerja_bersertifikat != NULL &&
                                $k02->pemberian_pekerjaan_utama_subpenyedia != NULL &&
                                $k02->ketersediaan_dokumen_standar_k4 != NULL &&
                                $k02->penerapan_smkk != NULL &&
                                $k02->kegiatan_antisipasi_kecelakaan_kerja != NULL
                            ) ? 'Tertib' : 'Tidak Tertib';
                        @endphp
                        <tr>
                            <td style="color: rgb(0, 0, 0); text-align:center; vertical-align: top;">
                               
                                <div class="btn-group" role="group">
                                    <button id="btnGroupDrop1" type="button"
                                        class="btn btn-sm btn-outline-secondary dropdown-toggle"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="menu-icon tf-icons bx bx-cog"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1" style="">
                                        <button class="dropdown-item" data-bs-toggle="modal" 
                                                data-bs-target="#modal-edit" 
                                                data-id="{{ $k02->id }}"
                                                data-kegiatan_konstruksi="{{ $k02->kegiatan_konstruksi }}"
                                                data-no_kontrak="{{ $k02->no_kontrak }}"
                                                data-nm_bujk="{{ $k02->nm_bujk }}">
                                            <i class="bx bx-edit-alt"> Edit</i>
                                        </button>
                            
                                        <form action="{{ route('admin.monev.k02.destroy', $k02->id) }}" method="POST" class="d-inline" id="delete-form-{{ $k02->id }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="dropdown-item" onclick="deleteData({{ $k02->id }})">
                                                <i class="bx bx-trash"> Hapus</i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                            <td style="color: rgb(0, 0, 0); text-align:center; vertical-align: top;">{{ $index + 1 }}</td>
                            <td style="color: rgb(0, 0, 0); text-align:center; vertical-align: top;">{{ $k02->kegiatan_konstruksi }}</td>
                            <td style="color: rgb(0, 0, 0); text-align:center; vertical-align: top;">{{ $k02->no_kontrak }}</td>
                            <td style="color: rgb(0, 0, 0); text-align:center; vertical-align: top;">{{ $k02->nm_bujk }}</td>
                            <td style="color: rgb(0, 0, 0); text-align:center; vertical-align: top;">
                                @if ($k02->proses_pemilihan_penyedia_jasa == NULL )
                                    <button type="button" class="btn btn-sm rounded-pill btn-icon btn-danger">
                                        <i class='bx bx-x'></i>
                                    </button>
                                @else
                                    <button type="button" class="btn btn-sm rounded-pill btn-icon  btn-success" data-bs-toggle="modal" 
                                                data-bs-target="#modal-pdf" 
                                                data-data_dukung="{{ $k02->proses_pemilihan_penyedia_jasa }}">
                                            <i class='bx bx-check'></i>
                                    </button>
                                @endif
                            </td>
                            
                            <td style="color: rgb(0, 0, 0); text-align:center; vertical-align: top;">
                                @if ($k02->penerapan_standar_kontrak == NULL )
                                    <button type="button" class="btn btn-sm rounded-pill btn-icon btn-danger">
                                        <i class='bx bx-x'></i>
                                    </button>
                                @else
                                    <button type="button" class="btn btn-sm rounded-pill btn-icon  btn-success" data-bs-toggle="modal" 
                                                data-bs-target="#modal-pdf" 
                                                data-data_dukung="{{ $k02->penerapan_standar_kontrak }}">
                                            <i class='bx bx-check'></i>
                                    </button>
                                @endif
                            </td>
                            
                            <td style="color: rgb(0, 0, 0); text-align:center; vertical-align: top;">
                                @if ($k02->penggunaan_tenaga_kerja_bersertifikat == NULL )
                                    <button type="button" class="btn btn-sm rounded-pill btn-icon btn-danger">
                                        <i class='bx bx-x'></i>
                                    </button>
                                @else
                                    <button type="button" class="btn btn-sm rounded-pill btn-icon  btn-success" data-bs-toggle="modal" 
                                                data-bs-target="#modal-pdf" 
                                                data-data_dukung="{{ $k02->penggunaan_tenaga_kerja_bersertifikat }}">
                                            <i class='bx bx-check'></i>
                                    </button>
                                @endif
                            </td>
                            
                            <td style="color: rgb(0, 0, 0); text-align:center; vertical-align: top;">
                                @if ($k02->pemberian_pekerjaan_utama_subpenyedia == NULL )
                                    <button type="button" class="btn btn-sm rounded-pill btn-icon btn-danger">
                                        <i class='bx bx-x'></i>
                                    </button>
                                @else
                                    <button type="button" class="btn btn-sm rounded-pill btn-icon  btn-success" data-bs-toggle="modal" 
                                                data-bs-target="#modal-pdf" 
                                                data-data_dukung="{{ $k02->pemberian_pekerjaan_utama_subpenyedia }}">
                                            <i class='bx bx-check'></i>
                                    </button>
                                @endif
                            </td>
                            
                            <td style="color: rgb(0, 0, 0); text-align:center; vertical-align: top;">
                                @if ($k02->ketersediaan_dokumen_standar_k4 == NULL )
                                    <button type="button" class="btn btn-sm rounded-pill btn-icon btn-danger">
                                        <i class='bx bx-x'></i>
                                    </button>
                                @else
                                    <button type="button" class="btn btn-sm rounded-pill btn-icon  btn-success" data-bs-toggle="modal" 
                                                data-bs-target="#modal-pdf" 
                                                data-data_dukung="{{ $k02->ketersediaan_dokumen_standar_k4 }}">
                                            <i class='bx bx-check'></i>
                                    </button>
                                @endif
                            </td>
                            
                            <td style="color: rgb(0, 0, 0); text-align:center; vertical-align: top;">
                                @if ($k02->penerapan_smkk == NULL )
                                    <button type="button" class="btn btn-sm rounded-pill btn-icon btn-danger">
                                        <i class='bx bx-x'></i>
                                    </button>
                                @else
                                    <button type="button" class="btn btn-sm rounded-pill btn-icon  btn-success" data-bs-toggle="modal" 
                                                data-bs-target="#modal-pdf" 
                                                data-data_dukung="{{ $k02->penerapan_smkk }}">
                                            <i class='bx bx-check'></i>
                                    </button>
                                @endif
                            </td>
                            
                            <td style="color: rgb(0, 0, 0); text-align:center; vertical-align: top;">
                                @if ($k02->kegiatan_antisipasi_kecelakaan_kerja == NULL )
                                    <button type="button" class="btn btn-sm rounded-pill btn-icon btn-danger">
                                        <i class='bx bx-x'></i>
                                    </button>
                                @else
                                    <button type="button" class="btn btn-sm rounded-pill btn-icon  btn-success" data-bs-toggle="modal" 
                                                data-bs-target="#modal-pdf" 
                                                data-data_dukung="{{ $k02->kegiatan_antisipasi_kecelakaan_kerja }}">
                                            <i class='bx bx-check'></i>
                                    </button>
                                @endif
                            </td>
                            <td style="text-align:center;vertical-align: top;">
                                @if ($statusAkhir == 'Tertib')
                                    <button type="button" class="btn btn-sm rounded-pill btn-success">
                                        <i class='bx bx-check'></i> {{ $statusAkhir }}
                                    </button>
                                @else
                                    <button type="button" class="btn btn-sm rounded-pill btn-danger">
                                        <i class='bx bx-x'></i> {{ $statusAkhir }}
                                    </button>
                                @endif
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                
                </table>
            </div>
            
        </div>
    </div>
    <br>
    <div class="card">
        <div class="card-body ">
            <div class="table-responsive">
                <table class="table table-striped" id="table2">
                    <thead class="bg bg-primary">
                        <tr>
                            <th style="color: white; text-align:center; vertical-align: top;">Aksi</th>
                            <th style="color: white; text-align:center; vertical-align: top;">No</th>
                            <th style="color: white; text-align:center; vertical-align: top;">Kegiatan Konstruksi</th>
                            <th style="color: white; text-align:center; vertical-align: top;">Nomor Kontrak</th>
                            <th style="color: white; text-align:center; vertical-align: top;">Nama BUJK</th>
                            <th style="color: white; text-align:center; vertical-align: top;">Penerapan sistem manajemen mutu konstruksi</th>
                            <th style="color: white; text-align:center; vertical-align: top;">Pemenuhan penyediaan peralatan dalam pelaksanaan proyek konstruksi</th>
                            <th style="color: white; text-align:center; vertical-align: top;">Penggunaan material standar (SNI dan standar lain)</th>
                            <th style="color: white; text-align:center; vertical-align: top;">Penggunaan produk dalam negeri</th>
                            <th style="color: white; text-align:center; vertical-align: top;">Pemenuhan standar mutu material</th>
                            <th style="color: white; text-align:center; vertical-align: top;">Pemenuhan standar teknis lingkungan</th>
                            <th style="color: white; text-align:center; vertical-align: top;">Pemenuhan standar K3</th>
                            <th style="color: white; text-align:center; vertical-align: top;">Status</th>
                        </tr>
                        
                    </thead>
                    <tbody>
                        @foreach ($dataK02 as $index => $k02)
                        @php
                            $statusAkhir2 = (
                                $k02->penerapan_sistem_manajemen_mutu_konstruksi != NULL &&
                                $k02->pemenuhan_peralatan_pelaksanaan_proyek != NULL &&
                                $k02->penggunaan_material_standar != NULL &&
                                $k02->penggunaan_produk_dalam_negeri != NULL &&
                                $k02->pemenuhan_standar_mutu_material != NULL &&
                                $k02->pemenuhan_standar_teknis_lingkungan != NULL &&
                                $k02->pemenuhan_standar_k3 != NULL
                            ) ? 'Tertib' : 'Tidak Tertib';
                        @endphp

                        <tr>
                            <td style="color: rgb(0, 0, 0); text-align:center; vertical-align: top;">
                               
                                <div class="btn-group" role="group">
                                    <button id="btnGroupDrop1" type="button"
                                        class="btn btn-sm btn-outline-secondary dropdown-toggle"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="menu-icon tf-icons bx bx-cog"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1" style="">
                                        
                                        <button class="dropdown-item" data-bs-toggle="modal" 
                                                data-bs-target="#modal-edit2" 
                                                data-id="{{ $k02->id }}"
                                                data-kegiatan_konstruksi="{{ $k02->kegiatan_konstruksi }}"
                                                data-no_kontrak="{{ $k02->no_kontrak }}"
                                                data-nm_bujk="{{ $k02->nm_bujk }}">
                                            <i class="bx bx-edit-alt"> Edit</i>
                                        </button>
                                        <form action="{{ route('admin.monev.k02.destroy', $k02->id) }}" method="POST" class="d-inline" id="delete-form-{{ $k02->id }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="dropdown-item" onclick="deleteData({{ $k02->id }})">
                                                <i class="bx bx-trash"> Hapus</i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                            <td style="color: rgb(0, 0, 0); text-align:center; vertical-align: top;">{{ $index + 1 }}</td>
                            <td style="color: rgb(0, 0, 0); text-align:center; vertical-align: top;">{{ $k02->kegiatan_konstruksi }}</td>
                            <td style="color: rgb(0, 0, 0); text-align:center; vertical-align: top;">{{ $k02->no_kontrak }}</td>
                            <td style="color: rgb(0, 0, 0); text-align:center; vertical-align: top;">{{ $k02->nm_bujk }}</td>
                            <td style="color: rgb(0, 0, 0); text-align:center; vertical-align: top;">
                                @if ($k02->penerapan_sistem_manajemen_mutu_konstruksi == NULL)
                                    <button type="button" class="btn btn-sm rounded-pill btn-icon btn-danger">
                                        <i class='bx bx-x'></i>
                                    </button>
                                @else
                                    <button type="button" class="btn btn-sm rounded-pill btn-icon  btn-success" data-bs-toggle="modal" 
                                                data-bs-target="#modal-pdf" 
                                                data-data_dukung="{{ $k02->penerapan_sistem_manajemen_mutu_konstruksi }}">
                                            <i class='bx bx-check'></i>
                                    </button>
                                @endif
                            </td>
                            
                            <td style="color: rgb(0, 0, 0); text-align:center; vertical-align: top;">
                                @if ($k02->pemenuhan_peralatan_pelaksanaan_proyek == NULL)
                                    <button type="button" class="btn btn-sm rounded-pill btn-icon btn-danger">
                                        <i class='bx bx-x'></i>
                                    </button>
                                @else
                                    <button type="button" class="btn btn-sm rounded-pill btn-icon  btn-success" data-bs-toggle="modal" 
                                                data-bs-target="#modal-pdf" 
                                                data-data_dukung="{{ $k02->pemenuhan_peralatan_pelaksanaan_proyek }}">
                                            <i class='bx bx-check'></i>
                                    </button>
                                @endif
                            </td>
                            
                            <td style="color: rgb(0, 0, 0); text-align:center; vertical-align: top;">
                                @if ($k02->penggunaan_material_standar == NULL)
                                    <button type="button" class="btn btn-sm rounded-pill btn-icon btn-danger">
                                        <i class='bx bx-x'></i>
                                    </button>
                                @else
                                    <button type="button" class="btn btn-sm rounded-pill btn-icon  btn-success" data-bs-toggle="modal" 
                                                data-bs-target="#modal-pdf" 
                                                data-data_dukung="{{ $k02->penggunaan_material_standar }}">
                                            <i class='bx bx-check'></i>
                                    </button>
                                @endif
                            </td>
                            
                            <td style="color: rgb(0, 0, 0); text-align:center; vertical-align: top;">
                                @if ($k02->penggunaan_produk_dalam_negeri == NULL)
                                    <button type="button" class="btn btn-sm rounded-pill btn-icon btn-danger">
                                        <i class='bx bx-x'></i>
                                    </button>
                                @else
                                    <button type="button" class="btn btn-sm rounded-pill btn-icon  btn-success" data-bs-toggle="modal" 
                                                data-bs-target="#modal-pdf" 
                                                data-data_dukung="{{ $k02->penggunaan_produk_dalam_negeri }}">
                                            <i class='bx bx-check'></i>
                                    </button>
                                @endif
                            </td>
                            
                            <td style="color: rgb(0, 0, 0); text-align:center; vertical-align: top;">
                                @if ($k02->pemenuhan_standar_mutu_material == NULL)
                                    <button type="button" class="btn btn-sm rounded-pill btn-icon btn-danger">
                                        <i class='bx bx-x'></i>
                                    </button>
                                @else
                                    <button type="button" class="btn btn-sm rounded-pill btn-icon  btn-success" data-bs-toggle="modal" 
                                                data-bs-target="#modal-pdf" 
                                                data-data_dukung="{{ $k02->pemenuhan_standar_mutu_material }}">
                                            <i class='bx bx-check'></i>
                                    </button>
                                @endif
                            </td>
                            
                            <td style="color: rgb(0, 0, 0); text-align:center; vertical-align: top;">
                                @if ($k02->pemenuhan_standar_teknis_lingkungan == NULL)
                                    <button type="button" class="btn btn-sm rounded-pill btn-icon btn-danger">
                                        <i class='bx bx-x'></i>
                                    </button>
                                @else
                                    <button type="button" class="btn btn-sm rounded-pill btn-icon  btn-success" data-bs-toggle="modal" 
                                                data-bs-target="#modal-pdf" 
                                                data-data_dukung="{{ $k02->pemenuhan_standar_teknis_lingkungan }}">
                                            <i class='bx bx-check'></i>
                                    </button>
                                @endif
                            </td>
                            
                            <td style="color: rgb(0, 0, 0); text-align:center; vertical-align: top;">
                                @if ($k02->pemenuhan_standar_k3 == NULL)
                                    <button type="button" class="btn btn-sm rounded-pill btn-icon btn-danger">
                                        <i class='bx bx-x'></i>
                                    </button>
                                @else
                                    <button type="button" class="btn btn-sm rounded-pill btn-icon  btn-success" data-bs-toggle="modal" 
                                                data-bs-target="#modal-pdf" 
                                                data-data_dukung="{{ $k02->pemenuhan_standar_k3 }}">
                                            <i class='bx bx-check'></i>
                                    </button>
                                @endif
                            </td>
                            <td style="text-align:center;vertical-align: top;">
                                @if ($statusAkhir2 == 'Tertib')
                                    <button type="button" class="btn btn-sm rounded-pill btn-success">
                                        <i class='bx bx-check'></i> {{ $statusAkhir2 }}
                                    </button>
                                @else
                                    <button type="button" class="btn btn-sm rounded-pill btn-danger">
                                        <i class='bx bx-x'></i> {{ $statusAkhir2 }}
                                    </button>
                                @endif
                            </td>
                            
                        </tr>
                        @endforeach
                    </tbody>
                
                </table>
            </div>
        </div>
    </div>

    {{-- Tambah --}}
    <div class="modal fade" role="dialog" id="modal-tambah-foto" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah</h5>
                    
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-primary" role="alert">
                        REKAPITULASI PENGAWASAN TERTIB PENYELENGARAAN JASA KONSTRUKSI TAHUNAN 
                    </div>
                    <form method="post" id="form-tambah" action="{{ route('admin.monev.k02.insert') }}" enctype="multipart/form-data">
                        @csrf
                        
                        <div>
                            <input type="hidden" name="skpd_id" value="{{ auth()->user()->id }}">
                            
                            <div class="col-md-12 mt-4">
                                <small class="text-light fw-semibold">Upload :</small>
                            </div>
                    
                            <div class="col-md-12 mt-4">
                                <dt>Kegiatan Konstruksi (Nama Paket)</dt>
                                <dd><input type="text" class="form-control" name="kegiatan_konstruksi" placeholder="Kegiatan Konstruksi (Nama Paket)"></dd>
                            </div>
                    
                            <div class="col-md-12 mt-4">
                                <dt>Nomer Kontrak</dt>
                                <dd><input type="text" class="form-control" name="no_kontrak" placeholder="Nomer Kontrak"></dd>
                            </div>
                    
                            <div class="col-md-12 mt-4">
                                <dt>Nama BUJK</dt>
                                <dd><input type="text" class="form-control" name="nm_bujk" placeholder="Nama BUJK"></dd>
                            </div>
                    
                            {{-- <div class="col-md-12 mt-4">
                                <dt>Proses Pemilihan Penyedia Jasa</dt>
                                <dd>
                                    <select class="form-control" name="proses_pemilihan_penyedia_jasa">
                                        
                                        <option value="Tertib">Tertib</option>
                                        <option value="Tidak Tertib" selected>Tidak Tertib</option>
                                    </select>
                                </dd>
                            </div>
                    
                            <div class="col-md-12 mt-4">
                                <dt>Penerapan Standar Kontrak</dt>
                                <dd>
                                    <select class="form-control" name="penerapan_standar_kontrak">
                                        
                                        <option value="Tertib">Tertib</option>
                                        <option value="Tidak Tertib" selected>Tidak Tertib</option>
                                    </select>
                                </dd>
                            </div>
                    
                            <div class="col-md-12 mt-4">
                                <dt>Penggunaan Tenaga Kerja Bersertifikat</dt>
                                <dd>
                                    <select class="form-control" name="penggunaan_tenaga_kerja_bersertifikat">
                                        
                                        <option value="Tertib">Tertib</option>
                                        <option value="Tidak Tertib" selected>Tidak Tertib</option>
                                    </select>
                                </dd>
                            </div>
                    
                            <div class="col-md-12 mt-4">
                                <dt>Pemberian Pekerjaan Utama/Subpenyedia</dt>
                                <dd>
                                    <select class="form-control" name="pemberian_pekerjaan_utama_subpenyedia">
                                        
                                        <option value="Tertib">Tertib</option>
                                        <option value="Tidak Tertib" selected>Tidak Tertib</option>
                                    </select>
                                </dd>
                            </div>
                    
                            <div class="col-md-12 mt-4">
                                <dt>Ketersediaan Dokumen Standar K4</dt>
                                <dd>
                                    <select class="form-control" name="ketersediaan_dokumen_standar_k4">
                                        
                                        <option value="Tertib">Tertib</option>
                                        <option value="Tidak Tertib" selected>Tidak Tertib</option>
                                    </select>
                                </dd>
                            </div>
                    
                            <div class="col-md-12 mt-4">
                                <dt>Penerapan SMKK</dt>
                                <dd>
                                    <select class="form-control" name="penerapan_smkk">
                                        
                                        <option value="Tertib">Tertib</option>
                                        <option value="Tidak Tertib" selected>Tidak Tertib</option>
                                    </select>
                                </dd>
                            </div>
                    
                            <div class="col-md-12 mt-4">
                                <dt>Kegiatan Antisipasi Kecelakaan Kerja</dt>
                                <dd>
                                    <select class="form-control" name="kegiatan_antisipasi_kecelakaan_kerja">
                                        
                                        <option value="Tertib">Tertib</option>
                                        <option value="Tidak Tertib" selected>Tidak Tertib</option>
                                    </select>
                                </dd>
                            </div>
                            
                            <div class="col-md-12 mt-4">
                                <dt>Penerapan Sistem Manajemen Mutu Konstruksi</dt>
                                <dd>
                                    <select class="form-control" name="penerapan_sistem_manajemen_mutu_konstruksi">
                                        
                                        <option value="Tertib">Tertib</option>
                                        <option value="Tidak Tertib" selected>Tidak Tertib</option>
                                    </select>
                                </dd>
                            </div>

                            <div class="col-md-12 mt-4">
                                <dt>Pemenuhan Peralatan Pelaksanaan Proyek</dt>
                                <dd>
                                    <select class="form-control" name="pemenuhan_peralatan_pelaksanaan_proyek">
                                        
                                        <option value="Tertib">Tertib</option>
                                        <option value="Tidak Tertib" selected>Tidak Tertib</option>
                                    </select>
                                </dd>
                            </div>
                            
                            <div class="col-md-12 mt-4">
                                <dt>Penggunaan Material Standar</dt>
                                <dd>
                                    <select class="form-control" name="penggunaan_material_standar">
                                        
                                        <option value="Tertib">Tertib</option>
                                        <option value="Tidak Tertib" selected>Tidak Tertib</option>
                                    </select>
                                </dd>
                            </div>

                            <div class="col-md-12 mt-4">
                                <dt>Penggunaan Produk Dalam Negeri</dt>
                                <dd>
                                    <select class="form-control" name="penggunaan_produk_dalam_negeri">
                                        
                                        <option value="Tertib">Tertib</option>
                                        <option value="Tidak Tertib" selected>Tidak Tertib</option>
                                    </select>
                                </dd>
                            </div>
                    
                            <div class="col-md-12 mt-4">
                                <dt>Pemenuhan Standar Mutu Material</dt>
                                <dd>
                                    <select class="form-control" name="pemenuhan_standar_mutu_material">
                                        
                                        <option value="Tertib">Tertib</option>
                                        <option value="Tidak Tertib" selected>Tidak Tertib</option>
                                    </select>
                                </dd>
                            </div>
                    
                            <div class="col-md-12 mt-4">
                                <dt>Pemenuhan Standar Teknis Lingkungan</dt>
                                <dd>
                                    <select class="form-control" name="pemenuhan_standar_teknis_lingkungan">
                                        
                                        <option value="Tertib">Tertib</option>
                                        <option value="Tidak Tertib" selected>Tidak Tertib</option>
                                    </select>
                                </dd>
                            </div>
                    
                            <div class="col-md-12 mt-4">
                                <dt>Pemenuhan Standar K3</dt>
                                <dd>
                                    <select class="form-control" name="pemenuhan_standar_k3">
                                        
                                        <option value="Tertib">Tertib</option>
                                        <option value="Tidak Tertib" selected>Tidak Tertib</option>
                                    </select>
                                </dd>
                            </div>
                    
                            <div class="col-md-12 mt-4">
                                <dt>Upload Data Dukung <small style="color: red">*maks 2MB (Wajib PDF)</small></dt>
                                <dd><input type="file" class="form-control" name="data_dukung" accept=".pdf"></dd>
                            </div>
                            --}}
                        </div>
                    
                        <div class="modal-footer bg-whitesmoke br">
                            <button type="submit" id="tombol" class="btn btn-primary">SIMPAN</button>
                            <button type="button" id="loading" class="btn btn-warning" style="display: none;" disabled>LOADING......</button>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
    {{-- Edit Tabel Atas --}}
    <div class="modal fade" role="dialog" id="modal-edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" id="form-edit" action="{{ route('admin.monev.k02.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')  
                        <input type="hidden" name="id">
    
                        <div class="col-md-12 mt-4">
                            <dt>Kegiatan Konstruksi (Nama Paket)</dt>
                            <dd><input type="text" class="form-control" name="kegiatan_konstruksi" placeholder="Kegiatan Konstruksi (Nama Paket)"></dd>
                        </div>
    
                        <div class="col-md-12 mt-4">
                            <dt>No. Kontrak</dt>
                            <dd><input type="text" class="form-control" name="no_kontrak" placeholder="No. Kontrak"></dd>
                        </div>
    
                        <div class="col-md-12 mt-4">
                            <dt>Nama BUJK</dt>
                            <dd><input type="text" class="form-control" name="nm_bujk" placeholder="Nama BUJK"></dd>
                        </div>
                        
                        <div class="col-md-12 mt-4">
                            <dt>Pilih File Upload :</dt>
                            <dd>
                               <select class="form-control" name="field_tujuan" required>
                                    <option value="">- Pilih -</option>
                                    <option value="proses_pemilihan_penyedia_jasa">Proses Pemilihan Penyedia Jasa</option>
                                    <option value="penerapan_standar_kontrak">Penerapan Standar Kontrak</option>
                                    <option value="penggunaan_tenaga_kerja_bersertifikat">Penggunaan Tenaga Kerja Bersertifikat</option>
                                    <option value="pemberian_pekerjaan_utama_subpenyedia">Pemberian Pekerjaan Utama Subpenyedia</option>
                                    <option value="ketersediaan_dokumen_standar_k4">Ketersediaan Dokumen Standar K4</option>
                                    <option value="penerapan_smkk">Penerapan SMKK</option>
                                    <option value="kegiatan_antisipasi_kecelakaan_kerja">Kegiatan Antisipasi Kecelakaan Kerja</option>
                                </select>
                            </dd>
                        </div>
                         <div class="col-md-12 mt-4">
                            <dt>Upload File <small style="color: red">*maks 2MB (Wajib PDF)</small></dt>
                            <dd><input type="file" class="form-control" name="file" accept=".pdf"></dd>
                        </div>
                        {{-- <div class="col-md-12 mt-4">
                            <dt>Proses Pemilihan Penyedia Jasa</dt>
                            <dd>
                                <select class="form-control" name="proses_pemilihan_penyedia_jasa">
                                    <option value="Tertib">Tertib</option>
                                    <option value="Tidak Tertib">Tidak Tertib</option>
                                </select>
                            </dd>
                        </div>
    
                        <div class="col-md-12 mt-4">
                            <dt>Penerapan Standar Kontrak</dt>
                            <dd>
                                <select class="form-control" name="penerapan_standar_kontrak">
                                    <option value="Tertib">Tertib</option>
                                    <option value="Tidak Tertib">Tidak Tertib</option>
                                </select>
                            </dd>
                        </div>
    
                        <div class="col-md-12 mt-4">
                            <dt>Penggunaan Tenaga Kerja Bersertifikat</dt>
                            <dd>
                                <select class="form-control" name="penggunaan_tenaga_kerja_bersertifikat">
                                    <option value="Tertib">Tertib</option>
                                    <option value="Tidak Tertib">Tidak Tertib</option>
                                </select>
                            </dd>
                        </div>
    
                        <div class="col-md-12 mt-4">
                            <dt>Pemberian Pekerjaan Utama Subpenyedia</dt>
                            <dd>
                                <select class="form-control" name="pemberian_pekerjaan_utama_subpenyedia">
                                    <option value="Tertib">Tertib</option>
                                    <option value="Tidak Tertib">Tidak Tertib</option>
                                </select>
                            </dd>
                        </div>
    
                        <div class="col-md-12 mt-4">
                            <dt>Ketersediaan Dokumen Standar K4</dt>
                            <dd>
                                <select class="form-control" name="ketersediaan_dokumen_standar_k4">
                                    <option value="Tertib">Tertib</option>
                                    <option value="Tidak Tertib">Tidak Tertib</option>
                                </select>
                            </dd>
                        </div>
    
                        <div class="col-md-12 mt-4">
                            <dt>Penerapan SMKK</dt>
                            <dd>
                                <select class="form-control" name="penerapan_smkk">
                                    <option value="Tertib">Tertib</option>
                                    <option value="Tidak Tertib">Tidak Tertib</option>
                                </select>
                            </dd>
                        </div>
    
                        <div class="col-md-12 mt-4">
                            <dt>Kegiatan Antisipasi Kecelakaan Kerja</dt>
                            <dd>
                                <select class="form-control" name="kegiatan_antisipasi_kecelakaan_kerja">
                                    
                                    <option value="Tertib">Tertib</option>
                                    <option value="Tidak Tertib">Tidak Tertib</option>
                                </select>
                            </dd>
                        </div>
                        <div class="col-md-12 mt-4">
                            <dt>Update Data Dukung <small style="color: red">*maks 2MB (Wajib PDF)</small></dt>
                            <dd><input type="file" class="form-control" name="data_dukung" accept=".pdf"></dd>
                        </div>
                        <div id="pdf-preview" style="margin-top: 20px;">
                            <iframe id="pdf-frame" src="" width="100%" height="500px" style="border: 1px solid #ccc;"></iframe>
                        </div> --}}
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- Edit Tabel Bawah --}}
    <div class="modal fade" role="dialog" id="modal-edit2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" id="form-edit2" action="{{ route('admin.monev.k02.updatebawah') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')  
                        <input type="hidden" name="id">
    
                        <div class="col-md-12 mt-4">
                            <dt>Kegiatan Konstruksi (Nama Paket)</dt>
                            <dd><input type="text" class="form-control" name="kegiatan_konstruksi" placeholder="Kegiatan Konstruksi (Nama Paket)"></dd>
                        </div>
    
                        <div class="col-md-12 mt-4">
                            <dt>No. Kontrak</dt>
                            <dd><input type="text" class="form-control" name="no_kontrak" placeholder="No. Kontrak"></dd>
                        </div>
    
                        <div class="col-md-12 mt-4">
                            <dt>Nama BUJK</dt>
                            <dd><input type="text" class="form-control" name="nm_bujk" placeholder="Nama BUJK"></dd>
                        </div>
                        <div class="col-md-12 mt-4">
                            <dt>Pilih File Upload :</dt>
                            <dd>
                             <select class="form-control" name="field_tujuan" required>
                                <option value="">- Pilih -</option>
                                <option value="penerapan_sistem_manajemen_mutu_konstruksi">Penerapan Sistem Manajemen Mutu Konstruksi</option>
                                <option value="pemenuhan_peralatan_pelaksanaan_proyek">Pemenuhan Peralatan Pelaksanaan Proyek</option>
                                <option value="penggunaan_material_standar">Penggunaan Material Standar</option>
                                <option value="penggunaan_produk_dalam_negeri">Penggunaan Produk Dalam Negeri</option>
                                <option value="pemenuhan_standar_mutu_material">Pemenuhan Standar Mutu Material</option>
                                <option value="pemenuhan_standar_teknis_lingkungan">Pemenuhan Standar Teknis Lingkungan</option>
                                <option value="pemenuhan_standar_k3">Pemenuhan Standar K3</option>
                            </select>

                            </dd>
                        </div>
                         <div class="col-md-12 mt-4">
                            <dt>Upload File <small style="color: red">*maks 2MB (Wajib PDF)</small></dt>
                            <dd><input type="file" class="form-control" name="file" accept=".pdf"></dd>
                        </div>
                        {{-- <div class="col-md-12 mt-4">
                            <dt>Penerapan Sistem Manajemen Mutu Konstruksi</dt>
                            <dd>
                                <select class="form-control" name="penerapan_sistem_manajemen_mutu_konstruksi">
                                    <option value="Tertib">Tertib</option>
                                    <option value="Tidak Tertib">Tidak Tertib</option>
                                </select>
                            </dd>
                        </div>
                        
                        <div class="col-md-12 mt-4">
                            <dt>Pemenuhan Peralatan Pelaksanaan Proyek</dt>
                            <dd>
                                <select class="form-control" name="pemenuhan_peralatan_pelaksanaan_proyek">
                                    <option value="Tertib">Tertib</option>
                                    <option value="Tidak Tertib">Tidak Tertib</option>
                                </select>
                            </dd>
                        </div>
                        
                        <div class="col-md-12 mt-4">
                            <dt>Penggunaan Material Standar</dt>
                            <dd>
                                <select class="form-control" name="penggunaan_material_standar">
                                    <option value="Tertib">Tertib</option>
                                    <option value="Tidak Tertib">Tidak Tertib</option>
                                </select>
                            </dd>
                        </div>
                        
                        <div class="col-md-12 mt-4">
                            <dt>Penggunaan Produk Dalam Negeri</dt>
                            <dd>
                                <select class="form-control" name="penggunaan_produk_dalam_negeri">
                                    <option value="Tertib">Tertib</option>
                                    <option value="Tidak Tertib">Tidak Tertib</option>
                                </select>
                            </dd>
                        </div>
                        
                        <div class="col-md-12 mt-4">
                            <dt>Pemenuhan Standar Mutu Material</dt>
                            <dd>
                                <select class="form-control" name="pemenuhan_standar_mutu_material">
                                    <option value="Tertib">Tertib</option>
                                    <option value="Tidak Tertib">Tidak Tertib</option>
                                </select>
                            </dd>
                        </div>
                        
                        <div class="col-md-12 mt-4">
                            <dt>Pemenuhan Standar Teknis Lingkungan</dt>
                            <dd>
                                <select class="form-control" name="pemenuhan_standar_teknis_lingkungan">
                                    <option value="Tertib">Tertib</option>
                                    <option value="Tidak Tertib">Tidak Tertib</option>
                                </select>
                            </dd>
                        </div>
                        
                        <div class="col-md-12 mt-4">
                            <dt>Pemenuhan Standar K3</dt>
                            <dd>
                                <select class="form-control" name="pemenuhan_standar_k3">
                                    <option value="Tertib">Tertib</option>
                                    <option value="Tidak Tertib">Tidak Tertib</option>
                                </select>
                            </dd>
                        </div>
                        
                        <div class="col-md-12 mt-4">
                            <dt>Update Data Dukung <small style="color: red">*maks 2MB (Wajib PDF)</small></dt>
                            <dd><input type="file" class="form-control" name="data_dukung" accept=".pdf"></dd>
                        </div>
                        <div id="pdf-preview2" style="margin-top: 20px;">
                            <iframe id="pdf-frame2" src="" width="100%" height="500px" style="border: 1px solid #ccc;"></iframe>
                        </div> --}}
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- Tampil PDF --}}
    <div class="modal fade" role="dialog" id="modal-pdf" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">File Pendukung</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                        <div id="pdf-preview" style="margin-top: 20px;">
                            <iframe id="pdf-frame" src="" width="100%" height="500px" style="border: 1px solid #ccc;"></iframe>
                        </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom_js')
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
        integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
        crossorigin=""></script>
    <script src="https://unpkg.com/leaflet-geosearch@3.1.0/dist/geosearch.umd.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#table').DataTable();
            $('#range').daterangepicker();
        });

        $(document).ready(function() {
            $('#table2').DataTable();
            $('#range2').daterangepicker();
        });

    </script>
     {{-- filter SKPD --}}
     <script>
        function filterBySkpd(skpdId) {
            // Redirect ke URL yang sesuai, misal dengan query string
            let url = "{{ url()->current() }}"; // tetap di halaman ini
            if (skpdId) {
                window.location.href = url + '?skpd_id=' + skpdId;
            } else {
                window.location.href = url; // kembali tanpa filter
            }
        }
    </script>
    {{-- Data Edit Tabel Atas --}}
    <script>
        $('#modal-edit').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Tombol yang diklik
            var modal = $(this);
        
            // Ambil data dari tombol
            var id = button.data('id') || '';
            var kegiatan_konstruksi = button.data('kegiatan_konstruksi') || '';
            var no_kontrak = button.data('no_kontrak') || '';
            var nm_bujk = button.data('nm_bujk') || '';

        
            // Masukkan data ke dalam form modal
            modal.find('input[name="kegiatan_konstruksi"]').val(kegiatan_konstruksi);
            modal.find('input[name="no_kontrak"]').val(no_kontrak);
            modal.find('input[name="nm_bujk"]').val(nm_bujk);
            modal.find('input[name="id"]').val(id); // hidden input
        
        });
    </script>
    {{-- Data Edit Tabel Bawah --}}
    <script>
        $('#modal-edit2').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Tombol yang diklik
            var modal = $(this);
        
            // Ambil data dari tombol
            var id = button.data('id') || '';
            var kegiatan_konstruksi = button.data('kegiatan_konstruksi') || '';
            var no_kontrak = button.data('no_kontrak') || '';
            var nm_bujk = button.data('nm_bujk') || '';
        
            // Masukkan data ke dalam form modal
            modal.find('input[name="kegiatan_konstruksi"]').val(kegiatan_konstruksi);
            modal.find('input[name="no_kontrak"]').val(no_kontrak);
            modal.find('input[name="nm_bujk"]').val(nm_bujk);
            modal.find('input[name="id"]').val(id); // hidden input
            
        });
    </script>
    {{-- Tampil PDF --}}
    <script>
        $('#modal-pdf').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Tombol yang diklik
            var modal = $(this);
        
            // Ambil data dari tombol
            var file_pdf = button.data('data_dukung') ? '/uploads/data_dukung/' + button.data('data_dukung') : '';
            $('#pdf-frame').attr('src', file_pdf);
            $('#pdf-preview').show();
            
        
        });
    </script>
    {{-- Delete --}}
    <script>
        function deleteData(id) {
            // Menggunakan SweetAlert untuk konfirmasi
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data ini akan dihapus secara permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jika pengguna mengonfirmasi, kirimkan form
                    document.getElementById('delete-form-' + id).submit();
                }
            })
        }
    </script>
@endsection