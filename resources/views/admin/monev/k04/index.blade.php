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
                        PENGAWASAN TERTIB USAHA JASA KONSTRUKSI UNTUK USAHA ORANG PERSEORANGAN 
                        @if (auth()->user()->hasRole('admin'))
                        <div class="btn-group" style="float: right; margin-right:10px;"  role="group">
                            <a type="button" class="btn btn-sm btn-secondary"
                                href="{{ route('admin.monev.k04.download', ['skpd_id' => $selectedSkpdId ?? 'all','status'=>'k04']) }}"
                                target="_blank">
                                Download (K.04)
                            </a>
                        </div>
                        <!--<div class="btn-group" style="float: right; margin-right:10px;"  role="group">
                            <a type="button" class="btn btn-sm btn-secondary"
                                href="{{ route('admin.monev.k04.download', ['skpd_id' => $selectedSkpdId ?? 'all','status'=>'p04']) }}"
                                target="_blank">
                                Download (P.04)
                            </a>
                            </div>
                        -->
                        <div class="btn-group" style="float: right; margin-right:10px;"  role="group">
                            <a type="button" class="btn btn-sm btn-secondary"
                                href="{{ route('admin.monev.k04.download', ['skpd_id' => $selectedSkpdId ?? 'all','status'=>'rk04']) }}"
                                target="_blank">
                                Download (RK.04)
                            </a>
                        </div>
                        @else 
                        <button style="float: right;margin-right:10px;" type="button" data-bs-toggle="modal"
                            data-bs-target="#modal-tambah-foto" class="btn btn-sm btn-primary">
                            Tambah
                        </button>
                         <div class="btn-group" style="float: right; margin-right:10px;"  role="group">
                            <a type="button" class="btn btn-sm btn-secondary"
                                href="{{ route('admin.monev.k04.download', ['skpd_id' => $selectedSkpdId ?? 'all','status'=>'k04']) }}"
                                target="_blank">
                                Download (K.04)
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
                            <th style="color: white; text-align:center; vertical-align: top;">Nama Usaha Orang Perorangan</th>
                            <th style="color: white; text-align:center; vertical-align: top;">Nomer Sertifikat Standar yang telah terverifikasi </th>
                            <th style="color: white; text-align:center; vertical-align: top;">Alamat</th>
                            <th style="color: white; text-align:center; vertical-align: top;">Hasil Pengawasan</th>
                            
                        </tr>
                        
                    </thead>
                    <tbody>
                        @foreach ($dataK04 as $index => $k04)
                        <tr>
                            <td style="color: rgb(0, 0, 0); text-align:center; vertical-align: top;">
                               <div class="btn-group" role="group">
                                   <button id="btnGroupDrop1" type="button"
                                       class="btn btn-sm btn-outline-secondary dropdown-toggle"
                                       data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                       <i class="menu-icon tf-icons bx bx-cog"></i>
                                   </button>
                                   <div class="dropdown-menu" aria-labelledby="btnGroupDrop1" style="">
                                       <button class="dropdown-item btn btn-sm btn-flat my-2" data-bs-toggle="modal" 
                                            data-bs-target="#modal-edit" 
                                            data-id="{{ $k04->id }}"
                                            data-nib="{{ $k04->nib }}"
                                            data-nama_usaha="{{ $k04->nama_usaha }}"
                                            data-no_sertif="{{ $k04->no_sertif }}"
                                            data-alamat="{{ $k04->alamat }}"
                                            data-hasil="{{ $k04->hasil }}"
                                            data-data_dukung="{{ $k04->data_dukung }}">
                                           <i class="bx bx-edit-alt"> Edit</i>
                                       </button>
                           
                                       <form action="{{ route('admin.monev.k04.destroy', $k04->id) }}" method="POST" class="d-inline" id="delete-form-{{ $k04->id }}">
                                           @csrf
                                           @method('DELETE')
                                           <button type="button" class="dropdown-item" onclick="deleteData({{ $k04->id }})">
                                               <i class="bx bx-trash"> Hapus</i>
                                           </button>
                                       </form>
                                   </div>
                               </div>
                           </td>
                            <td style="color: rgb(0, 0, 0); text-align:center; vertical-align: top;">{{ $index + 1 }}</td>
                            <td style="color: rgb(0, 0, 0); text-align:center; vertical-align: top;">{{ $k04->nib }}</td>
                            <td style="color: rgb(0, 0, 0); text-align:center; vertical-align: top;">{{ $k04->nama_usaha }}</td>
                            <td style="color: rgb(0, 0, 0); text-align:center; vertical-align: top;">{{ $k04->no_sertif }}</td>
                            <td style="color: rgb(0, 0, 0); text-align:center; vertical-align: top;">{{ $k04->alamat }}</td>
                            <td style="text-align:center;vertical-align: top;">
                                @if ($k04->hasil == 'Tertib')
                                    <button type="button" class="btn btn-sm rounded-pill btn-success">
                                        <i class='bx bx-check'></i> {{ $k04->hasil }}
                                    </button>
                                @else
                                    <button type="button" class="btn btn-sm rounded-pill btn-danger">
                                        <i class='bx bx-x'></i> {{ $k04->hasil }}
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
                        REKAPITULASI PENGAWASAN TERTIB USAHA JASA KONSTRUKSI UNTUK USAHA ORANG PERSEORANGAN TAHUNAN 
                    </div>
                    <form method="post" id="form-tambah" action="{{ route('admin.monev.k04.insert') }}" enctype="multipart/form-data">
                        @csrf
                        
                        <div>
                            <input type="hidden" id="skpd_id_foto" name="skpd_id" value="{{ auth()->user()->skpd_id }}">
                            
                            <div class="col-md-12 mt-4">
                                <small class="text-light fw-semibold">Upload :</small>
                            </div>
                            <div class="col-md-12 mt-4">
                                <dt>NIB</dt>
                                <dd><input type="text" class="form-control" id="nib" name="nib" placeholder="NIB"></dd>
                            </div>
                            <div class="col-md-12 mt-4">
                                <dt>Nama Usaha Orang Perorangan</dt>
                                <dd><input type="text" class="form-control" id="nama_usaha" name="nama_usaha" placeholder="Nama Usaha"></dd>
                            </div>
                            <div class="col-md-12 mt-4">
                                <dt>Nomer Sertifikat Standar yang telah terverifikasi</dt>
                                <dd><input type="text" class="form-control" id="no_sertif" name="no_sertif" placeholder="Nomor Sertifikat"></dd>
                            </div>
                            <div class="col-md-12 mt-4">
                                <dt>Alamat</dt>
                                <dd><input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat"></dd>
                            </div>
                            <div class="col-md-12 mt-4">
                                <dt>Hasil Pengawasan</dt>
                                <dd>
                                    <select type="text" class="form-control" id="hasil" name="hasil">
                                        <option value="">- Pilih</option>
                                        <option value="Tertib">Tertib</option>
                                        <option value="Tidak Tertib">Tidak Tertib</option>
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

   
    {{-- Edit Tabel --}}
    <div class="modal fade" role="dialog" id="modal-edit" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
                    
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-primary" role="alert">
                        REKAPITULASI PENGAWASAN TERTIB USAHA JASA KONSTRUKSI UNTUK USAHA ORANG PERSEORANGAN TAHUNAN 
                    </div>
                    <form method="post" id="form-tambah" action="{{ route('admin.monev.k04.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT') 
                        
                        <input type="hidden" id="edit-id" name="id">
                        <div class="col-md-12 mt-4">
                            <dt>NIB</dt>
                            <dd><input type="text" class="form-control" id="edit-nib" name="nib" placeholder="NIB"></dd>
                        </div>
                        <div class="col-md-12 mt-4">
                            <dt>Nama Usaha Orang Perorangan</dt>
                            <dd><input type="text" class="form-control" id="edit-nama_usaha" name="nama_usaha" placeholder="Nama Usaha"></dd>
                        </div>
                        <div class="col-md-12 mt-4">
                            <dt>Nomer Sertifikat Standar yang telah terverifikasi</dt>
                            <dd><input type="text" class="form-control" id="edit-no_sertif" name="no_sertif" placeholder="Nomor Sertifikat"></dd>
                        </div>
                        <div class="col-md-12 mt-4">
                            <dt>Alamat</dt>
                            <dd><input type="text" class="form-control" id="edit-alamat" name="alamat" placeholder="Alamat"></dd>
                        </div>
                        <div class="col-md-12 mt-4">
                            <dt>Hasil Pengawasan</dt>
                            <dd>
                                <select type="text" class="form-control" id="edit-hasil" name="hasil">
                                    <option value="">- Pilih</option>
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
            var nib = button.data('nib') || '';
            var nama_usaha = button.data('nama_usaha') || '';
            var no_sertif = button.data('no_sertif') || '';
            var alamat = button.data('alamat') || '';
            var hasil = button.data('hasil') || '';
            var data_dukung = button.data('data_dukung') || ''; // Untuk file PDF

            // Masukkan data ke dalam form modal
            modal.find('input[name="nib"]').val(nib);
            modal.find('input[name="nama_usaha"]').val(nama_usaha);
            modal.find('input[name="no_sertif"]').val(no_sertif);
            modal.find('input[name="alamat"]').val(alamat);
            modal.find('select[name="hasil"]').val(hasil);
            modal.find('input[name="id"]').val(id); // hidden input

            // Tampilkan file PDF kalau ada
            if (data_dukung !== '') {
                $('#pdf-frame').attr('src', '/uploads/data_dukung/' + data_dukung); // Ganti dengan URL file yang sesuai
                $('#pdf-preview').show(); // Menampilkan preview PDF
            } else {
                $('#pdf-frame').attr('src', '');
                $('#pdf-preview').hide(); // Menyembunyikan preview PDF jika tidak ada
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

