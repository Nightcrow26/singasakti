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
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-12">
                    <div class="alert alert-primary" role="alert">
                        REKAPITULASI PENGAWASAN TERTIB USAHA JASA KONSTRUKSI TAHUNAN (BUJK) 
                        <button style="float: right;margin-right:10px;" type="button" data-bs-toggle="modal"
                            data-bs-target="#modal-tambah-foto" class="btn btn-sm btn-primary">
                            Tambah
                        </button>
                        <button style="float: right;margin-right:10px;" type="button" data-bs-toggle="modal"
                            data-bs-target="#modal-download" class="btn btn-sm btn-secondary">
                            Download
                        </button>
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
                <div>
                    <form action="{{ route('admin.monev.pengawasan.index') }}" method="GET">
                        <select name="skpd_id" class="form-control select2 my-3" onchange="this.form.submit()">
                            <option value="">Pilih SOPD</option>
                            @foreach ($skpd as $skpdItem)
                                <option value="{{ $skpdItem->id }}"
                                    {{ $selectedSkpdId == $skpdItem->id ? 'selected' : '' }}>
                                    {{ $skpdItem->nama }}
                                </option>
                            @endforeach
                        </select>
                    </form>
                    {{-- <label for="skpdFilter">Filter SOPD:</label>
                    <select id="skpdFilter" class="form-control select2 my-3">
                        <option value="">Pilih SOPD</option>
                        @foreach ($skpd2 as $skpd2)
                            <option value="{{ $skpd2->id }}">{{ $skpd2->nama }}</option>
                        @endforeach
                    </select> --}}
                </div>
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
                            <th style="color: white; text-align:center; vertical-align: top;">NIB</th>
                            <th style="color: white; text-align:center; vertical-align: top;">Pelaksanaan Pengembangan Usaha Berkelanjutan</th>
                            <th style="color: white; text-align:center; vertical-align: top;">Bukti Dukung</th>
                            
                        </tr>
                        
                    </thead>
                    <tbody>
                        <!-- Example Row -->
                        <tr>
                            <td style="color: rgb(0, 0, 0); text-align:center; vertical-align: top;">
                                <button data-bs-toggle="modal" data-bs-target="#modal-edit" class="btn btn-sm btn-flat btn-primary my-2"><i class="bx bx-edit-alt"></i></button>
                                <button class="btn btn-sm btn-flat btn-danger my-2"><i class="bx bx-trash" ></i></button>
                            </td>
                            <td style="color: rgb(0, 0, 0); text-align:center; vertical-align: top;">1</td>
                            <td style="color: rgb(0, 0, 0); text-align:center; vertical-align: top;">Paket A</td>
                            <td style="color: rgb(0, 0, 0); text-align:center; vertical-align: top;">12345</td>
                            <td style="color: rgb(0, 0, 0); text-align:center; vertical-align: top;">PT. BUJK Abadi</td>
                            <td style="color: rgb(0, 0, 0); text-align:center; vertical-align: top;">Tertib</td>
                            <td style="color: rgb(0, 0, 0); text-align:center; vertical-align: top;">Tertib</td>
                            <td style="color: rgb(0, 0, 0); text-align:center; vertical-align: top;">Tertib</td>
                            <td style="color: rgb(0, 0, 0); text-align:center; vertical-align: top;">Tertib</td>
                            <td style="color: rgb(0, 0, 0); text-align:center; vertical-align: top;">Tertib</td>
                            <td style="color: rgb(0, 0, 0); text-align:center; vertical-align: top;">Tertib</td>
                            <td style="color: rgb(0, 0, 0); text-align:center; vertical-align: top;">Tertib</td>
                            <td style="color: rgb(0, 0, 0); text-align:center; vertical-align: top;">Tertib</td>
                            <td style="color: rgb(0, 0, 0); text-align:center; vertical-align: top;"></td>

                        </tr>
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
                        REKAPITULASI PENGAWASAN TERTIB USAHA JASA KONSTRUKSI TAHUNAN (BUJK) 
                    </div>
                    <form method="post" id="form-tambah" action="{{ route('admin.monev.k01b.index') }}"
                        enctype="multipart/form-data">
                        @csrf
                        
                        <div>
                            <input type="hidden" id="skpd_id_foto" name="skpd_id"
                                value="{{ auth()->user()->skpd_id }}">
                            <input type="hidden" id="tahun" name="tahun" value="{{ auth()->user()->tahun }}">
                            <div class="col-md-12 mt-4">
                                <small class="text-light fw-semibold">Upload :</small>
                            </div>
                            <div class="col-md-12 mt-4">
                                <dt>Nomor Induk Berusaha</dt>
                                <dd><input type="text" class="form-control" id="nib" name="nib" placeholder="Nomor Izin Berusaha"></dd>
                            </div>
                            <div class="col-md-12 mt-4">
                                <dt>Nama Badan Usaha</dt>
                                <dd><input type="text" class="form-control" id="nama_badanusaha" name="nama_badanusaha" placeholder="Nama Badan Usaha"></dd>
                            </div>
                            <div class="col-md-12 mt-4">
                                <dt>PBJU</dt>
                                <dd><input type="text" class="form-control" id="pbju" name="pbju" placeholder="PBJU"></dd>
                            </div>
                            <br>
                            <div class="alert alert-primary" role="alert">
                                Kesesuaian Kegiatan Kontruksi
                            </div>
                            <div class="col-md-12 mt-4">
                                <dt>Jenis </dt>
                                <dd>
                                    <select type="text" class="form-control" id="" name="">
                                        <option value="">- Pilih</option>
                                        <option value="Tertib">Tertib</option>
                                        <option value="Tidak Tertib">Tidak Tertib</option>
                                    </select>

                                </dd>
                            </div>
                            <div class="col-md-12 mt-4">
                                <dt>Sifat </dt>
                                <dd>
                                    <select type="text" class="form-control" id="" name="">
                                        <option value="">- Pilih</option>
                                        <option value="Tertib">Tertib</option>
                                        <option value="Tidak Tertib">Tidak Tertib</option>
                                    </select>

                                </dd>
                            </div>
                            <div class="col-md-12 mt-4">
                                <dt>Klasifikasi </dt>
                                <dd>
                                    <select type="text" class="form-control" id="" name="">
                                        <option value="">- Pilih</option>
                                        <option value="Tertib">Tertib</option>
                                        <option value="Tidak Tertib">Tidak Tertib</option>
                                    </select>

                                </dd>
                            </div>
                            <div class="col-md-12 mt-4">
                                <dt>Layanan </dt>
                                <dd>
                                    <select type="text" class="form-control" id="" name="">
                                        <option value="">- Pilih</option>
                                        <option value="Tertib">Tertib</option>
                                        <option value="Tidak Tertib">Tidak Tertib</option>
                                    </select>

                                </dd>
                            </div>       
                            <br>
                            <div class="alert alert-primary" role="alert">
                                Kesesuaian Kegiatan Usaha Jasa Kontruksi dan Segmentasi Pasar Jasa Kontruksi
                            </div>
                            <div class="col-md-12 mt-4">
                                <dt>Bentuk </dt>
                                <dd>
                                    <select type="text" class="form-control" id="" name="">
                                        <option value="">- Pilih</option>
                                        <option value="Tertib">Tertib</option>
                                        <option value="Tidak Tertib">Tidak Tertib</option>
                                    </select>

                                </dd>
                            </div>   
                            <div class="col-md-12 mt-4">
                                <dt>Kualifikasi </dt>
                                <dd>
                                    <select type="text" class="form-control" id="" name="">
                                        <option value="">- Pilih</option>
                                        <option value="Tertib">Tertib</option>
                                        <option value="Tidak Tertib">Tidak Tertib</option>
                                    </select>

                                </dd>
                            </div>               
                            <br>
                            <div class="alert alert-primary" role="alert">
                                Pemenuhan Persyaratan Usaha
                            </div>                                
                            <div class="col-md-12 mt-4">
                                <dt>SBU </dt>
                                <dd>
                                    <select type="text" class="form-control" id="" name="">
                                        <option value="">- Pilih</option>
                                        <option value="Tertib">Tertib</option>
                                        <option value="Tidak Tertib">Tidak Tertib</option>
                                    </select>

                                </dd>
                            </div>
                            <div class="col-md-12 mt-4">
                                <dt>NIB </dt>
                                <dd>
                                    <select type="text" class="form-control" id="" name="">
                                        <option value="">- Pilih</option>
                                        <option value="Tertib">Tertib</option>
                                        <option value="Tidak Tertib">Tidak Tertib</option>
                                    </select>

                                </dd>
                            </div>

                            <div class="col-md-12 mt-4">
                                <dt>Pelaksanaan Pengembangan Usaha Berkelanjutan </dt>
                                <dd>
                                    <select type="text" class="form-control" id="" name="">
                                        <option value="">- Pilih</option>
                                        <option value="Tertib">Tertib</option>
                                        <option value="Tidak Tertib">Tidak Tertib</option>
                                    </select>

                                </dd>
                            </div>
                            <div class="col-md-12 mt-4">
                                <dt>Upload Data Dukung</dt>
                                <dd><input type="file" class="form-control" id="data_dukung" name="data_dukung" placeholder="Upload Data Dukung"></dd>
                            </div>
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
                        REKAPITULASI PENGAWASAN TERTIB USAHA JASA KONSTRUKSI TAHUNAN (BUJK) 
                    </div>
                    <form method="post" id="form-tambah" action="{{ route('admin.monev.k01a.index') }}"
                        enctype="multipart/form-data">
                        @csrf
                        
                        <div>
                            <input type="hidden" id="skpd_id_foto" name="skpd_id"
                                value="{{ auth()->user()->skpd_id }}">
                            <input type="hidden" id="tahun" name="tahun" value="{{ auth()->user()->tahun }}">
                            <div class="col-md-12 mt-4">
                                <small class="text-light fw-semibold">Upload :</small>
                            </div>
                            <div class="col-md-12 mt-4">
                                <dt>Nomor Induk Berusaha</dt>
                                <dd><input type="text" class="form-control" id="nib" name="nib" placeholder="Nomor Izin Berusaha"></dd>
                            </div>
                            <div class="col-md-12 mt-4">
                                <dt>Nama Badan Usaha</dt>
                                <dd><input type="text" class="form-control" id="nama_badanusaha" name="nama_badanusaha" placeholder="Nama Badan Usaha"></dd>
                            </div>
                            <div class="col-md-12 mt-4">
                                <dt>PBJU</dt>
                                <dd><input type="text" class="form-control" id="pbju" name="pbju" placeholder="PBJU"></dd>
                            </div>
                            <br>
                            <div class="alert alert-primary" role="alert">
                                Kesesuaian Kegiatan Kontruksi
                            </div>
                            <div class="col-md-12 mt-4">
                                <dt>Jenis </dt>
                                <dd>
                                    <select type="text" class="form-control" id="" name="">
                                        <option value="">- Pilih</option>
                                        <option value="Tertib">Tertib</option>
                                        <option value="Tidak Tertib">Tidak Tertib</option>
                                    </select>

                                </dd>
                            </div>
                            <div class="col-md-12 mt-4">
                                <dt>Sifat </dt>
                                <dd>
                                    <select type="text" class="form-control" id="" name="">
                                        <option value="">- Pilih</option>
                                        <option value="Tertib">Tertib</option>
                                        <option value="Tidak Tertib">Tidak Tertib</option>
                                    </select>

                                </dd>
                            </div>
                            <div class="col-md-12 mt-4">
                                <dt>Klasifikasi </dt>
                                <dd>
                                    <select type="text" class="form-control" id="" name="">
                                        <option value="">- Pilih</option>
                                        <option value="Tertib">Tertib</option>
                                        <option value="Tidak Tertib">Tidak Tertib</option>
                                    </select>

                                </dd>
                            </div>
                            <div class="col-md-12 mt-4">
                                <dt>Layanan </dt>
                                <dd>
                                    <select type="text" class="form-control" id="" name="">
                                        <option value="">- Pilih</option>
                                        <option value="Tertib">Tertib</option>
                                        <option value="Tidak Tertib">Tidak Tertib</option>
                                    </select>

                                </dd>
                            </div>       
                            <br>
                            <div class="alert alert-primary" role="alert">
                                Kesesuaian Kegiatan Usaha Jasa Kontruksi dan Segmentasi Pasar Jasa Kontruksi
                            </div>
                            <div class="col-md-12 mt-4">
                                <dt>Bentuk </dt>
                                <dd>
                                    <select type="text" class="form-control" id="" name="">
                                        <option value="">- Pilih</option>
                                        <option value="Tertib">Tertib</option>
                                        <option value="Tidak Tertib">Tidak Tertib</option>
                                    </select>

                                </dd>
                            </div>   
                            <div class="col-md-12 mt-4">
                                <dt>Kualifikasi </dt>
                                <dd>
                                    <select type="text" class="form-control" id="" name="">
                                        <option value="">- Pilih</option>
                                        <option value="Tertib">Tertib</option>
                                        <option value="Tidak Tertib">Tidak Tertib</option>
                                    </select>

                                </dd>
                            </div>               
                            <br>
                            <div class="alert alert-primary" role="alert">
                                Pemenuhan Persyaratan Usaha
                            </div>                                
                            <div class="col-md-12 mt-4">
                                <dt>SBU </dt>
                                <dd>
                                    <select type="text" class="form-control" id="" name="">
                                        <option value="">- Pilih</option>
                                        <option value="Tertib">Tertib</option>
                                        <option value="Tidak Tertib">Tidak Tertib</option>
                                    </select>

                                </dd>
                            </div>
                            <div class="col-md-12 mt-4">
                                <dt>NIB </dt>
                                <dd>
                                    <select type="text" class="form-control" id="" name="">
                                        <option value="">- Pilih</option>
                                        <option value="Tertib">Tertib</option>
                                        <option value="Tidak Tertib">Tidak Tertib</option>
                                    </select>

                                </dd>
                            </div>

                            <div class="col-md-12 mt-4">
                                <dt>Pelaksanaan Pengembangan Usaha Berkelanjutan </dt>
                                <dd>
                                    <select type="text" class="form-control" id="" name="">
                                        <option value="">- Pilih</option>
                                        <option value="Tertib">Tertib</option>
                                        <option value="Tidak Tertib">Tidak Tertib</option>
                                    </select>

                                </dd>
                            </div>
                            <div class="col-md-12 mt-4">
                                <dt>Upload Data Dukung</dt>
                                <dd><input type="file" class="form-control" id="data_dukung" name="data_dukung" placeholder="Upload Data Dukung"></dd>
                            </div>
                        </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="submit" id="tombol" class="btn btn-primary">UPDATE</button>
                    <button type="submit" id="loading" class="btn btn-warning" style="display: none;" readonly>
                        LOADING......
                    </button>
                </div>
                </form>
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
     
    {{-- <script src="{{ asset('js/master/skpd/main.js') }}"></script> --}}
@endsection