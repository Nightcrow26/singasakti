@extends('layouts.app')

@section('custom_head')
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
    <section class="section">
        <div class="section-header">
            <h1>Manajemen Resiko</h1>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <a href="{{ route('admin.monev.edit', [$data->id]) }}" class="btn btn-sm btn-primary my-3">
                            <i class="fa fa-pen"> Edit</i>
                        </a>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped header-fixed">
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
                            </table>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped header-fixed">
                                <thead style="background-color: #ad67ef;">
                                    <tr>
                                        <th colspan="12"
                                            style="color: white;text-align:center;padding-left:20px;padding-right:20px;border-spacing: 0px;white-space: nowrap;">
                                            REALISASI KEUANGAN</th>
                                    </tr>
                                    <tr>
                                        <th
                                            style="color: white;text-align:center;padding-left:20px;padding-right:20px;border-spacing: 0px;white-space: nowrap;">
                                            JAN</th>
                                        <th
                                            style="color: white;text-align:center;padding-left:20px;padding-right:20px;border-spacing: 0px;white-space: nowrap;">
                                            FEB</th>
                                        <th
                                            style="color: white;text-align:center;padding-left:20px;padding-right:20px;border-spacing: 0px;white-space: nowrap;">
                                            MAR</th>
                                        <th
                                            style="color: white;text-align:center;padding-left:20px;padding-right:20px;border-spacing: 0px;white-space: nowrap;">
                                            APR</th>
                                        <th
                                            style="color: white;text-align:center;padding-left:20px;padding-right:20px;border-spacing: 0px;white-space: nowrap;">
                                            MEI</th>
                                        <th
                                            style="color: white;text-align:center;padding-left:20px;padding-right:20px;border-spacing: 0px;white-space: nowrap;">
                                            JUN</th>
                                        <th
                                            style="color: white;text-align:center;padding-left:20px;padding-right:20px;border-spacing: 0px;white-space: nowrap;">
                                            JUL</th>
                                        <th
                                            style="color: white;text-align:center;padding-left:20px;padding-right:20px;border-spacing: 0px;white-space: nowrap;">
                                            AGU</th>
                                        <th
                                            style="color: white;text-align:center;padding-left:20px;padding-right:20px;border-spacing: 0px;white-space: nowrap;">
                                            SEP</th>
                                        <th
                                            style="color: white;text-align:center;padding-left:20px;padding-right:20px;border-spacing: 0px;white-space: nowrap;">
                                            OKT</th>
                                        <th
                                            style="color: white;text-align:center;padding-left:20px;padding-right:20px;border-spacing: 0px;white-space: nowrap;">
                                            NOV</th>
                                        <th
                                            style="color: white;text-align:center;padding-left:20px;padding-right:20px;border-spacing: 0px;white-space: nowrap;">
                                            DES</th>
                                    </tr>

                                </thead>
                                <tbody>
                                    <tr>
                                        @foreach ($data->realisasis as $realisasi)
                                            <td>
                                                Rp.{{ number_format($realisasi->realisasi_januari, 0, ',', '.') }}
                                            </td>

                                            <td>
                                                Rp.{{ number_format($realisasi->realisasi_februari, 0, ',', '.') }}
                                            </td>

                                            <td>
                                                Rp.{{ number_format($realisasi->realisasi_maret, 0, ',', '.') }}
                                            </td>

                                            <td>
                                                Rp.{{ number_format($realisasi->realisasi_april, 0, ',', '.') }}
                                            </td>

                                            <td>
                                                Rp.{{ number_format($realisasi->realisasi_mei, 0, ',', '.') }}
                                            </td>

                                            <td>
                                                Rp.{{ number_format($realisasi->realisasi_juni, 0, ',', '.') }}
                                            </td>

                                            <td>
                                                Rp.{{ number_format($realisasi->realisasi_juli, 0, ',', '.') }}
                                            </td>

                                            <td>
                                                Rp.{{ number_format($realisasi->realisasi_agustus, 0, ',', '.') }}
                                            </td>

                                            <td>
                                                Rp.{{ number_format($realisasi->realisasi_september, 0, ',', '.') }}
                                            </td>

                                            <td>
                                                Rp.{{ number_format($realisasi->realisasi_oktober, 0, ',', '.') }}
                                            </td>

                                            <td>
                                                Rp.{{ number_format($realisasi->realisasi_november, 0, ',', '.') }}
                                            </td>

                                            <td>
                                                Rp.{{ number_format($realisasi->realisasi_desember, 0, ',', '.') }}
                                            </td>
                                        @endforeach
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped header-fixed">
                                <thead style="background-color: #ad67ef;">
                                    <tr>
                                        <th colspan="12"
                                            style="color: white;text-align:center;padding-left:20px;padding-right:20px;border-spacing: 0px;white-space: nowrap;">
                                            REALISASI FISIK</th>
                                    </tr>
                                    <tr>
                                        <th
                                            style="color: white;text-align:center;padding-left:20px;padding-right:20px;border-spacing: 0px;white-space: nowrap;">
                                            JAN</th>
                                        <th
                                            style="color: white;text-align:center;padding-left:20px;padding-right:20px;border-spacing: 0px;white-space: nowrap;">
                                            FEB</th>
                                        <th
                                            style="color: white;text-align:center;padding-left:20px;padding-right:20px;border-spacing: 0px;white-space: nowrap;">
                                            MAR</th>
                                        <th
                                            style="color: white;text-align:center;padding-left:20px;padding-right:20px;border-spacing: 0px;white-space: nowrap;">
                                            APR</th>
                                        <th
                                            style="color: white;text-align:center;padding-left:20px;padding-right:20px;border-spacing: 0px;white-space: nowrap;">
                                            MEI</th>
                                        <th
                                            style="color: white;text-align:center;padding-left:20px;padding-right:20px;border-spacing: 0px;white-space: nowrap;">
                                            JUN</th>
                                        <th
                                            style="color: white;text-align:center;padding-left:20px;padding-right:20px;border-spacing: 0px;white-space: nowrap;">
                                            JUL</th>
                                        <th
                                            style="color: white;text-align:center;padding-left:20px;padding-right:20px;border-spacing: 0px;white-space: nowrap;">
                                            AGU</th>
                                        <th
                                            style="color: white;text-align:center;padding-left:20px;padding-right:20px;border-spacing: 0px;white-space: nowrap;">
                                            SEP</th>
                                        <th
                                            style="color: white;text-align:center;padding-left:20px;padding-right:20px;border-spacing: 0px;white-space: nowrap;">
                                            OKT</th>
                                        <th
                                            style="color: white;text-align:center;padding-left:20px;padding-right:20px;border-spacing: 0px;white-space: nowrap;">
                                            NOV</th>
                                        <th
                                            style="color: white;text-align:center;padding-left:20px;padding-right:20px;border-spacing: 0px;white-space: nowrap;">
                                            DES</th>
                                    </tr>

                                </thead>
                                <tbody>
                                    <tr>
                                        @foreach ($data->realisasis as $realisasi)
                                            <td>
                                                {{ number_format($realisasi->realisasi_fisik_januari, 2, ',', '.') }}
                                            </td>

                                            <td>
                                                {{ number_format($realisasi->realisasi_fisik_februari, 2, ',', '.') }}
                                            </td>

                                            <td>
                                                {{ number_format($realisasi->realisasi_fisik_maret, 2, ',', '.') }}
                                            </td>

                                            <td>
                                                {{ number_format($realisasi->realisasi_fisik_april, 2, ',', '.') }}
                                            </td>

                                            <td>
                                                {{ number_format($realisasi->realisasi_fisik_mei, 2, ',', '.') }}
                                            </td>

                                            <td>
                                                {{ number_format($realisasi->realisasi_fisik_juni, 2, ',', '.') }}
                                            </td>

                                            <td>
                                                {{ number_format($realisasi->realisasi_fisik_juli, 2, ',', '.') }}
                                            </td>

                                            <td>
                                                {{ number_format($realisasi->realisasi_fisik_agustus, 2, ',', '.') }}
                                            </td>

                                            <td>
                                                {{ number_format($realisasi->realisasi_fisik_september, 2, ',', '.') }}
                                            </td>

                                            <td>
                                                {{ number_format($realisasi->realisasi_fisik_oktober, 2, ',', '.') }}
                                            </td>

                                            <td>
                                                {{ number_format($realisasi->realisasi_fisik_november, 2, ',', '.') }}
                                            </td>

                                            <td>
                                                {{ number_format($realisasi->realisasi_fisik_desember, 2, ',', '.') }}
                                            </td>
                                        @endforeach
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        {!! $chart->container() !!}
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div id="map"></div>
                    </div>
                </div>
            </div>
        </div>


    </section>
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
    <script src="{{ $chart->cdn() }}"></script>
    <script src="https://unpkg.com/leaflet-geosearch@3.1.0/dist/geosearch.umd.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    {{ $chart->script() }}
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

        axios.get(
                'https://geoportal.hulusungaiselatankab.go.id/geoserver/ADMIN/ows?service=WFS&version=1.0.0&request=GetFeature&typeName=ADMIN:6306hss_batas_kecamatan_ar_630620220624102942&maxFeatures=50&outputFormat=application%2Fjson'
            )
            .then(response => {
                const geojsonFeature = response.data;

                // Menampilkan poligon pada peta
                L.geoJSON(geojsonFeature).addTo(leafletMapEdit);
            })
            .catch(error => {
                console.error('Error fetching GeoJSON:', error);
            });




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
    </script>
@endsection
