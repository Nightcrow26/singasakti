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
                        PENGAWASAN TERTIB PEMANFAATAN JASA KONSTRUKSI 
                        @if (auth()->user()->hasRole('admin'))
                        <div class="btn-group" style="float: right; margin-right:10px;"  role="group">
                            <a type="button" class="btn btn-sm btn-secondary"
                                href="{{ route('admin.monev.k03.download', ['skpd_id' => $selectedSkpdId ?? 'all','status'=>'k03']) }}"
                                target="_blank">
                                Download (K.03)
                            </a>
                        </div>
                        <div class="btn-group" style="float: right; margin-right:10px;"  role="group">
                            <a type="button" class="btn btn-sm btn-secondary"
                                href="{{ route('admin.monev.k03.download', ['skpd_id' => $selectedSkpdId ?? 'all','status'=>'p03']) }}"
                                target="_blank">
                                Download (P.03)
                            </a>
                        </div>
                        <div class="btn-group" style="float: right; margin-right:10px;"  role="group">
                            <a type="button" class="btn btn-sm btn-secondary"
                                href="{{ route('admin.monev.k03.download', ['skpd_id' => $selectedSkpdId ?? 'all','status'=>'rk03']) }}"
                                target="_blank">
                                Download (RK.03)
                            </a>
                        </div>
                        @else 
                        <button style="float: right;margin-right:10px;" type="button" data-bs-toggle="modal"
                            data-bs-target="#modal-tambah-foto" class="btn btn-sm btn-primary">
                            Tambah
                        </button>
                         <div class="btn-group" style="float: right; margin-right:10px;"  role="group">
                            <a type="button" class="btn btn-sm btn-secondary"
                                href="{{ route('admin.monev.k03.download', ['skpd_id' => $selectedSkpdId ?? 'all','status'=>'k03']) }}"
                                target="_blank">
                                Download (K.03)
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
                            <th style="color: white; text-align:center; vertical-align: top;">Nama Bangunan Konstruksi</th>
                            <th style="color: white; text-align:center; vertical-align: top;">Nomor Kontrak (Pembangunan)</th>
                            <th style="color: white; text-align:center; vertical-align: top;">Lokasi</th>
                            <th style="color: white; text-align:center; vertical-align: top;">Tanggal dan Tahun Pembangunan</th>
                            <th style="color: white; text-align:center; vertical-align: top;">Tanggal dan Tahun Pemamfaatan</th>
                            <th style="color: white; text-align:center; vertical-align: top;">Umur Konstruksi</th>
                            <th style="color: white; text-align:center; vertical-align: top;">Kesesuaian Fungsi</th>
                            <th style="color: white; text-align:center; vertical-align: top;">Kesesuaian Lokasi</th>
                            <th style="color: white; text-align:center; vertical-align: top;">Rencana Umur Konstruksi</th>
                            <th style="color: white; text-align:center; vertical-align: top;">Kapasitas dan Beban</th>
                            <th style="color: white; text-align:center; vertical-align: top;">Pemeliharaan Bangunan</th>
                            <th style="color: white; text-align:center; vertical-align: top;">Program Pemeliharaan</th>
                            <th style="color: white; text-align:center; vertical-align: top;">Status</th>
                        </tr>
                        
                    </thead>
                    <tbody>
                        @foreach ($dataK03 as $index => $k03)
                        @php
                            $statusAkhir = (
                                $k03->kesesuaian_fungsi != NULL &&
                                $k03->kesesuaian_lokasi != NULL &&
                                $k03->rencana_umur != NULL &&
                                $k03->kapasitas_beban != NULL &&
                                $k03->pemeliharaan_bangunan != NULL &&
                                $k03->program_pemeliharaan != NULL
                            ) ? 'Tertib' : 'Tidak Tertib';
                        @endphp
                        <!-- Example Row -->
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
                                            data-id="{{ $k03->id }}"
                                            data-nama_bangunan="{{ $k03->nama_bangunan }}"
                                            data-no_kontrak="{{ $k03->no_kontrak }}"
                                            data-lokasi="{{ $k03->lokasi }}"
                                            data-tgl_thn_pembangunan="{{ $k03->tgl_thn_pembangunan }}"
                                            data-tgl_thn_pemanfaatan="{{ $k03->tgl_thn_pemanfaatan }}"
                                            data-umur_konstruksi="{{ $k03->umur_konstruksi }}">
                                           <i class="bx bx-edit-alt"> Edit</i>
                                       </button>
                           
                                       <form action="{{ route('admin.monev.k03.destroy', $k03->id) }}" method="POST" class="d-inline" id="delete-form-{{ $k03->id }}">
                                           @csrf
                                           @method('DELETE')
                                           <button type="button" class="dropdown-item" onclick="deleteData({{ $k03->id }})">
                                               <i class="bx bx-trash"> Hapus</i>
                                           </button>
                                       </form>
                                   </div>
                               </div>
                           </td>
                            <td style="color: rgb(0, 0, 0); text-align:center; vertical-align: top;">{{ $index + 1 }}</td>
                            <td style="color: rgb(0, 0, 0); text-align:center; vertical-align: top;">{{ $k03->nama_bangunan }}</td>
                            <td style="color: rgb(0, 0, 0); text-align:center; vertical-align: top;">{{ $k03->no_kontrak }}</td>
                            <td style="color: rgb(0, 0, 0); text-align:center; vertical-align: top;">{{ $k03->lokasi }}</td>
                            <td style="color: rgb(0, 0, 0); text-align:center; vertical-align: top;">{{ $k03->tgl_thn_pembangunan }}</td>
                            <td style="color: rgb(0, 0, 0); text-align:center; vertical-align: top;">{{ $k03->tgl_thn_pemanfaatan }}</td>
                            <td style="color: rgb(0, 0, 0); text-align:center; vertical-align: top;">{{ $k03->umur_konstruksi }}</td>
                            <td style="color: rgb(0, 0, 0); text-align:center; vertical-align: top;">
                                @if ($k03->kesesuaian_fungsi == NULL)
                                    <button type="button" class="btn btn-sm rounded-pill btn-icon btn-danger">
                                        <i class='bx bx-x'></i>
                                    </button>
                                @else
                                    <button type="button" class="btn btn-sm rounded-pill btn-icon  btn-success" data-bs-toggle="modal" 
                                                data-bs-target="#modal-pdf" 
                                                data-data_dukung="{{ $k03->kesesuaian_fungsi }}">
                                        <i class='bx bx-check'></i>
                                    </button>
                                @endif
                            </td>
                            
                            <td style="color: rgb(0, 0, 0); text-align:center; vertical-align: top;">
                                @if ($k03->kesesuaian_lokasi== NULL)
                                    <button type="button" class="btn btn-sm rounded-pill btn-icon btn-danger">
                                        <i class='bx bx-x'></i>
                                    </button>
                                @else
                                   <button type="button" class="btn btn-sm rounded-pill btn-icon  btn-success" data-bs-toggle="modal" 
                                                data-bs-target="#modal-pdf" 
                                                data-data_dukung="{{ $k03->kesesuaian_lokasi }}">
                                        <i class='bx bx-check'></i>
                                    </button>
                                @endif
                            </td>
                            
                            <td style="color: rgb(0, 0, 0); text-align:center; vertical-align: top;">
                                @if ($k03->rencana_umur == NULL)
                                    <button type="button" class="btn btn-sm rounded-pill btn-icon btn-danger">
                                        <i class='bx bx-x'></i>
                                    </button>
                                @else
                                   <button type="button" class="btn btn-sm rounded-pill btn-icon  btn-success" data-bs-toggle="modal" 
                                                data-bs-target="#modal-pdf" 
                                                data-data_dukung="{{ $k03->rencana_umur }}">
                                        <i class='bx bx-check'></i>
                                    </button>
                                @endif
                            </td>
                            
                            <td style="color: rgb(0, 0, 0); text-align:center; vertical-align: top;">
                                @if ($k03->kapasitas_beban == NULL)
                                    <button type="button" class="btn btn-sm rounded-pill btn-icon btn-danger">
                                        <i class='bx bx-x'></i>
                                    </button>
                                @else
                                     <button type="button" class="btn btn-sm rounded-pill btn-icon  btn-success" data-bs-toggle="modal" 
                                                data-bs-target="#modal-pdf" 
                                                data-data_dukung="{{ $k03->kapasitas_beban }}">
                                        <i class='bx bx-check'></i>
                                    </button>
                                @endif
                            </td>
                            
                            <td style="color: rgb(0, 0, 0); text-align:center; vertical-align: top;">
                                @if ($k03->pemeliharaan_bangunan == NULL)
                                    <button type="button" class="btn btn-sm rounded-pill btn-icon btn-danger">
                                        <i class='bx bx-x'></i>
                                    </button>
                                @else
                                    <button type="button" class="btn btn-sm rounded-pill btn-icon  btn-success" data-bs-toggle="modal" 
                                                data-bs-target="#modal-pdf" 
                                                data-data_dukung="{{ $k03->pemeliharaan_bangunan }}">
                                        <i class='bx bx-check'></i>
                                    </button>
                                @endif
                            </td>
                            
                            <td style="color: rgb(0, 0, 0); text-align:center; vertical-align: top;">
                                @if ($k03->program_pemeliharaan == NULL)
                                    <button type="button" class="btn btn-sm rounded-pill btn-icon btn-danger">
                                        <i class='bx bx-x'></i>
                                    </button>
                                @else
                                    <button type="button" class="btn btn-sm rounded-pill btn-icon  btn-success" data-bs-toggle="modal" 
                                                data-bs-target="#modal-pdf" 
                                                data-data_dukung="{{ $k03->program_pemeliharaan }}">
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
                        REKAPITULASI PENGAWASAN TERTIB PEMANFAATAN JASA KONSTRUKSI TAHUNAN 
                    </div>
                    <form method="post" id="form-tambah" action="{{ route('admin.monev.k03.insert') }}" enctype="multipart/form-data">
                        @csrf
                        
                        <div>
                            <input type="hidden" id="skpd_id_foto" name="skpd_id"value="{{ auth()->user()->id }}">
                            
                            <div class="col-md-12 mt-4">
                                <small class="text-light fw-semibold">Upload :</small>
                            </div>
                            <div class="col-md-12 mt-4">
                                <dt>Nama Bangunan Konstruksi</dt>
                                <dd><input type="text" class="form-control" id="nama_bangunan" name="nama_bangunan" placeholder="Nama Bangunan"></dd>
                            </div>
                            <div class="col-md-12 mt-4">
                                <dt>Nomor Kontrak (Pembangunan)</dt>
                                <dd><input type="text" class="form-control" id="no_kontrak" name="no_kontrak" placeholder="Nomor Kontrak (Pembangunan)"></dd>
                            </div>
                            <div class="col-md-12 mt-4">
                                <dt>Lokasi</dt>
                                <dd><input type="text" class="form-control" id="lokasi" name="lokasi" placeholder="Lokasi"></dd>
                            </div>
                            <div class="col-md-12 mt-4">
                                <dt>Tanggal dan Tahun Pembangunan</dt>
                                <dd><input type="date" class="form-control" id="tgl_thn_pembangunan" name="tgl_thn_pembangunan" placeholder="Tanggal dan Tahun Pembangunan"></dd>
                            </div>
                            <div class="col-md-12 mt-4">
                                <dt>Tanggal dan Tahun Pemanfaatan</dt>
                                <dd><input type="date" class="form-control" id="tgl_thn_pemanfaatan" name="tgl_thn_pemanfaatan" placeholder="Tanggal dan Tahun Pemanfaatan"></dd>
                            </div>
                            <div class="col-md-12 mt-4">
                                <dt>Umur Konstruksi</dt>
                                <dd><input type="text" class="form-control" id="umur_konstruksi" name="umur_konstruksi" placeholder="Umur Konstruksi"></dd>
                            </div>

                            {{-- <div class="col-md-12 mt-4">
                                <dt>Kesesuaian Fungsi</dt>
                                <dd>
                                    <select type="text" class="form-control" id="kesesuaian_fungsi" name="kesesuaian_fungsi">
                                        <option value="">- Pilih</option>
                                        <option value="Tertib">Tertib</option>
                                        <option value="Tidak Tertib">Tidak Tertib</option>
                                    </select>

                                </dd>
                            </div>

                            <div class="col-md-12 mt-4">
                                <dt>Kesesuaian Lokasi</dt>
                                <dd>
                                    <select type="text" class="form-control" id="kesesuaian_lokasi" name="kesesuaian_lokasi">
                                        <option value="">- Pilih</option>
                                        <option value="Tertib">Tertib</option>
                                        <option value="Tidak Tertib">Tidak Tertib</option>
                                    </select>

                                </dd>
                            </div>

                            <div class="col-md-12 mt-4">
                                <dt>Rencana Umur Konstruksi</dt>
                                <dd>
                                    <select type="text" class="form-control" id="rencana_umur" name="rencana_umur">
                                        <option value="">- Pilih</option>
                                        <option value="Tertib">Tertib</option>
                                        <option value="Tidak Tertib">Tidak Tertib</option>
                                    </select>

                                </dd>
                            </div>
                            <div class="col-md-12 mt-4">
                                <dt>Kapasitas dan Beban</dt>
                                <dd>
                                    <select type="text" class="form-control" id="kapasitas_beban" name="kapasitas_beban">
                                        <option value="">- Pilih</option>
                                        <option value="Tertib">Tertib</option>
                                        <option value="Tidak Tertib">Tidak Tertib</option>
                                    </select>

                                </dd>
                            </div>
                            <div class="col-md-12 mt-4">
                                <dt>Pemeliharaan Bangunan</dt>
                                <dd>
                                    <select type="text" class="form-control" id="pemeliharaan_bangunan" name="pemeliharaan_bangunan">
                                        <option value="">- Pilih</option>
                                        <option value="Tertib">Tertib</option>
                                        <option value="Tidak Tertib">Tidak Tertib</option>
                                    </select>

                                </dd>
                            </div>
                            <div class="col-md-12 mt-4">
                                <dt>Program Pemeliharaan</dt>
                                <dd>
                                    <select type="text" class="form-control" id="program_pemeliharaan" name="program_pemeliharaan">
                                        <option value="">- Pilih</option>
                                        <option value="Tertib">Tertib</option>
                                        <option value="Tidak Tertib">Tidak Tertib</option>
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

   
    {{-- Edit Tabel --}}
    <div class="modal fade" role="dialog" id="modal-edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" id="form-edit" action="{{ route('admin.monev.k03.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT') 
                        
                        <input type="hidden" id="edit-id" name="id">

                        <div class="col-md-12 mt-4">
                            <dt>Nama Bangunan Konstruksi</dt>
                            <dd><input type="text" class="form-control" id="edit-nama_bangunan" name="nama_bangunan" placeholder="Nama Bangunan"></dd>
                        </div>
                        <div class="col-md-12 mt-4">
                            <dt>Nomor Kontrak (Pembangunan)</dt>
                            <dd><input type="text" class="form-control" id="edit-no_kontrak" name="no_kontrak" placeholder="Nomor Kontrak (Pembangunan)"></dd>
                        </div>
                        <div class="col-md-12 mt-4">
                            <dt>Lokasi</dt>
                            <dd><input type="text" class="form-control" id="edit-lokasi" name="lokasi" placeholder="Lokasi"></dd>
                        </div>
                        <div class="col-md-12 mt-4">
                            <dt>Tanggal dan Tahun Pembangunan</dt>
                            <dd><input type="date" class="form-control" id="edit-tgl_thn_pembangunan" name="tgl_thn_pembangunan" placeholder="Tanggal dan Tahun Pembangunan"></dd>
                        </div>
                        <div class="col-md-12 mt-4">
                            <dt>Tanggal dan Tahun Pemanfaatan</dt>
                            <dd><input type="date" class="form-control" id="edit-tgl_thn_pemanfaatan" name="tgl_thn_pemanfaatan" placeholder="Tanggal dan Tahun Pemanfaatan"></dd>
                        </div>
                        <div class="col-md-12 mt-4">
                            <dt>Umur Konstruksi</dt>
                            <dd><input type="text" class="form-control" id="edit-umur_konstruksi" name="umur_konstruksi" placeholder="Umur Konstruksi"></dd>
                        </div>
                        <div class="col-md-12 mt-4">
                            <dt>Pilih File Upload :</dt>
                            <dd>
                               <select class="form-control" name="field_tujuan" required>
                                    <option value="">- Pilih -</option>
                                    <option value="kesesuaian_fungsi">Kesesuaian Fungsi</option>
                                    <option value="kesesuaian_lokasi">Kesesuaian Lokasi</option>
                                    <option value="rencana_umur">Rencana Umur</option>
                                    <option value="kapasitas_beban">Kapasitas Beban</option>
                                    <option value="pemeliharaan_bangunan">Pemeliharaan Bangunan</option>
                                    <option value="program_pemeliharaan">Program Pemeliharaan</option>
                                </select>
                            </dd>
                        </div>
                         <div class="col-md-12 mt-4">
                            <dt>Upload File <small style="color: red">*maks 2MB (Wajib PDF)</small></dt>
                            <dd><input type="file" class="form-control" name="file" accept=".pdf"></dd>
                        </div>


                        {{-- <div class="col-md-12 mt-4">
                            <dt>Kesesuaian Fungsi</dt>
                            <dd>
                                <select class="form-control" id="edit-kesesuaian_fungsi" name="kesesuaian_fungsi">
                                    <option value="">- Pilih</option>
                                    <option value="Tertib">Tertib</option>
                                    <option value="Tidak Tertib">Tidak Tertib</option>
                                </select>
                            </dd>
                        </div>
                        <div class="col-md-12 mt-4">
                            <dt>Kesesuaian Lokasi</dt>
                            <dd>
                                <select class="form-control" id="edit-kesesuaian_lokasi" name="kesesuaian_lokasi">
                                    <option value="">- Pilih</option>
                                    <option value="Tertib">Tertib</option>
                                    <option value="Tidak Tertib">Tidak Tertib</option>
                                </select>
                            </dd>
                        </div>
                        <div class="col-md-12 mt-4">
                            <dt>Rencana Umur Konstruksi</dt>
                            <dd>
                                <select class="form-control" id="edit-rencana_umur" name="rencana_umur">
                                    <option value="">- Pilih</option>
                                    <option value="Tertib">Tertib</option>
                                    <option value="Tidak Tertib">Tidak Tertib</option>
                                </select>
                            </dd>
                        </div>
                        <div class="col-md-12 mt-4">
                            <dt>Kapasitas dan Beban</dt>
                            <dd>
                                <select class="form-control" id="edit-kapasitas_beban" name="kapasitas_beban">
                                    <option value="">- Pilih</option>
                                    <option value="Tertib">Tertib</option>
                                    <option value="Tidak Tertib">Tidak Tertib</option>
                                </select>
                            </dd>
                        </div>
                        <div class="col-md-12 mt-4">
                            <dt>Pemeliharaan Bangunan</dt>
                            <dd>
                                <select class="form-control" id="edit-pemeliharaan_bangunan" name="pemeliharaan_bangunan">
                                    <option value="">- Pilih</option>
                                    <option value="Tertib">Tertib</option>
                                    <option value="Tidak Tertib">Tidak Tertib</option>
                                </select>
                            </dd>
                        </div>
                        <div class="col-md-12 mt-4">
                            <dt>Program Pemeliharaan</dt>
                            <dd>
                                <select class="form-control" id="edit-program_pemeliharaan" name="program_pemeliharaan">
                                    <option value="">- Pilih</option>
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
                        </div>
                        --}}
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

    <script>
    $('#modal-edit').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Tombol yang diklik
            var modal = $(this);

            // Ambil data dari tombol
            var id = button.data('id') || '';
            var nama_bangunan = button.data('nama_bangunan') || '';
            var no_kontrak = button.data('no_kontrak') || '';
            var lokasi = button.data('lokasi') || '';
            var tgl_thn_pembangunan = button.data('tgl_thn_pembangunan') || '';
            var tgl_thn_pemanfaatan = button.data('tgl_thn_pemanfaatan') || '';
            var umur_konstruksi = button.data('umur_konstruksi') || '';
           

            // Masukkan data ke dalam form modal
            modal.find('input[name="nama_bangunan"]').val(nama_bangunan);
            modal.find('input[name="no_kontrak"]').val(no_kontrak);
            modal.find('input[name="lokasi"]').val(lokasi);
            modal.find('input[name="tgl_thn_pembangunan"]').val(tgl_thn_pembangunan);
            modal.find('input[name="tgl_thn_pemanfaatan"]').val(tgl_thn_pemanfaatan);
            modal.find('input[name="umur_konstruksi"]').val(umur_konstruksi);
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
