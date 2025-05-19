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
                        PENGAWASAN TERTIB USAHA JASA KONSTRUKSI TAHUNAN (BUJK) 
                        @if (auth()->user()->hasRole('admin'))
                        <div class="btn-group" style="float: right; margin-right:10px;"  role="group">
                            <a type="button" class="btn btn-sm btn-secondary"
                                href="{{ route('admin.monev.k01b.download', ['skpd_id' => $selectedSkpdId ?? 'all','status'=>'k01b']) }}"
                                target="_blank">
                                Download (K.01.B)
                            </a>
                        </div>
                        <div class="btn-group" style="float: right; margin-right:10px;"  role="group">
                            <a type="button" class="btn btn-sm btn-secondary"
                                href="{{ route('admin.monev.k01b.download', ['skpd_id' => $selectedSkpdId ?? 'all','status'=>'p01b']) }}"
                                target="_blank">
                                Download (P.01.B)
                            </a>
                        </div>
                        <div class="btn-group" style="float: right; margin-right:10px;"  role="group">
                            <a type="button" class="btn btn-sm btn-secondary"
                                href="{{ route('admin.monev.k01b.download', ['skpd_id' => $selectedSkpdId ?? 'all','status'=>'rk01b']) }}"
                                target="_blank">
                                Download (RK.01.B)
                            </a>
                        </div>
                        @else 
                            <button style="float: right;margin-right:10px;" type="button" data-bs-toggle="modal"
                                data-bs-target="#modal-tambah-foto" class="btn btn-sm btn-primary">
                                Tambah
                            </button>
                            <div class="btn-group" style="float: right; margin-right:10px;"  role="group">
                                <a type="button" class="btn btn-sm btn-secondary"
                                    href="{{ route('admin.monev.k01b.download', ['skpd_id' => $selectedSkpdId ?? 'all','status'=>'k01b']) }}"
                                    target="_blank">
                                    Download (K.01.B)
                                </a>
                            </div>
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
            @if (auth()->user()->hasRole('admin'))
                <label for="skpdFilter">Filter SOPD:</label>
                <select id="skpdFilter" class="form-control select2" onchange="filterBySkpd(this.value)">
                    <option value="">Pilih SOPD</option>
                    @foreach ($skpd as $skpd2)
                        <option value="{{ $skpd2->id }}" {{ $selectedSkpdId == $skpd2->id ? 'selected' : '' }}>
                            {{ $skpd2->nama }}
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
                            <th style="color: white; text-align:center; vertical-align: top;">NIB</th>
                            <th style="color: white; text-align:center; vertical-align: top;">Nama Badan Usaha</th>
                            <th style="color: white; text-align:center; vertical-align: top;">PJBU</th>
                            <th style="color: white; text-align:center; vertical-align: top;">Jenis</th>
                            <th style="color: white; text-align:center; vertical-align: top;">Sifat</th>
                            <th style="color: white; text-align:center; vertical-align: top;">Klasifikasi</th>
                            <th style="color: white; text-align:center; vertical-align: top;">Layanan</th>
                            <th style="color: white; text-align:center; vertical-align: top;">Bentuk</th>
                            <th style="color: white; text-align:center; vertical-align: top;">Kualisifikasi</th>
                            <th style="color: white; text-align:center; vertical-align: top;">SBU</th>
                            <th style="color: white; text-align:center; vertical-align: top;">NIB</th>
                            <th style="color: white; text-align:center; vertical-align: top;">Pelaksanaan Pengembangan Usaha Berkelanjutan</th>
                            <th style="color: white; text-align:center; vertical-align: top;">Status</th>
                        </tr>
                        
                    </thead>
                    <tbody>
                       
                        @foreach ($dataK01b as $index => $k01b)
                        @php
                            $statusAkhir = (
                                $k01b->jenis != NULL &&
                                $k01b->sifat != NULL &&
                                $k01b->klasifikasi != NULL &&
                                $k01b->layanan != NULL &&
                                $k01b->bentuk != NULL &&
                                $k01b->kualifikasi != NULL &&
                                $k01b->pm_sbu != NULL &&
                                $k01b->pm_nib != NULL &&
                                $k01b->pl_peng_usaha_berkelanjutan != NULL
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
                                                data-id="{{ $k01b->id }}"
                                                data-nib="{{ $k01b->nib }}"
                                                data-nm_badan_usaha="{{ $k01b->nm_badan_usaha }}"
                                                data-pjbu="{{ $k01b->pjbu }}">
                                            <i class="bx bx-edit-alt"> Edit</i>
                                        </button>
                            
                                        <form action="{{ route('admin.monev.k01b.destroy', $k01b->id) }}" method="POST" class="d-inline" id="delete-form-{{ $k01b->id }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="dropdown-item" onclick="deleteData({{ $k01b->id }})">
                                                <i class="bx bx-trash"> Hapus</i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                            <td style="color: rgb(0, 0, 0); text-align:center; vertical-align: top;">{{ $index + 1 }}</td>
                            <td style="color: rgb(0, 0, 0); text-align:center; vertical-align: top;">{{ $k01b->nib }}</td>
                            <td style="color: rgb(0, 0, 0); text-align:center; vertical-align: top;">{{ $k01b->nm_badan_usaha }}</td>
                            <td style="color: rgb(0, 0, 0); text-align:center; vertical-align: top;">{{ $k01b->pjbu }}</td>
                            <td style="color: rgb(0, 0, 0); text-align:center; vertical-align: top;">
                                @if ($k01b->jenis == NULL )
                                    <button type="button" class="btn btn-sm rounded-pill btn-icon btn-danger">
                                        <i class='bx bx-x'></i>
                                    </button>
                                @else
                                    <button type="button" class="btn btn-sm rounded-pill btn-icon  btn-success" data-bs-toggle="modal" 
                                                data-bs-target="#modal-pdf" 
                                                data-data_dukung="{{ $k01b->jenis }}">
                                            <i class='bx bx-check'></i>
                                    </button>
                                @endif
                            </td>
                            
                             <td style="color: rgb(0, 0, 0); text-align:center; vertical-align: top;">
                                @if ($k01b->sifat == NULL )
                                    <button type="button" class="btn btn-sm rounded-pill btn-icon btn-danger">
                                        <i class='bx bx-x'></i>
                                    </button>
                                @else
                                    <button type="button" class="btn btn-sm rounded-pill btn-icon  btn-success" data-bs-toggle="modal" 
                                                data-bs-target="#modal-pdf" 
                                                data-data_dukung="{{ $k01b->sifat }}">
                                            <i class='bx bx-check'></i>
                                    </button>
                                @endif
                            </td>
                            
                            <td style="color: rgb(0, 0, 0); text-align:center; vertical-align: top;">
                                @if ($k01b->klasifikasi == NULL )
                                    <button type="button" class="btn btn-sm rounded-pill btn-icon btn-danger">
                                        <i class='bx bx-x'></i>
                                    </button>
                                @else
                                    <button type="button" class="btn btn-sm rounded-pill btn-icon  btn-success" data-bs-toggle="modal" 
                                                data-bs-target="#modal-pdf" 
                                                data-data_dukung="{{ $k01b->klasifikasi }}">
                                            <i class='bx bx-check'></i>
                                    </button>
                                @endif
                            </td>

                            <td style="color: rgb(0, 0, 0); text-align:center; vertical-align: top;">
                                @if ($k01b->layanan == NULL )
                                    <button type="button" class="btn btn-sm rounded-pill btn-icon btn-danger">
                                        <i class='bx bx-x'></i>
                                    </button>
                                @else
                                    <button type="button" class="btn btn-sm rounded-pill btn-icon  btn-success" data-bs-toggle="modal" 
                                                data-bs-target="#modal-pdf" 
                                                data-data_dukung="{{ $k01b->layanan }}">
                                            <i class='bx bx-check'></i>
                                    </button>
                                @endif
                            </td>

                            <td style="color: rgb(0, 0, 0); text-align:center; vertical-align: top;">
                                @if ($k01b->bentuk == NULL )
                                    <button type="button" class="btn btn-sm rounded-pill btn-icon btn-danger">
                                        <i class='bx bx-x'></i>
                                    </button>
                                @else
                                    <button type="button" class="btn btn-sm rounded-pill btn-icon  btn-success" data-bs-toggle="modal" 
                                                data-bs-target="#modal-pdf" 
                                                data-data_dukung="{{ $k01b->bentuk }}">
                                            <i class='bx bx-check'></i>
                                    </button>
                                @endif
                            </td>

                            <td style="color: rgb(0, 0, 0); text-align:center; vertical-align: top;">
                                @if ($k01b->kualifikasi == NULL )
                                    <button type="button" class="btn btn-sm rounded-pill btn-icon btn-danger">
                                        <i class='bx bx-x'></i>
                                    </button>
                                @else
                                    <button type="button" class="btn btn-sm rounded-pill btn-icon  btn-success" data-bs-toggle="modal" 
                                                data-bs-target="#modal-pdf" 
                                                data-data_dukung="{{ $k01b->kualifikasi }}">
                                            <i class='bx bx-check'></i>
                                    </button>
                                @endif
                            </td>

                            <td style="color: rgb(0, 0, 0); text-align:center; vertical-align: top;">
                                @if ($k01b->pm_sbu == NULL )
                                    <button type="button" class="btn btn-sm rounded-pill btn-icon btn-danger">
                                        <i class='bx bx-x'></i>
                                    </button>
                                @else
                                    <button type="button" class="btn btn-sm rounded-pill btn-icon  btn-success" data-bs-toggle="modal" 
                                                data-bs-target="#modal-pdf" 
                                                data-data_dukung="{{ $k01b->pm_sbu }}">
                                            <i class='bx bx-check'></i>
                                    </button>
                                @endif
                            </td>

                            <td style="color: rgb(0, 0, 0); text-align:center; vertical-align: top;">
                                @if ($k01b->pm_nib == NULL )
                                    <button type="button" class="btn btn-sm rounded-pill btn-icon btn-danger">
                                        <i class='bx bx-x'></i>
                                    </button>
                                @else
                                    <button type="button" class="btn btn-sm rounded-pill btn-icon  btn-success" data-bs-toggle="modal" 
                                                data-bs-target="#modal-pdf" 
                                                data-data_dukung="{{ $k01b->pm_nib }}">
                                            <i class='bx bx-check'></i>
                                    </button>
                                @endif
                            </td>

                            <td style="color: rgb(0, 0, 0); text-align:center; vertical-align: top;">
                                @if ($k01b->pl_peng_usaha_berkelanjutan == NULL )
                                    <button type="button" class="btn btn-sm rounded-pill btn-icon btn-danger">
                                        <i class='bx bx-x'></i>
                                    </button>
                                @else
                                    <button type="button" class="btn btn-sm rounded-pill btn-icon  btn-success" data-bs-toggle="modal" 
                                                data-bs-target="#modal-pdf" 
                                                data-data_dukung="{{ $k01b->pl_peng_usaha_berkelanjutan }}">
                                            <i class='bx bx-check'></i>
                                    </button>
                                @endif
                            </td>

                            <td style="text-align:center; vertical-align: top;">
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
                        PENGAWASAN TERTIB USAHA JASA KONSTRUKSI TAHUNAN (BUJK)
                    </div>
                    <form method="post" id="form-tambah" action="{{ route('admin.monev.k01b.insert') }}"
                        enctype="multipart/form-data">
                        @csrf
                        
                        <div>
                            <input type="hidden" name="skpd_id" value="{{ auth()->user()->skpd_id }}">
                            
                            <div class="col-md-12 mt-4">
                                <small class="text-light fw-semibold">Upload :</small>
                            </div>
                    
                            <div class="col-md-12 mt-4">
                                <dt>Nomor Izin Berusaha</dt>
                                <dd><input type="text" class="form-control" name="nib" placeholder="Nomor Izin Berusaha"></dd>
                            </div>
                    
                            <div class="col-md-12 mt-4">
                                <dt>Nama Badan Usaha</dt>
                                <dd><input type="text" class="form-control" name="nm_badan_usaha" placeholder="Nama Badan Usaha"></dd>
                            </div>
                    
                            <div class="col-md-12 mt-4">
                                <dt>Penanggung Jawab Badan Usaha</dt>
                                <dd><input type="text" class="form-control" name="pjbu" placeholder="Penanggung Jawab Badan Usaha"></dd>
                            </div>
                    
                            {{-- <br>
                            <div class="alert alert-primary" role="alert">
                                Kesesuaian Kegiatan Kontruksi
                            </div>

                            <div class="col-md-12 mt-4">
                                <dt>Jenis</dt>
                                <dd>
                                    <select class="form-control" name="jenis">
                                        
                                        <option value="Tertib">Tertib</option>
                                        <option value="Tidak Tertib" selected>Tidak Tertib</option>
                                    </select>
                                </dd>
                            </div>
                    
                            <div class="col-md-12 mt-4">
                                <dt>Sifat</dt>
                                <dd>
                                    <select class="form-control" name="sifat">
                                        
                                        <option value="Tertib">Tertib</option>
                                        <option value="Tidak Tertib" selected>Tidak Tertib</option>
                                    </select>
                                </dd>
                            </div>
                    
                            <div class="col-md-12 mt-4">
                                <dt>Klasifikasi</dt>
                                <dd>
                                    <select class="form-control" name="klasifikasi">
                                        
                                        <option value="Tertib">Tertib</option>
                                        <option value="Tidak Tertib" selected>Tidak Tertib</option>
                                    </select>
                                </dd>
                            </div>

                            <div class="col-md-12 mt-4">
                                <dt>Layanan</dt>
                                <dd>
                                    <select class="form-control" name="layanan">
                                        
                                        <option value="Tertib">Tertib</option>
                                        <option value="Tidak Tertib" selected>Tidak Tertib</option>
                                    </select>
                                </dd>
                            </div>
                    
                            <br>
                            <div class="alert alert-primary" role="alert">
                                Kesesuaian Kegiatan Usaha Jasa Kontruksi dan Segmentasi Pasar Jasa Kontruksi
                            </div>

                            <div class="col-md-12 mt-4">
                                <dt>Bentuk</dt>
                                <dd>
                                    <select class="form-control" name="bentuk">
                                        
                                        <option value="Tertib">Tertib</option>
                                        <option value="Tidak Tertib" selected>Tidak Tertib</option>
                                    </select>
                                </dd>
                            </div>

                            <div class="col-md-12 mt-4">
                                <dt>Kualifikasi</dt>
                                <dd>
                                    <select class="form-control" name="kualifikasi">
                                        
                                        <option value="Tertib">Tertib</option>
                                        <option value="Tidak Tertib" selected>Tidak Tertib</option>
                                    </select>
                                </dd>
                            </div>

                            <br>
                            <div class="alert alert-primary" role="alert">
                                Pemenuhan Persyaratan Usaha
                            </div>   

                            <div class="col-md-12 mt-4">
                                <dt>SBU</dt>
                                <dd>
                                    <select class="form-control" name="pm_sbu">
                                        
                                        <option value="Tertib">Tertib</option>
                                        <option value="Tidak Tertib" selected>Tidak Tertib</option>
                                    </select>
                                </dd>
                            </div>

                            <div class="col-md-12 mt-4">
                                <dt>NIB</dt>
                                <dd>
                                    <select class="form-control" name="pm_nib">
                                        
                                        <option value="Tertib">Tertib</option>
                                        <option value="Tidak Tertib" selected>Tidak Tertib</option>
                                    </select>
                                </dd>
                            </div>

                            <div class="col-md-12 mt-4">
                                <dt>Pelaksanaan Pengembangan Usaha Berkelanjutan</dt>
                                <dd>
                                    <select class="form-control" name="pl_peng_usaha_berkelanjutan">
                                        
                                        <option value="Tertib">Tertib</option>
                                        <option value="Tidak Tertib" selected>Tidak Tertib</option>
                                    </select>
                                </dd>
                            </div>

                            <div class="col-md-12 mt-4">
                                <dt>Upload Data Dukung <small style="color: red">*maks 5MB (Wajib PDF)</small></dt>
                                <dd><input type="file" class="form-control" name="data_dukung" accept=".pdf"></dd>
                            </div> --}}
                    
                        </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="submit" id="tombol" class="btn btn-primary">SIMPAN</button>
                    <button type="submit" id="loading" class="btn btn-warning" style="display: none;" readonly>
                        LOADING......
                    </button>
                </div>
                </form>
            </div>
        </div>
    </div>
    {{-- Edit Tabel --}}
    <div class="modal fade" role="dialog" id="modal-edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" id="form-edit" action="{{ route('admin.monev.k01b.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')  
                        <input type="hidden" name="id">

                        <input type="hidden" name="skpd_id" value="{{ auth()->user()->skpd_id }}">
    
                        <div class="col-md-12 mt-4">
                            <dt>Nomor Izin Berusaha</dt>
                            <dd><input type="text" class="form-control" name="nib" placeholder="Nomor Izin Berusaha"></dd>
                        </div>
                
                        <div class="col-md-12 mt-4">
                            <dt>Nama Badan Usaha</dt>
                            <dd><input type="text" class="form-control" name="nm_badan_usaha" placeholder="Nama Badan Usaha"></dd>
                        </div>
                
                        <div class="col-md-12 mt-4">
                            <dt>Penanggung Jawab Badan Usaha</dt>
                            <dd><input type="text" class="form-control" name="pjbu" placeholder="Penanggung Jawab Badan Usaha"></dd>
                        </div>


                        <div class="col-md-12 mt-4">
                            <dt>Pilih File Upload :</dt>
                            <dd>
                               <select class="form-control" name="field_tujuan" required>
                                    <option value="">- Pilih -</option>
                                    <option value="jenis">(Jenis) Kesesuaian Kegiatan Kontruksi</option>
                                    <option value="sifat">(Sifat) Kesesuaian Kegiatan Kontruksi</option>
                                    <option value="klasifikasi">(Klasifikasi) Kesesuaian Kegiatan Kontruksi</option>
                                    <option value="layanan">(Layanan) Kesesuaian Kegiatan Kontruksi</option>

                                    <option value="bentuk">(Bentuk) Kesesuaian Kegiatan Usaha Jasa Kontruksi dan Segmentasi Pasar Jasa Kontruksi</option>
                                    <option value="kualifikasi">(Kualifikasi) Kesesuaian Kegiatan Usaha Jasa Kontruksi dan Segmentasi Pasar Jasa Kontruksi</option>

                                    <option value="pm_sbu">(SBU) Pemenuhan Persyaratan Usaha</option>
                                    <option value="pm_nib">(NIB) Pemenuhan Persyaratan Usaha</option>

                                    <option value="pl_peng_usaha_berkelanjutan">Pelaksanaan Pengembangan Usaha Berkelanjutan</option>
                                </select>
                            </dd>
                        </div>
                         <div class="col-md-12 mt-4">
                            <dt>Upload File <small style="color: red">*maks 5MB (Wajib PDF)</small></dt>
                            <dd><input type="file" class="form-control" name="file" accept=".pdf"></dd>
                        </div>



{{--                 
                        <br>
                        <div class="alert alert-primary" role="alert">
                            Kesesuaian Kegiatan Kontruksi
                        </div>

                        <div class="col-md-12 mt-4">
                            <dt>Jenis</dt>
                            <dd>
                                <select class="form-control" name="jenis">
                                    
                                    <option value="Tertib">Tertib</option>
                                    <option value="Tidak Tertib" selected>Tidak Tertib</option>
                                </select>
                            </dd>
                        </div>
                
                        <div class="col-md-12 mt-4">
                            <dt>Sifat</dt>
                            <dd>
                                <select class="form-control" name="sifat">
                                    
                                    <option value="Tertib">Tertib</option>
                                    <option value="Tidak Tertib" selected>Tidak Tertib</option>
                                </select>
                            </dd>
                        </div>
                
                        <div class="col-md-12 mt-4">
                            <dt>Klasifikasi</dt>
                            <dd>
                                <select class="form-control" name="klasifikasi">
                                    
                                    <option value="Tertib">Tertib</option>
                                    <option value="Tidak Tertib" selected>Tidak Tertib</option>
                                </select>
                            </dd>
                        </div>

                        <div class="col-md-12 mt-4">
                            <dt>Layanan</dt>
                            <dd>
                                <select class="form-control" name="layanan">
                                    
                                    <option value="Tertib">Tertib</option>
                                    <option value="Tidak Tertib" selected>Tidak Tertib</option>
                                </select>
                            </dd>
                        </div>
                
                        <br>
                        <div class="alert alert-primary" role="alert">
                            Kesesuaian Kegiatan Usaha Jasa Kontruksi dan Segmentasi Pasar Jasa Kontruksi
                        </div>

                        <div class="col-md-12 mt-4">
                            <dt>Bentuk</dt>
                            <dd>
                                <select class="form-control" name="bentuk">
                                    
                                    <option value="Tertib">Tertib</option>
                                    <option value="Tidak Tertib" selected>Tidak Tertib</option>
                                </select>
                            </dd>
                        </div>

                        <div class="col-md-12 mt-4">
                            <dt>Kualifikasi</dt>
                            <dd>
                                <select class="form-control" name="kualifikasi">
                                    
                                    <option value="Tertib">Tertib</option>
                                    <option value="Tidak Tertib" selected>Tidak Tertib</option>
                                </select>
                            </dd>
                        </div>

                        <br>
                        <div class="alert alert-primary" role="alert">
                            Pemenuhan Persyaratan Usaha
                        </div>   

                        <div class="col-md-12 mt-4">
                            <dt>SBU</dt>
                            <dd>
                                <select class="form-control" name="pm_sbu">
                                    
                                    <option value="Tertib">Tertib</option>
                                    <option value="Tidak Tertib" selected>Tidak Tertib</option>
                                </select>
                            </dd>
                        </div>

                        <div class="col-md-12 mt-4">
                            <dt>NIB</dt>
                            <dd>
                                <select class="form-control" name="pm_nib">
                                    
                                    <option value="Tertib">Tertib</option>
                                    <option value="Tidak Tertib" selected>Tidak Tertib</option>
                                </select>
                            </dd>
                        </div>

                        <div class="col-md-12 mt-4">
                            <dt>Pelaksanaan Pengembangan Usaha Berkelanjutan</dt>
                            <dd>
                                <select class="form-control" name="pl_peng_usaha_berkelanjutan">
                                    
                                    <option value="Tertib">Tertib</option>
                                    <option value="Tidak Tertib" selected>Tidak Tertib</option>
                                </select>
                            </dd>
                        </div>

                        <div class="col-md-12 mt-4">
                            <dt>Update Data Dukung <small style="color: red">*maks 5MB (Wajib PDF)</small></dt>
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
    {{-- Data Edit Tabel --}}
    <script>
        $('#modal-edit').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Tombol yang diklik
            var modal = $(this);
        
            // Ambil data dari tombol
            var id = button.data('id') || '';
            var nib = button.data('nib') || '';
            var nm_badan_usaha = button.data('nm_badan_usaha') || '';
            var pjbu = button.data('pjbu') || '';
            var jenis = button.data('jenis') || '';
            var sifat = button.data('sifat') || '';
            var klasifikasi = button.data('klasifikasi') || '';
            var layanan = button.data('layanan') || '';
            var bentuk	 = button.data('bentuk') || '';
            var kualifikasi	 = button.data('kualifikasi') || '';
            var pm_sbu	= button.data('pm_sbu') || '';
            var pm_nib	= button.data('pm_nib') || '';
            var pl_peng_usaha_berkelanjutan	= button.data('pl_peng_usaha_berkelanjutan') || '';
            var file_pdf = button.data('data_dukung') ? '/uploads/data_dukung/' + button.data('data_dukung') : '';

        
            // Masukkan data ke dalam form modal
            modal.find('input[name="nib"]').val(nib);
            modal.find('input[name="nm_badan_usaha"]').val(nm_badan_usaha);
            modal.find('input[name="pjbu"]').val(pjbu);
            modal.find('select[name="jenis"]').val(jenis);
            modal.find('select[name="sifat"]').val(sifat);
            modal.find('select[name="klasifikasi"]').val(klasifikasi);
            modal.find('select[name="layanan"]').val(layanan);
            modal.find('select[name="bentuk"]').val(bentuk);
            modal.find('select[name="kualifikasi"]').val(kualifikasi);
            modal.find('select[name="pm_sbu"]').val(pm_sbu);
            modal.find('select[name="pm_nib"]').val(pm_nib);
            modal.find('select[name="pl_peng_usaha_berkelanjutan"]').val(pl_peng_usaha_berkelanjutan);
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
