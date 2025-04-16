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
                        REKAPITULASI PENGAWASAN TERTIB PENYELENGARAAN JASA KONSTRUKSI TAHUNAN 
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
                            <th style="color: white; text-align:center; vertical-align: top;">Kegiatan Konstruksi (Nama Paket)</th>
                            <th style="color: white; text-align:center; vertical-align: top;">Nomor Kontrak</th>
                            <th style="color: white; text-align:center; vertical-align: top;">Nama BUJK</th>
                            <th style="color: white; text-align:center; vertical-align: top;">Proses pemilihan Penyedia Jasa</th>
                            <th style="color: white; text-align:center; vertical-align: top;">Penerapan standar kontrak</th>
                            <th style="color: white; text-align:center; vertical-align: top;">Penggunaan tenaga kerja konstruksi bersertifikat</th>
                            <th style="color: white; text-align:center; vertical-align: top;">Pemberian pekerjaan utama dan/atau penunjang kepada subpenyedia jasa</th>
                            <th style="color: white; text-align:center; vertical-align: top;">Ketersediaan dokumen standar K4</th>
                            <th style="color: white; text-align:center; vertical-align: top;">Penerapan SMKK</th>
                            <th style="color: white; text-align:center; vertical-align: top;">Kegiatan antisipasi kecelakaan kerja</th>
                            
                        </tr>
                        
                    </thead>
                    <tbody>
                        <!-- Example Row -->
                        <tr>
                            <td style="color: rgb(0, 0, 0); text-align:center; vertical-align: top;"></td>
                            <td style="color: rgb(0, 0, 0); text-align:center; vertical-align: top;">1</td>
                            <td style="color: rgb(0, 0, 0); text-align:center; vertical-align: top;">Paket A</td>
                            <td style="color: rgb(0, 0, 0); text-align:center; vertical-align: top;">12345</td>
                            <td style="color: rgb(0, 0, 0); text-align:center; vertical-align: top;">PT. BUJK Abadi</td>
                            <td style="color: rgb(0, 0, 0); text-align:center; vertical-align: top;">Tertib</td>
                            <td style="color: rgb(0, 0, 0); text-align:center; vertical-align: top;">Tertib</td>
                            <td style="color: rgb(0, 0, 0); text-align:center; vertical-align: top;">Tertib</td>
                            <td style="color: rgb(0, 0, 0); text-align:center; vertical-align: top;">Tertib</td>
                            <td style="color: rgb(0, 0, 0); text-align:center; vertical-align: top;">Tidak Tertib</td>
                            <td style="color: rgb(0, 0, 0); text-align:center; vertical-align: top;">Tidak Tertib</td>
                            <td style="color: rgb(0, 0, 0); text-align:center; vertical-align: top;">Tertib</td>
                        </tr>
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
                            <th style="color: white; text-align:center; vertical-align: top;">Kegiatan Konstruksi (Nama Paket)</th>
                            <th style="color: white; text-align:center; vertical-align: top;">Nomor Kontrak</th>
                            <th style="color: white; text-align:center; vertical-align: top;">Nama BUJK</th>
                            <th style="color: white; text-align:center; vertical-align: top;">Penerapan sistem manajemen mutu konstruksi</th>
                            <th style="color: white; text-align:center; vertical-align: top;">Pemenuhan penyediaan peralatan dalam pelaksanaan proyek konstruksi</th>
                            <th style="color: white; text-align:center; vertical-align: top;">Penggunaan material standar (SNI dan standar lain)</th>
                            <th style="color: white; text-align:center; vertical-align: top;">Penggunaan produk dalam negeri untuk teknologi dan MPK (material, peralatan konstruksi) sesuai dengan ketentuan perundang-undangan tentang pemberdayaan industri nasional</th>
                            <th style="color: white; text-align:center; vertical-align: top;">Pemenuhan terhadap standar mutu material</th>
                            <th style="color: white; text-align:center; vertical-align: top;">Pemenuhan terhadap standar teknis lingkungan</th>
                            <th style="color: white; text-align:center; vertical-align: top;">Pemenuhan terhadap standar keselamatan dan kesehatan kerja</th>
                        </tr>
                        
                    </thead>
                    <tbody>
                        <!-- Example Row -->
                        <tr>
                            <td style="color: rgb(0, 0, 0); text-align:center; vertical-align: top;"></td>
                            <td style="color: rgb(0, 0, 0); text-align:center; vertical-align: top;">1</td>
                            <td style="color: rgb(0, 0, 0); text-align:center; vertical-align: top;">Paket A</td>
                            <td style="color: rgb(0, 0, 0); text-align:center; vertical-align: top;">12345</td>
                            <td style="color: rgb(0, 0, 0); text-align:center; vertical-align: top;">PT. BUJK Abadi</td>
                            <td style="color: rgb(0, 0, 0); text-align:center; vertical-align: top;">Tertib</td>
                            <td style="color: rgb(0, 0, 0); text-align:center; vertical-align: top;">Tertib</td>
                            <td style="color: rgb(0, 0, 0); text-align:center; vertical-align: top;">Tertib</td>
                            <td style="color: rgb(0, 0, 0); text-align:center; vertical-align: top;">Tertib</td>
                            <td style="color: rgb(0, 0, 0); text-align:center; vertical-align: top;">Tidak Tertib</td>
                            <td style="color: rgb(0, 0, 0); text-align:center; vertical-align: top;">Tidak Tertib</td>
                            <td style="color: rgb(0, 0, 0); text-align:center; vertical-align: top;">Tertib</td>
                        </tr>
                    </tbody>
                
                </table>
            </div>
        </div>
    </div>



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
                    <form method="post" id="form-tambah-foto" action="{{ route('admin.monev.pengawasan.storefile') }}"
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
                                <dt>Kegiatan Konstruksi (Nama Paket)</dt>
                                <dd><input type="text" class="form-control" id="kegiatan_konstruksi" name="kegiatan_konstruksi" placeholder="Kegiatan Konstruksi (Nama Paket)"></dd>
                            </div>
                            <div class="col-md-12 mt-4">
                                <dt>Nomer Kontrak</dt>
                                <dd><input type="text" class="form-control" id="no_kontrak" name="no_kontrak" placeholder="Nomer Kontrak"></dd>
                            </div>
                            <div class="col-md-12 mt-4">
                                <dt>Nama BUJK</dt>
                                <dd><input type="text" class="form-control" id="nm_bujk" name="nm_bujk" placeholder="Nama BUJK"></dd>
                            </div>
                            <div class="col-md-12 mt-4">
                                <dt>Proses pemilihan Penyedia Jasa</dt>
                                <dd><input type="text" class="form-control" id="proses_pemilihan_penyedia_jasa" name="proses_pemilihan_penyedia_jasa" placeholder="Proses pemilihan Penyedia Jasa"></dd>
                            </div>
                            <div class="col-md-12 mt-4">
                                <dt>Penerapan standar kontrak </dt>
                                <dd>
                                    <select type="text" class="form-control" id="" name="">
                                        <option value="">- Pilih</option>
                                        <option value="Tertib">Tertib</option>
                                        <option value="Tidak Tertib">Tidak Tertib</option>
                                    </select>

                                </dd>
                            </div>
                            <div class="col-md-12 mt-4">
                                <dt>Penggunaan tenaga kerja konstruksi bersertifikat  </dt>
                                <dd>
                                    <select type="text" class="form-control" id="" name="">
                                        <option value="">- Pilih</option>
                                        <option value="Tertib">Tertib</option>
                                        <option value="Tidak Tertib">Tidak Tertib</option>
                                    </select>

                                </dd>
                            </div>
                            <div class="col-md-12 mt-4">
                                <dt>Pemberian pekerjaan utama dan/atau penunjang kepada subpenyedia jasa  </dt>
                                <dd>
                                    <select type="text" class="form-control" id="" name="">
                                        <option value="">- Pilih</option>
                                        <option value="Tertib">Tertib</option>
                                        <option value="Tidak Tertib">Tidak Tertib</option>
                                    </select>

                                </dd>
                            </div>
                            <div class="col-md-12 mt-4">
                                <dt>ketersediaan dokumen standar K4 </dt>
                                <dd>
                                    <select type="text" class="form-control" id="" name="">
                                        <option value="">- Pilih</option>
                                        <option value="Tertib">Tertib</option>
                                        <option value="Tidak Tertib">Tidak Tertib</option>
                                    </select>

                                </dd>
                            </div>
                            <div class="col-md-12 mt-4">
                                <dt>penerapan SMKK </dt>
                                <dd>
                                    <select type="text" class="form-control" id="" name="">
                                        <option value="">- Pilih</option>
                                        <option value="Tertib">Tertib</option>
                                        <option value="Tidak Tertib">Tidak Tertib</option>
                                    </select>

                                </dd>
                            </div>
                            <div class="col-md-12 mt-4">
                                <dt>kegiatan antisipasi kecelakaan kerja </dt>
                                <dd>
                                    <select type="text" class="form-control" id="" name="">
                                        <option value="">- Pilih</option>
                                        <option value="Tertib">Tertib</option>
                                        <option value="Tidak Tertib">Tidak Tertib</option>
                                    </select>

                                </dd>
                            </div>
                            <div class="col-md-12 mt-4">
                                <dt>pemenuhan penyediaan peralatan dalam pelaksanaan proyek konstruksi </dt>
                                <dd>
                                    <select type="text" class="form-control" id="" name="">
                                        <option value="">- Pilih</option>
                                        <option value="Tertib">Tertib</option>
                                        <option value="Tidak Tertib">Tidak Tertib</option>
                                    </select>

                                </dd>
                            </div>
                            <div class="col-md-12 mt-4">
                                <dt>penggunaan produk dalam negeri untuk teknologi dan MPK (material, peralatan konstruksi) sesuai dengan ketentuan perundang-undangan tentang pemberdayaan industri nasional</dt>
                                <dd>
                                    <select type="text" class="form-control" id="" name="">
                                        <option value="">- Pilih</option>
                                        <option value="Tertib">Tertib</option>
                                        <option value="Tidak Tertib">Tidak Tertib</option>
                                    </select>

                                </dd>
                            </div>
                            <div class="col-md-12 mt-4">
                                <dt>pemenuhan terhadap standar mutu material</dt>
                                <dd>
                                    <select type="text" class="form-control" id="" name="">
                                        <option value="">- Pilih</option>
                                        <option value="Tertib">Tertib</option>
                                        <option value="Tidak Tertib">Tidak Tertib</option>
                                    </select>

                                </dd>
                            </div>
                            <div class="col-md-12 mt-4">
                                <dt>pemenuhan terhadap standar teknis lingkungan</dt>
                                <dd>
                                    <select type="text" class="form-control" id="" name="">
                                        <option value="">- Pilih</option>
                                        <option value="Tertib">Tertib</option>
                                        <option value="Tidak Tertib">Tidak Tertib</option>
                                    </select>

                                </dd>
                            </div>
                            <div class="col-md-12 mt-4">
                                <dt>pemenuhan terhadap standar keselamatan dan kesehatan kerja</dt>
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

   

    <div class="modal fade" role="dialog" id="modal-detail" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Surat Keterangan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">

                    <form method="post" id="form-tambah-foto" action="{{ route('admin.monev.pengawasan.storefile') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="id_foto" name="id_foto">
                        <div id="pdf-container" style="display: none;">
                            <iframe id="pdf-frame" width="100%" height="500px"></iframe>
                        </div>
                </div>
                {{-- <div class="modal-footer bg-whitesmoke br">
                    <button type="submit" id="tombol" class="btn btn-primary">SIMPAN</button>
                    <button type="submit" id="loading" class="btn btn-warning" style="display: none;" readonly>
                        LOADING......
                    </button>
                </div> --}}
                </form>
            </div>
        </div>
    </div>



    {{-- @include('admin.master.skpd.form') --}}
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
     
    {{-- <script src="{{ asset('js/master/skpd/main.js') }}"></script> --}}
@endsection
