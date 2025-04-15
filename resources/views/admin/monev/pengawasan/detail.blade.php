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

    <style>
        #map {
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
                        Detail
                        <a href="{{ route('admin.monev.edit', [$data->id]) }}" style="float: right"
                            class="btn btn-sm btn-primary">
                            <i class="fa fa-pen"> Edit</i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped header-fixed">
                                <thead style="background-color: #696cff;;">
                                    <tr>
                                        <th colspan="12"
                                            style="color: white;text-align:center;padding-left:20px;padding-right:20px;border-spacing: 0px;white-space: nowrap;">
                                            Perencanaan</th>
                                    </tr>
                                </thead>
                                {{-- <tr>
                                    <td>Skpd</td>
                                    <td>:</td>
                                    <td>
                                        {{ $data->skpd->nama }}
                                    </td>
                                </tr> --}}
                                <tr>
                                    <td>Urusan</td>
                                    <td>:</td>
                                    <td>
                                        {{ $data->urusan->nama }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Bidang</td>
                                    <td>:</td>
                                    <td>
                                        {{ $data->bidang->nama }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Program</td>
                                    <td>:</td>
                                    <td>
                                        {{ $data->prog->nama }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Kegiatan</td>
                                    <td>:</td>
                                    <td>
                                        {{ $data->keg->nama }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Sub Kegiatan</td>
                                    <td>:</td>
                                    <td>
                                        {{ $data->sub->nama }}
                                    </td>
                                </tr>
                                <thead style="background-color: #696cff;;">
                                    <tr>
                                        <th colspan="12"
                                            style="color: white;text-align:center;padding-left:20px;padding-right:20px;border-spacing: 0px;white-space: nowrap;">
                                            Pelaksana</th>
                                    </tr>
                                </thead>
                                <tr>
                                    <td>Nama Perusahaan</td>
                                    <td>:</td>
                                    <td>
                                        {{ $data->nama_perusahaan }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Nama Direktur</td>
                                    <td>:</td>
                                    <td>
                                        {{ $data->nama_direktur }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Alamat Perusahaan</td>
                                    <td>:</td>
                                    <td>
                                        {{ $data->alamat_perusahaan }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>No Telpon</td>
                                    <td>:</td>
                                    <td>
                                        {{ $data->telpon }}
                                    </td>
                                </tr>
                                <thead style="background-color: #696cff;;">
                                    <tr>
                                        <th colspan="12"
                                            style="color: white;text-align:center;padding-left:20px;padding-right:20px;border-spacing: 0px;white-space: nowrap;">
                                            Proyek</th>
                                    </tr>
                                </thead>
                                <tr>
                                    <td>Nama Paket</td>
                                    <td>:</td>
                                    <td>
                                        {{ $data->paket }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Sumber Dana</td>
                                    <td>:</td>
                                    <td>
                                        {{ $data->sumber_dana }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Pagu</td>
                                    <td>:</td>
                                    <td>
                                        Rp. {{ number_format($data->pagu, 0, ',', '.') }}
                                    </td>
                                </tr>

                                <tr>
                                    <td>Pagu Kontrak</td>
                                    <td>:</td>
                                    <td>
                                        Rp. {{ number_format($data->pagu_kontrak, 0, ',', '.') }}
                                    </td>
                                </tr>

                                <tr>
                                    <td>Tanggal Kontrak</td>
                                    <td>:</td>
                                    <td>
                                        {{ date('d-m-Y', strtotime($data->tgl_kontrak)) }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Waktu Pelaksanaan</td>
                                    <td>:</td>
                                    <td>
                                        @php
                                            $tgl_mulai = strtotime($data->tgl_mulai);
                                            $tgl_akhir = strtotime($data->tgl_akhir);

                                            $selisih = abs($tgl_akhir - $tgl_mulai); // Menghitung selisih dalam detik
                                            $jumlah_hari = floor($selisih / (60 * 60 * 24));
                                        @endphp
                                        {{ date('d-m-Y', strtotime($data->tgl_mulai)) }} -
                                        {{ date('d-m-Y', strtotime($data->tgl_akhir)) }} ({{ $jumlah_hari }} Hari)
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered  header-fixed">
                                <thead style="background-color: #696cff;;">
                                    <th style="color: white;text-align:center"> Aksi</th>
                                    <th style="color: white;text-align:center"> No</th>
                                    <th
                                        style="color: white;text-align:center;padding-left:50px;padding-right:50px;border-spacing: 0px;white-space: nowrap;">
                                        Tanggal Realiasasi</th>
                                    <th
                                        style="color: white;text-align:center;padding-left:50px;padding-right:50px;border-spacing: 0px;white-space: nowrap;">
                                        Realiasasi Keuangan</th>
                                    <th
                                        style="color: white;text-align:center;padding-left:50px;padding-right:50px;border-spacing: 0px;white-space: nowrap;">
                                        Realiasasi Fisik (%)</th>
                                </thead>
                                <tbody>
                                    @foreach ($data->realisasis as $realisasi)
                                        <tr>
                                            <td>
                                                <a href="{{ route('admin.monev.detailfoto', [$realisasi->id]) }}"
                                                    class="btn btn-sm btn-primary">
                                                    <i class='bx bxs-low-vision'></i>
                                                </a>
                                            </td>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ date('d-m-Y', strtotime($realisasi->tgl_realisasi)) }}</td>
                                            <td>Rp. {{ number_format($realisasi->realisasi, 0, ',', '.') }}</td>
                                            <td>{{ number_format($realisasi->realisasi_fisik, 2, ',', '.') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        {!! $chart->container() !!}
                    </div>
                </div>
            </div>
        </div> --}}

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div id="map"></div>
                    </div>
                </div>
            </div>
        </div>

        {{-- <div class="row mt-5  mb-5">
            <div class="card-header">
                <div class="alert alert-primary" role="alert">
                    Foto Proyek
                </div>
            </div>
            @foreach ($foto as $item)
                <div class="col-4">
                    <div class="card">
                        <div class="card-header">
                            <button onclick="hapus('{{ $item->id }}')" style="float: right"
                                class="btn btn-sm btn-danger">
                                <i class='bx bxs-trash'></i>
                            </button>
                        </div>

                        <div class="card-body">
                            <img class="card-img-top" src="{{ asset('/storage') }}/{{ $item->foto }}"
                                alt="Card image cap">
                        </div>
                    </div>
                </div>
            @endforeach
        </div> --}}

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
    {{-- <script src="{{ $chart->cdn() }}"></script> --}}
    <script src="https://unpkg.com/leaflet-geosearch@3.1.0/dist/geosearch.umd.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    {{-- {{ $chart->script() }} --}}
    <script>
        if (jQuery().select2) {
            $(".select2").select2({
                theme: 'bootstrap4'
            });
        }


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
        var leafletMapEdit = L.map('map', {
            zoomSnap: 0
        }).setView([desa_latitude_edit, desa_longitude_edit], 13);

        L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(leafletMapEdit);


        leafletMapEdit.attributionControl.setPrefix(false);

        var marker = new L.marker(curLocationEdit, {
            // draggable: 'false'
        });
        // });
        leafletMapEdit.addLayer(marker);

        let theMarker = {};

        // axios.get(
        //         'https://geoportal.hulusungaiselatankab.go.id/geoserver/ADMIN/ows?service=WFS&version=1.0.0&request=GetFeature&typeName=ADMIN:6306hss_batas_kecamatan_ar_630620220624102942&maxFeatures=50&outputFormat=application%2Fjson'
        //     )
        //     .then(response => {
        //         const geojsonFeature = response.data;

        //         // Menampilkan poligon pada peta
        //         L.geoJSON(geojsonFeature).addTo(leafletMapEdit);
        //     })
        //     .catch(error => {
        //         console.error('Error fetching GeoJSON:', error);
        //     });




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
                            url: "{{ url('') }}/admin/monev/deletefoto",
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
    </script>
@endsection
