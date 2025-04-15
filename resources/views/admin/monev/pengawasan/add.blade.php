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
                        Realisasi
                        <button style="float: right" type="button" onclick="tambah_realisasi('{{ $id }}')"
                            class="btn btn-sm btn-primary">
                            Tambah
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body ">

            <div class="table-responsive">
                <table class="table table-bordered table-striped header-fixed">
                    <thead style="background-color: #696cff;;">
                        <tr>
                            <th colspan="12"
                                style="color: white;text-align:center;padding-left:20px;padding-right:20px;border-spacing: 0px;white-space: nowrap;">
                                Data Proyek</th>
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
                        <td>Nama Perusahaan</td>
                        <td>:</td>
                        <td>
                            {{ $data->nama_perusahaan }}
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

            <div class="table-responsive mt-5">
                <table class="table  table-striped" id="table">
                    <thead class="bg bg-primary">
                        <tr>
                            <th
                                style="color: white;text-align:center;padding-right:100px;border-spacing: 0px;white-space: nowrap;">
                                Aksi
                            </th>
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
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($realisasi as $a)
                            <tr>
                                <td>
                                    <div class="btn-group" role="group">
                                        <button id="btnGroupDrop1" type="button"
                                            class="btn btn-sm btn-outline-secondary dropdown-toggle"
                                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="menu-icon tf-icons bx bx-cog"></i>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1" style="">
                                            <button class="dropdown-item" onclick="update_realisasi('{{ $a->id }}')">
                                                <i class='bx bxs-edit-alt'></i> Edit
                                            </button>
                                            {{-- <button class="dropdown-item" onclick="tambah_foto('{{ $a->id }}')">
                                                    <i class='bx bxs-image-add'></i> Foto
                                                </button> --}}
                                            <a href="{{ route('admin.monev.detailfoto', [$a->id]) }}"
                                                class="dropdown-item">
                                                <i class='bx bxs-low-vision'></i> Detail
                                            </a>
                                            <button class="dropdown-item" onclick="hapus('{{ $a->id }}')">
                                                <i class='bx bxs-trash'></i> Hapus
                                            </button>
                                        </div>
                                    </div>

                                </td>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ date('d-m-Y', strtotime($a->tgl_realisasi)) }}</td>
                                <td>Rp. {{ number_format($a->realisasi, 0, ',', '.') }}</td>
                                <td>{{ number_format($a->realisasi_fisik, 2, ',', '.') }}</td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <div class="modal fade" role="dialog" id="modal-tambah-realisasi" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Realisasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" id="form-tambah-realisasi" action="{{ route('admin.monev.storerealisasi') }}"
                        enctype="multipart/form-data">
                        @csrf
                        {{-- @method('PATCH') --}}
                        <div class="row">
                            <input type="hidden" id="skpd_id_realisasi" name="skpd_id">
                            <input type="hidden" id="ref_urusan_id_realisasi" name="ref_urusan_id">
                            <input type="hidden" id="ref_bidang_urusan_id_realisasi" name="ref_bidang_urusan_id">
                            <input type="hidden" id="ref_program_id_realisasi" name="ref_program_id">
                            <input type="hidden" id="ref_kegiatan_id_realisasi" name="ref_kegiatan_id">
                            <input type="hidden" id="ref_sub_kegiatan_id_realisasi" name="ref_sub_kegiatan_id">
                            <input type="hidden" id="tahun" name="tahun" value="{{ auth()->user()->tahun }}">
                            <input type="hidden" id="id_tambah_realisasi" name="trx_monev_id">

                            <div class="col-12 mt-3">
                                <div class="row">
                                    <div class="col-3"><b> PAKET PEKERJAAN </b> </div>
                                    <div style="margin-left: -50px" class="col-1">: </div>
                                    <div style="margin-left: -50px" class="col-9">
                                        <p id="nama_paket"></p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 mt-3">
                                <div class="row">
                                    <div class="col-3"><b> PAGU </b> </div>
                                    <div style="margin-left: -50px" class="col-1">: </div>
                                    <div style="margin-left: -50px" class="col-9">
                                        <p id="pagu"></p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 mt-3">
                                <div class="row">
                                    <div class="col-3"><b> PAGU KONTRAK </b> </div>
                                    <div style="margin-left: -50px" class="col-1">: </div>
                                    <div style="margin-left: -50px" class="col-9">
                                        <p id="pagu_kontrak_modal"></p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 mt-3">
                                <div class="row">
                                    <table class="table table-bordered  header-fixed">
                                        <tr style="background-color: #696cff;">
                                            <th style="color: white;text-align:center">
                                                REALISASI</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="col-12 mt-2">
                                <label for="tgl_realisasi">Tanggal Realisasi <small class="text-danger">*</small></label>
                                <input type="date" class="form-control" name="tgl_realisasi" id="tgl_realisasi"
                                    min="{{ date('Y-m-d', strtotime($data->tgl_mulai)) }}"
                                    max="{{ date('Y-m-d', strtotime($data->tgl_akhir)) }}" required>
                            </div>
                            <div class="col-12 mt-2">
                                <label for="realisasi">Realisasi Keuangan <small class="text-danger">*</small></label>
                                <input type="text" name="realisasi" id="realisasi" onkeypress="return hanyaAngka()"
                                    class="form-control angka">
                            </div>
                            <div class="col-12 mt-2">
                                <label for="realisasi_fisik">Realisasi Fisik (%) <small
                                        class="text-danger">*</small></label>
                                <input type="text" name="realisasi_fisik" id="realisasi_fisik"
                                    onkeypress="return hanyaAngka()" class="form-control angka">
                            </div>
                            <div class="col-12 mt-5">
                                <div class="row">
                                    <table class="table table-bordered  header-fixed" id="dynamic_field_lampiran">
                                        <tr style="background-color: #696cff;">
                                            <th colspan="2" style="color: white;text-align:center">
                                                FOTO
                                            </th>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="file" id="file" name="foto[]"
                                                    class="form-control file_list" required>
                                            </td>
                                            <td><button type="button" name="add_lampiran" id="add_lampiran"
                                                    class="btn btn-success">+</button>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer bg-whitesmoke br">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">TUTUP</button>
                            <button type="submit" id="tombol" class="btn btn-primary">SIMPAN</button>
                            <button type="submit" id="loading" class="btn btn-warning" style="display: none;"
                                readonly>
                                LOADING......
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" role="dialog" id="modal-tambah-edit" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Realisasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" id="form-tambah-edit" action="{{ route('admin.monev.updaterealisasi') }}"
                        enctype="multipart/form-data">
                        @csrf
                        {{-- @method('PATCH') --}}
                        <div class="row">
                            <input type="hidden" id="id_tambah_edit" name="id">
                            <input type="hidden" name="trx_monev_id" value="{{ $id }}">
                            <input type="hidden" id="skpd_id_edit" name="skpd_id">
                            <input type="hidden" name="tahun" value="{{ auth()->user()->tahun }}">
                            <div class="col-12 mt-3">
                                <div class="row">
                                    <table class="table table-bordered  header-fixed">
                                        <tr style="background-color: #696cff;">
                                            <th style="color: white;text-align:center">
                                                REALISASI</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="col-12 mt-2">
                                <label for="tgl_realisasi">Tanggal Realisasi <small class="text-danger">*</small></label>
                                <input type="date" class="form-control" name="tgl_realisasi" id="tgl_realisasi_edit"
                                    min="{{ date('Y-m-d', strtotime($data->tgl_mulai)) }}"
                                    max="{{ date('Y-m-d', strtotime($data->tgl_akhir)) }}" required>
                            </div>
                            <div class="col-12 mt-2">
                                <label for="realisasi">Realisasi Keuangan <small class="text-danger">*</small></label>
                                <input type="text" name="realisasi" id="realisasi_edit"
                                    onkeypress="return hanyaAngka()" class="form-control angka">
                            </div>
                            <div class="col-12 mt-2">
                                <label for="realisasi_fisik">Realisasi Fisik (%) <small
                                        class="text-danger">*</small></label>
                                <input type="text" name="realisasi_fisik" id="realisasi_fisik_edit"
                                    onkeypress="return hanyaAngka()" class="form-control angka">
                            </div>
                            <div class="col-12 mt-5">
                                <div class="row">
                                    <table class="table table-bordered  header-fixed" id="dynamic_field_lampiran_edit">
                                        <tr style="background-color: #696cff;">
                                            <th colspan="2" style="color: white;text-align:center">
                                                FOTO
                                            </th>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="file" id="file_edit" name="foto[]"
                                                    class="form-control file_list_edit">
                                            </td>
                                            <td><button type="button" name="add_lampiran_edit" id="add_lampiran_edit"
                                                    class="btn btn-success">+</button>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer bg-whitesmoke br">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">TUTUP</button>
                            <button type="submit" id="tombol" class="btn btn-primary">SIMPAN</button>
                            <button type="submit" id="loading" class="btn btn-warning" style="display: none;"
                                readonly>
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
        var i = 1;

        $(document).on('click', '.btn_remove_lampiran', function() {
            var button_id = $(this).attr("id");
            $('#row' + button_id + '').remove();
        });


        $('#add_lampiran').click(function() {
            i++;
            $('#dynamic_field_lampiran').append('<tr id="row' + i +
                '" class="dynamic-added"><td><input type="file" id="file" name="foto[]" class="form-control file_list" required></td><td><button type="button" name="remove" id="' +
                i + '" class="btn btn-danger btn_remove_lampiran">x</button></td></tr>');
        });

        $(document).on('click', '.btn_remove_lampiran_edit', function() {
            var button_id = $(this).attr("id");
            $('#row' + button_id + '').remove();
        });

        var i_edit = 1;
        $('#add_lampiran_edit').click(function() {
            i_edit++;
            $('#dynamic_field_lampiran_edit').append('<tr id="row' + i_edit +
                '" class="dynamic-added"><td><input type="file" id="file_edit" name="foto[]" class="form-control file_list_edit" required></td><td><button type="button" name="remove" id="' +
                i_edit + '" class="btn btn-danger btn_remove_lampiran_edit">x</button></td></tr>');
        });

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

        $('#form-tambah-edit').on('submit', function(e) {
            e.preventDefault()

            $("#form-tambah-edit").ajaxSubmit({
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
                        swal('Gagal', '', 'error');
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
                            url: "{{ url('') }}/admin/monev/deleterealisasi",
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

        function tambah_realisasi(id) {

            $.ajax({
                url: "{{ url('') }}/admin/monev/show",
                method: "POST",
                data: {
                    id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    console.log(response)
                    $("#modal-tambah-realisasi").modal('show')

                    $('#id_tambah_realisasi').empty();
                    $('#ref_urusan_id_realisasi').empty();
                    $('#ref_bidang_urusan_id_realisasi').empty();
                    $('#ref_program_id_realisasi').empty();
                    $('#ref_kegiatan_id_realisasi').empty();
                    $('#ref_sub_kegiatan_id_realisasi').empty();
                    $('#skpd_id').empty();
                    $('#nama_paket').empty();
                    $('#pagu').empty();
                    $('#pagu_kontrak_modal').empty();
                    $('#rencana').empty();
                    $('#permasalahan').empty();

                    $('#nama_paket').html(response['paket']);
                    $('#pagu').html("Rp. " + response['pagu']);
                    $('#pagu_kontrak_modal').html("Rp. " + response['pagu_kontrak']);
                    $('#id_tambah_realisasi').val(id);
                    $('#skpd_id_realisasi').val(response['skpd_id']);
                    $('#ref_urusan_id_realisasi').val(response['ref_urusan_id']);
                    $('#ref_bidang_urusan_id_realisasi').val(response['ref_bidang_urusan_id']);
                    $('#ref_program_id_realisasi').val(response['ref_program_id']);
                    $('#ref_kegiatan_id_realisasi').val(response['ref_kegiatan_id']);
                    $('#ref_sub_kegiatan_id_realisasi').val(response['ref_sub_kegiatan_id']);
                }
            })
        }

        function update_realisasi(id) {
            $.ajax({
                url: "{{ url('') }}/admin/monev/showedit",
                method: "POST",
                data: {
                    id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    console.log(response)
                    $("#modal-tambah-edit").modal('show')
                    $('#id_tambah_edit').empty();
                    $('#realisasi_edit').empty();
                    $('#realisasi_fisik_edit').empty();
                    $('#tgl_realisasi_edit').empty();
                    $('#skpd_id_edit').empty();
                    $('#skpd_id_edit').val(response['skpd_id']);
                    $('#realisasi_edit').val(response['realisasi']);
                    $('#realisasi_fisik_edit').val(response['realisasi_fisik']);
                    $('#tgl_realisasi_edit').val(response['tgl_realisasi']);
                    $('#id_tambah_edit').val(id);

                }
            })
        }

        function tambah_foto(id) {

            $.ajax({
                url: "{{ url('') }}/admin/monev/show",
                method: "POST",
                data: {
                    id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    $("#modal-tambah-foto").modal('show')

                    $('#id_tambah_foto').empty();
                    $('#skpd_id_foto').empty();

                    $('#id_tambah_foto').val(id);
                    $('#skpd_id_foto').val(response['skpd_id']);
                }
            })
        }
    </script>
    {{-- <script src="{{ asset('js/master/skpd/main.js') }}"></script> --}}
@endsection
