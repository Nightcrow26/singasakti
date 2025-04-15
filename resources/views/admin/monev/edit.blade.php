@extends('layouts.app')

@section('custom_css')
    <link rel="stylesheet" href="{{ asset('stisla/node_modules/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('stisla/node_modules/weathericons/css/weather-icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('stisla/node_modules/weathericons/css/weather-icons-wind.min.css') }}">
    <link rel="stylesheet" href="{{ asset('stisla/node_modules/summernote/dist/summernote-bs4.css') }}">
    <link rel="stylesheet" href="{{ asset('stisla/node_modules/izitoast/dist/css/iziToast.min.css') }}">
    <link rel="stylesheet" href="{{ asset('stisla/node_modules/select2/dist/css/select2.min.css') }}">
    {{-- <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css"
        integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ=="
        crossorigin="" /> --}}
    <link rel="stylesheet" href="{{ asset('leaflet-search/src/leaflet-search.css') }}" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
        integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
        crossorigin="" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-geosearch@3.0.0/dist/geosearch.css" />
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <style>
        #map {
            height: 400px;
            /* The height is 400 pixels */
        }

        #leafletMap-registration {
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
        <div class="row">
            <div class="col-12">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
                    </div>
                    <div class="modal-body">
                        <form method="post" id="form-tambah" action="{{ route('admin.monev.update') }}"
                            enctype="multipart/form-data">
                            <input type="hidden" name="skpd_id" value="27">
                            @csrf
                            {{-- @method('PATCH') --}}
                            <div class="row">

                                <input type="hidden" id="id" name="id" value="{{ $data->id }}">
                                <div class="alert alert-primary" role="alert">
                                    Perencanaan
                                </div>

                                {{-- <div class="col-12">
                                    <label for="bidang">skpd <small class="text-danger">*</small></label>
                                    <select name="skpd_id" id="skpd_id" style="width:100%" required>
                                        <option value="{{ $skpd_select->id }}">{{ $skpd_select->nama }}</option>
                                        @foreach ($skpd as $skpd)
                                            <option value="{{ $skpd->id }}">{{ $skpd->nama }}</option>
                                        @endforeach

                                    </select>
                                </div> --}}

                                <div class="col-12">
                                    <label for="bidang">Urusan <small class="text-danger">*</small></label>
                                    <select name="ref_urusan_id" id="ref_urusan_id" style="width:100%" required>
                                        <option value="{{ $urusan_select->id }}">{{ $urusan_select->nama }}</option>
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
                                        <option value="{{ $bidang_select->id }}">{{ $bidang_select->nama }}</option>
                                    </select>
                                </div>

                                <div class="col-12 mt-3">
                                    <label for="ref_program_id">Program<small class="text-danger">*</small></label>
                                    <select name="ref_program_id" id="ref_program_id" style="width:100%" required>
                                        <option value="{{ $program_select->id }}">{{ $program_select->nama }}</option>
                                    </select>
                                </div>

                                <div class="col-12 mt-3">
                                    <label for="ref_kegiatan_id">Kegiatan<small class="text-danger">*</small></label>
                                    <select name="ref_kegiatan_id" id="ref_kegiatan_id" style="width:100%" required>
                                        <option value="{{ $kegiatan_select->id }}">{{ $kegiatan_select->nama }}</option>
                                    </select>
                                </div>

                                <div class="col-12 mt-3">
                                    <label for="ref_sub_kegiatan_id">Sub Kegiatan<small
                                            class="text-danger">*</small></label>
                                    <select name="ref_sub_kegiatan_id" id="ref_sub_kegiatan_id" style="width:100%" required>
                                        <option value="{{ $sub_select->id }}">{{ $sub_select->nama }}</option>
                                    </select>
                                </div>

                                <div class="alert alert-primary mt-3" role="alert">
                                    Pelaksana
                                </div>

                                <div class="col-6">
                                    <label for="nama_perusahaan">Nama Perusahaan <small
                                            class="text-danger">*</small></label>
                                    <input type="text" class="form-control" name="nama_perusahaan" id="nama_perusahaan"
                                        placeholder="Contoh: PT. ABC" value="{{ $data->nama_perusahaan }}" required>
                                </div>
                                <div class="col-6">
                                    <label for="nama_direktur">Nama Direktur <small class="text-danger">*</small></label>
                                    <input type="text" class="form-control" name="nama_direktur" id="nama_direktur"
                                        placeholder="Contoh: Muhammad" value="{{ $data->nama_direktur }}" required>
                                </div>
                                <div class="col-6">
                                    <label for="alamat_perusahaan">Alamat Perusahaan <small
                                            class="text-danger">*</small></label>
                                    <input type="text" class="form-control" name="alamat_perusahaan"
                                        placeholder="Contoh: Jl. Anggrek" value="{{ $data->alamat_perusahaan }}"
                                        required>
                                </div>

                                <div class="col-6">
                                    <label for="telpon">Nomer Telpon <small class="text-danger">*</small></label>
                                    <input type="text" class="form-control" name="telpon"
                                        placeholder="Contoh: 08434423789472" value="{{ $data->telpon }}" required>
                                </div>

                                <div class="alert alert-primary mt-3" role="alert">
                                    Perencana
                                </div>

                                <div class="col-6">
                                    <label for="nama_perusahaan_perencana">Nama Perusahaan <small
                                            class="text-danger">*</small></label>
                                    <input type="text" class="form-control" name="nama_perusahaan_perencana"
                                        id="nama_perusahaan_perencana" placeholder="Contoh: PT. ABC"
                                        value="{{ $data->nama_perusahaan_perencana }}" required>
                                </div>
                                <div class="col-6">
                                    <label for="nama_direktur_perencana">Nama Direktur <small
                                            class="text-danger">*</small></label>
                                    <input type="text" class="form-control" name="nama_direktur_perencana"
                                        id="nama_direktur_perencana" placeholder="Contoh: Muhammad"
                                        value="{{ $data->nama_direktur_perencana }}" required>
                                </div>
                                <div class="col-6">
                                    <label for="alamat_perusahaan_perencana">Alamat Perusahaan <small
                                            class="text-danger">*</small></label>
                                    <input type="text" class="form-control" name="alamat_perusahaan_perencana"
                                        placeholder="Contoh: Jl. Anggrek"
                                        value="{{ $data->alamat_perusahaan_perencana }}" required>
                                </div>

                                <div class="col-6">
                                    <label for="telpon_perencana">Nomer Telpon <small
                                            class="text-danger">*</small></label>
                                    <input type="text" class="form-control" name="telpon_perencana"
                                        placeholder="Contoh: 08434423789472" value="{{ $data->telpon_perencana }}"
                                        required>
                                </div>

                                <div class="alert alert-primary mt-3" role="alert">
                                    Pengawas
                                </div>

                                <div class="col-6">
                                    <label for="nama_perusahaan_pengawas">Nama Perusahaan <small
                                            class="text-danger">*</small></label>
                                    <input type="text" class="form-control" name="nama_perusahaan_pengawas"
                                        id="nama_perusahaan_pengawas" placeholder="Contoh: PT. ABC"
                                        value="{{ $data->nama_perusahaan_pengawas }}" required>
                                </div>
                                <div class="col-6">
                                    <label for="nama_direktur_pengawas">Nama Direktur <small
                                            class="text-danger">*</small></label>
                                    <input type="text" class="form-control" name="nama_direktur_pengawas"
                                        id="nama_direktur_pengawas" placeholder="Contoh: Muhammad"
                                        value="{{ $data->nama_direktur_pengawas }}" required>
                                </div>
                                <div class="col-6">
                                    <label for="alamat_perusahaan_pengawas">Alamat Perusahaan <small
                                            class="text-danger">*</small></label>
                                    <input type="text" class="form-control" name="alamat_perusahaan_pengawas"
                                        placeholder="Contoh: Jl. Anggrek" value="{{ $data->alamat_perusahaan_pengawas }}"
                                        required>
                                </div>

                                <div class="col-6">
                                    <label for="telpon_pengawas">Nomer Telpon <small class="text-danger">*</small></label>
                                    <input type="text" class="form-control" name="telpon_pengawas"
                                        placeholder="Contoh: 08434423789472" value="{{ $data->telpon_pengawas }}"
                                        required>
                                </div>


                                <div class="alert alert-primary mt-3" role="alert">
                                    Proyek
                                </div>

                                <div class="col-6">
                                    <label for="paket">Nama Paket <small class="text-danger">*</small></label>
                                    <input type="text" class="form-control" name="paket" id="paket"
                                        placeholder="Contoh: Jembatan" value="{{ $data->paket }}" required>
                                </div>
                                <div class="col-6">
                                    <label for="pagu">pagu <small class="text-danger">*</small></label>
                                    <input type="text" onkeypress="return hanyaAngka()" class="form-control angka"
                                        name="pagu" placeholder="Contoh: 100000" value="{{ $data->pagu }}"
                                        required>
                                </div>
                                <div class="col-6 mt-2">
                                    <label for="pagu_kontrak">pagu kontrak <small class="text-danger">*</small></label>
                                    <input type="text" onkeypress="return hanyaAngka()" class="form-control angka"
                                        name="pagu_kontrak" id="pagu_kontrak" placeholder="Contoh: 7000000"
                                        value="{{ $data->pagu_kontrak }}" required>
                                </div>
                                <div class="col-6 mt-2">
                                    <label for="sumber_dana">Sumber Dana <small class="text-danger">*</small></label>
                                    <select name="sumber_dana" class="form-control h5" style="width:100%;color: black"
                                        required>
                                        <option value="{{ $data->sumber_dana }}">{{ $data->sumber_dana }}</option>
                                        <option value="DAU">DAU</option>
                                        <option value="DAK FISIK">DAK FISIK</option>
                                        <option value="DAK NON FISIK">DAK NON FISIK</option>
                                        <option value="BLUD">BLUD</option>
                                    </select>
                                </div>
                                <div class="col-6 mt-2">
                                    <label for="tgl_kontrak">Tanggal Kontrak <small class="text-danger">*</small></label>
                                    <input type="date" class="form-control" name="tgl_kontrak" id="tgl_kontrak"
                                        value="{{ $data->tgl_kontrak }}" required>
                                </div>
                                <div class="col-6 mt-2">
                                    <label for="range">Waktu Pelaksanaan
                                        <small class="text-danger">*</small></label>
                                    <input type="text" class="form-control" id="range" name="daterange"
                                        data-parsley-validate="false" />
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
                                    <input type="text" id="Latitude" name="latitude" class="form-control"
                                        value="{{ $data->latitude }}" required>
                                </div>

                                <div class="col-md-6 mt-2">
                                    <label for="longitude">longitude <small class="text-danger">*</small></label>
                                    <input type="text" id="Longitude" name="longitude" class="form-control"
                                        value="{{ $data->longitude }}" required>
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
    </div>



    {{-- @include('admin.master.skpd.form') --}}
@endsection

@section('custom_js')
    <script src="{{ asset('plugins/jquery.form.min.js') }}"></script>
    <script src="{{ asset('stisla/node_modules/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('stisla/node_modules/sweetalert/dist/sweetalert.min.js') }}"></script>
    <script src="{{ asset('stisla/node_modules/izitoast/dist/js/iziToast.min.js') }}"></script>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
        integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
        crossorigin=""></script>
    <script src="https://unpkg.com/leaflet-geosearch@3.1.0/dist/geosearch.umd.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

    <script>
        if (jQuery().select2) {
            $(".select2").select2({
                theme: 'bootstrap4'
            });
        }
        $(document).ready(function() {
            // $('#range').daterangepicker({
            //     opens: 'left'
            // });
            var start_date = moment('{{ $data->tgl_mulai }}').format('DD-MM-YYYY');
            var end_date = moment('{{ $data->tgl_akhir }}').format('DD-MM-YYYY');

            $('#range').daterangepicker({
                opens: 'right',
                // minDate: new Date(),
                startDate: start_date,
                endDate: end_date,
                locale: {
                    format: 'DD-MM-YYYY'
                }
            }, function(start, end, label) {
                start_date = start.format('DD-MM-YYYY')
                end_date = end.format('DD-MM-YYYY')
                $('#id_start_date').val(start_date);
                $('#id_end_date').val(end_date);
            });
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


        var desa_latitude_edit = {{ $data->latitude }}
        var desa_longitude_edit = {{ $data->longitude }}
        console.log(parseFloat(desa_latitude_edit))
        var curLocationEdit = [0, 0];
        if (curLocationEdit[0] == 0 && curLocationEdit[1] == 0) {
            curLocationEdit = [desa_latitude_edit, desa_longitude_edit];
        }
        const providerOSM = new GeoSearch.OpenStreetMapProvider();


        //leaflet map
        var leafletMap = L.map('leafletMap-registration', {
            zoomSnap: 0
        }).setView([desa_latitude_edit, desa_longitude_edit], 13);

        L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(leafletMap);


        leafletMap.attributionControl.setPrefix(false);

        var marker = new L.marker(curLocationEdit, {
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
                            url: "{{ url('') }}/mr_delete",
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
    </script>
@endsection
