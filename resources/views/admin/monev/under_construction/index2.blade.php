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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.css" />

    <style>
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
    <section class="section">
        <div class="section-header">
            <h1>Manajemen Resiko</h1>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="col-md-12 mb-3">
                            <div id="leafletMap-registration2"></div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped header-fixed" id="table">
                                <thead style="background-color: #ad67ef;">
                                    <tr>
                                        <th
                                            style="color: white;text-align:center;padding-right:100px;border-spacing: 0px;white-space: nowrap;">
                                            Aksi
                                        </th>
                                        <th style="color: white;text-align:center"> No</th>
                                        <th style="color: white;text-align:center"> SKPD</th>
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
                                        <th style="color: white;text-align:center"> Tanggal Kontrak</th>
                                        <th style="color: white;text-align:center"> Nama Pelaksana</th>
                                        <th style="color: white;text-align:center"> Realiasasi Keuangan</th>
                                        <th style="color: white;text-align:center"> Realiasasi Fisik (%)</th>
                                        <th style="color: white;text-align:center"> Kendala</th>
                                        <th style="color: white;text-align:center"> Rencana</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $a)
                                        <tr>
                                            <td>
                                                {{-- <button @if ($kunci->kunci == 1) disabled @endif
                                                    class="btn btn-sm btn-outline-success"
                                                    onclick="tambah_realisasi('{{ $a->id }}')" data-toggle="modal"
                                                    data-target="#modal-tambah-realisasi">
                                                    <i class="fa fa-pen"></i>
                                                </button> --}}
                                                <a href="{{ route('admin.mr.detail', [$a->id]) }}"
                                                    class="btn btn-sm btn-outline-warning">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                {{-- <button @if ($kunci->kunci == 1) disabled @endif
                                                    class="btn btn-sm btn-outline-danger"
                                                    onclick="hapus('{{ $a->id }}')">
                                                    <i class="fa fa-trash"></i>
                                                </button> --}}
                                            </td>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $a->skpd->name }}</td>
                                            <td>{{ $a->paket }}</td>
                                            <td>{{ $a->sumber_dana }}</td>
                                            <td>Rp. {{ number_format($a->pagu, 0, ',', '.') }}</td>
                                            <td>Rp. {{ number_format($a->pagu_kontrak, 0, ',', '.') }}</td>
                                            <td>{{ $a->tgl_kontrak }}</td>
                                            <td>{{ $a->pelaksana }}</td>
                                            @foreach ($a->realisasis as $b)
                                                @php
                                                    $bulan = date('m');
                                                    $realisasi = '';

                                                    if ($bulan == '01') {
                                                        $realisasi = $b->realisasi_januari;
                                                    } elseif ($bulan == '02') {
                                                        $realisasi = $b->realisasi_februari;
                                                    } elseif ($bulan == '03') {
                                                        $realisasi = $b->realisasi_maret;
                                                    } elseif ($bulan == '04') {
                                                        $realisasi = $b->realisasi_april;
                                                    } elseif ($bulan == '05') {
                                                        $realisasi = $b->realisasi_mei;
                                                    } elseif ($bulan == '06') {
                                                        $realisasi = $b->realisasi_juni;
                                                    } elseif ($bulan == '07') {
                                                        $realisasi = $b->realisasi_juli;
                                                    } elseif ($bulan == '08') {
                                                        $realisasi = $b->realisasi_agustus;
                                                    } elseif ($bulan == '09') {
                                                        $realisasi = $b->realisasi_september;
                                                    } elseif ($bulan == '10') {
                                                        $realisasi = $b->realisasi_oktober;
                                                    } elseif ($bulan == '11') {
                                                        $realisasi = $b->realisasi_november;
                                                    } elseif ($bulan == '12') {
                                                        $realisasi = $b->realisasi_desember;
                                                    }

                                                    $realisasi_fisik = '';

                                                    if ($bulan == '01') {
                                                        $realisasi_fisik = $b->realisasi_fisik_januari;
                                                    } elseif ($bulan == '02') {
                                                        $realisasi_fisik = $b->realisasi_fisik_februari;
                                                    } elseif ($bulan == '03') {
                                                        $realisasi_fisik = $b->realisasi_fisik_maret;
                                                    } elseif ($bulan == '04') {
                                                        $realisasi_fisik = $b->realisasi_fisik_april;
                                                    } elseif ($bulan == '05') {
                                                        $realisasi_fisik = $b->realisasi_fisik_mei;
                                                    } elseif ($bulan == '06') {
                                                        $realisasi_fisik = $b->realisasi_fisik_juni;
                                                    } elseif ($bulan == '07') {
                                                        $realisasi_fisik = $b->realisasi_fisik_juli;
                                                    } elseif ($bulan == '08') {
                                                        $realisasi_fisik = $b->realisasi_fisik_agustus;
                                                    } elseif ($bulan == '09') {
                                                        $realisasi_fisik = $b->realisasi_fisik_september;
                                                    } elseif ($bulan == '10') {
                                                        $realisasi_fisik = $b->realisasi_fisik_oktober;
                                                    } elseif ($bulan == '11') {
                                                        $realisasi_fisik = $b->realisasi_fisik_november;
                                                    } elseif ($bulan == '12') {
                                                        $realisasi_fisik = $b->realisasi_fisik_desember;
                                                    }
                                                @endphp
                                                <td>Rp. {{ number_format($realisasi, 0, ',', '.') }}</td>
                                                <td>{{ number_format($realisasi_fisik, 2, ',', '.') }}</td>
                                                <td>{{ $b->permasalahan }}</td>
                                                <td>{{ $b->rencana }}</td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{-- <table class="table table-bordered table-striped header-fixed">
                                <thead style="background-color: #ad67ef;">
                                    <tr>
                                        <th
                                            style="color: white;text-align:center;padding-right:100px;border-spacing: 0px;white-space: nowrap;">
                                            Aksi
                                        </th>
                                        <th style="color: white;text-align:center"> No</th>
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
                                        <th style="color: white;text-align:center"> Tanggal Kontrak</th>
                                        <th style="color: white;text-align:center"> Nama Pelaksana</th>
                                        <th style="color: white;text-align:center"> Realiasasi Keuangan</th>
                                        <th style="color: white;text-align:center"> Realiasasi Fisik</th>
                                        <th style="color: white;text-align:center"> Kendala</th>
                                        <th style="color: white;text-align:center"> Rencana</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($trx_sub_kegiatan as $sub)
                                        @php
                                            $no_sub = $loop->iteration;
                                        @endphp
                                        <tr>
                                            <td>
                                                <button class="btn btn-sm btn-outline-primary mr-2"
                                                    @if ($kunci->kunci == 1) disabled @endif
                                                    onclick="tambah_pagu('{{ $sub->id }}')" data-toggle="modal"
                                                    data-target="#modal-tambah">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </td>
                                            <td>
                                                {{ $loop->iteration }}
                                            </td>
                                            <td colspan="14">
                                                @foreach ($sub->nama_sub_kegiatan as $nama_sub_kegiatan)
                                                    <b>SUB KEGIATAN : </b> {{ $nama_sub_kegiatan->nama }}
                                                @endforeach
                                            </td>
                                        </tr>
                                        @foreach ($sub->mrs as $a)
                                            <tr>
                                                <td>
                                                    <button @if ($kunci->kunci == 1) disabled @endif
                                                        class="btn btn-sm btn-outline-success"
                                                        onclick="tambah_realisasi('{{ $a->id }}')"
                                                        data-toggle="modal" data-target="#modal-tambah-realisasi">
                                                        <i class="fa fa-pen"></i>
                                                    </button>
                                                    <a href="{{ route('mr.detail', [$a->id]) }}"
                                                        class="btn btn-sm btn-outline-warning">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                    <button @if ($kunci->kunci == 1) disabled @endif
                                                        class="btn btn-sm btn-outline-danger"
                                                        onclick="hapus('{{ $a->id }}')">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </td>
                                                <td>{{ $no_sub }}.{{ $loop->iteration }}</td>
                                                <td>{{ $a->paket }}</td>
                                                <td>{{ $a->sumber_dana }}</td>
                                                <td>Rp. {{ number_format($a->pagu, 0, ',', '.') }}</td>
                                                <td>Rp. {{ number_format($a->pagu_kontrak, 0, ',', '.') }}</td>
                                                <td>{{ $a->tgl_kontrak }}</td>
                                                <td>{{ $a->pelaksana }}</td>
                                                @foreach ($a->realisasis as $b)
                                                    @php
                                                        $bulan = date('m');
                                                        $realisasi = '';

                                                        if ($bulan == '01') {
                                                            $realisasi = $b->realisasi_januari;
                                                        } elseif ($bulan == '02') {
                                                            $realisasi = $b->realisasi_februari;
                                                        } elseif ($bulan == '03') {
                                                            $realisasi = $b->realisasi_maret;
                                                        } elseif ($bulan == '04') {
                                                            $realisasi = $b->realisasi_april;
                                                        } elseif ($bulan == '05') {
                                                            $realisasi = $b->realisasi_mei;
                                                        } elseif ($bulan == '06') {
                                                            $realisasi = $b->realisasi_juni;
                                                        } elseif ($bulan == '07') {
                                                            $realisasi = $b->realisasi_juli;
                                                        } elseif ($bulan == '08') {
                                                            $realisasi = $b->realisasi_agustus;
                                                        } elseif ($bulan == '09') {
                                                            $realisasi = $b->realisasi_september;
                                                        } elseif ($bulan == '10') {
                                                            $realisasi = $b->realisasi_oktober;
                                                        } elseif ($bulan == '11') {
                                                            $realisasi = $b->realisasi_november;
                                                        } elseif ($bulan == '12') {
                                                            $realisasi = $b->realisasi_desember;
                                                        }

                                                        $realisasi_fisik = '';

                                                        if ($bulan == '01') {
                                                            $realisasi_fisik = $b->realisasi_fisik_januari;
                                                        } elseif ($bulan == '02') {
                                                            $realisasi_fisik = $b->realisasi_fisik_februari;
                                                        } elseif ($bulan == '03') {
                                                            $realisasi_fisik = $b->realisasi_fisik_maret;
                                                        } elseif ($bulan == '04') {
                                                            $realisasi_fisik = $b->realisasi_fisik_april;
                                                        } elseif ($bulan == '05') {
                                                            $realisasi_fisik = $b->realisasi_fisik_mei;
                                                        } elseif ($bulan == '06') {
                                                            $realisasi_fisik = $b->realisasi_fisik_juni;
                                                        } elseif ($bulan == '07') {
                                                            $realisasi_fisik = $b->realisasi_fisik_juli;
                                                        } elseif ($bulan == '08') {
                                                            $realisasi_fisik = $b->realisasi_fisik_agustus;
                                                        } elseif ($bulan == '09') {
                                                            $realisasi_fisik = $b->realisasi_fisik_september;
                                                        } elseif ($bulan == '10') {
                                                            $realisasi_fisik = $b->realisasi_fisik_oktober;
                                                        } elseif ($bulan == '11') {
                                                            $realisasi_fisik = $b->realisasi_fisik_november;
                                                        } elseif ($bulan == '12') {
                                                            $realisasi_fisik = $b->realisasi_fisik_desember;
                                                        }
                                                    @endphp
                                                    <td>Rp. {{ number_format($realisasi, 0, ',', '.') }}</td>
                                                    <td>Rp. {{ number_format($realisasi_fisik, 0, ',', '.') }}</td>
                                                    <td>{{ $b->permasalahan }}</td>
                                                    <td>{{ $b->rencana }}</td>
                                                @endforeach
                                            </tr>
                                        @endforeach
                                    @endforeach
                                </tbody>
                            </table> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <div class="modal fade" role="dialog" id="modal-tambah">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header alert alert-primary">
                    <h5 class="modal-title mb-2">Tambah Realisasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" id="form-tambah" action="{{ url('/mr_store') }}" enctype="multipart/form-data">
                        @csrf
                        {{-- @method('PATCH') --}}
                        <div class="row">
                            <input type="hidden" id="user_id" name="user_id" value="{{ auth()->user()->id }}">
                            <input type="hidden" id="tahun" name="tahun" value="{{ auth()->user()->tahun }}">
                            <input type="hidden" id="id_tambah" name="trx_sub_kegiatan_id">

                            <div class="col-12 mt-3">
                                <div class="row">
                                    <div class="col-2"><b> PROGRAM </b> </div>
                                    <div style="margin-left: -50px" class="col-1">: </div>
                                    <div style="margin-left: -50px" class="col-9">
                                        <p id="nama_program"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mt-3">
                                <div class="row">
                                    <div class="col-2"><b> KEGIATAN </b> </div>
                                    <div style="margin-left: -50px" class="col-1">: </div>
                                    <div style="margin-left: -50px" class="col-9">
                                        <p id="nama_kegiatan"></p>
                                    </div>
                                </div>

                            </div>
                            <div class="col-12 mt-3">
                                <div class="row">
                                    <div class="col-2"><b> SUB KEGIATAN </b> </div>
                                    <div style="margin-left: -50px" class="col-1">: </div>
                                    <div style="margin-left: -50px" class="col-9">
                                        <p id="nama_sub"></p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 mt-2">
                                <input type="hidden" name="total_pagu" id="total_pagu_modal" required>
                            </div>
                            <div class="col-12 mt-2">
                                <input type="hidden" name="pagu_sub" id="pagu_sub" required>
                            </div>
                            <div class="col-6 mt-2">
                                <label for="paket">Nama Paket <small class="text-danger">*</small></label>
                                <input type="text" class="form-control" name="paket" id="paket" required>
                            </div>
                            <div class="col-6 mt-2">
                                <label for="pagu">pagu <small class="text-danger">*</small></label>
                                <input type="text" onkeypress="return hanyaAngka()" class="form-control angka"
                                    name="pagu" required>
                            </div>
                            <div class="col-6 mt-2">
                                <label for="pagu_kontrak">pagu kontrak <small class="text-danger">*</small></label>
                                <input type="text" onkeypress="return hanyaAngka()" class="form-control angka"
                                    name="pagu_kontrak" id="pagu_kontrak" required>
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
                                <label for="pelaksana">Nama Pelaksana <small class="text-danger">*</small></label>
                                <input type="text" class="form-control" name="pelaksana" id="pelaksana" required>
                            </div>

                            <div class="col-md-12 mt-3">
                                <a href="#" class="btn btn-primary btn-sm" onclick="getCurrentLocation()">Pakai
                                    Lokasi Saat
                                    Ini</a>
                                <div id="loadingIndicator" style="display: none;">Loading...</div>
                                <div id="leafletMap-registration"></div>
                                <button onclick="enableDrawing('polygon')">Gambar Poligon</button>
                                <button onclick="enableDrawing('polyline')">Gambar Garis</button>
                            </div>

                            <div class="col-md-6 mt-2">
                                <label for="latitude">latitude <small class="text-danger">*</small></label>
                                <input type="text" id="Latitude" name="latitude" class="form-control" required>
                            </div>

                            <div class="col-md-6 mt-2">
                                <label for="longitude">longitude <small class="text-danger">*</small></label>
                                <input type="text" id="Longitude" name="longitude" class="form-control" required>
                            </div>

                            <label for="type">Jenis Geometri:</label>
                            <select name="type" id="type">
                                <option value="Polygon">Poligon</option>
                                <option value="LineString">Garis</option>
                            </select><br>
                            <label for="coordinates">Koordinat:</label>
                            <input type="text" name="coordinates" id="coordinates"><br>
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

    <div class="modal fade" role="dialog" id="modal-tambah-realisasi">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header alert alert-primary">
                    <h5 class="modal-title mb-2">Tambah Realisasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" id="form-tambah-realisasi" action="{{ url('/mr_storerealisasi') }}"
                        enctype="multipart/form-data">
                        @csrf
                        {{-- @method('PATCH') --}}
                        <div class="row">
                            <input type="hidden" id="user_id" name="user_id" value="{{ auth()->user()->id }}">
                            <input type="hidden" id="tahun" name="tahun" value="{{ auth()->user()->tahun }}">
                            <input type="hidden" id="id_tambah_realisasi" name="trx_mr_id">

                            <div class="col-12 mt-3">
                                <div class="row">
                                    <div class="col-2"><b> PAKET PEKERJAAN </b> </div>
                                    <div style="margin-left: -50px" class="col-1">: </div>
                                    <div style="margin-left: -50px" class="col-9">
                                        <p id="nama_paket"></p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 mt-3">
                                <div class="row">
                                    <div class="col-2"><b> PAGU </b> </div>
                                    <div style="margin-left: -50px" class="col-1">: </div>
                                    <div style="margin-left: -50px" class="col-9">
                                        <p id="pagu"></p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 mt-3">
                                <div class="row">
                                    <div class="col-2"><b> PAGU KONTRAK </b> </div>
                                    <div style="margin-left: -50px" class="col-1">: </div>
                                    <div style="margin-left: -50px" class="col-9">
                                        <p id="pagu_kontrak_modal"></p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 mt-3">
                                <div class="row">


                                    <table class="table table-bordered  header-fixed">
                                        <tr style="background-color: #ad67ef;">
                                            <th colspan="3" style="color: white;text-align:center">REALISASI DENGAN
                                                BULAN</td>
                                        </tr>

                                        <tr>
                                            <td>
                                                @if ($kunci_realisasi_januari == 1)
                                                    <table>
                                                        <tr style="text-align: center">
                                                            <th colspan="2"> <span
                                                                    class="badge badge-primary mt-3">JANUARI</span>
                                                                <p class="small text-danger" id="text-januari"></p>
                                                            </th>
                                                        </tr>
                                                        <tr>
                                                            <td>KEUANGAN</td>
                                                            <td>
                                                                <div class="col-12 mt-2 mb-3">
                                                                    <input type="text" name="realisasi_januari"
                                                                        id="realisasi_januari"
                                                                        onkeypress="return hanyaAngka()"
                                                                        class="form-control angka" readonly>
                                                                    {{-- <label class="mt-2">Target : <label class="mt-2">Rp. 10000</label> </label> --}}
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>FISIK (%)</td>
                                                            <td>
                                                                <div class="col-12 mt-2 mb-3">
                                                                    <input type="text" name="realisasi_fisik_januari"
                                                                        id="realisasi_fisik_januari"
                                                                        onkeypress="return hanyaAngka()"
                                                                        class="form-control angka" readonly>
                                                                    {{-- <label class="mt-2">Target : <label class="mt-2">Rp. 10000</label> </label> --}}
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                @else
                                                    <table>
                                                        <tr style="text-align: center">
                                                            <th colspan="2"> <span
                                                                    class="badge badge-primary mt-3">JANUARI </span>
                                                                <p class="small text-danger" id="text-januari"></p>
                                                            </th>
                                                        </tr>
                                                        <tr>
                                                            <td>KEUANGAN</td>
                                                            <td>
                                                                <div class="col-12 mt-2 mb-3">
                                                                    <input type="text" name="realisasi_januari"
                                                                        id="realisasi_januari"
                                                                        onkeypress="return hanyaAngka()"
                                                                        class="form-control angka">
                                                                    {{-- <label class="mt-2">Target : <label class="mt-2">Rp. 10000</label> </label> --}}
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>FISIK (%)</td>
                                                            <td>
                                                                <div class="col-12 mt-2 mb-3">
                                                                    <input type="text" name="realisasi_fisik_januari"
                                                                        id="realisasi_fisik_januari"
                                                                        onkeypress="return hanyaAngka()"
                                                                        class="form-control angka">
                                                                    {{-- <label class="mt-2">Target : <label class="mt-2">Rp. 10000</label> </label> --}}
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                @endif
                                            </td>

                                            <td>
                                                @if ($kunci_realisasi_februari == 1)
                                                    <table>
                                                        <tr style="text-align: center">
                                                            <th colspan="2"> <span
                                                                    class="badge badge-primary mt-3">FEBRUARI</span>
                                                                <p class="small text-danger" id="text-februari"></p>
                                                            </th>

                                                        </tr>
                                                        <tr>
                                                            <td>KEUANGAN</td>
                                                            <td>
                                                                <div class="col-12 mt-2 mb-3">
                                                                    <input type="text" name="realisasi_februari"
                                                                        id="realisasi_februari"
                                                                        onkeypress="return hanyaAngka()"
                                                                        class="form-control angka" readonly>
                                                                    {{-- <label class="mt-2">Target : <label class="mt-2">Rp. 10000</label> </label> --}}
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>FISIK (%)</td>
                                                            <td>
                                                                <div class="col-12 mt-2 mb-3">
                                                                    <input type="text" name="realisasi_fisik_februari"
                                                                        id="realisasi_fisik_februari"
                                                                        onkeypress="return hanyaAngka()"
                                                                        class="form-control angka" readonly>
                                                                    {{-- <label class="mt-2">Target : <label class="mt-2">Rp. 10000</label> </label> --}}
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                @else
                                                    <table>
                                                        <tr style="text-align: center">
                                                            <th colspan="2"> <span
                                                                    class="badge badge-primary mt-3">FEBRUARI</span>
                                                                <p class="small text-danger" id="text-februari"></p>
                                                            </th>

                                                        </tr>
                                                        <tr>
                                                            <td>KEUANGAN</td>
                                                            <td>
                                                                <div class="col-12 mt-2 mb-3">
                                                                    <input type="text" name="realisasi_februari"
                                                                        id="realisasi_februari"
                                                                        onkeypress="return hanyaAngka()"
                                                                        class="form-control angka">
                                                                    {{-- <label class="mt-2">Target : <label class="mt-2">Rp. 10000</label> </label> --}}
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>FISIK (%)</td>
                                                            <td>
                                                                <div class="col-12 mt-2 mb-3">
                                                                    <input type="text" name="realisasi_fisik_februari"
                                                                        id="realisasi_fisik_februari"
                                                                        onkeypress="return hanyaAngka()"
                                                                        class="form-control angka">
                                                                    {{-- <label class="mt-2">Target : <label class="mt-2">Rp. 10000</label> </label> --}}
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                @endif
                                            </td>

                                            <td>
                                                @if ($kunci_realisasi_maret == 1)
                                                    <table>
                                                        <tr style="text-align: center">
                                                            <th colspan="2"> <span
                                                                    class="badge badge-primary mt-3">MARET</span>
                                                                <p class="small text-danger" id="text-maret"></p>
                                                            </th>

                                                        </tr>
                                                        <tr>
                                                            <td>KEUANGAN</td>
                                                            <td>
                                                                <div class="col-12 mt-2 mb-3">
                                                                    <input type="text" name="realisasi_maret"
                                                                        id="realisasi_maret"
                                                                        onkeypress="return hanyaAngka()"
                                                                        class="form-control angka" readonly>
                                                                    {{-- <label class="mt-2">Target : <label class="mt-2">Rp. 10000</label> </label> --}}
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>FISIK (%)</td>
                                                            <td>
                                                                <div class="col-12 mt-2 mb-3">
                                                                    <input type="text" name="realisasi_fisik_maret"
                                                                        id="realisasi_fisik_maret"
                                                                        onkeypress="return hanyaAngka()"
                                                                        class="form-control angka" readonly>
                                                                    {{-- <label class="mt-2">Target : <label class="mt-2">Rp. 10000</label> </label> --}}
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                @else
                                                    <table>
                                                        <tr style="text-align: center">
                                                            <th colspan="2"> <span
                                                                    class="badge badge-primary mt-3">MARET</span>
                                                                <p class="small text-danger" id="text-maret"></p>
                                                            </th>

                                                        </tr>
                                                        <tr>
                                                            <td>KEUANGAN</td>
                                                            <td>
                                                                <div class="col-12 mt-2 mb-3">
                                                                    <input type="text" name="realisasi_maret"
                                                                        id="realisasi_maret"
                                                                        onkeypress="return hanyaAngka()"
                                                                        class="form-control angka">
                                                                    {{-- <label class="mt-2">Target : <label class="mt-2">Rp. 10000</label> </label> --}}
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>FISIK (%)</td>
                                                            <td>
                                                                <div class="col-12 mt-2 mb-3">
                                                                    <input type="text" name="realisasi_fisik_maret"
                                                                        id="realisasi_fisik_maret"
                                                                        onkeypress="return hanyaAngka()"
                                                                        class="form-control angka">
                                                                    {{-- <label class="mt-2">Target : <label class="mt-2">Rp. 10000</label> </label> --}}
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                @endif
                                            </td>

                                        </tr>

                                        <tr>
                                            <td>
                                                @if ($kunci_realisasi_april == 1)
                                                    <table>
                                                        <tr style="text-align: center">
                                                            <th colspan="2"> <span
                                                                    class="badge badge-primary mt-3">APRIL</span>
                                                                <p class="small text-danger" id="text-april"></p>
                                                            </th>

                                                        </tr>
                                                        <tr>
                                                            <td>KEUANGAN</td>
                                                            <td>
                                                                <div class="col-12 mt-2 mb-3">
                                                                    <input type="text" name="realisasi_april"
                                                                        id="realisasi_april"
                                                                        onkeypress="return hanyaAngka()"
                                                                        class="form-control angka" readonly>
                                                                    {{-- <label class="mt-2">Target : <label class="mt-2">Rp. 10000</label> </label> --}}
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>FISIK (%)</td>
                                                            <td>
                                                                <div class="col-12 mt-2 mb-3">
                                                                    <input type="text" name="realisasi_fisik_april"
                                                                        id="realisasi_fisik_april"
                                                                        onkeypress="return hanyaAngka()"
                                                                        class="form-control angka" readonly>
                                                                    {{-- <label class="mt-2">Target : <label class="mt-2">Rp. 10000</label> </label> --}}
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                @else
                                                    <table>
                                                        <tr style="text-align: center">
                                                            <th colspan="2"> <span
                                                                    class="badge badge-primary mt-3">APRIL</span>
                                                                <p class="small text-danger" id="text-april"></p>
                                                            </th>

                                                        </tr>
                                                        <tr>
                                                            <td>KEUANGAN</td>
                                                            <td>
                                                                <div class="col-12 mt-2 mb-3">
                                                                    <input type="text" name="realisasi_april"
                                                                        id="realisasi_april"
                                                                        onkeypress="return hanyaAngka()"
                                                                        class="form-control angka">
                                                                    {{-- <label class="mt-2">Target : <label class="mt-2">Rp. 10000</label> </label> --}}
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>FISIK (%)</td>
                                                            <td>
                                                                <div class="col-12 mt-2 mb-3">
                                                                    <input type="text" name="realisasi_fisik_april"
                                                                        id="realisasi_fisik_april"
                                                                        onkeypress="return hanyaAngka()"
                                                                        class="form-control angka">
                                                                    {{-- <label class="mt-2">Target : <label class="mt-2">Rp. 10000</label> </label> --}}
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                @endif
                                            </td>

                                            <td>
                                                @if ($kunci_realisasi_mei == 1)
                                                    <table>
                                                        <tr style="text-align: center">
                                                            <th colspan="2"> <span
                                                                    class="badge badge-primary mt-3">MEI</span>
                                                                <p class="small text-danger" id="text-mei"></p>
                                                            </th>

                                                        </tr>
                                                        <tr>
                                                            <td>KEUANGAN</td>
                                                            <td>
                                                                <div class="col-12 mt-2 mb-3">
                                                                    <input type="text" name="realisasi_mei"
                                                                        id="realisasi_mei"
                                                                        onkeypress="return hanyaAngka()"
                                                                        class="form-control angka" readonly>
                                                                    {{-- <label class="mt-2">Target : <label class="mt-2">Rp. 10000</label> </label> --}}
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>FISIK (%)</td>
                                                            <td>
                                                                <div class="col-12 mt-2 mb-3">
                                                                    <input type="text" name="realisasi_fisik_mei"
                                                                        id="realisasi_fisik_mei"
                                                                        onkeypress="return hanyaAngka()"
                                                                        class="form-control angka" readonly>
                                                                    {{-- <label class="mt-2">Target : <label class="mt-2">Rp. 10000</label> </label> --}}
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                @else
                                                    <table>
                                                        <tr style="text-align: center">
                                                            <th colspan="2"> <span
                                                                    class="badge badge-primary mt-3">MEI</span>
                                                                <p class="small text-danger" id="text-mei"></p>
                                                            </th>

                                                        </tr>
                                                        <tr>
                                                            <td>KEUANGAN</td>
                                                            <td>
                                                                <div class="col-12 mt-2 mb-3">
                                                                    <input type="text" name="realisasi_mei"
                                                                        id="realisasi_mei"
                                                                        onkeypress="return hanyaAngka()"
                                                                        class="form-control angka">
                                                                    {{-- <label class="mt-2">Target : <label class="mt-2">Rp. 10000</label> </label> --}}
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>FISIK (%)</td>
                                                            <td>
                                                                <div class="col-12 mt-2 mb-3">
                                                                    <input type="text" name="realisasi_fisik_mei"
                                                                        id="realisasi_fisik_mei"
                                                                        onkeypress="return hanyaAngka()"
                                                                        class="form-control angka">
                                                                    {{-- <label class="mt-2">Target : <label class="mt-2">Rp. 10000</label> </label> --}}
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                @endif
                                            </td>

                                            <td>
                                                @if ($kunci_realisasi_juni == 1)
                                                    <table>
                                                        <tr style="text-align: center">
                                                            <th colspan="2"> <span
                                                                    class="badge badge-primary mt-3">JUNI</span>
                                                                <p class="small text-danger" id="text-juni"></p>
                                                            </th>

                                                        </tr>
                                                        <tr>
                                                            <td>KEUANGAN</td>
                                                            <td>
                                                                <div class="col-12 mt-2 mb-3">
                                                                    <input type="text" name="realisasi_juni"
                                                                        id="realisasi_juni"
                                                                        onkeypress="return hanyaAngka()"
                                                                        class="form-control angka" readonly>
                                                                    {{-- <label class="mt-2">Target : <label class="mt-2">Rp. 10000</label> </label> --}}
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>FISIK (%)</td>
                                                            <td>
                                                                <div class="col-12 mt-2 mb-3">
                                                                    <input type="text" name="realisasi_fisik_juni"
                                                                        id="realisasi_fisik_juni"
                                                                        onkeypress="return hanyaAngka()"
                                                                        class="form-control angka" readonly>
                                                                    {{-- <label class="mt-2">Target : <label class="mt-2">Rp. 10000</label> </label> --}}
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                @else
                                                    <table>
                                                        <tr style="text-align: center">
                                                            <th colspan="2"> <span
                                                                    class="badge badge-primary mt-3">JUNI</span>
                                                                <p class="small text-danger" id="text-juni"></p>
                                                            </th>

                                                        </tr>
                                                        <tr>
                                                            <td>KEUANGAN</td>
                                                            <td>
                                                                <div class="col-12 mt-2 mb-3">
                                                                    <input type="text" name="realisasi_juni"
                                                                        id="realisasi_juni"
                                                                        onkeypress="return hanyaAngka()"
                                                                        class="form-control angka">
                                                                    {{-- <label class="mt-2">Target : <label class="mt-2">Rp. 10000</label> </label> --}}
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>FISIK (%)</td>
                                                            <td>
                                                                <div class="col-12 mt-2 mb-3">
                                                                    <input type="text" name="realisasi_fisik_juni"
                                                                        id="realisasi_fisik_juni"
                                                                        onkeypress="return hanyaAngka()"
                                                                        class="form-control angka">
                                                                    {{-- <label class="mt-2">Target : <label class="mt-2">Rp. 10000</label> </label> --}}
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                @endif
                                            </td>

                                        </tr>

                                        <tr>
                                            <td>
                                                @if ($kunci_realisasi_juli == 1)
                                                    <table>
                                                        <tr style="text-align: center">
                                                            <th colspan="2"> <span
                                                                    class="badge badge-primary mt-3">JULI</span>
                                                                <p class="small text-danger" id="text-juli"></p>
                                                            </th>

                                                        </tr>
                                                        <tr>
                                                            <td>KEUANGAN</td>
                                                            <td>
                                                                <div class="col-12 mt-2 mb-3">
                                                                    <input type="text" name="realisasi_juli"
                                                                        id="realisasi_juli"
                                                                        onkeypress="return hanyaAngka()"
                                                                        class="form-control angka" readonly>
                                                                    {{-- <label class="mt-2">Target : <label class="mt-2">Rp. 10000</label> </label> --}}
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>FISIK (%)</td>
                                                            <td>
                                                                <div class="col-12 mt-2 mb-3">
                                                                    <input type="text" name="realisasi_fisik_juli"
                                                                        id="realisasi_fisik_juli"
                                                                        onkeypress="return hanyaAngka()"
                                                                        class="form-control angka" readonly>
                                                                    {{-- <label class="mt-2">Target : <label class="mt-2">Rp. 10000</label> </label> --}}
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                @else
                                                    <table>
                                                        <tr style="text-align: center">
                                                            <th colspan="2"> <span
                                                                    class="badge badge-primary mt-3">JULI</span>
                                                                <p class="small text-danger" id="text-juli"></p>
                                                            </th>

                                                        </tr>
                                                        <tr>
                                                            <td>KEUANGAN</td>
                                                            <td>
                                                                <div class="col-12 mt-2 mb-3">
                                                                    <input type="text" name="realisasi_juli"
                                                                        id="realisasi_juli"
                                                                        onkeypress="return hanyaAngka()"
                                                                        class="form-control angka">
                                                                    {{-- <label class="mt-2">Target : <label class="mt-2">Rp. 10000</label> </label> --}}
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>FISIK (%)</td>
                                                            <td>
                                                                <div class="col-12 mt-2 mb-3">
                                                                    <input type="text" name="realisasi_fisik_juli"
                                                                        id="realisasi_fisik_juli"
                                                                        onkeypress="return hanyaAngka()"
                                                                        class="form-control angka">
                                                                    {{-- <label class="mt-2">Target : <label class="mt-2">Rp. 10000</label> </label> --}}
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                @endif
                                            </td>

                                            <td>
                                                @if ($kunci_realisasi_agustus == 1)
                                                    <table>
                                                        <tr style="text-align: center">
                                                            <th colspan="2"> <span
                                                                    class="badge badge-primary mt-3">AGUSTUS</span>
                                                                <p class="small text-danger" id="text-agustus"></p>
                                                            </th>

                                                        </tr>
                                                        <tr>
                                                            <td>KEUANGAN</td>
                                                            <td>
                                                                <div class="col-12 mt-2 mb-3">
                                                                    <input type="text" name="realisasi_agustus"
                                                                        id="realisasi_agustus"
                                                                        onkeypress="return hanyaAngka()"
                                                                        class="form-control angka" readonly>
                                                                    {{-- <label class="mt-2">Target : <label class="mt-2">Rp. 10000</label> </label> --}}
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>FISIK (%)</td>
                                                            <td>
                                                                <div class="col-12 mt-2 mb-3">
                                                                    <input type="text" name="realisasi_fisik_agustus"
                                                                        id="realisasi_fisik_agustus"
                                                                        onkeypress="return hanyaAngka()"
                                                                        class="form-control angka" readonly>
                                                                    {{-- <label class="mt-2">Target : <label class="mt-2">Rp. 10000</label> </label> --}}
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                @else
                                                    <table>
                                                        <tr style="text-align: center">
                                                            <th colspan="2"> <span
                                                                    class="badge badge-primary mt-3">AGUSTUS</span>
                                                                <p class="small text-danger" id="text-agustus"></p>
                                                            </th>

                                                        </tr>
                                                        <tr>
                                                            <td>KEUANGAN</td>
                                                            <td>
                                                                <div class="col-12 mt-2 mb-3">
                                                                    <input type="text" name="realisasi_agustus"
                                                                        id="realisasi_agustus"
                                                                        onkeypress="return hanyaAngka()"
                                                                        class="form-control angka">
                                                                    {{-- <label class="mt-2">Target : <label class="mt-2">Rp. 10000</label> </label> --}}
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>FISIK (%)</td>
                                                            <td>
                                                                <div class="col-12 mt-2 mb-3">
                                                                    <input type="text" name="realisasi_fisik_agustus"
                                                                        id="realisasi_fisik_agustus"
                                                                        onkeypress="return hanyaAngka()"
                                                                        class="form-control angka">
                                                                    {{-- <label class="mt-2">Target : <label class="mt-2">Rp. 10000</label> </label> --}}
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                @endif
                                            </td>

                                            <td>
                                                @if ($kunci_realisasi_september == 1)
                                                    <table>
                                                        <tr style="text-align: center">
                                                            <th colspan="2"> <span
                                                                    class="badge badge-primary mt-3">SEPTEMBER</span>
                                                                <p class="small text-danger" id="text-september"></p>
                                                            </th>

                                                        </tr>
                                                        <tr>
                                                            <td>KEUANGAN</td>
                                                            <td>
                                                                <div class="col-12 mt-2 mb-3">
                                                                    <input type="text" name="realisasi_september"
                                                                        id="realisasi_september"
                                                                        onkeypress="return hanyaAngka()"
                                                                        class="form-control angka" readonly>
                                                                    {{-- <label class="mt-2">Target : <label class="mt-2">Rp. 10000</label> </label> --}}
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>FISIK (%)</td>
                                                            <td>
                                                                <div class="col-12 mt-2 mb-3">
                                                                    <input type="text" name="realisasi_fisik_september"
                                                                        id="realisasi_fisik_september"
                                                                        onkeypress="return hanyaAngka()"
                                                                        class="form-control angka" readonly>
                                                                    {{-- <label class="mt-2">Target : <label class="mt-2">Rp. 10000</label> </label> --}}
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                @else
                                                    <table>
                                                        <tr style="text-align: center">
                                                            <th colspan="2"> <span
                                                                    class="badge badge-primary mt-3">SEPTEMBER</span>
                                                                <p class="small text-danger" id="text-september"></p>
                                                            </th>

                                                        </tr>
                                                        <tr>
                                                            <td>KEUANGAN</td>
                                                            <td>
                                                                <div class="col-12 mt-2 mb-3">
                                                                    <input type="text" name="realisasi_september"
                                                                        id="realisasi_september"
                                                                        onkeypress="return hanyaAngka()"
                                                                        class="form-control angka">
                                                                    {{-- <label class="mt-2">Target : <label class="mt-2">Rp. 10000</label> </label> --}}
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>FISIK (%)</td>
                                                            <td>
                                                                <div class="col-12 mt-2 mb-3">
                                                                    <input type="text" name="realisasi_fisik_september"
                                                                        id="realisasi_fisik_september"
                                                                        onkeypress="return hanyaAngka()"
                                                                        class="form-control angka">
                                                                    {{-- <label class="mt-2">Target : <label class="mt-2">Rp. 10000</label> </label> --}}
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                @endif
                                            </td>

                                        </tr>

                                        <tr>
                                            <td>
                                                @if ($kunci_realisasi_oktober == 1)
                                                    <table>
                                                        <tr style="text-align: center">
                                                            <th colspan="2"> <span
                                                                    class="badge badge-primary mt-3">OKTOBER</span>
                                                                <p class="small text-danger" id="text-oktober"></p>
                                                            </th>

                                                        </tr>
                                                        <tr>
                                                            <td>KEUANGAN</td>
                                                            <td>
                                                                <div class="col-12 mt-2 mb-3">
                                                                    <input type="text" name="realisasi_oktober"
                                                                        id="realisasi_oktober"
                                                                        onkeypress="return hanyaAngka()"
                                                                        class="form-control angka" readonly>
                                                                    {{-- <label class="mt-2">Target : <label class="mt-2">Rp. 10000</label> </label> --}}
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>FISIK (%)</td>
                                                            <td>
                                                                <div class="col-12 mt-2 mb-3">
                                                                    <input type="text" name="realisasi_fisik_oktober"
                                                                        id="realisasi_fisik_oktober"
                                                                        onkeypress="return hanyaAngka()"
                                                                        class="form-control angka" readonly>
                                                                    {{-- <label class="mt-2">Target : <label class="mt-2">Rp. 10000</label> </label> --}}
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                @else
                                                    <table>
                                                        <tr style="text-align: center">
                                                            <th colspan="2"> <span
                                                                    class="badge badge-primary mt-3">OKTOBER</span>
                                                                <p class="small text-danger" id="text-oktober"></p>
                                                            </th>

                                                        </tr>
                                                        <tr>
                                                            <td>KEUANGAN</td>
                                                            <td>
                                                                <div class="col-12 mt-2 mb-3">
                                                                    <input type="text" name="realisasi_oktober"
                                                                        id="realisasi_oktober"
                                                                        onkeypress="return hanyaAngka()"
                                                                        class="form-control angka">
                                                                    {{-- <label class="mt-2">Target : <label class="mt-2">Rp. 10000</label> </label> --}}
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>FISIK (%)</td>
                                                            <td>
                                                                <div class="col-12 mt-2 mb-3">
                                                                    <input type="text" name="realisasi_fisik_oktober"
                                                                        id="realisasi_fisik_oktober"
                                                                        onkeypress="return hanyaAngka()"
                                                                        class="form-control angka">
                                                                    {{-- <label class="mt-2">Target : <label class="mt-2">Rp. 10000</label> </label> --}}
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                @endif
                                            </td>

                                            <td>
                                                @if ($kunci_realisasi_november == 1)
                                                    <table>
                                                        <tr style="text-align: center">
                                                            <th colspan="2"> <span
                                                                    class="badge badge-primary mt-3">NOVEMBER</span>
                                                                <p class="small text-danger" id="text-november"></p>
                                                            </th>

                                                        </tr>
                                                        <tr>
                                                            <td>KEUANGAN</td>
                                                            <td>
                                                                <div class="col-12 mt-2 mb-3">
                                                                    <input type="text" name="realisasi_november"
                                                                        id="realisasi_november"
                                                                        onkeypress="return hanyaAngka()"
                                                                        class="form-control angka" readonly>
                                                                    {{-- <label class="mt-2">Target : <label class="mt-2">Rp. 10000</label> </label> --}}
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>FISIK (%)</td>
                                                            <td>
                                                                <div class="col-12 mt-2 mb-3">
                                                                    <input type="text" name="realisasi_fisik_november"
                                                                        id="realisasi_fisik_november"
                                                                        onkeypress="return hanyaAngka()"
                                                                        class="form-control angka" readonly>
                                                                    {{-- <label class="mt-2">Target : <label class="mt-2">Rp. 10000</label> </label> --}}
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                @else
                                                    <table>
                                                        <tr style="text-align: center">
                                                            <th colspan="2"> <span
                                                                    class="badge badge-primary mt-3">NOVEMBER</span>
                                                                <p class="small text-danger" id="text-november"></p>
                                                            </th>

                                                        </tr>
                                                        <tr>
                                                            <td>KEUANGAN</td>
                                                            <td>
                                                                <div class="col-12 mt-2 mb-3">
                                                                    <input type="text" name="realisasi_november"
                                                                        id="realisasi_november"
                                                                        onkeypress="return hanyaAngka()"
                                                                        class="form-control angka">
                                                                    {{-- <label class="mt-2">Target : <label class="mt-2">Rp. 10000</label> </label> --}}
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>FISIK (%)</td>
                                                            <td>
                                                                <div class="col-12 mt-2 mb-3">
                                                                    <input type="text" name="realisasi_fisik_november"
                                                                        id="realisasi_fisik_november"
                                                                        onkeypress="return hanyaAngka()"
                                                                        class="form-control angka">
                                                                    {{-- <label class="mt-2">Target : <label class="mt-2">Rp. 10000</label> </label> --}}
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                @endif
                                            </td>

                                            <td>
                                                @if ($kunci_realisasi_desember == 1)
                                                    <table>
                                                        <tr style="text-align: center">
                                                            <th colspan="2"> <span
                                                                    class="badge badge-primary mt-3">DESEMBER</span>
                                                                <p class="small text-danger" id="text-desember"></p>
                                                            </th>

                                                        </tr>
                                                        <tr>
                                                            <td>KEUANGAN</td>
                                                            <td>
                                                                <div class="col-12 mt-2 mb-3">
                                                                    <input type="text" name="realisasi_desember"
                                                                        id="realisasi_desember"
                                                                        onkeypress="return hanyaAngka()"
                                                                        class="form-control angka" readonly>
                                                                    {{-- <label class="mt-2">Target : <label class="mt-2">Rp. 10000</label> </label> --}}
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>FISIK (%)</td>
                                                            <td>
                                                                <div class="col-12 mt-2 mb-3">
                                                                    <input type="text" name="realisasi_fisik_desember"
                                                                        id="realisasi_fisik_desember"
                                                                        onkeypress="return hanyaAngka()"
                                                                        class="form-control angka" readonly>
                                                                    {{-- <label class="mt-2">Target : <label class="mt-2">Rp. 10000</label> </label> --}}
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                @else
                                                    <table>
                                                        <tr style="text-align: center">
                                                            <th colspan="2"> <span
                                                                    class="badge badge-primary mt-3">DESEMBER</span>
                                                                <p class="small text-danger" id="text-desember"></p>
                                                            </th>

                                                        </tr>
                                                        <tr>
                                                            <td>KEUANGAN</td>
                                                            <td>
                                                                <div class="col-12 mt-2 mb-3">
                                                                    <input type="text" name="realisasi_desember"
                                                                        id="realisasi_desember"
                                                                        onkeypress="return hanyaAngka()"
                                                                        class="form-control angka">
                                                                    {{-- <label class="mt-2">Target : <label class="mt-2">Rp. 10000</label> </label> --}}
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>FISIK (%)</td>
                                                            <td>
                                                                <div class="col-12 mt-2 mb-3">
                                                                    <input type="text" name="realisasi_fisik_desember"
                                                                        id="realisasi_fisik_desember"
                                                                        onkeypress="return hanyaAngka()"
                                                                        class="form-control angka">
                                                                    {{-- <label class="mt-2">Target : <label class="mt-2">Rp. 10000</label> </label> --}}
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                @endif
                                            </td>

                                        </tr>

                                    </table>
                                </div>
                                @if ($kunci_permasalahan == 1)
                                    <div class="col-12 mt-2">
                                        <label for="permasalahan">Permasalahan <small
                                                class="text-danger">*</small></label>
                                        <textarea name="permasalahan" class="form-control" id="permasalahan" cols="60" rows="60"
                                            style="height: 100px" readonly></textarea>
                                        {{-- <input type="text" name="indikator" class="form-control"> --}}
                                    </div>
                                @else
                                    <div class="col-12 mt-2">
                                        <label for="permasalahan">Permasalahan <small
                                                class="text-danger">*</small></label>
                                        <textarea name="permasalahan" class="form-control" id="permasalahan" cols="60" rows="60"
                                            style="height: 100px"></textarea>
                                        {{-- <input type="text" name="indikator" class="form-control"> --}}
                                    </div>
                                @endif

                                @if ($kunci_rencana == 1)
                                    <div class="col-12 mt-2">
                                        <label for="rencana">Rencana Tindak Lanjut <small
                                                class="text-danger">*</small></label>
                                        <textarea name="rencana" class="form-control" id="rencana" cols="60" rows="60" style="height: 100px"
                                            readonly></textarea>
                                        {{-- <input type="text" name="indikator" class="form-control"> --}}
                                    </div>
                                @else
                                    <div class="col-12 mt-2">
                                        <label for="rencana">Rencana Tindak Lanjut <small
                                                class="text-danger">*</small></label>
                                        <textarea name="rencana" class="form-control" id="rencana" cols="60" rows="60" style="height: 100px"></textarea>
                                        {{-- <input type="text" name="indikator" class="form-control"> --}}
                                    </div>
                                @endif



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



    <div class="modal fade" role="dialog" id="modal-edit">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header alert alert-primary">
                    <h5 class="modal-title mb-2">Edit Indikator Sub Kegiatan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" id="form-edit" action="{{ url('/bulan_update') }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                            <input type="hidden" id="kd_urusan_edit" name="kd_urusan">
                            <input type="hidden" id="kd_bidang_edit" name="kd_bidang">
                            <input type="hidden" id="kd_unit_edit" name="kd_unit">
                            <input type="hidden" id="kd_sub_edit" name="kd_sub">
                            <input type="hidden" id="kd_prog_edit" name="kd_prog">
                            <input type="hidden" id="id_prog_edit" name="id_prog">
                            <input type="hidden" id="kd_keg_edit" name="kd_keg">
                            <div class="col-12">
                                <label for="permasalahan">Permasalahan <small class="text-danger">*</small></label>
                                <textarea name="permasalahan" class="form-control" id="permasalahan" cols="60" rows="60"
                                    style="height: 100px"></textarea>
                                {{-- <input type="text" name="indikator" class="form-control"> --}}
                            </div>
                            <div class="col-12">
                                <label for="rencana">Rencana Tindak Lanjut <small class="text-danger">*</small></label>
                                <textarea name="rencana" class="form-control" id="rencana" cols="60" rows="60" style="height: 100px"></textarea>
                                {{-- <input type="text" name="indikator" class="form-control"> --}}
                            </div>
                            <div class="col-12">
                                <label for="fisik">Fisik<small class="text-danger">*</small></label>
                                <input type="text" name="fisik" id="fisik" onkeypress="return hanyaAngka()"
                                    class="form-control angka" required>
                            </div>

                        </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">TUTUP</button>
                    <button type="submit" id="tombol2" class="btn btn-primary">SIMPAN</button>
                    <button type="submit" id="loading2" class="btn btn-warning" style="display: none;" readonly>
                        LOADING......
                    </button>
                </div>
                </form>
            </div>
        </div>
    </div>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.js"></script>
    <script>
        if (jQuery().select2) {
            $(".select2").select2({
                theme: 'bootstrap4'
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



        // function hapus(id, nama) {
        //     swal({
        //             title: 'Anda Yakin Ingin Menghapus SUB KEGIATAN : ' + nama + '?',
        //             text: '',
        //             icon: 'warning',
        //             buttons: true,
        //             dangerMode: true,
        //         })
        //         .then((willDelete) => {
        //             if (willDelete) {

        //                 $.ajax({
        //                     url: "{{ url('') }}/hapus_sub_kegiatan",
        //                     method: "POST",
        //                     data: {
        //                         id: id,
        //                         _token: '{{ csrf_token() }}'
        //                     },
        //                     success: function(results) {
        //                         location.reload();
        //                         swal('Berhasil Menghapus Data', {
        //                             icon: 'success',
        //                         });
        //                     }
        //                 });

        //             } else {
        //                 swal('Data Batal Dihapus');
        //             }
        //         });
        // }

        function tambah_pagu(id) {
            total_pagu = $('#total_pagu').html();

            $.ajax({
                url: "{{ url('') }}/realisasi_show",
                method: "POST",
                data: {
                    id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {

                    $('#id_tambah').empty();
                    // $('#ref_urusan_id_tambah').empty();
                    // $('#ref_bidang_urusan_id_tambah').empty();
                    // $('#ref_program_id_tambah').empty();
                    // $('#ref_kegiatan_id_tambah').empty();
                    // $('#ref_sub_kegiatan_id_tambah').empty();
                    $('#nama_program').empty();
                    $('#nama_kegiatan').empty();
                    $('#nama_sub').empty();
                    $('#pagu').empty();
                    $('#pagu_sub').empty();
                    $('#target_januari').empty();
                    $('#target_februari').empty();
                    $('#target_maret').empty();
                    $('#target_april').empty();
                    $('#target_mei').empty();
                    $('#target_juni').empty();
                    $('#target_juli').empty();
                    $('#target_agustus').empty();
                    $('#target_september').empty();
                    $('#target_oktober').empty();
                    $('#target_november').empty();
                    $('#target_desember').empty();
                    $('#realisasi_januari').empty();
                    $('#realisasi_februari').empty();
                    $('#realisasi_maret').empty();
                    $('#realisasi_april').empty();
                    $('#realisasi_mei').empty();
                    $('#realisasi_juni').empty();
                    $('#realisasi_juli').empty();
                    $('#realisasi_agustus').empty();
                    $('#realisasi_september').empty();
                    $('#realisasi_oktober').empty();
                    $('#realisasi_november').empty();
                    $('#realisasi_desember').empty();
                    $('#realisasi_fisik_januari').empty();
                    $('#realisasi_fisik_februari').empty();
                    $('#realisasi_fisik_maret').empty();
                    $('#realisasi_fisik_april').empty();
                    $('#realisasi_fisik_mei').empty();
                    $('#realisasi_fisik_juni').empty();
                    $('#realisasi_fisik_juli').empty();
                    $('#realisasi_fisik_agustus').empty();
                    $('#realisasi_fisik_september').empty();
                    $('#realisasi_fisik_oktober').empty();
                    $('#realisasi_fisik_november').empty();
                    $('#realisasi_fisik_desember').empty();

                    $('#total_pagu_modal').empty();

                    $('#rencana').empty();
                    $('#permasalahan').empty();

                    $('#id_tambah').val(id);

                    $('#nama_program').html(response['nama_program']);
                    $('#nama_kegiatan').html(response['nama_kegiatan']);
                    $('#nama_sub').html(response['nama_sub']);
                    $('#pagu').html("Rp. " + response['pagu']);
                    $('#pagu_sub').val(response['pagu_sub']);
                    $('#target_januari').val(response['target_januari']);
                    $('#target_februari').val(response['target_februari']);
                    $('#target_maret').val(response['target_maret']);
                    $('#target_april').val(response['target_april']);
                    $('#target_mei').val(response['target_mei']);
                    $('#target_juni').val(response['target_juni']);
                    $('#target_juli').val(response['target_juli']);
                    $('#target_agustus').val(response['target_agustus']);
                    $('#target_september').val(response['target_september']);
                    $('#target_oktober').val(response['target_oktober']);
                    $('#target_november').val(response['target_november']);
                    $('#target_desember').val(response['target_desember']);
                    $('#realisasi_januari').val(response['realisasi_januari']);
                    $('#realisasi_februari').val(response['realisasi_februari']);
                    $('#realisasi_maret').val(response['realisasi_maret']);
                    $('#realisasi_april').val(response['realisasi_april']);
                    $('#realisasi_mei').val(response['realisasi_mei']);
                    $('#realisasi_juni').val(response['realisasi_juni']);
                    $('#realisasi_juli').val(response['realisasi_juli']);
                    $('#realisasi_agustus').val(response['realisasi_agustus']);
                    $('#realisasi_september').val(response['realisasi_september']);
                    $('#realisasi_oktober').val(response['realisasi_oktober']);
                    $('#realisasi_november').val(response['realisasi_november']);
                    $('#realisasi_desember').val(response['realisasi_desember']);
                    $('#realisasi_fisik_januari').val(response['realisasi_fisik_januari']);
                    $('#realisasi_fisik_februari').val(response['realisasi_fisik_februari']);
                    $('#realisasi_fisik_maret').val(response['realisasi_fisik_maret']);
                    $('#realisasi_fisik_april').val(response['realisasi_fisik_april']);
                    $('#realisasi_fisik_mei').val(response['realisasi_fisik_mei']);
                    $('#realisasi_fisik_juni').val(response['realisasi_fisik_juni']);
                    $('#realisasi_fisik_juli').val(response['realisasi_fisik_juli']);
                    $('#realisasi_fisik_agustus').val(response['realisasi_fisik_agustus']);
                    $('#realisasi_fisik_september').val(response['realisasi_fisik_september']);
                    $('#realisasi_fisik_oktober').val(response['realisasi_fisik_oktober']);
                    $('#realisasi_fisik_november').val(response['realisasi_fisik_november']);
                    $('#realisasi_fisik_desember').val(response['realisasi_fisik_desember']);
                    let realisasi_januari = parseInt($('#realisasi_januari').val())
                    realisasi_februari = parseInt($('#realisasi_februari').val())
                    realisasi_maret = parseInt($('#realisasi_maret').val())
                    realisasi_april = parseInt($('#realisasi_april').val())
                    realisasi_mei = parseInt($('#realisasi_mei').val())
                    realisasi_juni = parseInt($('#realisasi_juni').val())
                    realisasi_juli = parseInt($('#realisasi_juli').val())
                    realisasi_agustus = parseInt($('#realisasi_agustus').val())
                    realisasi_september = parseInt($('#realisasi_september').val())
                    realisasi_oktober = parseInt($('#realisasi_oktober').val())
                    realisasi_november = parseInt($('#realisasi_november').val())
                    realisasi_desember = parseInt($('#realisasi_desember').val())

                    if (realisasi_februari < realisasi_januari && realisasi_februari != 0) {
                        $('#text-februari').text('Realisasi Kurang Dari Bulan Sebelumnya');
                    }
                    if (realisasi_maret < realisasi_februari && realisasi_maret != 0) {
                        $('#text-maret').text('Realisasi Kurang Dari Bulan Sebelumnya');
                    }
                    if (realisasi_april < realisasi_maret && realisasi_april != 0) {
                        $('#text-april').text('Realisasi Kurang Dari Bulan Sebelumnya');
                    }
                    if (realisasi_mei < realisasi_april && realisasi_mei != 0) {
                        $('#text-mei').text('Realisasi Kurang Dari Bulan Sebelumnya');
                    }
                    if (realisasi_juni < realisasi_mei && realisasi_juni != 0) {
                        $('#text-juni').text('Realisasi Kurang Dari Bulan Sebelumnya');
                    }
                    if (realisasi_juli < realisasi_juni && realisasi_juli != 0) {
                        $('#text-juli').text('Realisasi Kurang Dari Bulan Sebelumnya');
                    }
                    if (realisasi_agustus < realisasi_juli && realisasi_agustus != 0) {
                        $('#text-agustus').text('Realisasi Kurang Dari Bulan Sebelumnya');
                    }
                    if (realisasi_september < realisasi_agustus && realisasi_september != 0) {
                        $('#text-september').text('Realisasi Kurang Dari Bulan Sebelumnya');
                    }
                    if (realisasi_oktober < realisasi_september && realisasi_oktober != 0) {
                        $('#text-oktober').text('Realisasi Kurang Dari Bulan Sebelumnya');
                    }
                    if (realisasi_november < realisasi_oktober && realisasi_november != 0) {
                        $('#text-november').text('Realisasi Kurang Dari Bulan Sebelumnya');
                    }
                    if (realisasi_desember < realisasi_november && realisasi_desember != 0) {
                        $('#text-desember').text('Realisasi Kurang Dari Bulan Sebelumnya');
                    }


                    $('#rencana').val(response['rencana']);
                    $('#permasalahan').val(response['permasalahan']);

                    $('#total_pagu_modal').val(total_pagu);
                }
            })
        }

        function tambah_realisasi(id) {

            $.ajax({
                url: "{{ url('') }}/mr_show",
                method: "POST",
                data: {
                    id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {

                    $('#id_tambah_realisasi').empty();
                    $('#nama_paket').empty();
                    $('#pagu').empty();
                    $('#pagu_kontrak_modal').empty();
                    $('#target_januari').empty();
                    $('#target_februari').empty();
                    $('#target_maret').empty();
                    $('#target_april').empty();
                    $('#target_mei').empty();
                    $('#target_juni').empty();
                    $('#target_juli').empty();
                    $('#target_agustus').empty();
                    $('#target_september').empty();
                    $('#target_oktober').empty();
                    $('#target_november').empty();
                    $('#target_desember').empty();
                    $('#realisasi_januari').empty();
                    $('#realisasi_februari').empty();
                    $('#realisasi_maret').empty();
                    $('#realisasi_april').empty();
                    $('#realisasi_mei').empty();
                    $('#realisasi_juni').empty();
                    $('#realisasi_juli').empty();
                    $('#realisasi_agustus').empty();
                    $('#realisasi_september').empty();
                    $('#realisasi_oktober').empty();
                    $('#realisasi_november').empty();
                    $('#realisasi_desember').empty();
                    $('#realisasi_fisik_januari').empty();
                    $('#realisasi_fisik_februari').empty();
                    $('#realisasi_fisik_maret').empty();
                    $('#realisasi_fisik_april').empty();
                    $('#realisasi_fisik_mei').empty();
                    $('#realisasi_fisik_juni').empty();
                    $('#realisasi_fisik_juli').empty();
                    $('#realisasi_fisik_agustus').empty();
                    $('#realisasi_fisik_september').empty();
                    $('#realisasi_fisik_oktober').empty();
                    $('#realisasi_fisik_november').empty();
                    $('#realisasi_fisik_desember').empty();

                    $('#rencana').empty();
                    $('#permasalahan').empty();

                    $('#id_tambah_realisasi').val(id);

                    $('#nama_paket').html(response['paket']);
                    $('#pagu').html("Rp. " + response['pagu']);
                    $('#pagu_kontrak_modal').html("Rp. " + response['pagu_kontrak']);
                    $('#target_januari').val(response['target_januari']);
                    $('#target_februari').val(response['target_februari']);
                    $('#target_maret').val(response['target_maret']);
                    $('#target_april').val(response['target_april']);
                    $('#target_mei').val(response['target_mei']);
                    $('#target_juni').val(response['target_juni']);
                    $('#target_juli').val(response['target_juli']);
                    $('#target_agustus').val(response['target_agustus']);
                    $('#target_september').val(response['target_september']);
                    $('#target_oktober').val(response['target_oktober']);
                    $('#target_november').val(response['target_november']);
                    $('#target_desember').val(response['target_desember']);
                    $('#realisasi_januari').val(response['realisasi_januari']);
                    $('#realisasi_februari').val(response['realisasi_februari']);
                    $('#realisasi_maret').val(response['realisasi_maret']);
                    $('#realisasi_april').val(response['realisasi_april']);
                    $('#realisasi_mei').val(response['realisasi_mei']);
                    $('#realisasi_juni').val(response['realisasi_juni']);
                    $('#realisasi_juli').val(response['realisasi_juli']);
                    $('#realisasi_agustus').val(response['realisasi_agustus']);
                    $('#realisasi_september').val(response['realisasi_september']);
                    $('#realisasi_oktober').val(response['realisasi_oktober']);
                    $('#realisasi_november').val(response['realisasi_november']);
                    $('#realisasi_desember').val(response['realisasi_desember']);
                    $('#realisasi_fisik_januari').val(response['realisasi_fisik_januari']);
                    $('#realisasi_fisik_februari').val(response['realisasi_fisik_februari']);
                    $('#realisasi_fisik_maret').val(response['realisasi_fisik_maret']);
                    $('#realisasi_fisik_april').val(response['realisasi_fisik_april']);
                    $('#realisasi_fisik_mei').val(response['realisasi_fisik_mei']);
                    $('#realisasi_fisik_juni').val(response['realisasi_fisik_juni']);
                    $('#realisasi_fisik_juli').val(response['realisasi_fisik_juli']);
                    $('#realisasi_fisik_agustus').val(response['realisasi_fisik_agustus']);
                    $('#realisasi_fisik_september').val(response['realisasi_fisik_september']);
                    $('#realisasi_fisik_oktober').val(response['realisasi_fisik_oktober']);
                    $('#realisasi_fisik_november').val(response['realisasi_fisik_november']);
                    $('#realisasi_fisik_desember').val(response['realisasi_fisik_desember']);
                    let realisasi_januari = parseInt($('#realisasi_januari').val())
                    realisasi_februari = parseInt($('#realisasi_februari').val())
                    realisasi_maret = parseInt($('#realisasi_maret').val())
                    realisasi_april = parseInt($('#realisasi_april').val())
                    realisasi_mei = parseInt($('#realisasi_mei').val())
                    realisasi_juni = parseInt($('#realisasi_juni').val())
                    realisasi_juli = parseInt($('#realisasi_juli').val())
                    realisasi_agustus = parseInt($('#realisasi_agustus').val())
                    realisasi_september = parseInt($('#realisasi_september').val())
                    realisasi_oktober = parseInt($('#realisasi_oktober').val())
                    realisasi_november = parseInt($('#realisasi_november').val())
                    realisasi_desember = parseInt($('#realisasi_desember').val())

                    if (realisasi_februari < realisasi_januari && realisasi_februari != 0) {
                        $('#text-februari').text('Realisasi Kurang Dari Bulan Sebelumnya');
                    }
                    if (realisasi_maret < realisasi_februari && realisasi_maret != 0) {
                        $('#text-maret').text('Realisasi Kurang Dari Bulan Sebelumnya');
                    }
                    if (realisasi_april < realisasi_maret && realisasi_april != 0) {
                        $('#text-april').text('Realisasi Kurang Dari Bulan Sebelumnya');
                    }
                    if (realisasi_mei < realisasi_april && realisasi_mei != 0) {
                        $('#text-mei').text('Realisasi Kurang Dari Bulan Sebelumnya');
                    }
                    if (realisasi_juni < realisasi_mei && realisasi_juni != 0) {
                        $('#text-juni').text('Realisasi Kurang Dari Bulan Sebelumnya');
                    }
                    if (realisasi_juli < realisasi_juni && realisasi_juli != 0) {
                        $('#text-juli').text('Realisasi Kurang Dari Bulan Sebelumnya');
                    }
                    if (realisasi_agustus < realisasi_juli && realisasi_agustus != 0) {
                        $('#text-agustus').text('Realisasi Kurang Dari Bulan Sebelumnya');
                    }
                    if (realisasi_september < realisasi_agustus && realisasi_september != 0) {
                        $('#text-september').text('Realisasi Kurang Dari Bulan Sebelumnya');
                    }
                    if (realisasi_oktober < realisasi_september && realisasi_oktober != 0) {
                        $('#text-oktober').text('Realisasi Kurang Dari Bulan Sebelumnya');
                    }
                    if (realisasi_november < realisasi_oktober && realisasi_november != 0) {
                        $('#text-november').text('Realisasi Kurang Dari Bulan Sebelumnya');
                    }
                    if (realisasi_desember < realisasi_november && realisasi_desember != 0) {
                        $('#text-desember').text('Realisasi Kurang Dari Bulan Sebelumnya');
                    }


                    $('#rencana').val(response['rencana']);
                    $('#permasalahan').val(response['permasalahan']);
                }
            })
        }

        var desa_latitude = `-2.786424597331654`
        var desa_longitude = `115.26619201875089`
        var curLocation = [0, 0];
        if (curLocation[0] == 0 && curLocation[1] == 0) {
            curLocation = [desa_latitude, desa_longitude];
        }
        const providerOSM = new GeoSearch.OpenStreetMapProvider();


        //leaflet map
        var leafletMap = L.map('leafletMap-registration', {
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
        }).setView([desa_latitude, desa_longitude], 11);

        L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(leafletMap2);

        const cari = new GeoSearch.GeoSearchControl({
            provider: providerOSM,
            style: 'bar',
            searchLabel: 'Cari',
        });

        leafletMap2.addControl(cari);

        axios.get('/markerskpd')
            .then(response => {
                // console.log(response.data)
                const markers = response.data;

                // Tambahkan setiap marker ke peta
                markers.forEach(marker => {
                    var newMarker = L.marker([marker.latitude, marker.longitude]);
                    var currentMonth = new Date().getMonth();
                    console.log(marker.realisasi)
                    if (currentMonth === 0) {
                        var fisik = marker.realisasi.realisasi_fisik_januari;
                    } else if (currentMonth === 1) {
                        var fisik = marker.realisasi.realisasi_fisik_februari;
                    } else if (currentMonth === 2) {
                        var fisik = marker.realisasi.realisasi_fisik_maret;
                    } else if (currentMonth === 3) {
                        var fisik = marker.realisasi.realisasi_fisik_april;
                    } else if (currentMonth === 4) {
                        var fisik = marker.realisasi.realisasi_fisik_mei;
                    } else if (currentMonth === 5) {
                        var fisik = marker.realisasi.realisasi_fisik_juni;
                    } else if (currentMonth === 6) {
                        var fisik = marker.realisasi.realisasi_fisik_juli;
                    } else if (currentMonth === 7) {
                        var fisik = marker.realisasi.realisasi_fisik_agustus;
                    } else if (currentMonth === 8) {
                        var fisik = marker.realisasi.realisasi_fisik_september;
                    } else if (currentMonth === 9) {
                        var fisik = marker.realisasi.realisasi_fisik_oktober;
                    } else if (currentMonth === 10) {
                        var fisik = marker.realisasi.realisasi_fisik_november;
                    } else if (currentMonth === 11) {
                        var fisik = marker.realisasi.realisasi_fisik_desember;
                    }

                    if (currentMonth === 0) {
                        var keuangan = marker.realisasi.realisasi_januari;
                    } else if (currentMonth === 1) {
                        var keuangan = marker.realisasi.realisasi_februari;
                    } else if (currentMonth === 2) {
                        var keuangan = marker.realisasi.realisasi_maret;
                    } else if (currentMonth === 3) {
                        var keuangan = marker.realisasi.realisasi_april;
                    } else if (currentMonth === 4) {
                        var keuangan = marker.realisasi.realisasi_mei;
                    } else if (currentMonth === 5) {
                        var keuangan = marker.realisasi.realisasi_juni;
                    } else if (currentMonth === 6) {
                        var keuangan = marker.realisasi.realisasi_juli;
                    } else if (currentMonth === 7) {
                        var keuangan = marker.realisasi.realisasi_agustus;
                    } else if (currentMonth === 8) {
                        var keuangan = marker.realisasi.realisasi_september;
                    } else if (currentMonth === 9) {
                        var keuangan = marker.realisasi.realisasi_oktober;
                    } else if (currentMonth === 10) {
                        var keuangan = marker.realisasi.realisasi_november;
                    } else if (currentMonth === 11) {
                        var keuangan = marker.realisasi.realisasi_desember;
                    }

                    var pagu = marker.pagu;
                    var pagu_kontrak = marker.pagu_kontrak;
                    console.log(fisik)
                    var fisikNumber = parseInt(fisik);
                    var fisikTanpaKoma = fisikNumber.toFixed(0);

                    var keuanganNumber = parseInt(keuangan);
                    var keuanganTanpaKoma = keuanganNumber.toFixed(0);

                    var paguNumber = parseInt(pagu);
                    var paguTanpaKoma = paguNumber.toFixed(0);

                    var pagu_kontrakNumber = parseInt(pagu_kontrak);
                    var pagu_kontrakTanpaKoma = pagu_kontrakNumber.toFixed(0);

                    var color = 'green'; // Default color
                    if (fisik < 50) {
                        color = 'red';
                    } else if (fisik < 80) {
                        color = 'yellow';
                    }

                    var iconUrl;
                    if (fisik == 100) {
                        iconUrl =
                            'https://cdn-icons-png.flaticon.com/512/8029/8029509.png'; // Flag icon for fisik 100
                    } else {
                        iconUrl =
                            `https://maps.google.com/mapfiles/ms/icons/${color}-dot.png`; // Default colored dot icon
                    }



                    // Buat popup untuk menampilkan detail marker
                    var popupContent = `
                <p>
                    Paket : ${marker.paket}
                     <br>
                     Pelaksana : ${marker.pelaksana}
                      <br>
                      Sumber Dana : ${marker.sumber_dana}
                      <br>
                       SKPD : ${marker.skpd.name}
                      <br>
                       Pagu : Rp. ${paguTanpaKoma}
                     <br>
                      Pagu Kontrak : Rp. ${pagu_kontrakNumber}
                     <br>
                     Realisasi Fisik : ${fisikTanpaKoma}%
                     <br>
                     Realisasi Keuangan : Rp. ${keuanganTanpaKoma}
                     <br>
                       <a href="mr/detail/${marker.id}"class="btn btn-sm btn-outline-success">Detail</a>
                </p>
                <!-- Tambahkan detail lainnya sesuai kebutuhan -->
            `;
                    newMarker.bindPopup(popupContent);

                    newMarker.setIcon(L.icon({
                        iconUrl: iconUrl,
                        // shadowUrl: 'http://leafletjs.com/examples/custom-icons/leaf-shadow.png',
                        iconSize: [40, 40],
                        // shadowSize: [50, 64],
                        // iconAnchor: [22, 94],
                        // shadowAnchor: [4, 62],
                        // popupAnchor: [-3, -76]
                    }));

                    // Tambahkan marker ke peta
                    newMarker.addTo(leafletMap2);
                });
            })
            .catch(error => {
                console.error('Error fetching markers:', error);
            });

        var legend = L.control({
            position: 'topright'
        });

        legend.onAdd = function(map) {
            var div = L.DomUtil.create('div', 'legend');
            div.style.backgroundColor = 'rgba(255, 255, 255, 0.8)'; // Atur warna latar belakang legenda
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

        axios.get(
                'https://geoportal.hulusungaiselatankab.go.id/geoserver/ADMIN/ows?service=WFS&version=1.0.0&request=GetFeature&typeName=ADMIN:6306hss_batas_kecamatan_ar_630620220624102942&maxFeatures=50&outputFormat=application%2Fjson'
            )
            .then(response => {
                const geojsonFeature = response.data;

                // Menampilkan poligon pada peta
                L.geoJSON(geojsonFeature).addTo(leafletMap2);
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

        var drawnItems = new L.FeatureGroup();
        leafletMap.addLayer(drawnItems);

        var drawControl = new L.Control.Draw({
            draw: {
                polygon: {
                    allowIntersection: false,
                    showArea: true,
                    shapeOptions: {
                        color: 'red'
                    }
                },
                polyline: {
                    shapeOptions: {
                        color: 'green'
                    }
                },
                circle: false,
                rectangle: false,
                marker: false
            },
            edit: {
                featureGroup: drawnItems
            }
        });

        leafletMap.addControl(drawControl);

        function enableDrawing(shape) {
            if (shape === 'polygon') {
                drawControl.setDrawingOptions({
                    polygon: true,
                    polyline: false
                });
            } else if (shape === 'polyline') {
                drawControl.setDrawingOptions({
                    polygon: false,
                    polyline: true
                });
            }
            drawControl._toolbars.draw._modes.polygon.handler.enable();
        }

        leafletMap.on('draw:created', function(e) {
            var type = e.layerType;
            var layer = e.layer;
            var coordinates = layer.getLatLngs();
            drawnItems.addLayer(layer);

            // Ubah koordinat menjadi format yang sesuai untuk disimpan di dalam textarea form
            var formattedCoordinates = JSON.stringify(coordinates);

            // Masukkan koordinat ke dalam textarea form
            document.getElementById('coordinates').value = formattedCoordinates;
        });
    </script>
@endsection
