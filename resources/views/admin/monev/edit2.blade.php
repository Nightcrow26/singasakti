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
                <div class="modal-content">
                    <div class="modal-header alert alert-primary">
                        <h5 class="modal-title mb-2">Edit</h5>
                    </div>
                    <div class="modal-body">
                        <form method="post" id="form-tambah" action="{{ url('/mr_update') }}"
                            enctype="multipart/form-data">
                            @csrf
                            {{-- @method('PATCH') --}}
                            <div class="row">
                                <input type="hidden" id="id" name="id" value="{{ $data->id }}">
                                <div class="col-6 mt-2">
                                    <label for="paket">Nama Paket <small class="text-danger">*</small></label>
                                    <input type="text" value="{{ $data->paket }}" class="form-control" name="paket"
                                        id="paket" required>
                                </div>
                                <div class="col-6 mt-2">
                                    <label for="pagu">pagu <small class="text-danger">*</small></label>
                                    <input type="text" value="{{ number_format($data->pagu, 0, ',', '') }}"
                                        onkeypress="return hanyaAngka()" class="form-control angka" name="pagu" required>
                                </div>
                                <div class="col-6 mt-2">
                                    <label for="pagu_kontrak">pagu kontrak <small class="text-danger">*</small></label>
                                    <input type="text" onkeypress="return hanyaAngka()" class="form-control angka"
                                        value="{{ number_format($data->pagu_kontrak, 0, ',', '') }}" name="pagu_kontrak"
                                        id="pagu_kontrak" required>
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
                                    <input type="date" class="form-control" value="{{ $data->tgl_kontrak }}"
                                        name="tgl_kontrak" id="tgl_kontrak" required>
                                </div>
                                <div class="col-6 mt-2">
                                    <label for="pelaksana">Nama Pelaksana <small class="text-danger">*</small></label>
                                    <input type="text" class="form-control" value="{{ $data->pelaksana }}"
                                        name="pelaksana" id="pelaksana" required>
                                </div>

                                <div class="col-md-12 mt-3">
                                    <a href="#" class="btn btn-primary btn-sm" onclick="getCurrentLocation()">Pakai
                                        Lokasi Saat
                                        Ini</a>
                                    <div id="loadingIndicator" style="display: none;">Loading...</div>
                                    <div id="map"></div>
                                </div>

                                <div class="col-md-6 mt-2">
                                    <label style="color: white" for="latitude">latitude <small
                                            class="text-danger">*</small></label>
                                    <input type="text" id="Latitude" name="latitude" value="{{ $data->latitude }}"
                                        class="form-control" required>
                                </div>

                                <div class="col-md-6 mt-2">
                                    <label style="color: white" for="longitude">longitude <small
                                            class="text-danger">*</small></label>
                                    <input type="text" id="Longitude" value="{{ $data->longitude }}"
                                        name="longitude" class="form-control" required>
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
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
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


        var desa_latitude = {{ $data->latitude }}
        var desa_longitude = {{ $data->longitude }}
        var curLocation = [0, 0];
        if (curLocation[0] == 0 && curLocation[1] == 0) {
            curLocation = [desa_latitude, desa_longitude];
        }
        const providerOSM = new GeoSearch.OpenStreetMapProvider();


        //leaflet map
        var leafletMap = L.map('map', {
            zoomSnap: 0
        }).setView([desa_latitude, desa_longitude], 13);

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

        leafletMap.on('click', function(e) {
            var position = marker.getLatLng();
            $("#Latitude").val(position.lat);
            $("#Longitude").val(position.lng);

            let latitude = e.latlng.lat.toString().substring(0, 15);
            let longitude = e.latlng.lng.toString().substring(0, 15);
            // document.getElementById("latitude").value = latitude;
            // document.getElementById("longitude").value = longitude;
            // let popup = L.popup()
            //     .setLatLng([latitude, longitude])
            //     .setContent("Kordinat : " + latitude + " - " + longitude)
            //     .openOn(leafletMap);

            if (marker != undefined) {
                leafletMap.removeLayer(marker);
            };
            marker = L.marker([latitude, longitude], {
                draggable: 'true'
            }).addTo(leafletMap);

            marker.on('dragend', function(event) {
                var position = marker.getLatLng();
                $("#Latitude").val(position.lat);
                $("#Longitude").val(position.lng).keyup();


            });
        });

        const search = new GeoSearch.GeoSearchControl({
            provider: providerOSM,
            style: 'bar',
            searchLabel: 'Cari',
        });

        leafletMap.addControl(search);

        $('#modal-tambah').on('shown.bs.modal', function() {
            leafletMap.invalidateSize();
        });

        var latitudeInput = document.getElementById('Latitude');
        var longitudeInput = document.getElementById('Longitude');

        latitudeInput.addEventListener('input', updateMarker);
        longitudeInput.addEventListener('input', updateMarker);

        var marker;

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



        axios.get(
                'https://geoportal.hulusungaiselatankab.go.id/geoserver/ADMIN/ows?service=WFS&version=1.0.0&request=GetFeature&typeName=ADMIN:6306hss_batas_kecamatan_ar_630620220624102942&maxFeatures=50&outputFormat=application%2Fjson'
            )
            .then(response => {
                const geojsonFeature = response.data;

                // Menampilkan poligon pada peta
                L.geoJSON(geojsonFeature).addTo(leafletMap);
            })
            .catch(error => {
                console.error('Error fetching GeoJSON:', error);
            });

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
    </script>
@endsection
