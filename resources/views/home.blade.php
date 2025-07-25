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

        #leafletMap-registration2 {
            height: 500px;
            /* The height is 400 pixels */
        }

        #chart {
            max-width: 250px;
            padding-left: 20px;
        }

        #chartdiv {
            width: 100%;
            height: 400px;
        }

        /* Style untuk filter penyedia */
        .map-filters {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 15px;
        }

        .filter-group {
            display: flex;
            gap: 15px;
            align-items: end;
            flex-wrap: wrap;
        }

        .filter-item {
            flex: 1;
            min-width: 200px;
        }

        .filter-buttons {
            display: flex;
            gap: 10px;
        }
    </style>
@endsection

@section('content')

    <div class="row">
        <div class="col-lg-12 mb-4 order-0">
            <div class="card">
                <div class="d-flex align-items-end row">
                    <div class="col-sm-8">
                        <div class="card-body">
                            <h5 class="card-title text-primary">Selamat Datang di Singasakti!</h5>
                            <p class="mb-4">
                                Singasakti Kab. HST adalah sebuah sistem informasi pengawasan jasa konstruksi yang berfungi
                                untuk monitoring kelengkapan dan progres paket pekerjaan yang di laksankan oleh SOPD
                            </p>
                        </div>
                    </div>
                    <div class="col-sm-4 text-center text-sm-left">
                        <div class="card-body pb-0 px-0 px-md-4">
                            <img src="{{ asset('') }}landing/assets/images/2.png" height="140"
                                alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                data-app-light-img="illustrations/man-with-laptop-light.png">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('skpd'))
    <div class="row mb-4" style="overflow-y: auto;max-height:600px">
        <div class="col-md-6 col-lg-6 col-xl-6 order-0">
            <div class="card h-100">
                <div class="card-header d-flex align-items-center justify-content-between pb-0">
                    <div class="card-title mb-0">
                        <h5 class="m-0 me-2">Statistik Pengawasan Rutin</h5>
                    </div>
                </div>
                <hr>
                <div class="card-body" style="overflow-y: auto;max-height:200px;min-height:200px">
                    <div class="d-flex justify-content-between align-items-center mb-3" style="position: relative;">
                        <div class="d-flex flex-column align-items-center gap-1">
                            <h2 class="mb-2">{{ $total_pekerjaan }} </h2>
                            <span>Total</span>
                        </div>
                        <div class="d-flex flex-column align-items-center gap-1">
                            <h2 class="mb-2 text-success">{{ $total_lengkap }} </h2>
                            <span class="text-success">Lengkap</span>
                        </div>

                        <div class="d-flex flex-column align-items-center gap-1">
                            <h2 class="mb-2 text-danger">{{ $total_tidak_lengkap }} </h2>
                            <span class="text-danger">Tidak</span>
                        </div>

                        <div id="chart">
                        </div>
                    </div>
                </div>
                <div class="card-body" style="overflow-y: auto;max-height:400px;min-height:400px">
                    <div class="table-responsive" style="overflow-y: auto;">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>SOPD</th>
                                    <th>Lengkap</th>
                                    <th>Tidak Lengkap</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($total_skpd as $result)
                                    <tr>
                                        <td>{{ $result->nama }}</td>
                                        <td>{{ $result->lengkap }}</td>
                                        <td>{{ $result->tidak_lengkap }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-6 col-xl-6 order-0">
            <div class="card h-100">
                <div class="card-header d-flex align-items-center justify-content-between pb-0">
                    <div class="card-title mb-0">
                        <h5 class="m-0 me-2">Statistik Realisasi</h5>
                    </div>
                </div>
                <hr>
                <div class="card-body" style="overflow-y: auto;max-height:400px;min-height:400px">
                    @php
                        $totalRealisasiFisik = 0;
                        $totalRealisasi = 0;
                    @endphp

                    @foreach ($realisasi as $a)
                        @foreach ($a->realisasis as $c)
                            @if ($loop->first)
                                @php
                                    $totalRealisasiFisik += $c->realisasi_fisik ?? 0;
                                    $totalRealisasi += $c->realisasi ?? 0;
                                    $row = $a->count();
                                    $persen = number_format($totalRealisasiFisik / $row_hitung, 0, ',', '.');
                                @endphp
                            @endif
                        @endforeach
                    @endforeach
                    <ul class="p-0 m-0">
                        <li class="d-flex pb-1">
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                    <h6> Realisasi Keuangan</h6>
                                </div>
                                <div class="user-progress">
                                    <h6 class="fw-semibold">
                                        Rp. {{ number_format($totalRealisasi, 0, ',', '.') ?? 0 }}</h6>
                                </div>
                            </div>
                        </li>
                        <li class="d-flex pb-1">
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                    <h6>Realisasi Fisik</h6>
                                </div>
                                <div class="user-progress">
                                    <h6 class="fw-semibold">
                                        @if (isset($persen))
                                            {{ $persen }} %
                                        @else
                                            0
                                        @endif
                                    </h6>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <div id="chartdiv"></div>
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- Data K01-K04 --}}
    @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('penyedia'))
    <div class="row mb-4" style="overflow-y: auto;max-height:600px">
        <div class="col-md-4 col-lg-4 col-xl-4 order-0">
            <div class="card h-100">
                <div class="card-header d-flex align-items-center justify-content-between pb-0">
                    <div class="card-title mb-0">
                        <h5 class="m-0 me-2">Pengawasan K01A</h5>
                    </div>
                </div>
                <hr>
                <div class="card-body" style="overflow-y: auto;max-height:200px;min-height:200px">
                    <div class="d-flex justify-content-between align-items-center mb-3" style="position: relative;">
                        <div class="d-flex flex-column align-items-center gap-1">
                            <h2 class="mb-2">{{ $total_k01a }} </h2>
                            <span>Total</span>
                        </div>
                        <div class="d-flex flex-column align-items-center gap-1">
                            <h2 class="mb-2 text-success">{{ $total_lengkap_k01a }} </h2>
                            <span class="text-success">Tertib</span>
                        </div>

                        <div class="d-flex flex-column align-items-center gap-1">
                            <h2 class="mb-2 text-danger">{{ $total_tidaklengkap_k01a }} </h2>
                            <span class="text-danger">Tidak Tertib</span>
                        </div>

                        <div id="chart">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-lg-4 col-xl-4 order-0">
            <div class="card h-100">
                <div class="card-header d-flex align-items-center justify-content-between pb-0">
                    <div class="card-title mb-0">
                        <h5 class="m-0 me-2">Pengawasan K01B</h5>
                    </div>
                </div>
                <hr>
                <div class="card-body" style="overflow-y: auto;max-height:200px;min-height:200px">
                    <div class="d-flex justify-content-between align-items-center mb-3" style="position: relative;">
                        <div class="d-flex flex-column align-items-center gap-1">
                            <h2 class="mb-2">{{ $total_k01b }} </h2>
                            <span>Total</span>
                        </div>
                        <div class="d-flex flex-column align-items-center gap-1">
                            <h2 class="mb-2 text-success">{{ $total_lengkap_k01b }} </h2>
                            <span class="text-success">Tertib</span>
                        </div>

                        <div class="d-flex flex-column align-items-center gap-1">
                            <h2 class="mb-2 text-danger">{{ $total_tidaklengkap_k01b }} </h2>
                            <span class="text-danger">Tidak Tertib</span>
                        </div>

                        <div id="chart">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-lg-4 col-xl-4 order-0">
            <div class="card h-100">
                <div class="card-header d-flex align-items-center justify-content-between pb-0">
                    <div class="card-title mb-0">
                        <h5 class="m-0 me-2">Pengawasan K02</h5>
                    </div>
                </div>
                <hr>
                <div class="card-body" style="overflow-y: auto;max-height:200px;min-height:200px">
                    <div class="d-flex justify-content-between align-items-center mb-3" style="position: relative;">
                        <div class="d-flex flex-column align-items-center gap-1">
                            <h2 class="mb-2">{{ $total_k02 }} </h2>
                            <span>Total</span>
                        </div>
                        <div class="d-flex flex-column align-items-center gap-1">
                            <h2 class="mb-2 text-success">{{ $total_lengkap_k02 }} </h2>
                            <span class="text-success">Tertib</span>
                        </div>

                        <div class="d-flex flex-column align-items-center gap-1">
                            <h2 class="mb-2 text-danger">{{ $total_tidaklengkap_k02 }} </h2>
                            <span class="text-danger">Tidak Tertib</span>
                        </div>
                        <div id="chart">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4" style="overflow-y: auto;max-height:600px">
        <div class="col-md-6 col-lg-6 col-xl-6 order-0">
            <div class="card h-100">
                <div class="card-header d-flex align-items-center justify-content-between pb-0">
                    <div class="card-title mb-0">
                        <h5 class="m-0 me-2">Pengawasan K03</h5>
                    </div>
                </div>
                <hr>
                <div class="card-body" style="overflow-y: auto;max-height:200px;min-height:200px">
                    <div class="d-flex justify-content-between align-items-center mb-3" style="position: relative;">
                        <div class="d-flex flex-column align-items-center gap-1">
                            <h2 class="mb-2">{{ $total_k03 }} </h2>
                            <span>Total</span>
                        </div>
                        <div class="d-flex flex-column align-items-center gap-1">
                            <h2 class="mb-2 text-success">{{ $total_lengkap_k03 }} </h2>
                            <span class="text-success">Tertib</span>
                        </div>

                        <div class="d-flex flex-column align-items-center gap-1">
                            <h2 class="mb-2 text-danger">{{ $total_tidaklengkap_k03 }} </h2>
                            <span class="text-danger">Tidak Tertib</span>
                        </div>

                        <div id="chart">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-6 col-xl-6 order-0">
            <div class="card h-100">
                <div class="card-header d-flex align-items-center justify-content-between pb-0">
                    <div class="card-title mb-0">
                        <h5 class="m-0 me-2">Pengawasan K04</h5>
                    </div>
                </div>
                <hr>
                <div class="card-body" style="overflow-y: auto;max-height:200px;min-height:200px">
                    <div class="d-flex justify-content-between align-items-center mb-3" style="position: relative;">
                        <div class="d-flex flex-column align-items-center gap-1">
                            <h2 class="mb-2">{{ $total_k04 }} </h2>
                            <span>Total</span>
                        </div>
                        <div class="d-flex flex-column align-items-center gap-1">
                            <h2 class="mb-2 text-success">{{ $total_lengkap_k04 }} </h2>
                            <span class="text-success">Tertib</span>
                        </div>

                        <div class="d-flex flex-column align-items-center gap-1">
                            <h2 class="mb-2 text-danger">{{ $total_tidaklengkap_k04 }} </h2>
                            <span class="text-danger">Tidak Tertib</span>
                        </div>

                        <div id="chart">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- Peta untuk semua role yang memiliki akses --}}
    @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('skpd') || auth()->user()->hasRole('penyedia'))
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-12">
                    <div class="alert alert-primary" role="alert">
                        Peta Sebaran Proyek
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            {{-- Filter untuk berbagai role --}}
            <div class="map-filters">
                <div class="filter-group">
                    @if (auth()->user()->hasRole('admin'))
                        <div class="filter-item">
                            <label for="skpdFilter">Filter SOPD:</label>
                            <select id="skpdFilter" class="form-control select2">
                                <option value="">Semua SOPD</option>
                                @foreach ($skpd2 as $skpd2)
                                    <option value="{{ $skpd2->id }}">{{ $skpd2->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="filter-item">
                            <label for="penyediaFilter">Filter Penyedia:</label>
                            <select id="penyediaFilter" class="form-control select2">
                                <option value="">Semua Penyedia</option>
                                {{-- Data penyedia akan dimuat via AJAX --}}
                            </select>
                        </div>
                    @endif

                    @if (auth()->user()->hasRole('skpd'))
                        <div class="filter-item">
                            <label for="penyediaFilter">Filter Penyedia:</label>
                            <select id="penyediaFilter" class="form-control select2">
                                <option value="">Semua Penyedia</option>
                                {{-- Data penyedia akan dimuat via AJAX --}}
                            </select>
                        </div>
                    @endif

                    @if (auth()->user()->hasRole('penyedia'))
                        <div class="filter-item">
                            <label>Status Proyek:</label>
                            <select id="statusFilter" class="form-control">
                                <option value="">Semua Status</option>
                                <option value="ongoing">Sedang Berjalan</option>
                                <option value="completed">Selesai</option>
                                <option value="delayed">Terlambat</option>
                            </select>
                        </div>
                    @endif

                    <div class="filter-buttons">
                        <button type="button" class="btn btn-primary btn-sm" onclick="applyFilters()">
                            <i class="bx bx-filter"></i> Terapkan Filter
                        </button>
                        <button type="button" class="btn btn-secondary btn-sm" onclick="resetFilters()">
                            <i class="bx bx-refresh"></i> Reset
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-md-12 mb-3">
                <div id="leafletMap-registration2"></div>
            </div>
        </div>
    </div>
    @endif

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
    <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/radar.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
    <script>
        $(document).ready(function() {
            $('#table').DataTable();
            $('#range').daterangepicker();
            
            // Load data penyedia untuk filter
            loadPenyediaOptions();
        });

        function hanyaAngka(evt) {
            var charCode = (evt.which) ? evt.which : event.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;
            return true;
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

        var desa_latitude = `-2.587393559456695`
        var desa_longitude = `115.37534573108255`
        var curLocation = [0, 0];
        if (curLocation[0] == 0 && curLocation[1] == 0) {
            curLocation = [desa_latitude, desa_longitude];
        }
        const providerOSM = new GeoSearch.OpenStreetMapProvider();

        //leaflet map
        var leafletMap2 = L.map('leafletMap-registration2', {
            zoomSnap: 0
        }).setView([desa_latitude, desa_longitude], 12);

        L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(leafletMap2);

        // Function untuk load data penyedia
        function loadPenyediaOptions() {
            @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('skpd'))
            axios.get('/admin/monev/penyedia-list')
                .then(response => {
                    const penyediaSelect = document.getElementById('penyediaFilter');
                    if (penyediaSelect) {
                        // Clear existing options except the first one
                        while (penyediaSelect.children.length > 1) {
                            penyediaSelect.removeChild(penyediaSelect.lastChild);
                        }
                        
                        // Add new options
                        response.data.forEach(penyedia => {
                            const option = document.createElement('option');
                            option.value = penyedia.id;
                            option.textContent = penyedia.nama_perusahaan;
                            penyediaSelect.appendChild(option);
                        });
                    }
                })
                .catch(error => {
                    console.error('Error loading penyedia options:', error);
                });
            @endif
        }

        function loadMarkers(skpdId = '', penyediaId = '', status = '') {
            // Clear existing markers first
            leafletMap2.eachLayer(function(layer) {
                if (!!layer.toGeoJSON) {
                    leafletMap2.removeLayer(layer);
                }
            });

            // Re-add tile layer
            L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(leafletMap2);

            // Load project markers
            loadProjectMarkers(skpdId, penyediaId, status);
            
            // Load provider markers
            loadProviderMarkers(penyediaId);
        }

        function loadProjectMarkers(skpdId = '', penyediaId = '', status = '') {
            // Tentukan endpoint berdasarkan role
            let endpoint = '/admin/monev/marker';
            let params = {};

            @if(auth()->user()->hasRole('admin'))
                params = {
                    skpd_id: skpdId,
                    penyedia_id: penyediaId,
                    status: status
                };
            @elseif(auth()->user()->hasRole('skpd'))
                params = {
                    penyedia_id: penyediaId,
                    status: status
                };
            @elseif(auth()->user()->hasRole('penyedia'))
                params = {
                    status: status,
                    user_id: {{ auth()->user()->id }} // Hanya proyek milik penyedia ini
                };
            @endif

            axios.get(endpoint, { params })
                .then(response => {
                    const markers = response.data;

                    // Add project markers
                    markers.forEach(marker => {
                        var newMarker = L.marker([marker.latitude, marker.longitude]);

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

                        // Tentukan warna marker berdasarkan status dan role
                        var iconUrl = getProjectMarkerIcon(fisik, today, tgl_akhir, marker);

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

                        // Buat popup content berdasarkan role
                        var popupContent = createProjectPopupContent(marker, fisikTanpaKoma, keuanganTanpaKoma, 
                                                                    paguTanpaKoma, pagu_kontrakNumber, 
                                                                    tgl_kontrak, tgl_mulai, tgl_akhir, selisihHari);

                        newMarker.bindPopup(popupContent);

                        newMarker.setIcon(L.icon({
                            iconUrl: iconUrl,
                            iconSize: [40, 40]
                        }));

                        newMarker.addTo(leafletMap2);
                    });
                })
                .catch(error => {
                    console.error('Error fetching project markers:', error);
                });
        }

        function loadProviderMarkers(penyediaId = '') {
            let endpoint = '/admin/monev/provider-markers';
            let params = {};

            @if(auth()->user()->hasRole('admin'))
                params = {
                    penyedia_id: penyediaId
                };
            @elseif(auth()->user()->hasRole('skpd'))
                params = {
                    penyedia_id: penyediaId
                };
            @elseif(auth()->user()->hasRole('penyedia'))
                params = {
                    user_id: {{ auth()->user()->id }} // Hanya data penyedia ini
                };
            @endif

            axios.get(endpoint, { params })
                .then(response => {
                    const providers = response.data;

                    // Add provider markers
                    providers.forEach(provider => {
                        // Pastikan ada koordinat
                        if (provider.latitude && provider.longitude) {
                            var providerMarker = L.marker([provider.latitude, provider.longitude]);

                            // Icon khusus untuk penyedia (building/company icon)
                            var providerIconUrl = 'https://img.icons8.com/?size=100&id=ZUdYNxR6ddlu&format=png&color=000000';
                            
                            // Popup content untuk penyedia
                            var providerPopupContent = createProviderPopupContent(provider);

                            providerMarker.bindPopup(providerPopupContent);

                            providerMarker.setIcon(L.icon({
                                iconUrl: providerIconUrl,
                                iconSize: [32, 32]
                            }));

                            providerMarker.addTo(leafletMap2);
                        }
                    });
                })
                .catch(error => {
                    console.error('Error fetching provider markers:', error);
                });
        }

        // Function untuk menentukan icon marker proyek
        function getProjectMarkerIcon(fisik, today, tgl_akhir, marker) {
            var iconUrl = 'https://maps.google.com/mapfiles/ms/icons/blue-dot.png'; // Default untuk penyedia
            
            @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('skpd'))
                // Logic untuk admin dan SKPD (seperti sebelumnya)
                iconUrl = 'https://maps.google.com/mapfiles/ms/icons/green-dot.png';
                if (fisik < 50) {
                    iconUrl = 'https://maps.google.com/mapfiles/ms/icons/red-dot.png';
                } else if (fisik < 80) {
                    iconUrl = 'https://maps.google.com/mapfiles/ms/icons/yellow-dot.png';
                } else if (fisik < 100 && today > tgl_akhir) {
                    iconUrl = 'https://maps.google.com/mapfiles/ms/icons/red-dot.png';
                } else if (fisik == 100) {
                    iconUrl = 'https://cdn-icons-png.flaticon.com/512/8029/8029509.png';
                }
            @elseif(auth()->user()->hasRole('penyedia'))
                // Logic khusus untuk penyedia
                if (fisik == 100) {
                    iconUrl = 'https://maps.google.com/mapfiles/ms/icons/green-dot.png'; // Selesai
                } else if (today > tgl_akhir) {
                    iconUrl = 'https://maps.google.com/mapfiles/ms/icons/red-dot.png'; // Terlambat
                } else if (fisik >= 50) {
                    iconUrl = 'https://maps.google.com/mapfiles/ms/icons/yellow-dot.png'; // On track
                } else {
                    iconUrl = 'https://maps.google.com/mapfiles/ms/icons/blue-dot.png'; // Baru mulai
                }
            @endif

            return iconUrl;
        }

        // Function untuk membuat popup content proyek
        function createProjectPopupContent(marker, fisikTanpaKoma, keuanganTanpaKoma, paguTanpaKoma, 
                                   pagu_kontrakNumber, tgl_kontrak, tgl_mulai, tgl_akhir, selisihHari) {
            var content = `<div class="marker-popup">`;
            content += `<h6 style="color: #007bff; margin-bottom: 10px;"><i class="bx bx-building"></i> PROYEK</h6>`;
            
            @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('skpd'))
                content += `
                    <p><strong>SKPD:</strong> ${marker.skpd.nama}</p>
                    <p><strong>Paket:</strong> ${marker.paket}</p>
                    <p><strong>Nama Perusahaan:</strong> ${marker.nama_perusahaan}</p>
                    <p><strong>Sumber Dana:</strong> ${marker.sumber_dana}</p>
                    <p><strong>Pagu:</strong> Rp. ${paguTanpaKoma}</p>
                    <p><strong>Pagu Kontrak:</strong> Rp. ${pagu_kontrakNumber}</p>
                    <p><strong>Realisasi Fisik:</strong> ${fisikTanpaKoma}%</p>
                    <p><strong>Realisasi Keuangan:</strong> Rp. ${keuanganTanpaKoma}</p>
                    <p><strong>Tgl Kontrak:</strong> ${tgl_kontrak}</p>
                    <p><strong>Tgl Mulai:</strong> ${tgl_mulai}</p>
                    <p><strong>Tgl Selesai:</strong> ${tgl_akhir}</p>
                    <p><strong>Waktu Pengerjaan:</strong> ${selisihHari} Hari</p>
                    <a href="/admin/monev/detail/${marker.id}" class="btn btn-sm btn-outline-success">Detail</a>
                `;
            @elseif(auth()->user()->hasRole('penyedia'))
                content += `
                    <p><strong>Paket Pekerjaan:</strong> ${marker.paket}</p>
                    <p><strong>SKPD:</strong> ${marker.skpd.nama}</p>
                    <p><strong>Progress Fisik:</strong> ${fisikTanpaKoma}%</p>
                    <p><strong>Realisasi Keuangan:</strong> Rp. ${keuanganTanpaKoma}</p>
                    <p><strong>Nilai Kontrak:</strong> Rp. ${pagu_kontrakNumber}</p>
                    <p><strong>Periode:</strong> ${tgl_mulai} - ${tgl_akhir}</p>
                    <p><strong>Durasi:</strong> ${selisihHari} Hari</p>
                    <a href="/penyedia/proyek/detail/${marker.id}" class="btn btn-sm btn-outline-primary">Detail Proyek</a>
                `;
            @endif
            
            content += `</div>`;
            return content;
        }

        // Function untuk membuat popup content penyedia
        function createProviderPopupContent(provider) {
            var content = `<div class="marker-popup">`;
            content += `<h6 style="color: #28a745; margin-bottom: 10px;"><i class="bx bx-store"></i> PENYEDIA JASA</h6>`;
            
            content += `
                <p><strong>Nama:</strong> ${provider.name}</p>
                <p><strong>Alamat:</strong> ${provider.address || '-'}</p>
            `;

        
            
            content += `</div>`;
            return content;
        }

        // Function untuk apply filters
        function applyFilters() {
            var skpdId = document.getElementById('skpdFilter') ? document.getElementById('skpdFilter').value : '';
            var penyediaId = document.getElementById('penyediaFilter') ? document.getElementById('penyediaFilter').value : '';
            var status = document.getElementById('statusFilter') ? document.getElementById('statusFilter').value : '';
            
            loadMarkers(skpdId, penyediaId, status);
        }

        // Function untuk reset filters
        function resetFilters() {
            if (document.getElementById('skpdFilter')) document.getElementById('skpdFilter').value = '';
            if (document.getElementById('penyediaFilter')) document.getElementById('penyediaFilter').value = '';
            if (document.getElementById('statusFilter')) document.getElementById('statusFilter').value = '';
            
            loadMarkers();
        }

        // Initial load
        loadMarkers();

        // Event listeners untuk filter (hanya untuk admin)
        @if (auth()->user()->hasRole('admin'))
            document.getElementById('skpdFilter').addEventListener('change', function() {
                applyFilters();
            });
            
            if (document.getElementById('penyediaFilter')) {
                document.getElementById('penyediaFilter').addEventListener('change', function() {
                    applyFilters();
                });
            }
        @endif

        @if (auth()->user()->hasRole('skpd'))
            if (document.getElementById('penyediaFilter')) {
                document.getElementById('penyediaFilter').addEventListener('change', function() {
                    applyFilters();
                });
            }
        @endif

        @if (auth()->user()->hasRole('penyedia'))
            if (document.getElementById('statusFilter')) {
                document.getElementById('statusFilter').addEventListener('change', function() {
                    applyFilters();
                });
            }
        @endif

        // Legend yang disesuaikan berdasarkan role
        var legend = L.control({
            position: 'topright'
        });

        legend.onAdd = function(map) {
            var div = L.DomUtil.create('div', 'legend');
            div.style.backgroundColor = 'rgba(255, 255, 255, 0.95)';
            div.style.padding = '12px';
            div.style.borderRadius = '8px';
            div.style.boxShadow = '0 2px 10px rgba(0,0,0,0.3)';
            div.style.fontSize = '12px';
            div.style.lineHeight = '1.5';
            div.style.maxWidth = '250px';

            @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('skpd'))
                div.innerHTML += '<h6 style="margin: 0 0 8px 0; font-weight: bold; color: #333;">Legenda Peta:</h6>';
                
                // Project markers
                div.innerHTML += '<div style="margin-bottom: 8px;"><strong style="color: #007bff;">📍 Status Proyek:</strong></div>';
                div.innerHTML += '<div style="display: flex; align-items: center; margin-bottom: 3px;"><div style="background-color: red; width: 15px; height: 15px; margin-right: 8px;"></div>Terlambat / < 50%</div>';
                div.innerHTML += '<div style="display: flex; align-items: center; margin-bottom: 3px;"><div style="background-color: yellow; width: 15px; height: 15px; margin-right: 8px;"></div>Progress 50-80%</div>';
                div.innerHTML += '<div style="display: flex; align-items: center; margin-bottom: 3px;"><div style="background-color: green; width: 15px; height: 15px; margin-right: 8px;"></div>On Track > 80%</div>';
                div.innerHTML += '<div style="display: flex; align-items: center; margin-bottom: 8px;"><img src="https://cdn-icons-png.flaticon.com/512/8029/8029509.png" style="width: 15px; height: 15px; margin-right: 8px;">Selesai 100%</div>';
                
                // Provider markers
                div.innerHTML += '<div style="margin-bottom: 8px;"><strong style="color: #28a745;">🏢 Lokasi Penyedia:</strong></div>';
                div.innerHTML += '<div style="display: flex; align-items: center;"><img src="https://img.icons8.com/?size=100&id=ZUdYNxR6ddlu&format=png&color=000000" style="width: 15px; height: 15px; margin-right: 8px;">Kantor Penyedia Jasa</div>';
                
            @elseif(auth()->user()->hasRole('penyedia'))
                div.innerHTML += '<h6 style="margin: 0 0 8px 0; font-weight: bold; color: #333;">Status Proyek Anda:</h6>';
                
                // Project markers for provider
                div.innerHTML += '<div style="display: flex; align-items: center; margin-bottom: 3px;"><div style="background-color: blue; width: 15px; height: 15px; margin-right: 8px;"></div>Baru Mulai</div>';
                div.innerHTML += '<div style="display: flex; align-items: center; margin-bottom: 3px;"><div style="background-color: yellow; width: 15px; height: 15px; b; margin-right: 8px;"></div>Sedang Berjalan</div>';
                div.innerHTML += '<div style="display: flex; align-items: center; margin-bottom: 3px;"><div style="background-color: red; width: 15px; height: 15px; margin-right: 8px;"></div>Terlambat</div>';
                div.innerHTML += '<div style="display: flex; align-items: center; margin-bottom: 8px;"><div style="background-color: green; width: 15px; height: 15px; margin-right: 8px;"></div>Selesai</div>';
                
                // Provider marker for self
                div.innerHTML += '<div style="margin-bottom: 5px;"><strong style="color: #28a745;">Lokasi Anda:</strong></div>';
                div.innerHTML += '<div style="display: flex; align-items: center;"><img src="https://img.icons8.com/?size=100&id=ZUdYNxR6ddlu&format=png&color=000000" style="width: 15px; height: 15px; margin-right: 8px;">Kantor Anda</div>';
            @endif
            
            return div;
        };

        legend.addTo(leafletMap2);

        @if (auth()->user()->hasRole('admin'))
            $(document).ready(function() {
                new TomSelect("#skpd_id", {
                    sortField: {
                        field: "text",
                        direction: "asc"
                    }
                });
            });
        @endif

        // Chart code (existing)
        var options = {
            series: [{{ $total_lengkap }}, {{ $total_tidak_lengkap }}],
            labels: ['Lengkap', 'Tidak Lengkap'],
            chart: {
                type: 'donut',
            },
            colors: ['#00FF00', '#FF0000'],
            legend: {
                show: false
            },
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 200
                    },
                    legend: {
                        show: false
                    }
                }
            }]
        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();

        // AmCharts code (existing)
        am5.ready(function() {
            var root = am5.Root.new("chartdiv");
            root.setThemes([am5themes_Animated.new(root)]);

            var chart = root.container.children.push(am5radar.RadarChart.new(root, {
                panX: false,
                panY: false,
                startAngle: 180,
                endAngle: 360,
                radius: am5.percent(90),
                layout: root.verticalLayout
            }));

            var colors = am5.ColorSet.new(root, { step: 2 });

            var color1 = colors.next();
            var axisRenderer1 = am5radar.AxisRendererCircular.new(root, {
                radius: -10,
                stroke: color1,
                strokeOpacity: 1,
                strokeWidth: 6,
                inside: true
            });

            axisRenderer1.grid.template.setAll({ forceHidden: true });
            axisRenderer1.ticks.template.setAll({
                stroke: color1,
                visible: true,
                length: 10,
                strokeOpacity: 1,
                inside: true
            });

            axisRenderer1.labels.template.setAll({
                radius: 15,
                inside: true
            });

            var xAxis1 = chart.xAxes.push(am5xy.ValueAxis.new(root, {
                maxDeviation: 0,
                min: 0,
                max: 100,
                strictMinMax: true,
                renderer: axisRenderer1
            }));

            var label1 = chart.seriesContainer.children.push(am5.Label.new(root, {
                fill: am5.color(0xffffff),
                x: 0,
                y: 5,
                width: 00,
                centerX: am5.percent(50),
                textAlign: "center",
                centerY: am5.percent(50),
                fontSize: "0em",
                text: "0",
                background: am5.RoundedRectangle.new(root, {
                    fill: color1
                })
            }));

            var axisDataItem1 = xAxis1.makeDataItem({
                value: 0,
                fill: color1,
                name: "Realisasi Fisik  ({{ isset($persen) ? $persen : 0 }} %)"
            });

            var clockHand1 = am5radar.ClockHand.new(root, {
                pinRadius: 14,
                radius: am5.percent(98),
                bottomWidth: 10
            });

            clockHand1.pin.setAll({ fill: color1 });
            clockHand1.hand.setAll({ fill: color1 });

            var bullet1 = axisDataItem1.set("bullet", am5xy.AxisBullet.new(root, {
                sprite: clockHand1
            }));

            xAxis1.createAxisRange(axisDataItem1);
            axisDataItem1.get("grid").set("forceHidden", true);
            axisDataItem1.get("tick").set("forceHidden", true);

            var color2 = colors.next();
            var axisRenderer2 = am5radar.AxisRendererCircular.new(root, {
                stroke: color2,
                strokeOpacity: 1,
                strokeWidth: 6
            });

            axisRenderer2.grid.template.setAll({ forceHidden: true });
            axisRenderer2.ticks.template.setAll({
                stroke: color2,
                visible: true,
                length: 10,
                strokeOpacity: 1
            });

            axisRenderer2.labels.template.setAll({ radius: 15 });

            var xAxis2 = chart.xAxes.push(am5xy.ValueAxis.new(root, {
                maxDeviation: 0,
                min: 0,
                max: 100,
                strictMinMax: true,
                renderer: axisRenderer2
            }));

            var label2 = chart.seriesContainer.children.push(am5.Label.new(root, {
                fill: am5.color(0xffffff),
                x: 0,
                y: 5,
                width: 00,
                centerX: am5.percent(50),
                textAlign: "center",
                centerY: am5.percent(50),
                fontSize: "0em",
                text: "0",
                background: am5.RoundedRectangle.new(root, {
                    fill: color2
                })
            }));

            var axisDataItem2 = xAxis2.makeDataItem({
                value: 0,
                fill: color2,
                name: "Target"
            });

            var clockHand2 = am5radar.ClockHand.new(root, {
                pinRadius: 10,
                radius: am5.percent(98),
                bottomWidth: 10
            });

            clockHand2.pin.setAll({ fill: color2 });
            clockHand2.hand.setAll({ fill: color2 });

            var bullet2 = axisDataItem2.set("bullet", am5xy.AxisBullet.new(root, {
                sprite: clockHand2
            }));

            xAxis2.createAxisRange(axisDataItem2);
            axisDataItem2.get("grid").set("forceHidden", true);
            axisDataItem2.get("tick").set("forceHidden", true);

            var legend = chart.children.push(am5.Legend.new(root, {
                x: am5.p50,
                centerX: am5.p50
            }));
            legend.data.setAll([axisDataItem1, axisDataItem2])

            setInterval(function() {
                var value1 = {{ isset($persen) ? $persen : 0 }};
                axisDataItem1.animate({
                    key: "value",
                    to: value1,
                    duration: 1000,
                    easing: am5.ease.out(am5.ease.cubic)
                });

                label1.set("text", value1);

                var value2 = 100;
                axisDataItem2.animate({
                    key: "value",
                    to: value2,
                    duration: 1000,
                    easing: am5.ease.out(am5.ease.cubic)
                });

                label2.set("text", value2);
            }, 1)

            chart.appear(1000, 100);
        });
    </script>
@endsection