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
                        PENGAWASAN TEKNIS
                        @if (auth()->user()->hasRole('admin'))
                            <a href="{{ route('excel.teknis') }}" style="float: right;margin-right:10px;" type="button"
                                class="btn btn-sm btn-success">
                                Download Excel
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body ">
            <div class="row mb-5">
                <div class="col-md-4">
                    <label for="realisasi_filter">Filter Realisasi:</label>
                    <select id="realisasi_filter" class="form-control">
                        <option value="">Semua</option>
                        <option value=">80">Realisasi > 80%</option>
                        <option value="<80">Realisasi < 80%</option>
                        <option value="<50">Realisasi < 50%</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="skpdFilter">Filter SOPD:</label>
                    <select id="skpdFilter" class="form-control select2">
                        <option value="">Pilih SOPD</option>
                        @foreach ($skpd as $skpd2)
                            <option value="{{ $skpd2->id }}">{{ $skpd2->nama }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table  table-striped" id="table">
                    <thead class="bg bg-primary">
                        <tr>
                            <th style="color: white;padding-right:30px;border-spacing: 0px;white-space: nowrap;">
                                Aksi
                            </th>
                            <th style="color: white;text-align:center"> No</th>
                            <th
                                style="color: white;padding-left:100px;padding-right:100px;border-spacing: 0px;white-space: nowrap;">
                                Paket Pekerjaan</th>
                            <th
                                style="color: white;padding-left:20px;padding-right:20px;border-spacing: 0px;white-space: nowrap;">
                                Fisik (%)</th>
                            <th
                                style="color: white;padding-left:20px;padding-right:20px;border-spacing: 0px;white-space: nowrap;">
                                Keuangan</th>
                            <th
                                style="color: white;padding-left:20px;padding-right:20px;border-spacing: 0px;white-space: nowrap;">
                                Sumber Dana</th>
                            <th
                                style="color: white;padding-left:20px;padding-right:20px;border-spacing: 0px;white-space: nowrap;">
                                Nilai Pagu (Rp)</th>
                            <th
                                style="color: white;padding-left:20px;padding-right:20px;border-spacing: 0px;white-space: nowrap;">
                                Pagu Kontrak (Rp)</th>
                            <th
                                style="color: white;padding-left:20px;padding-right:20px;border-spacing: 0px;white-space: nowrap;">
                                Tanggal Kontrak</th>
                        </tr>
                    </thead>

                </table>
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
            $('#range').daterangepicker();



        });

        var table = $('#table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: window.location.origin + '/admin/table/data',
                data: function(d) {
                    // Kirim nilai filter ke server saat permintaan data
                    d.realisasi_filter = $('#realisasi_filter').val();
                    d.skpd_id = $('#skpdFilter').val();
                }
            },
            columns: [{
                    data: 'button',
                    name: 'button'
                },
                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },

                {
                    data: 'paket',
                    name: 'paket'
                },
                {
                    data: 'realisasi_fisik',
                    name: 'realisasi_fisik'
                },
                {
                    data: 'realisasi',
                    name: 'realisasi'
                },
                {
                    data: 'sumber_dana',
                    name: 'sumber_dana'
                },
                {
                    data: 'pagu',
                    name: 'pagu'
                },
                {
                    data: 'pagu_kontrak',
                    name: 'pagu_kontrak'
                },
                {
                    data: 'tanggal',
                    name: 'tanggal'
                }
            ]
        });

        $('#realisasi_filter').on('change', function() {
            table.draw(); // Gambar ulang tabel setelah filter berubah
        });

        $('#skpdFilter').on('change', function() {
            table.draw(); // Gambar ulang tabel setelah filter berubah
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
    </script>
    {{-- <script src="{{ asset('js/master/skpd/main.js') }}"></script> --}}
@endsection
