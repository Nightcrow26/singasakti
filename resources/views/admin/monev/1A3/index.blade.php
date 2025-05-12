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
                        PENGAWASAN PERALATAN
                        @if (auth()->user()->hasRole('admin'))
                        <div class="btn-group" style="float: right; margin-right:10px;"  role="group">
                           
                        @else 
                        <button style="float: right;margin-right:10px;" type="button" data-bs-toggle="modal"
                            data-bs-target="#modal-tambah-foto" class="btn btn-sm btn-primary">
                            Tambah
                        </button>
                         
                        @endif
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body ">
            @if (auth()->user()->hasRole('admin'))
                <label for="skpdFilter">Filter Penyedia:</label>
                <select id="skpdFilter" class="form-control select2" onchange="filterBySkpd(this.value)">
                    <option value="">Pilih Penyedia</option>
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
                            <th style="color: white; text-align:center; vertical-align: top;">Nama</th>
                            <th style="color: white; text-align:center; vertical-align: top;">Status</th>
                            <th style="color: white; text-align:center; vertical-align: top;">Tanggal Pengawasan</th>
                            <th style="color: white; text-align:center; vertical-align: top;">Kepemilikan Perizinan Usaha</th>
                            <th style="color: white; text-align:center; vertical-align: top;">Keabsahan Perizinan Berusaha</th>
                        
                    </thead>
                    <tbody>
                        @foreach ($data as $index => $a)
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
                                                data-bs-target="#modal-tambah-edit" 
                                                data-id="{{ $a->id }}"
                                                data-nama="{{ $a->nama }}"
                                                data-status="{{ $a->status }}"
                                                data-tanggal_pengawasan="{{ $a->tanggal_pengawasan }}"
                                                data-kepemilikan_perizinan_berusaha="{{ $a->kepemilikan_perizinan_berusaha }}"
                                                data-keabsahan_perizinan_berusaha="{{ $a->keabsahan_perizinan_berusaha }}"
                                                >
                                            <i class="bx bx-pencil"> Edit</i>
                                        </button>
                                         @if (auth()->user()->hasRole('penyedia'))
                                        <button class="dropdown-item" data-bs-toggle="modal" 
                                                data-bs-target="#modal-detail-tambah" 
                                                data-id="{{ $a->id }}"
                                                >
                                            <i class="bx bx-plus"> Detail Tambah</i>
                                        </button>
                                         @endif
                                        <button class="dropdown-item" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#modal-detail" 
                                                onclick="loadDetailTable({{ $a->id }})">
                                            <i class="bx bx-list-ul"> Detail</i>
                                        </button>

                                        <form action="{{ route('admin.monev.1A3.destroy', $a->id) }}" method="POST" class="d-inline" id="delete-form-{{ $a->id }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="dropdown-item" onclick="deleteData({{ $a->id }})">
                                                <i class="bx bx-trash"> Hapus</i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                            <td style="color: rgb(0, 0, 0); text-align:center; vertical-align: top;">{{ $a->nama }}</td>
                            <td style="color: rgb(0, 0, 0); text-align:center; vertical-align: top;">{{ $a->status }}</td>
                            <td style="color: rgb(0, 0, 0); text-align:center; vertical-align: top;">{{ $a->tanggal_pengawasan }}</td>
                            <td style="color: rgb(0, 0, 0); text-align:center; vertical-align: top;">{{ $a->kepemilikan_perizinan_berusaha }}</td>
                            <td style="color: rgb(0, 0, 0); text-align:center; vertical-align: top;">{{ $a->keabsahan_perizinan_berusaha }}</td>
                            
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
                       PENGAWASAN PERALATAN
                    </div>
                    <form method="post" id="form-tambah" action="{{ route('admin.monev.1A3.insert') }}" enctype="multipart/form-data">
                        @csrf
                            <input type="hidden" name="skpd_id" value="{{ auth()->user()->id }}">
                            
                            <div class="col-md-12 mt-4">
                                <small class="text-light fw-semibold">Upload :</small>
                            </div>
                    
                        <div class="col-md-12 mt-4">
                            <dt>Nama Pemilik Peralatan BUJK / Usaha Penyewaan Rantai Pasok Peralatan</dt>
                            <dd><input type="text" class="form-control" name="nama" placeholder="Nama Pemilik Peralatan BUJK / Usaha Penyewaan Rantai Pasok Peralatan" required></dd>
                        </div>
                        <div class="col-md-12 mt-4">
                            <dt>Status</dt>
                            <dd>
                                <select class="form-control" name="status" required>
                                    <option value="">Pilih</option>
                                    <option value="Pemilik Peralatan BUJK">Pemilik Peralatan BUJK</option>
                                    <option value="Usaha Penyewaan Rantai Pasok Peralatan">Usaha Penyewaan Rantai Pasok Peralatan</option>
                                </select>
                            </dd>
                        </div>

                        <div class="col-md-12 mt-4">
                            <dt>Tanggal Pengawasan</dt>
                            <dd><input type="date" class="form-control" name="tanggal_pengawasan" placeholder="Tanggal Pengawasan" required></dd>
                        </div>

                        <div class="col-md-12 mt-4">
                            <dt>Kepemilikan Perizinan Berusaha</dt>
                            <dd>
                                <select class="form-control" name="kepemilikan_perizinan_berusaha" required>
                                    <option value="">Pilih</option>
                                    <option value="Memiliki">Memiliki</option>
                                    <option value="Tidak Memiliki">Tidak Memiliki</option>
                                </select>
                            </dd>
                        </div>

                        <div class="col-md-12 mt-4">
                            <dt>Keabsahan Perizinan Berusaha</dt>
                            <dd>
                                <select class="form-control" name="keabsahan_perizinan_berusaha" required>
                                    <option value="">Pilih</option>
                                    <option value="Sah">Sah</option>
                                    <option value="Tidak Sah">Tidak Sah</option>
                                </select>
                            </dd>
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
    {{-- edit Master --}}
    <div class="modal fade" role="dialog" id="modal-tambah-edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" id="form-edit" action="{{ route('admin.monev.1A3.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')  
                        <input type="hidden" name="id">
                        <div class="col-md-12 mt-4">
                            <dt>Nama Pemilik Peralatan BUJK / Usaha Penyewaan Rantai Pasok Peralatan</dt>
                            <dd><input type="text" class="form-control" name="nama" placeholder="Nama Pemilik Peralatan BUJK / Usaha Penyewaan Rantai Pasok Peralatan" required></dd>
                        </div>
                        <div class="col-md-12 mt-4">
                            <dt>Status</dt>
                            <dd>
                                <select class="form-control" name="status" required>
                                    <option value="">Pilih</option>
                                    <option value="Pemilik Peralatan BUJK">Pemilik Peralatan BUJK</option>
                                    <option value="Usaha Penyewaan Rantai Pasok Peralatan">Usaha Penyewaan Rantai Pasok Peralatan</option>
                                </select>
                            </dd>
                        </div>

                        <div class="col-md-12 mt-4">
                            <dt>Tanggal Pengawasan</dt>
                            <dd><input type="date" class="form-control" name="tanggal_pengawasan" placeholder="Tanggal Pengawasan" required></dd>
                        </div>

                        <div class="col-md-12 mt-4">
                            <dt>Kepemilikan Perizinan Berusaha</dt>
                            <dd>
                                <select class="form-control" name="kepemilikan_perizinan_berusaha" required>
                                    <option value="">Pilih</option>
                                    <option value="Memiliki">Memiliki</option>
                                    <option value="Tidak Memiliki">Tidak Memiliki</option>
                                </select>
                            </dd>
                        </div>

                        <div class="col-md-12 mt-4">
                            <dt>Keabsahan Perizinan Berusaha</dt>
                            <dd>
                                <select class="form-control" name="keabsahan_perizinan_berusaha" required>
                                    <option value="">Pilih</option>
                                    <option value="Sah">Sah</option>
                                    <option value="Tidak Sah">Tidak Sah</option>
                                </select>
                            </dd>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" name="button" value="update" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- Tambah Detail --}}
    <div class="modal fade" role="dialog" id="modal-detail-tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Detail</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" id="form-edit" action="{{ route('admin.monev.1A3.tambahdetail') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')  
                        <input type="hidden" name="pengawasan_peralatan_id">
    
                        <div class="col-md-12 mt-4">
                            <dt>Nama Varian Peralatan</dt>
                            <dd><input type="text" class="form-control" name="nama_varian_peralatan" placeholder="Nama Varian Peralatan"></dd>
                        </div>
    
                       <div class="col-md-12 mt-4">
                            <dt>Nama Sub Varian Peralatan</dt>
                            <dd><input type="text" class="form-control" name="nama_sub_varian_peralatan" placeholder="Nama Sub Varian Peralatan"></dd>
                        </div>

                        <div class="col-md-12 mt-4">
                            <dt>Merk Peralatan</dt>
                            <dd><input type="text" class="form-control" name="merk_peralatan" placeholder="Merk Peralatan"></dd>
                        </div>

                        <div class="col-md-12 mt-4">
                            <dt>Jumlah Unit</dt>
                            <dd><input type="number" class="form-control" name="jumlah_unit" placeholder="Jumlah Unit" min="0"></dd>
                        </div>

                        <div class="col-md-12 mt-4">
                            <dt>Surat Keterangan Memenuhi Syarat K3</dt>
                            <dd><input type="text" class="form-control" name="surat_keterangan_k3" placeholder="SK Memenuhi Syarat K3"></dd>
                        </div>

                        <div class="col-md-12 mt-4">
                            <dt>Bukti Kepemilikan</dt>
                            <dd><input type="text" class="form-control" name="bukti_kepemilikan" placeholder="Bukti Kepemilikan"></dd>
                        </div>

                        <div class="col-md-12 mt-4">
                            <dt>Pencatatan Dalam SIMPK</dt>
                            <dd>
                                <select class="form-control" name="pencatatan_simpk">
                                    <option value="Sudah">Sudah</option>
                                    <option value="Belum">Belum</option>
                                </select>
                            </dd>
                        </div>

                        <div class="col-md-12 mt-4">
                            <dt>Nomor Registrasi Pencatatan dalam SIMPK</dt>
                            <dd><input type="text" class="form-control" name="nomor_registrasi_simpk" placeholder="Nomor Registrasi SIMPK"></dd>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- detail --}}
    <div class="modal fade" id="modal-detail" tabindex="-1" role="dialog" aria-labelledby="modalDetailLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Data Peralatan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Aksi</th>
                            <th>Nama Varian</th>
                            <th>Sub Varian</th>
                            <th>Merk</th>
                            <th>Jumlah</th>
                            <th>SK K3</th>
                            <th>Bukti Kepemilikan</th>
                            <th>SIMPK</th>
                            <th>No. Registrasi</th>
                        </tr>
                    </thead>
                    <tbody id="detail-tbody">
                        <tr><td colspan="9" class="text-center">Memuat data...</td></tr>
                    </tbody>
                </table>
            </div>
            </div>
        </div>
    </div>
    {{-- edit detail --}}
    <div class="modal fade" role="dialog" id="modal-detail-edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Data Detail</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" id="form-edit" action="{{ route('admin.monev.1A3.updatedetail') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')  
                        <input type="hidden" name="id">
    
                        <div class="col-md-12 mt-4">
                            <dt>Nama Varian Peralatan</dt>
                            <dd><input type="text" class="form-control" name="nama_varian_peralatan" placeholder="Nama Varian Peralatan"></dd>
                        </div>
    
                       <div class="col-md-12 mt-4">
                            <dt>Nama Sub Varian Peralatan</dt>
                            <dd><input type="text" class="form-control" name="nama_sub_varian_peralatan" placeholder="Nama Sub Varian Peralatan"></dd>
                        </div>

                        <div class="col-md-12 mt-4">
                            <dt>Merk Peralatan</dt>
                            <dd><input type="text" class="form-control" name="merk_peralatan" placeholder="Merk Peralatan"></dd>
                        </div>

                        <div class="col-md-12 mt-4">
                            <dt>Jumlah Unit</dt>
                            <dd><input type="number" class="form-control" name="jumlah_unit" placeholder="Jumlah Unit" min="0"></dd>
                        </div>

                        <div class="col-md-12 mt-4">
                            <dt>Surat Keterangan Memenuhi Syarat K3</dt>
                            <dd><input type="text" class="form-control" name="surat_keterangan_k3" placeholder="SK Memenuhi Syarat K3"></dd>
                        </div>

                        <div class="col-md-12 mt-4">
                            <dt>Bukti Kepemilikan</dt>
                            <dd><input type="text" class="form-control" name="bukti_kepemilikan" placeholder="Bukti Kepemilikan"></dd>
                        </div>

                        <div class="col-md-12 mt-4">
                            <dt>Pencatatan Dalam SIMPK</dt>
                            <dd>
                                <select class="form-control" name="pencatatan_simpk">
                                    <option value="Sudah">Sudah</option>
                                    <option value="Belum">Belum</option>
                                </select>
                            </dd>
                        </div>

                        <div class="col-md-12 mt-4">
                            <dt>Nomor Registrasi Pencatatan dalam SIMPK</dt>
                            <dd><input type="text" class="form-control" name="nomor_registrasi_simpk" placeholder="Nomor Registrasi SIMPK"></dd>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" name="button" value="hapus" class="btn btn-danger">Hapus</button>
                            <button type="submit" name="button" value="update" class="btn btn-primary">Update</button>
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
    {{-- Datatambahdetail --}}
    <script>
        $('#modal-detail-tambah').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Tombol yang diklik
            var modal = $(this);
        
            // Ambil data dari tombol
            var id = button.data('id') || '';
        
            // Masukkan data ke dalam form modal
          
            modal.find('input[name="pengawasan_peralatan_id"]').val(id); // hidden input
        });
    </script>
    {{-- Dataedit --}}
    <script>
        $('#modal-tambah-edit').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Tombol yang diklik
            var modal = $(this);

            // Ambil data dari tombol
            var id = button.data('id') || '';
            var nama = button.data('nama') || '';
            var status = button.data('status') || '';
            var rawTanggal = button.data('tanggal_pengawasan') || '';
            var tgl = rawTanggal.substring(0, 10);
            var kepemilikan = button.data('kepemilikan_perizinan_berusaha') || '';
            var keabsahan = button.data('keabsahan_perizinan_berusaha') || '';


            // Isi form di dalam modal
            modal.find('input[name="id"]').val(id);
            modal.find('input[name="nama"]').val(nama);
            modal.find('select[name="status"]').val(status);
            modal.find('input[name="tanggal_pengawasan"]').val(tgl);
            modal.find('select[name="kepemilikan_perizinan_berusaha"]').val(kepemilikan);
            modal.find('select[name="keabsahan_perizinan_berusaha"]').val(keabsahan);
        });
    </script>
    {{-- Dataeditdetail --}}
    <script>
        $('#modal-detail-edit').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Tombol yang diklik
            var modal = $(this);

            // Ambil data dari tombol
            var id = button.data('id') || '';
            var namaVarian = button.data('nama_varian') || '';
            var namaSub = button.data('nama_sub') || '';
            var merk = button.data('merk') || '';
            var jumlah = button.data('jumlah') || '';
            var keterangan = button.data('keterangan') || '';
            var bukti = button.data('bukti') || '';
            var pencatatan = button.data('pencatatan') || '';
            var nomor = button.data('nomor') || '';

            // Isi form di dalam modal
            modal.find('input[name="id"]').val(id);
            modal.find('input[name="nama_varian_peralatan"]').val(namaVarian);
            modal.find('input[name="nama_sub_varian_peralatan"]').val(namaSub);
            modal.find('input[name="merk_peralatan"]').val(merk);
            modal.find('input[name="jumlah_unit"]').val(jumlah);
            modal.find('input[name="surat_keterangan_k3"]').val(keterangan);
            modal.find('input[name="bukti_kepemilikan"]').val(bukti);
            modal.find('select[name="pencatatan_simpk"]').val(pencatatan);
            modal.find('input[name="nomor_registrasi_simpk"]').val(nomor);
        });
    </script>
    {{-- lihatdetail --}}
    <script>
        function loadDetailTable(pengawasanId) {
        const tbody = document.getElementById('detail-tbody');
        tbody.innerHTML = '<tr><td colspan="9" class="text-center">Memuat data...</td></tr>';

       fetch('/admin/pengawasan_peralatan/detail-data13A/' + pengawasanId)
            .then(response => response.json())
            .then(data => {
                if (data.message) {
                    // Jika response adalah pesan error (misalnya tidak ada data)
                    tbody.innerHTML = `<tr><td colspan="9" class="text-center text-danger">${data.message}</td></tr>`;
                    return;
                }

                tbody.innerHTML = '';
                
                data.forEach(item => {
                    tbody.innerHTML += `
                        <tr>
                            <td> 
                                <button class="dropdown-item"
                                    data-bs-toggle="modal"
                                        data-bs-target="#modal-detail-edit"
                                        data-id="${item.id}"
                                        data-nama_varian="${item.nama_varian_peralatan}"
                                        data-nama_sub="${item.nama_sub_varian_peralatan}"
                                        data-merk="${item.merk_peralatan}"
                                        data-jumlah="${item.jumlah_unit}"
                                        data-keterangan="${item.surat_keterangan_k3}"
                                        data-bukti="${item.bukti_kepemilikan}"
                                        data-pencatatan="${item.pencatatan_simpk}"
                                        data-nomor="${item.nomor_registrasi_simpk}">
                                    <i class="bx bx-pencil"> Edit</i>
                                </button>
                            </td>
                            <td>${item.nama_varian_peralatan ?? '-'}</td>
                            <td>${item.nama_sub_varian_peralatan ?? '-'}</td>
                            <td>${item.merk_peralatan ?? '-'}</td>
                            <td>${item.jumlah_unit ?? 0}</td>
                            <td>${item.surat_keterangan_k3 ?? '-'}</td>
                            <td>${item.bukti_kepemilikan ?? '-'}</td>
                            <td>${item.pencatatan_simpk ?? '-'}</td>
                            <td>${item.nomor_registrasi_simpk ?? '-'}</td>
                        </tr>
                    `;
                });
            })
            .catch(error => {
                tbody.innerHTML = '<tr><td colspan="9" class="text-center text-danger">Gagal memuat data.</td></tr>';
            });
        }
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