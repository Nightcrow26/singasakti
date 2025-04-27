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
                        REKAPITULASI PENGAWASAN TERTIB PENYELENGARAAN JASA KONSTRUKSI TAHUNAN 
                        @if (auth()->user()->hasRole('admin'))
                        <a href="{{ route('admin.monev.k02.download') }}" 
                            style="float: right; margin-right:10px;" 
                            class="btn btn-sm btn-secondary" target="_blank">
                            Download
                         </a>
                        @else 
                        <button style="float: right;margin-right:10px;" type="button" data-bs-toggle="modal"
                            data-bs-target="#modal-tambah-foto" class="btn btn-sm btn-primary">
                            Tambah
                        </button>
                        <a href="{{ route('admin.monev.k02.download') }}" 
                            style="float: right; margin-right:10px;" 
                            class="btn btn-sm btn-secondary" target="_blank">
                            Download
                         </a>
                        @endif
                        
                        {{-- @if (auth()->user()->hasRole('admin'))
                            <a href="{{ route('excel.rutin') }}" style="float: right;margin-right:10px;" type="button"
                                class="btn btn-sm btn-success">
                                Download Excel
                            </a>
                        @endif --}}
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body ">
         
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
                                $k02->proses_pemilihan_penyedia_jasa == 'Tertib' &&
                                $k02->penerapan_standar_kontrak == 'Tertib' &&
                                $k02->penggunaan_tenaga_kerja_bersertifikat == 'Tertib' &&
                                $k02->pemberian_pekerjaan_utama_subpenyedia == 'Tertib' &&
                                $k02->ketersediaan_dokumen_standar_k4 == 'Tertib' &&
                                $k02->penerapan_smkk == 'Tertib' &&
                                $k02->kegiatan_antisipasi_kecelakaan_kerja == 'Tertib'
                            ) ? 'Tertib' : 'Tidak Tertib';
                        @endphp
                        <tr>
                            <td style="color: rgb(0, 0, 0); text-align:center; vertical-align: top;">
                                <button data-bs-toggle="modal" 
                                        data-bs-target="#modal-edit" 
                                        class="btn btn-sm btn-flat btn-primary my-2"
                                        data-id="{{ $k02->id }}"
                                        data-kegiatan_konstruksi="{{ $k02->kegiatan_konstruksi }}"
                                        data-no_kontrak="{{ $k02->no_kontrak }}"
                                        data-nm_bujk="{{ $k02->nm_bujk }}"
                                        data-proses_pemilihan_penyedia_jasa="{{ $k02->proses_pemilihan_penyedia_jasa }}"
                                        data-penerapan_standar_kontrak="{{ $k02->penerapan_standar_kontrak }}"
                                        data-penggunaan_tenaga_kerja_bersertifikat="{{ $k02->penggunaan_tenaga_kerja_bersertifikat }}"
                                        data-pemberian_pekerjaan_utama_subpenyedia="{{ $k02->pemberian_pekerjaan_utama_subpenyedia }}"
                                        data-ketersediaan_dokumen_standar_k4="{{ $k02->ketersediaan_dokumen_standar_k4 }}"
                                        data-penerapan_smkk="{{ $k02->penerapan_smkk }}"
                                        data-kegiatan_antisipasi_kecelakaan_kerja="{{ $k02->kegiatan_antisipasi_kecelakaan_kerja }}"
                                        data-data_dukung="{{ $k02->data_dukung }}">
                                    <i class="bx bx-edit-alt"></i>
                                </button>
                                <form action="{{ route('admin.monev.k02.destroy', $k02->id) }}" method="POST" class="d-inline" id="delete-form-{{ $k02->id }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-sm btn-flat btn-danger my-2" onclick="deleteData({{ $k02->id }})">
                                        <i class="bx bx-trash"></i>
                                    </button>
                                </form>
                            </td>
                            <td style="color: rgb(0, 0, 0); text-align:center; vertical-align: top;">{{ $index + 1 }}</td>
                            <td style="color: rgb(0, 0, 0); text-align:center; vertical-align: top;">{{ $k02->kegiatan_konstruksi }}</td>
                            <td style="color: rgb(0, 0, 0); text-align:center; vertical-align: top;">{{ $k02->no_kontrak }}</td>
                            <td style="color: rgb(0, 0, 0); text-align:center; vertical-align: top;">{{ $k02->nm_bujk }}</td>
                            <td style="color: rgb(0, 0, 0); text-align:center; vertical-align: top;">
                                @if ($k02->proses_pemilihan_penyedia_jasa == 'Tidak Tertib')
                                    <button type="button" class="btn btn-sm rounded-pill btn-danger">
                                        <i class='bx bx-x'></i>
                                    </button>
                                @else
                                    <button type="button" class="btn btn-sm rounded-pill btn-success">
                                        <i class='bx bx-check'></i>
                                    </button>
                                @endif
                            </td>
                            
                            <td style="color: rgb(0, 0, 0); text-align:center; vertical-align: top;">
                                @if ($k02->penerapan_standar_kontrak == 'Tidak Tertib')
                                    <button type="button" class="btn btn-sm rounded-pill btn-danger">
                                        <i class='bx bx-x'></i>
                                    </button>
                                @else
                                    <button type="button" class="btn btn-sm rounded-pill btn-success">
                                        <i class='bx bx-check'></i>
                                    </button>
                                @endif
                            </td>
                            
                            <td style="color: rgb(0, 0, 0); text-align:center; vertical-align: top;">
                                @if ($k02->penggunaan_tenaga_kerja_bersertifikat == 'Tidak Tertib')
                                    <button type="button" class="btn btn-sm rounded-pill btn-danger">
                                        <i class='bx bx-x'></i>
                                    </button>
                                @else
                                    <button type="button" class="btn btn-sm rounded-pill btn-success">
                                        <i class='bx bx-check'></i>
                                    </button>
                                @endif
                            </td>
                            
                            <td style="color: rgb(0, 0, 0); text-align:center; vertical-align: top;">
                                @if ($k02->pemberian_pekerjaan_utama_subpenyedia == 'Tidak Tertib')
                                    <button type="button" class="btn btn-sm rounded-pill btn-danger">
                                        <i class='bx bx-x'></i>
                                    </button>
                                @else
                                    <button type="button" class="btn btn-sm rounded-pill btn-success">
                                        <i class='bx bx-check'></i>
                                    </button>
                                @endif
                            </td>
                            
                            <td style="color: rgb(0, 0, 0); text-align:center; vertical-align: top;">
                                @if ($k02->ketersediaan_dokumen_standar_k4 == 'Tidak Tertib')
                                    <button type="button" class="btn btn-sm rounded-pill btn-danger">
                                        <i class='bx bx-x'></i>
                                    </button>
                                @else
                                    <button type="button" class="btn btn-sm rounded-pill btn-success">
                                        <i class='bx bx-check'></i>
                                    </button>
                                @endif
                            </td>
                            
                            <td style="color: rgb(0, 0, 0); text-align:center; vertical-align: top;">
                                @if ($k02->penerapan_smkk == 'Tidak Tertib')
                                    <button type="button" class="btn btn-sm rounded-pill btn-danger">
                                        <i class='bx bx-x'></i>
                                    </button>
                                @else
                                    <button type="button" class="btn btn-sm rounded-pill btn-success">
                                        <i class='bx bx-check'></i>
                                    </button>
                                @endif
                            </td>
                            
                            <td style="color: rgb(0, 0, 0); text-align:center; vertical-align: top;">
                                @if ($k02->kegiatan_antisipasi_kecelakaan_kerja == 'Tidak Tertib')
                                    <button type="button" class="btn btn-sm rounded-pill btn-danger">
                                        <i class='bx bx-x'></i>
                                    </button>
                                @else
                                    <button type="button" class="btn btn-sm rounded-pill btn-success">
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
                                $k02->penerapan_sistem_manajemen_mutu_konstruksi == 'Tertib' &&
                                $k02->pemenuhan_peralatan_pelaksanaan_proyek == 'Tertib' &&
                                $k02->penggunaan_material_standar == 'Tertib' &&
                                $k02->penggunaan_produk_dalam_negeri == 'Tertib' &&
                                $k02->pemenuhan_standar_mutu_material == 'Tertib' &&
                                $k02->pemenuhan_standar_teknis_lingkungan == 'Tertib' &&
                                $k02->pemenuhan_standar_k3 == 'Tertib'
                            ) ? 'Tertib' : 'Tidak Tertib';
                        @endphp

                        <tr>
                            <td style="color: rgb(0, 0, 0); text-align:center; vertical-align: top;">
                                <button data-bs-toggle="modal" 
                                        data-bs-target="#modal-edit2" 
                                        class="btn btn-sm btn-flat btn-primary my-2"
                                        data-id="{{ $k02->id }}"
                                        data-kegiatan_konstruksi="{{ $k02->kegiatan_konstruksi }}"
                                        data-no_kontrak="{{ $k02->no_kontrak }}"
                                        data-nm_bujk="{{ $k02->nm_bujk }}"
                                        data-penerapan_sistem_manajemen_mutu_konstruksi="{{ $k02->penerapan_sistem_manajemen_mutu_konstruksi }}"
                                        data-pemenuhan_peralatan_pelaksanaan_proyek="{{ $k02->pemenuhan_peralatan_pelaksanaan_proyek }}"
                                        data-penggunaan_material_standar="{{ $k02->penggunaan_material_standar }}"
                                        data-penggunaan_produk_dalam_negeri="{{ $k02->penggunaan_produk_dalam_negeri }}"
                                        data-pemenuhan_standar_mutu_material="{{ $k02->pemenuhan_standar_mutu_material }}"
                                        data-pemenuhan_standar_teknis_lingkungan="{{ $k02->pemenuhan_standar_teknis_lingkungan }}"
                                        data-pemenuhan_standar_k3="{{ $k02->pemenuhan_standar_k3 }}"
                                        data-data_dukung="{{ $k02->data_dukung }}">
                                    <i class="bx bx-edit-alt"></i>
                                </button>
                                <form action="{{ route('admin.monev.k02.destroy', $k02->id) }}" method="POST" class="d-inline" id="delete-form-{{ $k02->id }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-sm btn-flat btn-danger my-2" onclick="deleteData({{ $k02->id }})">
                                        <i class="bx bx-trash"></i>
                                    </button>
                                </form>
                            </td>
                            <td style="color: rgb(0, 0, 0); text-align:center; vertical-align: top;">{{ $index + 1 }}</td>
                            <td style="color: rgb(0, 0, 0); text-align:center; vertical-align: top;">{{ $k02->kegiatan_konstruksi }}</td>
                            <td style="color: rgb(0, 0, 0); text-align:center; vertical-align: top;">{{ $k02->no_kontrak }}</td>
                            <td style="color: rgb(0, 0, 0); text-align:center; vertical-align: top;">{{ $k02->nm_bujk }}</td>
                            <td style="color: rgb(0, 0, 0); text-align:center; vertical-align: top;">
                                @if ($k02->penerapan_sistem_manajemen_mutu_konstruksi == 'Tidak Tertib')
                                    <button type="button" class="btn btn-sm rounded-pill btn-danger">
                                        <i class='bx bx-x'></i>
                                    </button>
                                @else
                                    <button type="button" class="btn btn-sm rounded-pill btn-success">
                                        <i class='bx bx-check'></i>
                                    </button>
                                @endif
                            </td>
                            
                            <td style="color: rgb(0, 0, 0); text-align:center; vertical-align: top;">
                                @if ($k02->pemenuhan_peralatan_pelaksanaan_proyek == 'Tidak Tertib')
                                    <button type="button" class="btn btn-sm rounded-pill btn-danger">
                                        <i class='bx bx-x'></i>
                                    </button>
                                @else
                                    <button type="button" class="btn btn-sm rounded-pill btn-success">
                                        <i class='bx bx-check'></i>
                                    </button>
                                @endif
                            </td>
                            
                            <td style="color: rgb(0, 0, 0); text-align:center; vertical-align: top;">
                                @if ($k02->penggunaan_material_standar == 'Tidak Tertib')
                                    <button type="button" class="btn btn-sm rounded-pill btn-danger">
                                        <i class='bx bx-x'></i>
                                    </button>
                                @else
                                    <button type="button" class="btn btn-sm rounded-pill btn-success">
                                        <i class='bx bx-check'></i>
                                    </button>
                                @endif
                            </td>
                            
                            <td style="color: rgb(0, 0, 0); text-align:center; vertical-align: top;">
                                @if ($k02->penggunaan_produk_dalam_negeri == 'Tidak Tertib')
                                    <button type="button" class="btn btn-sm rounded-pill btn-danger">
                                        <i class='bx bx-x'></i>
                                    </button>
                                @else
                                    <button type="button" class="btn btn-sm rounded-pill btn-success">
                                        <i class='bx bx-check'></i>
                                    </button>
                                @endif
                            </td>
                            
                            <td style="color: rgb(0, 0, 0); text-align:center; vertical-align: top;">
                                @if ($k02->pemenuhan_standar_mutu_material == 'Tidak Tertib')
                                    <button type="button" class="btn btn-sm rounded-pill btn-danger">
                                        <i class='bx bx-x'></i>
                                    </button>
                                @else
                                    <button type="button" class="btn btn-sm rounded-pill btn-success">
                                        <i class='bx bx-check'></i>
                                    </button>
                                @endif
                            </td>
                            
                            <td style="color: rgb(0, 0, 0); text-align:center; vertical-align: top;">
                                @if ($k02->pemenuhan_standar_teknis_lingkungan == 'Tidak Tertib')
                                    <button type="button" class="btn btn-sm rounded-pill btn-danger">
                                        <i class='bx bx-x'></i>
                                    </button>
                                @else
                                    <button type="button" class="btn btn-sm rounded-pill btn-success">
                                        <i class='bx bx-check'></i>
                                    </button>
                                @endif
                            </td>
                            
                            <td style="color: rgb(0, 0, 0); text-align:center; vertical-align: top;">
                                @if ($k02->pemenuhan_standar_k3 == 'Tidak Tertib')
                                    <button type="button" class="btn btn-sm rounded-pill btn-danger">
                                        <i class='bx bx-x'></i>
                                    </button>
                                @else
                                    <button type="button" class="btn btn-sm rounded-pill btn-success">
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
                            <input type="hidden" name="skpd_id" value="{{ auth()->user()->skpd_id }}">
                            
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
                    
                            <div class="col-md-12 mt-4">
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
                                <dt>Upload Data Dukung <small style="color: red">*maks 5MB (Wajib PDF)</small></dt>
                                <dd><input type="file" class="form-control" name="data_dukung" accept=".pdf"></dd>
                            </div>
                    
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
                            <dt>Update Data Dukung <small style="color: red">*maks 5MB (Wajib PDF)</small></dt>
                            <dd><input type="file" class="form-control" name="data_dukung" accept=".pdf"></dd>
                        </div>
                        <div id="pdf-preview" style="margin-top: 20px;">
                            <iframe id="pdf-frame" src="" width="100%" height="500px" style="border: 1px solid #ccc;"></iframe>
                        </div>
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
                            <dt>Update Data Dukung <small style="color: red">*maks 5MB (Wajib PDF)</small></dt>
                            <dd><input type="file" class="form-control" name="data_dukung" accept=".pdf"></dd>
                        </div>
                        <div id="pdf-preview2" style="margin-top: 20px;">
                            <iframe id="pdf-frame2" src="" width="100%" height="500px" style="border: 1px solid #ccc;"></iframe>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
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
            var proses_pemilihan_penyedia_jasa = button.data('proses_pemilihan_penyedia_jasa') || '';
            var penerapan_standar_kontrak = button.data('penerapan_standar_kontrak') || '';
            var penggunaan_tenaga_kerja_bersertifikat = button.data('penggunaan_tenaga_kerja_bersertifikat') || '';
            var pemberian_pekerjaan_utama_subpenyedia = button.data('pemberian_pekerjaan_utama_subpenyedia') || '';
            var ketersediaan_dokumen_standar_k4 = button.data('ketersediaan_dokumen_standar_k4') || '';
            var penerapan_smkk = button.data('penerapan_smkk') || '';
            var kegiatan_antisipasi_kecelakaan_kerja = button.data('kegiatan_antisipasi_kecelakaan_kerja') || '';
            var file_pdf = button.data('data_dukung') ? '/uploads/data_dukung/' + button.data('data_dukung') : '';

        
            // Masukkan data ke dalam form modal
            modal.find('input[name="kegiatan_konstruksi"]').val(kegiatan_konstruksi);
            modal.find('input[name="no_kontrak"]').val(no_kontrak);
            modal.find('input[name="nm_bujk"]').val(nm_bujk);
            modal.find('select[name="proses_pemilihan_penyedia_jasa"]').val(proses_pemilihan_penyedia_jasa);
            modal.find('select[name="penerapan_standar_kontrak"]').val(penerapan_standar_kontrak);
            modal.find('select[name="penggunaan_tenaga_kerja_bersertifikat"]').val(penggunaan_tenaga_kerja_bersertifikat);
            modal.find('select[name="pemberian_pekerjaan_utama_subpenyedia"]').val(pemberian_pekerjaan_utama_subpenyedia);
            modal.find('select[name="ketersediaan_dokumen_standar_k4"]').val(ketersediaan_dokumen_standar_k4);
            modal.find('select[name="penerapan_smkk"]').val(penerapan_smkk);
            modal.find('select[name="kegiatan_antisipasi_kecelakaan_kerja"]').val(kegiatan_antisipasi_kecelakaan_kerja);
            modal.find('input[name="id"]').val(id); // hidden input
        
            // Tampilkan file PDF kalau ada
            if(file_pdf !== ''){
                $('#pdf-frame').attr('src', file_pdf);
                $('#pdf-preview').show();
            } else {
                $('#pdf-frame').attr('src', '');
                $('#pdf-preview').hide();
            }
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
            var penerapan_sistem_manajemen_mutu_konstruksi = button.data('penerapan_sistem_manajemen_mutu_konstruksi') || '';
            var pemenuhan_peralatan_pelaksanaan_proyek = button.data('pemenuhan_peralatan_pelaksanaan_proyek') || '';
            var penggunaan_material_standar = button.data('penggunaan_material_standar') || '';
            var penggunaan_produk_dalam_negeri = button.data('penggunaan_produk_dalam_negeri') || '';
            var pemenuhan_standar_mutu_material = button.data('pemenuhan_standar_mutu_material') || '';
            var pemenuhan_standar_teknis_lingkungan = button.data('pemenuhan_standar_teknis_lingkungan') || '';
            var pemenuhan_standar_k3 = button.data('pemenuhan_standar_k3') || '';
            var file_pdf = button.data('data_dukung') ? '/uploads/data_dukung/' + button.data('data_dukung') : '';

        
            // Masukkan data ke dalam form modal
            modal.find('input[name="kegiatan_konstruksi"]').val(kegiatan_konstruksi);
            modal.find('input[name="no_kontrak"]').val(no_kontrak);
            modal.find('input[name="nm_bujk"]').val(nm_bujk);
            modal.find('select[name="penerapan_sistem_manajemen_mutu_konstruksi"]').val(penerapan_sistem_manajemen_mutu_konstruksi);
            modal.find('select[name="pemenuhan_peralatan_pelaksanaan_proyek"]').val(pemenuhan_peralatan_pelaksanaan_proyek);
            modal.find('select[name="penggunaan_material_standar"]').val(penggunaan_material_standar);
            modal.find('select[name="penggunaan_produk_dalam_negeri"]').val(penggunaan_produk_dalam_negeri);
            modal.find('select[name="pemenuhan_standar_mutu_material"]').val(pemenuhan_standar_mutu_material);
            modal.find('select[name="pemenuhan_standar_teknis_lingkungan"]').val(pemenuhan_standar_teknis_lingkungan);
            modal.find('select[name="pemenuhan_standar_k3"]').val(pemenuhan_standar_k3);
            modal.find('input[name="id"]').val(id); // hidden input
            // Tampilkan file PDF kalau ada
            if(file_pdf !== ''){
                $('#pdf-frame2').attr('src', file_pdf);
                $('#pdf-preview2').show();
            } else {
                $('#pdf-frame2').attr('src', '');
                $('#pdf-preview2').hide();
            }
        });
    </script>
    
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
