@extends('layouts.app')

@section('custom_css')
    <link href='https://fonts.googleapis.com/css?family=Battambang' rel='stylesheet'>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"/>
    <link rel="stylesheet" href="https://unpkg.com/leaflet-geosearch/dist/geosearch.css"/>
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
        /* Pastikan peta punya tinggi */
        #leafletMap-registration {
            width: 100%;
            height: 300px;
            margin-top: .5rem;
        }
    </style>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Ganti Password & Profil</h4>
        </div>
        <div class="card-body">
            <form method="post" id="form-edit" action="{{ route('user.update') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ auth()->user()->id }}">

                <div class="form-floating mb-3">
                    <input type="text" class="form-control" name="username"
                        placeholder="Username" value="{{ auth()->user()->username }}">
                    <label>Username</label>
                </div>
                <div class="form-floating mb-4">
                    <input type="password" class="form-control" name="password"
                        placeholder="Password">
                    <label>Password</label>
                </div>

                @if(auth()->user()->role === 'penyedia')
                    <div class="alert alert-primary">Lokasi Proyek</div>
                    <div class="row gx-3">
                        {{-- Alamat Manual --}}
                        <div class="col-12 mb-3">
                            <label for="address">Alamat <small class="text-danger">*</small></label>
                            <textarea id="address" name="address" class="form-control"
                                placeholder="Masukkan alamat lengkap">{{ old('address', auth()->user()->address) }}</textarea>
                        </div>

                        {{-- Tombol Geolocation & Peta --}}
                        <div class="col-12">
                            <button type="button" class="btn btn-primary btn-sm" onclick="getCurrentLocation()">
                                Pakai Lokasi Saat Ini
                            </button>
                            <span id="loadingIndicator" style="display:none; margin-left:.5rem;">Loading...</span>
                            <div id="leafletMap-registration"></div>
                        </div>

                        {{-- Koordinat --}}
                        <div class="col-md-6 mb-3">
                            <label for="Latitude">Latitude <small class="text-danger">*</small></label>
                            <input type="text" id="Latitude" name="latitude" class="form-control" required
                                value="{{ old('latitude', auth()->user()->latitude) }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="Longitude">Longitude <small class="text-danger">*</small></label>
                            <input type="text" id="Longitude" name="longitude" class="form-control" required
                                value="{{ old('longitude', auth()->user()->longitude) }}">
                        </div>
                    </div>
                @endif

                <div class="modal-footer bg-whitesmoke br">
                    <button type="submit" id="tombol" class="btn btn-primary">Simpan</button>
                    <button type="button" id="loading" class="btn btn-warning" style="display:none;" disabled>
                        LOADING...
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('custom_js')
    {{-- Leaflet & GeoSearch --}}
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-geosearch/dist/bundle.min.js"></script>

    <script>
    // Variabel global supaya bisa diakses di getCurrentLocation dan AJAX
    let map, marker;
    const desaLat = -2.587393559456695;
    const desaLng = 115.37534573108255;

    document.addEventListener('DOMContentLoaded', () => {
        // Elemen input & loading
        const latInput = document.getElementById('Latitude');
        const lngInput = document.getElementById('Longitude');
        const loadingIndicator = document.getElementById('loadingIndicator');

        // Inisialisasi koordinat awal
        const initLat = parseFloat(latInput.value) || desaLat;
        const initLng = parseFloat(lngInput.value) || desaLng;

        // Inisialisasi map
        map = L.map('leafletMap-registration', { zoomSnap: 0 })
            .setView([initLat, initLng], 12);
        L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);
        map.attributionControl.setPrefix(false);

        // Marker draggable
        marker = L.marker([initLat, initLng], { draggable: true }).addTo(map);
        marker.on('dragend', e => {
            const pos = e.target.getLatLng();
            latInput.value = pos.lat.toFixed(6);
            lngInput.value = pos.lng.toFixed(6);
        });

        // Klik di peta
        map.on('click', e => {
            marker.setLatLng(e.latlng);
            latInput.value = e.latlng.lat.toFixed(6);
            lngInput.value = e.latlng.lng.toFixed(6);
        });

        // GeoSearch Control
        const provider = new GeoSearch.OpenStreetMapProvider();
        const searchControl = new GeoSearch.GeoSearchControl({
            provider,
            style: 'bar',
            searchLabel: 'Cari alamat...',
            updateMap: true,
            retainZoomLevel: false
        });
        map.addControl(searchControl);

        // Ketika hasil pencarian dipilih
        map.on('geosearch/showlocation', e => {
            const { x: lng, y: lat } = e.location;
            latInput.value = lat.toFixed(6);
            lngInput.value = lng.toFixed(6);
            marker.setLatLng([lat, lng]);
            map.setView([lat, lng], map.getZoom());
        });
    });

    // Fungsi geolocation (Pakai Lokasi Saat Ini)
    function getCurrentLocation() {
        const loadingIndicator = document.getElementById('loadingIndicator');
        const latInput = document.getElementById('Latitude');
        const lngInput = document.getElementById('Longitude');

        if (!navigator.geolocation) {
            return alert('Browser Anda tidak mendukung geolocation.');
        }
        loadingIndicator.style.display = 'inline';

        navigator.geolocation.getCurrentPosition(pos => {
            const lat = pos.coords.latitude;
            const lng = pos.coords.longitude;

            latInput.value = lat.toFixed(6);
            lngInput.value = lng.toFixed(6);

            marker.setLatLng([lat, lng]);
            map.setView([lat, lng], 12);

            loadingIndicator.style.display = 'none';
        }, () => {
            alert('Tidak dapat mengambil lokasi Anda.');
            loadingIndicator.style.display = 'none';
        }, { enableHighAccuracy: true });
    }

    // Fungsi hanyaAngka untuk input tertentu
    function hanyaAngka(evt) {
        const charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        }
        return true;
    }

    // AJAX Submit untuk #form-edit
    $('#form-edit').on('submit', function(e) {
        e.preventDefault();
        $(this).ajaxSubmit({
            beforeSend() {
                $('#tombol').hide();
                $('#loading').show();
            },
            success(res) {
                if (res.status === 'failed') {
                    swal('Gagal', res.message || 'Terjadi kesalahan', 'error');
                } else {
                    swal('Sukses', 'Data berhasil disimpan', 'success')
                        .then(() => location.reload());
                }
            },
            complete() {
                $('#tombol').show();
                $('#loading').hide();
            }
        });
        return false;
    });
    </script>
@endsection

