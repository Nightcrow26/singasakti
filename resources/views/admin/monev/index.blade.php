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

        #leafletMap-registration {
            height: 400px;
            /* The height is 400 pixels */
        }

        #leafletMap-registration2 {
            height: 400px;
            /* The height is 400 pixels */
        }

        #leafletMap-registration-edit {
            height: 400px;
            /* The height is 400 pixels */
        }

        #leafletMap-registration-show {
            height: 400px;
            /* The height is 400 pixels */
        }
    </style>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-12">
                    <div class="alert alert-primary" role="alert">
                        PAKET PEKERJAAN
                        <button style="float: right" type="button" data-bs-toggle="modal" data-bs-target="#modal-tambah"
                            class="btn btn-sm btn-primary">
                            Tambah
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body ">
            @if (auth()->user()->hasRole('admin'))
                <div>
                    <label for="skpdFilter">Filter SOPD:</label>
                    <select id="skpdFilter" class="form-control select2 my-3">
                        <option value="">Pilih SOPD</option>
                        @foreach ($skpd2 as $skpd2)
                            <option value="{{ $skpd2->id }}">{{ $skpd2->nama }}</option>
                        @endforeach
                    </select>
                </div>
            @endif
            <div class="col-md-12 mb-3">
                <div id="leafletMap-registration2"></div>
            </div>
            <div class="table-responsive">
                <table class="table  table-striped" id="table">
                    <thead class="bg bg-primary">
                        <tr>
                            <th
                                style="color: white;text-align:center;padding-right:100px;border-spacing: 0px;white-space: nowrap;">
                                Aksi
                            </th>
                            <th style="color: white;text-align:center"> No</th>
                            {{-- <th style="color: white;text-align:center"> SOPD</th> --}}
                            <th
                                style="color: white;text-align:center;padding-left:100px;padding-right:100px;border-spacing: 0px;white-space: nowrap;">
                                SOPD</th>
                            <th
                                style="color: white;text-align:center;padding-left:100px;padding-right:100px;border-spacing: 0px;white-space: nowrap;">
                                Paket Pekerjaan</th>
                            <th
                                style="color: white;text-align:center;padding-left:50px;padding-right:50px;border-spacing: 0px;white-space: nowrap;">
                                Sumber Dana (DAU/DAK)</th>
                            <th
                                style="color: white;text-align:center;padding-left:50px;padding-right:50px;border-spacing: 0px;white-space: nowrap;">
                                Nilai Pagu (Rp)</th>
                            <th
                                style="color: white;text-align:center;padding-left:50px;padding-right:50px;border-spacing: 0px;white-space: nowrap;">
                                Pagu Kontrak (Rp)</th>
                            <th
                                style="color: white;text-align:center;padding-left:50px;padding-right:50px;border-spacing: 0px;white-space: nowrap;">
                                Tanggal Kontrak</th>
                            <th
                                style="color: white;text-align:center;padding-left:50px;padding-right:50px;border-spacing: 0px;white-space: nowrap;">
                                Realiasasi Keuangan</th>
                            <th
                                style="color: white;text-align:center;padding-left:50px;padding-right:50px;border-spacing: 0px;white-space: nowrap;">
                                Realiasasi Fisik (%)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $a)
                            <tr>
                                <td>
                                    <div class="btn-group" role="group">
                                        <button id="btnGroupDrop1" type="button"
                                            class="btn btn-sm btn-outline-secondary dropdown-toggle"
                                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="menu-icon tf-icons bx bx-cog"></i>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1" style="">
                                            <button style="float: right" type="button"
                                                onclick="tambah_foto('{{ $a->id }}')" class="dropdown-item">
                                                <i class='bx bxs-add-to-queue'></i> Surat Keterangan
                                            </button>
                                            <a href="{{ route('admin.monev.add', [$a->id]) }}" class="dropdown-item">
                                                <i class='bx bxs-add-to-queue'></i> Realisasi
                                            </a>
                                            <a href="{{ route('admin.monev.detail', [$a->id]) }}" class="dropdown-item">
                                                <i class='bx bxs-low-vision'></i> Detail
                                            </a>
                                            <button class="dropdown-item" onclick="hapus('{{ $a->id }}')">
                                                <i class='bx bxs-trash'></i> Hapus
                                            </button>
                                        </div>
                                    </div>

                                </td>
                                <td>{{ $loop->iteration }}</td>
                                {{-- <td>{{ $a->skpd->nama }}</td> --}}
                                <td>{{ $a->skpd->nama }}</td>
                                <td>{{ $a->paket }}</td>
                                <td>{{ $a->sumber_dana }}</td>
                                <td>Rp. {{ number_format($a->pagu, 0, ',', '.') }}</td>
                                <td>Rp. {{ number_format($a->pagu_kontrak, 0, ',', '.') }}</td>
                                <td>{{ $a->tgl_kontrak }}</td>
                                @foreach ($a->realisasis as $c)
                                    @if ($loop->first)
                                        <td>Rp. {{ number_format($c->realisasi, 0, ',', '.') }}</td>
                                        <td>{{ number_format($c->realisasi_fisik, 2, ',', '.') }}</td>
                                    @endif
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" role="dialog" id="modal-tambah" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" id="form-tambah" action="{{ route('admin.monev.store') }}"
                        enctype="multipart/form-data">
                        @csrf
                        {{-- @method('PATCH') --}}
                        <div class="row">
                            <input type="hidden" id="user_id" name="skpd_id" value="{{ auth()->user()->skpd_id }}">
                            <input type="hidden" id="tahun" name="tahun" value="{{ auth()->user()->tahun }}">
                            <div class="col-12 mt-2">
                                <input type="hidden" name="total_pagu" id="total_pagu_modal" required>
                            </div>
                            <div class="col-12 mt-2">
                                <input type="hidden" name="pagu_sub" id="pagu_sub" required>
                            </div>

                            <div class="alert alert-primary" role="alert">
                                Perencanaan
                            </div>
                            {{--
                            <div class="col-12">
                                <label for="bidang">skpd <small class="text-danger">*</small></label>
                                <select name="skpd_id" id="skpd_id" style="width:100%" required>
                                    <option value="">Pilih skpd</option>
                                    @foreach ($skpd as $skpd)
                                        <option value="{{ $skpd->id }}">{{ $skpd->nama }}</option>
                                    @endforeach

                                </select>
                            </div> --}}

                            <div class="col-12">
                                <label for="bidang">Urusan <small class="text-danger">*</small></label>
                                <select name="ref_urusan_id" id="ref_urusan_id" style="width:100%" required>
                                    <option value="">Pilih Urusan</option>
                                    @foreach ($urusan as $urusan5)
                                        <option value="{{ $urusan5->id }}">{{ $urusan5->nama }}</option>
                                    @endforeach

                                </select>
                            </div>

                            <div class="col-12 mt-3">
                                <label for="ref_bidang_urusan_id">Bidang Urusan<small
                                        class="text-danger">*</small></label>
                                <select name="ref_bidang_urusan_id" id="ref_bidang_urusan_id" style="width:100%"
                                    required>
                                    <option value="">Pilih Bidang Urusan</option>
                                </select>
                            </div>

                            <div class="col-12 mt-3">
                                <label for="ref_program_id">Program<small class="text-danger">*</small></label>
                                <select name="ref_program_id" id="ref_program_id" style="width:100%" required>
                                    <option value="">Pilih Program</option>
                                </select>
                            </div>

                            <div class="col-12 mt-3">
                                <label for="ref_kegiatan_id">Kegiatan<small class="text-danger">*</small></label>
                                <select name="ref_kegiatan_id" id="ref_kegiatan_id" style="width:100%" required>
                                    <option value="">Pilih Kegiatan</option>
                                </select>
                            </div>

                            <div class="col-12 mt-3">
                                <label for="ref_sub_kegiatan_id">Sub Kegiatan<small class="text-danger">*</small></label>
                                <select name="ref_sub_kegiatan_id" id="ref_sub_kegiatan_id" style="width:100%" required>
                                    <option value="">Pilih Sub Kegiatan</option>
                                </select>
                            </div>

                            <div class="alert alert-primary mt-3" role="alert">
                                Pelaksana
                            </div>

                            <div class="col-6">
                                <label for="nama_perusahaan">Nama Perusahaan <small class="text-danger">*</small></label>
                                <input type="text" class="form-control" name="nama_perusahaan" id="nama_perusahaan"
                                    placeholder="Contoh: PT. ABC" required>
                            </div>
                            <div class="col-6">
                                <label for="nama_direktur">Nama Direktur <small class="text-danger">*</small></label>
                                <input type="text" class="form-control" name="nama_direktur" id="nama_direktur"
                                    placeholder="Contoh: Muhammad" required>
                            </div>
                            <div class="col-6">
                                <label for="alamat_perusahaan">Alamat Perusahaan <small
                                        class="text-danger">*</small></label>
                                <input type="text" class="form-control" name="alamat_perusahaan"
                                    placeholder="Contoh: Jl. Anggrek" required>
                            </div>

                            <div class="col-6">
                                <label for="telpon">Nomer Telpon <small class="text-danger">*</small></label>
                                <input type="text" class="form-control" name="telpon"
                                    placeholder="Contoh: 08434423789472"required>
                            </div>

                            <div class="alert alert-primary mt-3" role="alert">
                                Perencana
                            </div>

                            <div class="col-6">
                                <label for="nama_perusahaan_perencana">Nama Perusahaan <small
                                        class="text-danger">*</small></label>
                                <input type="text" class="form-control" name="nama_perusahaan_perencana"
                                    id="nama_perusahaan_perencana" placeholder="Contoh: PT. ABC" required>
                            </div>
                            <div class="col-6">
                                <label for="nama_direktur_perencana">Nama Direktur <small
                                        class="text-danger">*</small></label>
                                <input type="text" class="form-control" name="nama_direktur_perencana"
                                    id="nama_direktur_perencana" placeholder="Contoh: Muhammad" required>
                            </div>
                            <div class="col-6">
                                <label for="alamat_perusahaan_perencana">Alamat Perusahaan <small
                                        class="text-danger">*</small></label>
                                <input type="text" class="form-control" name="alamat_perusahaan_perencana"
                                    placeholder="Contoh: Jl. Anggrek" required>
                            </div>

                            <div class="col-6">
                                <label for="telpon_perencana">Nomer Telpon <small class="text-danger">*</small></label>
                                <input type="text" class="form-control" name="telpon_perencana"
                                    placeholder="Contoh: 08434423789472"required>
                            </div>

                            <div class="alert alert-primary mt-3" role="alert">
                                Pengawas
                            </div>

                            <div class="col-6">
                                <label for="nama_perusahaan_pengawas">Nama Perusahaan <small
                                        class="text-danger">*</small></label>
                                <input type="text" class="form-control" name="nama_perusahaan_pengawas"
                                    id="nama_perusahaan_pengawas" placeholder="Contoh: PT. ABC" required>
                            </div>
                            <div class="col-6">
                                <label for="nama_direktur_pengawas">Nama Direktur <small
                                        class="text-danger">*</small></label>
                                <input type="text" class="form-control" name="nama_direktur_pengawas"
                                    id="nama_direktur_pengawas" placeholder="Contoh: Muhammad" required>
                            </div>
                            <div class="col-6">
                                <label for="alamat_perusahaan_pengawas">Alamat Perusahaan <small
                                        class="text-danger">*</small></label>
                                <input type="text" class="form-control" name="alamat_perusahaan_pengawas"
                                    placeholder="Contoh: Jl. Anggrek" required>
                            </div>

                            <div class="col-6">
                                <label for="telpon_pengawas">Nomer Telpon <small class="text-danger">*</small></label>
                                <input type="text" class="form-control" name="telpon_pengawas"
                                    placeholder="Contoh: 08434423789472"required>
                            </div>


                            <div class="alert alert-primary mt-3" role="alert">
                                Proyek
                            </div>

                            <div class="col-6">
                                <label for="paket">Nama Paket <small class="text-danger">*</small></label>
                                <input type="text" class="form-control" name="paket" id="paket"
                                    placeholder="Contoh: Jembatan" required>
                            </div>
                            <div class="col-6">
                                <label for="pagu">pagu <small class="text-danger">*</small></label>
                                <input type="text" onkeypress="return hanyaAngka()" class="form-control angka"
                                    name="pagu" placeholder="Contoh: 100000" required>
                            </div>
                            <div class="col-6 mt-2">
                                <label for="pagu_kontrak">pagu kontrak <small class="text-danger">*</small></label>
                                <input type="text" onkeypress="return hanyaAngka()" class="form-control angka"
                                    name="pagu_kontrak" id="pagu_kontrak" placeholder="Contoh: 7000000" required>
                            </div>
                            <div class="col-6 mt-2">
                                <label for="sumber_dana">Sumber Dana <small class="text-danger">*</small></label>
                                <select name="sumber_dana" class="form-control h5" style="width:100%;color: black"
                                    required>
                                    <option value="">Pilih</option>
                                    <option value="DAU">DAU</option>
                                    <option value="DAK FISIK">DAK FISIK</option>
                                    <option value="DAK NON FISIK">DAK NON FISIK</option>
                                    <option value="BLUD">BLUD</option>
                                </select>
                            </div>
                            <div class="col-6 mt-2">
                                <label for="tgl_kontrak">Tanggal Kontrak <small class="text-danger">*</small></label>
                                <input type="date" class="form-control" name="tgl_kontrak" id="tgl_kontrak" required>
                            </div>
                            <div class="col-6 mt-2">
                                <label for="range">Waktu Pelaksanaan <small class="text-danger">*</small></label>
                                <input type="text" class="form-control" id="range" name="daterange" />
                            </div>

                            <div class="alert alert-primary mt-3" role="alert">
                                Lokasi Proyek
                            </div>

                            <div class="col-md-12 mt-3">
                                <a href="#" class="btn btn-primary btn-sm" onclick="getCurrentLocation()">Pakai
                                    Lokasi Saat
                                    Ini</a>
                                <div id="loadingIndicator" style="display: none;">Loading...</div>
                                <div id="leafletMap-registration"></div>
                            </div>

                            <div class="col-md-6 mt-2">
                                <label for="latitude">latitude <small class="text-danger">*</small></label>
                                <input type="text" id="Latitude" name="latitude" class="form-control" required>
                            </div>

                            <div class="col-md-6 mt-2">
                                <label for="longitude">longitude <small class="text-danger">*</small></label>
                                <input type="text" id="Longitude" name="longitude" class="form-control" required>
                            </div>

                        </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">TUTUP</button>
                    <button type="submit" id="tombol" class="btn btn-primary">SIMPAN</button>
                    <button type="submit" id="loading" class="btn btn-warning" style="display: none;" readonly>
                        LOADING......
                    </button>
                </div>
                </form>
            </div>
        </div>
    </div>



    <div class="modal fade" role="dialog" id="modal-tambah-foto" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Surat Keterangan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">

                    <form method="post" id="form-tambah-foto" action="{{ route('admin.monev.storefile') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <small class="text-dark fw-semibold">Surat Keterangan yang di upload</small>
                            <small class="text-dark fw-semibold">1. Bukti Dukung Tertib Usaha Jasa Konstruksi</small>
                            <small class="text-dark fw-semibold">2. Bukti Dukung Tertib Penyelenggaraan Jasa
                                Konstruksi</small>
                            <small class="text-dark fw-semibold">3. Bukti Dukung Tertib Pemanfaatan Jasa
                                Konstruksi</small>
                            <small class="text-dark fw-semibold">*File Maksimal 2 Mb</small>
                        </div>
                        <div class="row" id="ins">
                        </div>
                        {{-- <div class="row">
                            <input type="hidden" id="skpd_id_foto" name="skpd_id">
                            <input type="hidden" id="tahun" name="tahun" value="{{ auth()->user()->tahun }}">
                            <input type="hidden" id="id_tambah_foto" name="trx_monev_id">
                            <small class="text-dark fw-semibold">Surat Keterangan yang di upload</small>
                            <small class="text-dark fw-semibold">1. Bukti Dukung Tertib Usaha Jasa Konstruksi</small>
                            <small class="text-dark fw-semibold">2. Bukti Dukung Tertib Penyelenggaraan Jasa
                                Konstruksi</small>
                            <small class="text-dark fw-semibold">3. Bukti Dukung Tertib Pemanfaatan Jasa
                                Konstruksi</small>

                            <div class="col-md-12 mt-4">
                                <small class="text-light fw-semibold">Upload :</small>
                                <table class="table" id="dynamic_field_lampiran">
                                    <tr>
                                        <td>
                                            <input type="file" name="file[]" class="form-control file_list" required>
                                        </td>
                                        <td>
                                            <input type="text" id="ket" name="ket" class="form-control"
                                                placeholder="Nama File" required>
                                        </td>
                                        <td><button type="button" name="add_lampiran" id="add_lampiran"
                                                class="btn btn-success">+</button>
                                        </td>
                                    </tr>
                                </table>
                            </div>


                        </div> --}}
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

        function hanyaAngka(evt) {
            var charCode = (evt.which) ? evt.which : event.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57))

                return false;
            return true;
        }

        $('#form-tambah').on('submit', function(e) {
            e.preventDefault()

            $("#form-tambah").ajaxSubmit({
                beforeSend: function() {
                    $('#tombol').hide();
                    $('#loading').show();
                },
                success: function(res) {
                    if (res === true) {
                        swal('Data Berhasil Di Tambah', '', 'success');
                        // table.ajax.reload(null,false)
                        location.reload();
                        //set semua ke default
                        // $("#form-tambah input:not([name='_token'])").val('')
                        $("#modal-tambah").modal('hide')
                    } else if (res === 'realisasi_melebihi') {
                        swal('Realisasi Melebihi Pagu', '', 'error');
                        $('#tombol').show();
                        $('#loading').hide();
                    } else if (res === 'fisik_melebihi') {
                        swal('Realisasi Fisik Melebihi 100%', '', 'error');
                        $('#tombol').show();
                        $('#loading').hide();
                    } else if (res === 'realisasi_februari_kurang') {
                        swal('Realisasi Februari Tidak Boleh Kurang Dari Realisasi Sebelumnya', '',
                            'error');
                        $('#tombol').show();
                        $('#loading').hide();
                    } else if (res === 'realisasi_maret_kurang') {
                        swal('Realisasi maret Tidak Boleh Kurang Dari Realisasi Sebelumnya', '',
                            'error');
                        $('#tombol').show();
                        $('#loading').hide();
                    } else if (res === 'realisasi_april_kurang') {
                        swal('Realisasi april Tidak Boleh Kurang Dari Realisasi Sebelumnya', '',
                            'error');
                        $('#tombol').show();
                        $('#loading').hide();
                    } else if (res === 'realisasi_mei_kurang') {
                        swal('Realisasi mei Tidak Boleh Kurang Dari Realisasi Sebelumnya', '', 'error');
                        $('#tombol').show();
                        $('#loading').hide();
                    } else if (res === 'realisasi_juni_kurang') {
                        swal('Realisasi juni Tidak Boleh Kurang Dari Realisasi Sebelumnya', '',
                            'error');
                        $('#tombol').show();
                        $('#loading').hide();
                    } else if (res === 'realisasi_juli_kurang') {
                        swal('Realisasi juli Tidak Boleh Kurang Dari Realisasi Sebelumnya', '',
                            'error');
                        $('#tombol').show();
                        $('#loading').hide();
                    } else if (res === 'realisasi_agustus_kurang') {
                        swal('Realisasi agustus Tidak Boleh Kurang Dari Realisasi Sebelumnya', '',
                            'error');
                        $('#tombol').show();
                        $('#loading').hide();
                    } else if (res === 'realisasi_september_kurang') {
                        swal('Realisasi september Tidak Boleh Kurang Dari Realisasi Sebelumnya', '',
                            'error');
                        $('#tombol').show();
                        $('#loading').hide();
                    } else if (res === 'realisasi_oktober_kurang') {
                        swal('Realisasi oktober Tidak Boleh Kurang Dari Realisasi Sebelumnya', '',
                            'error');
                        $('#tombol').show();
                        $('#loading').hide();
                    } else if (res === 'realisasi_november_kurang') {
                        swal('Realisasi november Tidak Boleh Kurang Dari Realisasi Sebelumnya', '',
                            'error');
                        $('#tombol').show();
                        $('#loading').hide();
                    } else if (res === 'realisasi_desember_kurang') {
                        swal('Realisasi desember Tidak Boleh Kurang Dari Realisasi Sebelumnya', '',
                            'error');
                        $('#tombol').show();
                        $('#loading').hide();
                    }


                }
            })
        });

        $('#form-tambah-realisasi').on('submit', function(e) {
            e.preventDefault()

            $("#form-tambah-realisasi").ajaxSubmit({
                beforeSend: function() {
                    $('#tombol').hide();
                    $('#loading').show();
                },
                success: function(res) {
                    if (res === true) {
                        swal('Data Berhasil Di Tambah', '', 'success');
                        // table.ajax.reload(null,false)
                        location.reload();
                        //set semua ke default
                        // $("#form-tambah input:not([name='_token'])").val('')
                        $("#modal-tambah").modal('hide')
                    } else if (res === 'realisasi_melebihi') {
                        swal('Realisasi Melebihi Pagu', '', 'error');
                        $('#tombol').show();
                        $('#loading').hide();
                    } else if (res === 'fisik_melebihi') {
                        swal('Realisasi Fisik Melebihi 100%', '', 'error');
                        $('#tombol').show();
                        $('#loading').hide();
                    }
                }
            })
        });

        $('#form-tambah-foto').on('submit', function(e) {
            e.preventDefault()
            console.log('aaa')

            $("#form-tambah-foto").ajaxSubmit({
                beforeSend: function() {
                    $('#tombol').hide();
                    $('#loading').show();
                },
                success: function(res) {

                    if (res.status == "success") {
                        swal('Data Berhasil Di Tambah', '', 'success');

                        // table.ajax.reload(null,false)
                        location.reload();
                        //set semua ke default
                        // $("#form-tambah input:not([name='_token'])").val('')
                        $("#modal-tambah").modal('hide')
                    } else if (res.status == "failed") {
                        swal('Gagal', 'Maksimal File 2 MB', 'error');
                        $('#tombol').show();
                        $('#loading').hide();
                    }
                }
            })
        });


        $('#form-edit').on('submit', function(e) {
            e.preventDefault()

            $("#form-edit").ajaxSubmit({
                beforeSend: function() {
                    $('#tombol2').hide();
                    $('#loading2').show();
                },
                success: function(res) {
                    if (res === true) {
                        swal('Data Berhasil Dirubah', '', 'success');
                        location.reload();
                        $("#modal-edit").modal('hide')
                    }
                }
            })
        });


        function hanyaAngka() {
            const regex = /[^\d.]|\.(?=.*\.)/g;
            const subst = ``;

            $('.angka').keyup(function() {
                const str = this.value;
                const result = str.replace(regex, subst);
                this.value = result;

            });
        }







        var desa_latitude = `-2.587393559456695`
        var desa_longitude = `115.37534573108255`
        var curLocation = [0, 0];
        if (curLocation[0] == 0 && curLocation[1] == 0) {
            curLocation = [desa_latitude, desa_longitude];
        }
        const providerOSM = new GeoSearch.OpenStreetMapProvider();


        //leaflet map
        var leafletMap = L.map('leafletMap-registration', {
            zoomSnap: 0
        }).setView([desa_latitude, desa_longitude], 12);

        L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(leafletMap);


        leafletMap.attributionControl.setPrefix(false);

        var marker = new L.marker(curLocation, {
            draggable: 'true'
        });

        marker.on('dragend', function(event) {
            var position = marker.getLatLng();

            $("#Latitude").val(position.lat);
            $("#Longitude").val(position.lng).keyup();
        });

        leafletMap.addLayer(marker);

        let theMarker = {};


        const search = new GeoSearch.GeoSearchControl({
            provider: providerOSM,
            style: 'bar',
            searchLabel: 'Cari',
        });

        leafletMap.addControl(search);


        $('#modal-tambah').on('shown.bs.modal', function() {
            leafletMap.invalidateSize();
        });

        var marker;

        // Mendengarkan event ketika hasil pencarian dipilih
        leafletMap.on('geosearch/showlocation', function(data) {
            var latitude = data.location.y; // Mendapatkan nilai latitude dari hasil pencarian
            var longitude = data.location.x; // Mendapatkan nilai longitude dari hasil pencarian

            // Mengisi nilai latitude dan longitude ke dalam form
            document.getElementById('Latitude').value = latitude;
            document.getElementById('Longitude').value = longitude;

            // Jika marker sudah ada sebelumnya, perbarui posisinya; jika tidak, buat marker baru
            if (marker) {
                marker.setLatLng([latitude, longitude]);
            } else {
                // Buat marker baru dan tambahkan ke peta
                marker = L.marker([latitude, longitude], {
                    draggable: true
                }).addTo(leafletMap);

                // Mendengarkan event ketika marker didrag
                marker.on('dragend', function(event) {
                    var markerLatLng = event.target.getLatLng(); // Mendapatkan posisi marker setelah didrag
                    document.getElementById('Latitude').value = markerLatLng.lat;
                    document.getElementById('Longitude').value = markerLatLng.lng;
                });
            }

            // Mengatur peta untuk menampilkan marker di lokasi baru
            leafletMap.setView([latitude, longitude], leafletMap.getZoom());

            // Aktifkan interaksi drag pada marker
            marker.dragging.enable();
        });



        //leaflet map
        var leafletMap2 = L.map('leafletMap-registration2', {
            zoomSnap: 0
        }).setView([desa_latitude, desa_longitude], 12);

        L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(leafletMap2);

        const cari = new GeoSearch.GeoSearchControl({
            provider: providerOSM,
            style: 'bar',
            searchLabel: 'Cari',
        });

        leafletMap2.addControl(cari);

        function loadMarkers(skpdId = '') {
            axios.get('/admin/monev/marker', {
                    params: {
                        skpd_id: skpdId
                    }
                })
                .then(response => {
                    const markers = response.data;

                    // Clear existing markers
                    leafletMap2.eachLayer(function(layer) {
                        if (!!layer.toGeoJSON) {
                            leafletMap2.removeLayer(layer);
                        }
                    });

                    // Add new markers
                    markers.forEach(marker => {
                        var newMarker = L.marker([marker.latitude, marker.longitude]);
                        var currentMonth = new Date().getMonth();


                        var fisik = parseInt(marker.realisasi.realisasi_fisik);

                        var keuangan = parseInt(marker.realisasi.realisasi);

                        var pagu = marker.pagu;
                        var pagu_kontrak = marker.pagu_kontrak;
                        var fisikNumber = parseInt(fisik);
                        var fisikTanpaKoma = fisikNumber.toFixed(0);

                        var keuanganNumber = parseInt(keuangan);
                        var keuanganTanpaKoma = keuanganNumber.toFixed(0);

                        var paguNumber = parseInt(pagu);
                        var paguTanpaKoma = paguNumber.toFixed(0);

                        var pagu_kontrakNumber = parseInt(pagu_kontrak);
                        var pagu_kontrakTanpaKoma = pagu_kontrakNumber.toFixed(0);

                        var today = moment(new Date()).format('YYYY-MM-DD');
                        var tgl_akhir = moment(marker.tgl_akhir).format('YYYY-MM-DD');


                        var iconUrl =
                            'https://maps.google.com/mapfiles/ms/icons/green-dot.png'; // Default color
                        if (fisik < 50) {
                            iconUrl = 'https://maps.google.com/mapfiles/ms/icons/red-dot.png';
                        } else if (fisik < 80) {
                            iconUrl = 'https://maps.google.com/mapfiles/ms/icons/yellow-dot.png';
                        } else if (fisik < 100 && today > tgl_akhir) {
                            iconUrl = 'https://maps.google.com/mapfiles/ms/icons/red-dot.png';
                        } else if (fisik == 100) {
                            iconUrl = 'https://cdn-icons-png.flaticon.com/512/8029/8029509.png';
                        }

                        // Buat popup untuk menampilkan detail marker
                        var tgl_mulai_string = marker.tgl_mulai;
                        var tgl_akhir_string = marker.tgl_akhir;
                        var tgl_kontrak_string = marker.tgl_kontrak;
                        var tgl_mulai = moment(tgl_mulai_string).format('DD-MM-YYYY');
                        var tgl_akhir = moment(tgl_akhir_string).format('DD-MM-YYYY');
                        var tgl_kontrak = moment(tgl_kontrak_string).format('DD-MM-YYYY');
                        var tgl_mulai_diff = moment(tgl_mulai_string);
                        var tgl_akhir_diff = moment(tgl_akhir_string);
                        var selisihHari = tgl_akhir_diff.diff(tgl_mulai_diff, 'days') + 1;
                        var popupContent = `
                <p>
                    SOPD : ${marker.skpd.nama}
                     <br>
                    Paket : ${marker.paket}
                     <br>
                     Nama Perusahaan : ${marker.nama_perusahaan}
                      <br>
                      Sumber Dana : ${marker.sumber_dana}
                      <br>
                       Pagu : Rp. ${paguTanpaKoma}
                     <br>
                      Pagu Kontrak : Rp. ${pagu_kontrakNumber}
                     <br>
                     Realisasi Fisik : ${fisikTanpaKoma}%
                     <br>
                     Realisasi Keuangan : Rp. ${keuanganTanpaKoma}
                     <br>
                     Tgl Kontrak : ${tgl_kontrak}
                      <br>
                     Tgl Mulai : ${tgl_mulai}
                      <br>
                     Tgl Selesai : ${tgl_akhir}
                     <br>
                     Waktu Pengerjaan : ${selisihHari} Hari
                     <br>
                       <a href="/admin/monev/detail/${marker.id}"class="btn btn-sm btn-outline-success">Detail</a>
                </p>
                <!-- Tambahkan detail lainnya sesuai kebutuhan -->
            `;
                        newMarker.bindPopup(popupContent);

                        newMarker.setIcon(L.icon({
                            iconUrl: iconUrl,
                            iconSize: [40, 40]
                        }));

                        newMarker.addTo(leafletMap2);
                    });
                })
                .catch(error => {
                    console.error('Error fetching markers:', error);
                });
        }

        // Initial load
        loadMarkers();

        @if (auth()->user()->hasRole('admin'))
            document.getElementById('skpdFilter').addEventListener('change', function() {
                var skpdId = this.value;
                loadMarkers(skpdId);
            });
        @endif

        var legend = L.control({
            position: 'topright'
        });

        legend.onAdd = function(map) {
            var div = L.DomUtil.create('div', 'legend');
            div.style.backgroundColor = 'rgba(255, 255, 255, 0.8)'; // Atur warna latar belakang legenda
            div.innerHTML +=
                '<div style="background-color: red; width: 20px; height: 20px; display: inline-block; margin-right: 5px;"></div>Priode pengerjaan melewati batas waktu<br>';
            div.innerHTML +=
                '<div style="background-color: red; width: 20px; height: 20px; display: inline-block; margin-right: 5px;"></div>Realiasi Fisik Kurang dari 50%<br>';
            div.innerHTML +=
                '<div style="background-color: yellow; width: 20px; height: 20px; display: inline-block; margin-right: 5px;"></div>Realiasi Fisik  Kurang dari 80%<br>';
            div.innerHTML +=
                '<div style="background-color: green; width: 20px; height: 20px; display: inline-block; margin-right: 5px;"></div>Realiasi Fisik  80% atau lebih<br>';
            div.innerHTML +=
                '<img src="https://cdn-icons-png.flaticon.com/512/8029/8029509.png" style="width: 20px; height: 20px; margin-right: 5px;">Realiasi Fisik 100%<br>';
            return div;
        };

        legend.addTo(leafletMap2);

        // axios.get(
        //         'https://geoportal.hulusungaiselatankab.go.id/geoserver/ADMIN/ows?service=WFS&version=1.0.0&request=GetFeature&typeName=ADMIN:6306hss_batas_kecamatan_ar_630620220624102942&maxFeatures=50&outputFormat=application%2Fjson'
        //     )
        //     .then(response => {
        //         const geojsonFeature = response.data;

        //         // Menampilkan poligon pada peta
        //         L.geoJSON(geojsonFeature).addTo(leafletMap2);
        //         L.geoJSON(geojsonFeature).addTo(leafletMap);
        //     })
        //     .catch(error => {
        //         console.error('Error fetching GeoJSON:', error);
        //     });

        var latitudeInput = document.getElementById('Latitude');
        var longitudeInput = document.getElementById('Longitude');

        latitudeInput.addEventListener('input', updateMarker);
        longitudeInput.addEventListener('input', updateMarker);

        function updateMarker() {
            var latitude = parseFloat(latitudeInput.value);
            var longitude = parseFloat(longitudeInput.value);

            if (isNaN(latitude) || isNaN(longitude)) {
                return;
            }

            if (marker) {
                marker.setLatLng([latitude, longitude]);
            } else {
                marker = L.marker([latitude, longitude]).addTo(map);
            }

            map.setView([latitude, longitude], 13);
        }


        function hapus(id) {
            swal({
                    title: 'Anda Yakin Ingin Menghapus ?',
                    text: '',
                    icon: 'warning',
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {

                        $.ajax({
                            url: "{{ url('') }}/admin/monev/delete",
                            method: "POST",
                            data: {
                                id: id,
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(results) {
                                location.reload();
                                swal('Berhasil Menghapus Data', {
                                    icon: 'success',
                                });
                            }
                        });

                    } else {
                        swal('Data Batal Dihapus');
                    }
                });
        }


        function getCurrentLocation() {
            // Menampilkan indikator loading saat tombol diklik
            document.getElementById('loadingIndicator').style.display = 'block';

            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var latitude = position.coords.latitude;
                    var longitude = position.coords.longitude;

                    // Update nilai latitude dan longitude ke dalam form
                    document.getElementById('Latitude').value = latitude;
                    document.getElementById('Longitude').value = longitude;

                    // Setelah mendapatkan lokasi terkini, panggil fungsi untuk memindahkan marker ke lokasi tersebut
                    moveMarkerlocToCurrentLocation();

                    // Menyembunyikan indikator loading setelah mendapatkan lokasi
                    document.getElementById('loadingIndicator').style.display = 'none';
                }, function(error) {
                    // Handle kesalahan jika geolokasi tidak dapat diakses
                    console.error('Kesalahan Geolokasi:', error.message);

                    // Menyembunyikan indikator loading jika terjadi kesalahan
                    document.getElementById('loadingIndicator').style.display = 'none';
                });
            } else {
                // Handle jika geolokasi tidak didukung oleh browser
                console.error('Geolokasi tidak didukung oleh browser ini.');

                // Menyembunyikan indikator loading jika geolokasi tidak didukung
                document.getElementById('loadingIndicator').style.display = 'none';
            }
        }

        // Fungsi untuk membuat marker baru di lokasi terkini dan memindahkannya ke peta
        function moveMarkerlocToCurrentLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var latitude = position.coords.latitude;
                    var longitude = position.coords.longitude;

                    // Menghapus markerloc jika sudah ada
                    if (marker) {
                        leafletMap.removeLayer(marker);
                    }

                    // Membuat marker baru di lokasi terkini dan menambahkannya ke peta
                    marker = L.marker([latitude, longitude], {
                        draggable: true
                    }).addTo(leafletMap);

                    // Mendengarkan event ketika marker didrag
                    marker.on('dragend', function(event) {
                        var markerLatLng = event.target
                            .getLatLng(); // Mendapatkan posisi marker setelah didrag
                        document.getElementById('Latitude').value = markerLatLng.lat;
                        document.getElementById('Longitude').value = markerLatLng.lng;
                    });

                    // Mengatur peta untuk menampilkan marker di lokasi terkini
                    leafletMap.setView([latitude, longitude], leafletMap.getZoom());
                }, function(error) {
                    // Handle kesalahan jika geolokasi tidak dapat diakses
                    console.error('Kesalahan Geolokasi:', error.message);
                });
            } else {
                // Handle jika geolokasi tidak didukung oleh browser
                console.error('Geolokasi tidak didukung oleh browser ini.');
            }
        }

        // var drawnItems = new L.FeatureGroup();
        // leafletMap.addLayer(drawnItems);

        // var drawControl = new L.Control.Draw({
        //     draw: {
        //         polygon: {
        //             allowIntersection: false,
        //             showArea: true,
        //             shapeOptions: {
        //                 color: 'red'
        //             }
        //         },
        //         polyline: {
        //             shapeOptions: {
        //                 color: 'green'
        //             }
        //         },
        //         circle: false,
        //         rectangle: false,
        //         marker: false
        //     },
        //     edit: {
        //         featureGroup: drawnItems
        //     }
        // });

        // leafletMap.addControl(drawControl);

        // function enableDrawing(shape) {
        //     if (shape === 'polygon') {
        //         drawControl.setDrawingOptions({
        //             polygon: true,
        //             polyline: false
        //         });
        //     } else if (shape === 'polyline') {
        //         drawControl.setDrawingOptions({
        //             polygon: false,
        //             polyline: true
        //         });
        //     }
        //     drawControl._toolbars.draw._modes.polygon.handler.enable();
        // }

        // leafletMap.on('draw:created', function(e) {
        //     var type = e.layerType;
        //     var layer = e.layer;
        //     var coordinates = layer.getLatLngs();
        //     drawnItems.addLayer(layer);

        //     // Ubah koordinat menjadi format yang sesuai untuk disimpan di dalam textarea form
        //     var formattedCoordinates = JSON.stringify(coordinates);

        //     // Masukkan koordinat ke dalam textarea form
        //     document.getElementById('coordinates').value = formattedCoordinates;
        // });

        $(document).ready(function() {
            new TomSelect("#skpd_id", {
                sortField: {
                    field: "text",
                    direction: "asc"
                }
            });
        });

        $(document).ready(function() {
            new TomSelect("#ref_urusan_id", {
                sortField: {
                    field: "text",
                    direction: "asc"
                }
            });
        });

        var tomSelect1 = new TomSelect("#ref_bidang_urusan_id", {
            sortField: {
                field: "text",
                direction: "asc"
            }
        });

        var tomSelect2 = new TomSelect("#ref_program_id", {
            sortField: {
                field: "text",
                direction: "asc"
            }
        });

        var tomSelect3 = new TomSelect("#ref_kegiatan_id", {
            sortField: {
                field: "text",
                direction: "asc"
            }
        });

        var tomSelect4 = new TomSelect("#ref_sub_kegiatan_id", {
            sortField: {
                field: "text",
                direction: "asc"
            }
        });


        $(function() {
            $('#ref_urusan_id').on('change', function() {
                id = $("#ref_urusan_id").val()


                $.ajax({
                    url: window.location.origin + "/master/nomen/bidang_filter",
                    method: "POST",
                    data: {
                        id: id
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {

                        $('#ref_bidang_urusan_id').empty();
                        $('#ref_program_id').empty();
                        $('#ref_kegiatan_id').empty();
                        $('#ref_sub_kegiatan_id').empty();
                        $('select[id="ref_bidang_urusan_id"]').append(
                            '<option value="">Pilih Bidang Urusan</option>');
                        $('select[id="ref_program_id"]').append(
                            '<option value="">Pilih Program</option>');
                        $('select[id="ref_kegiatan_id"]').append(
                            '<option value="">Pilih Kegiatan</option>');
                        $('select[id="ref_sub_kegiatan_id"]').append(
                            '<option value="">Pilih Sub Kegiatan</option>');
                        // $.each(response, function(id, nama) {
                        //     $('select[id="ref_bidang_urusan_id"]').append(
                        //         '<option value="' + id + '">' + nama + '</option>');
                        // })


                        // Iterasi respons dan tambahkan opsi ke dalam Tom Select
                        $.each(response, function(id, nama) {
                            tomSelect1.addOption({
                                value: id,
                                text: nama
                            });
                        });

                        // program()
                        // kegiatan()
                    }
                })
            });
        });

        $(function() {
            $('#ref_bidang_urusan_id').on('change', function() {
                ref_urusan = $("#ref_urusan_id").val()
                ref_bidang_urusan = $("#ref_bidang_urusan_id").val()


                $.ajax({
                    url: window.location.origin + "/master/nomen/program_filter",
                    method: "POST",
                    data: {
                        ref_urusan: ref_urusan,
                        ref_bidang_urusan: ref_bidang_urusan
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {

                        $('#ref_program_id').empty();
                        $('#ref_kegiatan_id').empty();
                        $('#ref_sub_kegiatan_id').empty();
                        $('select[id="ref_program_id"]').append(
                            '<option value="">Pilih Program</option>');
                        $('select[id="ref_kegiatan_id"]').append(
                            '<option value="">Pilih Kegiatan</option>');
                        $('select[id="ref_sub_kegiatan_id"]').append(
                            '<option value="">Pilih Sub Kegiatan</option>');
                        // $.each(response, function(id, nama) {
                        //     $('select[id="ref_program_id"]').append('<option value="' + id +
                        //         '">' + nama + '</option>');
                        // })
                        // kegiatan()



                        // Iterasi respons dan tambahkan opsi ke dalam Tom Select
                        $.each(response, function(id, nama) {
                            tomSelect2.addOption({
                                value: id,
                                text: nama
                            });
                        });

                    }
                })
            });
        });

        $(function() {
            $('#ref_program_id').on('change', function() {
                ref_urusan = $("#ref_urusan_id").val()
                ref_bidang_urusan = $("#ref_bidang_urusan_id").val()
                ref_program = $("#ref_program_id").val()


                $.ajax({
                    url: window.location.origin + "/master/nomen/kegiatan_filter",
                    method: "POST",
                    data: {
                        ref_urusan: ref_urusan,
                        ref_bidang_urusan: ref_bidang_urusan,
                        ref_program: ref_program
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {

                        $('#ref_kegiatan_id').empty();
                        $('#ref_sub_kegiatan_id').empty();
                        $('select[id="ref_kegiatan_id"]').append(
                            '<option value="">Pilih Kegiatan</option>');
                        $('select[id="ref_sub_kegiatan_id"]').append(
                            '<option value="">Pilih Sub Kegiatan</option>');
                        // $.each(response, function(id, nama) {
                        //     $('select[id="ref_kegiatan_id"]').append('<option value="' +
                        //         id + '">' + nama + '</option>');
                        // })
                        // kegiatan()



                        // Iterasi respons dan tambahkan opsi ke dalam Tom Select
                        $.each(response, function(id, nama) {
                            tomSelect3.addOption({
                                value: id,
                                text: nama
                            });
                        });

                    }
                })
            });
        });

        $(function() {
            $('#ref_kegiatan_id').on('change', function() {
                ref_urusan = $("#ref_urusan_id").val()
                ref_bidang_urusan = $("#ref_bidang_urusan_id").val()
                ref_program = $("#ref_program_id").val()
                ref_kegiatan = $("#ref_kegiatan_id").val()


                $.ajax({
                    url: window.location.origin + "/master/nomen/sub_filter",
                    method: "POST",
                    data: {
                        ref_urusan: ref_urusan,
                        ref_bidang_urusan: ref_bidang_urusan,
                        ref_program: ref_program,
                        ref_kegiatan: ref_kegiatan
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {

                        $('#ref_sub_kegiatan_id').empty();
                        $('select[id="ref_sub_kegiatan_id"]').append(
                            '<option value="">Pilih Sub Kegiatan</option>');
                        // $.each(response, function(id, nama) {
                        //     $('select[id="ref_sub_kegiatan_id"]').append('<option value="' +
                        //         id + '">' + nama + '</option>');
                        // })



                        // Iterasi respons dan tambahkan opsi ke dalam Tom Select
                        $.each(response, function(id, nama) {
                            tomSelect4.addOption({
                                value: id,
                                text: nama
                            });
                        });

                        // kegiatan()
                    }
                })
            });
        });

        var i = 1;

        $(document).on('click', '.btn_remove_lampiran', function() {
            var button_id = $(this).attr("id");
            $('#row' + button_id + '').remove();
        });


        $('#add_lampiran').click(function() {
            i++;
            $('#dynamic_field_lampiran').append('<tr id="row' + i +
                '" class="dynamic-added"><td><input type="file" name="file[]" class="form-control file_list" required></td>  <td><input type="text"  name="ket" class="form-control"placeholder="Nama File" required></td><td><button type="button" name="remove" id="' +
                i + '" class="btn btn-danger btn_remove_lampiran">x</button></td></tr>');
        });

        function tambah_foto(id) {

            $.ajax({
                url: "{{ url('') }}/admin/monev/showfile",
                method: "POST",
                data: {
                    id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    $("#modal-tambah-foto").modal('show')
                    $('#ins').html(response)
                }
            })
        }

        $('#modal-tambah-foto').on('hidden.bs.modal', function() {
            location.reload()
        });
    </script>
    {{-- <script src="{{ asset('js/master/skpd/main.js') }}"></script> --}}
@endsection
