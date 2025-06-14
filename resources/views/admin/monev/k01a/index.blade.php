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
                        PENGAWASAN TERTIB USAHA JASA KONSTRUKSI TAHUNAN (USAHA RANTAI PASOK) 
                        @if (auth()->user()->hasRole('admin'))
                        <div class="btn-group" style="float: right; margin-right:10px;"  role="group">
                            <a type="button" class="btn btn-sm btn-secondary"
                                href="{{ route('admin.monev.k01a.download', ['skpd_id' => $selectedSkpdId ?? 'all','status'=>'k01a']) }}"
                                target="_blank">
                                Download (K.01.A)
                            </a>
                        </div>
                        <div class="btn-group" style="float: right; margin-right:10px;"  role="group">
                            <a type="button" class="btn btn-sm btn-secondary"
                                href="{{ route('admin.monev.k01a.download', ['skpd_id' => $selectedSkpdId ?? 'all','status'=>'p01a']) }}"
                                target="_blank">
                                Download (P.01.A)
                            </a>
                        </div>
                        <div class="btn-group" style="float: right; margin-right:10px;"  role="group">
                            <a type="button" class="btn btn-sm btn-secondary"
                                href="{{ route('admin.monev.k01a.download', ['skpd_id' => $selectedSkpdId ?? 'all','status'=>'rk01a']) }}"
                                target="_blank">
                                Download (RK.01.A)
                            </a>
                        </div>
                        @else 
                            <button style="float: right;margin-right:10px;" type="button" data-bs-toggle="modal"
                                data-bs-target="#modal-tambah-foto" class="btn btn-sm btn-primary">
                                Tambah
                            </button>
                            <div class="btn-group" style="float: right; margin-right:10px;"  role="group">
                                <a type="button" class="btn btn-sm btn-secondary"
                                    href="{{ route('admin.monev.k01a.download', ['skpd_id' => $selectedSkpdId ?? 'all','status'=>'k01a']) }}"
                                    target="_blank">
                                    Download (K.01.A)
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
                            <th style="color: white; text-align:center; vertical-align: top;">Nama Usaha Rantai Pasok</th>
                            <th style="color: white; text-align:center; vertical-align: top;">PJBU</th>
                            <th style="color: white; text-align:center; vertical-align: top;">Kepemilikan dan Keabsahan Perizinan Berusaha</th>
                            <th style="color: white; text-align:center; vertical-align: top;">Kepemilikan dan Keabsahan Perizinan Penggunaan Material, Peralatan dan Teknologi</th>
                            <th style="color: white; text-align:center; vertical-align: top;">Pencatatan dalam SIMPK</th>
                            <th style="color: white; text-align:center; vertical-align: top;">Status</th>
                        </tr>
                        
                    </thead>
                    <tbody>
                       
                        @foreach ($dataK01a as $index => $k01a)
                        @php
                            $statusAkhir = (
                                $k01a->kep_keab_perizinan_berusaha != NULL &&
                                $k01a->kep_keab_perizinan_teknologi != NULL &&
                                $k01a->pencatatan_dalam_simpk != NULL
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
                                                data-id="{{ $k01a->id }}"
                                                data-nib="{{ $k01a->nib }}"
                                                data-nm_usaha_rantai_pasok="{{ $k01a->nm_usaha_rantai_pasok }}"
                                                data-pjbu="{{ $k01a->pjbu }}">
                                            <i class="bx bx-edit-alt"> Edit</i>
                                        </button>
                            
                                        <form action="{{ route('admin.monev.k01a.destroy', $k01a->id) }}" method="POST" class="d-inline" id="delete-form-{{ $k01a->id }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="dropdown-item" onclick="deleteData({{ $k01a->id }})">
                                                <i class="bx bx-trash"> Hapus</i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                            <td style="color: rgb(0, 0, 0); text-align:center; vertical-align: top;">{{ $index + 1 }}</td>
                            <td style="color: rgb(0, 0, 0); text-align:center; vertical-align: top;">{{ $k01a->nib }}</td>
                            <td style="color: rgb(0, 0, 0); text-align:center; vertical-align: top;">{{ $k01a->nm_usaha_rantai_pasok }}</td>
                            <td style="color: rgb(0, 0, 0); text-align:center; vertical-align: top;">{{ $k01a->pjbu }}</td>
                            <td style="color: rgb(0, 0, 0); text-align:center; vertical-align: top;">
                                @if ($k01a->kep_keab_perizinan_berusaha == NULL )
                                    <button type="button" class="btn btn-sm rounded-pill btn-icon btn-danger">
                                        <i class='bx bx-x'></i>
                                    </button>
                                @else
                                    <button type="button" class="btn btn-sm rounded-pill btn-icon  btn-success" data-bs-toggle="modal" 
                                                data-bs-target="#modal-pdf" 
                                                data-data_dukung="{{ $k01a->kep_keab_perizinan_berusaha }}">
                                            <i class='bx bx-check'></i>
                                    </button>
                                @endif
                            </td>

                            <td style="color: rgb(0, 0, 0); text-align:center; vertical-align: top;">
                                @if ($k01a->kep_keab_perizinan_teknologi == NULL )
                                    <button type="button" class="btn btn-sm rounded-pill btn-icon btn-danger">
                                        <i class='bx bx-x'></i>
                                    </button>
                                @else
                                    <button type="button" class="btn btn-sm rounded-pill btn-icon  btn-success" data-bs-toggle="modal" 
                                                data-bs-target="#modal-pdf" 
                                                data-data_dukung="{{ $k01a->kep_keab_perizinan_teknologi }}">
                                            <i class='bx bx-check'></i>
                                    </button>
                                @endif
                            </td>

                            <td style="color: rgb(0, 0, 0); text-align:center; vertical-align: top;">
                                @if ($k01a->pencatatan_dalam_simpk == NULL )
                                    <button type="button" class="btn btn-sm rounded-pill btn-icon btn-danger">
                                        <i class='bx bx-x'></i>
                                    </button>
                                @else
                                    <button type="button" class="btn btn-sm rounded-pill btn-icon  btn-success" data-bs-toggle="modal" 
                                                data-bs-target="#modal-pdf" 
                                                data-data_dukung="{{ $k01a->pencatatan_dalam_simpk }}">
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
                        PENGAWASAN TERTIB USAHA JASA KONSTRUKSI TAHUNAN (USAHA RANTAI PASOK) 
                    </div>
                    <form method="post" id="form-tambah" action="{{ route('admin.monev.k01a.insert') }}"
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
                                <dt>Nama Usaha Rantai Pasok</dt>
                                <dd><input type="text" class="form-control" name="nm_usaha_rantai_pasok" placeholder="Nama Usaha Rantai Pasok"></dd>
                            </div>
                    
                            <div class="col-md-12 mt-4">
                                <dt>Penanggung Jawab Badan Usaha</dt>
                                <dd><input type="text" class="form-control" name="pjbu" placeholder="Penanggung Jawab Badan Usaha"></dd>
                            </div>
                    
                            {{-- <div class="col-md-12 mt-4">
                                <dt>Kepemilikan  dan Keabsahan  Perizinan  Berusaha</dt>
                                <dd>
                                    <select class="form-control" name="kep_keab_perizinan_berusaha">
                                        
                                        <option value="Tertib">Tertib</option>
                                        <option value="Tidak Tertib" selected>Tidak Tertib</option>
                                    </select>
                                </dd>
                            </div>
                    
                            <div class="col-md-12 mt-4">
                                <dt>Kepemilikan Keabsahan Penggunaan Material,Peralatan dan Teknologik</dt>
                                <dd>
                                    <select class="form-control" name="pencatatan_dalam_simpk">
                                        
                                        <option value="Tertib">Tertib</option>
                                        <option value="Tidak Tertib" selected>Tidak Tertib</option>
                                    </select>
                                </dd>
                            </div>
                    
                            <div class="col-md-12 mt-4">
                                <dt>Pencatatan Dalam  SIMPK</dt>
                                <dd>
                                    <select class="form-control" name="pencatatan_dalam_simpk">
                                        
                                        <option value="Tertib">Tertib</option>
                                        <option value="Tidak Tertib" selected>Tidak Tertib</option>
                                    </select>
                                </dd>
                            </div>
                    
                            <div class="col-md-12 mt-4">
                                <dt>Upload Data Dukung <small style="color: red">*maks 2MB (Wajib PDF)</small></dt>
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
                    <form method="post" id="form-edit" action="{{ route('admin.monev.k01a.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')  
                        <input type="hidden" name="id">

                        <input type="hidden" name="skpd_id" value="{{ auth()->user()->skpd_id }}">
    
                        <div class="col-md-12 mt-4">
                            <dt>Nomor Izin Berusaha</dt>
                            <dd><input type="text" class="form-control" name="nib" placeholder="Nomor Izin Berusaha"></dd>
                        </div>
    
                        <div class="col-md-12 mt-4">
                            <dt>Nama Usaha Rantai Pasok</dt>
                            <dd><input type="text" class="form-control" name="nm_usaha_rantai_pasok" placeholder="Nama Usaha Rantai Pasok"></dd>
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
                                    <option value="kep_keab_perizinan_berusaha">Kepemilikan  dan Keabsahan  Perizinan  Berusaha</option>
                                    <option value="kep_keab_perizinan_teknologi">Kepemilikan Keabsahan Penggunaan Material,Peralatan dan Teknologi</option>
                                    <option value="pencatatan_dalam_simpk">Pencatatan Dalam  SIMPK</option>
                                </select>
                            </dd>
                        </div>
                         <div class="col-md-12 mt-4">
                            <dt>Upload File <small style="color: red">*maks 2MB (Wajib PDF)</small></dt>
                            <dd><input type="file" class="form-control" name="file" accept=".pdf"></dd>
                        </div>
    
                        {{-- <div class="col-md-12 mt-4">
                            <dt>Kepemilikan  dan Keabsahan  Perizinan  Berusaha</dt>
                            <dd>
                                <select class="form-control" name="kep_keab_perizinan_berusaha">
                                    <option value="Tertib">Tertib</option>
                                    <option value="Tidak Tertib">Tidak Tertib</option>
                                </select>
                            </dd>
                        </div>
    
                        <div class="col-md-12 mt-4">
                            <dt>Kepemilikan Keabsahan Penggunaan Material,Peralatan dan Teknologi</dt>
                            <dd>
                                <select class="form-control" name="kep_keab_perizinan_teknologi">
                                    <option value="Tertib">Tertib</option>
                                    <option value="Tidak Tertib">Tidak Tertib</option>
                                </select>
                            </dd>
                        </div>
    
                        <div class="col-md-12 mt-4">
                            <dt>Pencatatan Dalam  SIMPK</dt>
                            <dd>
                                <select class="form-control" name="pencatatan_dalam_simpk">
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
            var nm_usaha_rantai_pasok = button.data('nm_usaha_rantai_pasok') || '';
            var pjbu = button.data('pjbu') || '';
            var kep_keab_perizinan_berusaha = button.data('kep_keab_perizinan_berusaha') || '';
            var kep_keab_perizinan_teknologi = button.data('kep_keab_perizinan_teknologi') || '';
            var pencatatan_dalam_simpk = button.data('pencatatan_dalam_simpk') || '';
            var file_pdf = button.data('data_dukung') ? '/uploads/data_dukung/' + button.data('data_dukung') : '';

        
            // Masukkan data ke dalam form modal
            modal.find('input[name="nib"]').val(nib);
            modal.find('input[name="nm_usaha_rantai_pasok"]').val(nm_usaha_rantai_pasok);
            modal.find('input[name="pjbu"]').val(pjbu);
            modal.find('select[name="kep_keab_perizinan_berusaha"]').val(kep_keab_perizinan_berusaha);
            modal.find('select[name="kep_keab_perizinan_teknologi"]').val(kep_keab_perizinan_teknologi);
            modal.find('select[name="pencatatan_dalam_simpk"]').val(pencatatan_dalam_simpk);
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
