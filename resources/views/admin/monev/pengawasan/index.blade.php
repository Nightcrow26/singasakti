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
    </style>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-12">
                    <div class="alert alert-primary" role="alert">
                        PENGAWASAN RUTIN
                        <button style="float: right;margin-right:10px;" type="button" data-bs-toggle="modal"
                            data-bs-target="#modal-tambah-foto" class="btn btn-sm btn-primary">
                            Tambah
                        </button>
                        <button style="float: right;margin-right:10px;" type="button" data-bs-toggle="modal"
                            data-bs-target="#modal-download" class="btn btn-sm btn-secondary">
                            Download Contoh Formulir
                        </button>
                        @if (auth()->user()->hasRole('admin'))
                            <a href="{{ route('excel.rutin') }}" style="float: right;margin-right:10px;" type="button"
                                class="btn btn-sm btn-success">
                                Download Excel
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body ">
            @if (auth()->user()->hasRole('admin'))
                <div>
                    <form action="{{ route('admin.monev.pengawasan.index') }}" method="GET">
                        <select name="skpd_id" class="form-control select2 my-3" onchange="this.form.submit()">
                            <option value="">Pilih SOPD</option>
                            @foreach ($skpd as $skpdItem)
                                <option value="{{ $skpdItem->id }}"
                                    {{ $selectedSkpdId == $skpdItem->id ? 'selected' : '' }}>
                                    {{ $skpdItem->nama }}
                                </option>
                            @endforeach
                        </select>
                    </form>
                    {{-- <label for="skpdFilter">Filter SOPD:</label>
                    <select id="skpdFilter" class="form-control select2 my-3">
                        <option value="">Pilih SOPD</option>
                        @foreach ($skpd2 as $skpd2)
                            <option value="{{ $skpd2->id }}">{{ $skpd2->nama }}</option>
                        @endforeach
                    </select> --}}
                </div>
            @endif
            <div class="table-responsive">
                <table class="table  table-striped" id="table">
                    <thead class="bg bg-primary">
                        <tr>
                            {{-- <th style="color: white;text-align:center">
                                Aksi
                            </th> --}}
                            <th style="color: white;text-align:center"> No</th>
                            <th style="color: white;text-align:center;">
                                SOPD</th>
                            <th style="color: white;text-align:center;">
                                Paket Pekerjaan
                            </th>
                            <th style="color: white;text-align:center;">
                                U1
                            </th>
                            <th style="color: white;text-align:center;">
                                U2
                            </th>
                            <th style="color: white;text-align:center;">
                                U3
                            </th>
                            <th style="color: white;text-align:center;">
                                U4
                            </th>
                            <th style="color: white;text-align:center;">
                                U5
                            </th>
                            <th style="color: white;text-align:center;">
                                U6
                            </th>
                            <th style="color: white;text-align:center;">
                                U7
                            </th>
                            <th style="color: white;text-align:center;">
                                U8
                            </th>
                            <th style="color: white;text-align:center;">
                                U9
                            </th>
                            <th style="color: white;text-align:center;">
                                Status
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $a)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $a->skpd->nama }}</td>
                                <td>{{ $a->paket }}</td>
                                <td>
                                    @if ($a->berkas->up_1 == null)
                                        <button type="button" class="btn btn-sm rounded-pill btn-icon btn-danger">
                                            <i class='bx bx-x'></i>
                                        </button>
                                    @else
                                        <button type="button" onclick="tambah_foto('{{ $a->berkas->id }}','1')"
                                            class="btn btn-sm rounded-pill btn-icon btn-success">
                                            <i class='bx bx-check'></i>
                                        </button>
                                    @endif
                                </td>
                                <td>
                                    @if ($a->berkas->up_2 == null)
                                        <button type="button" class="btn btn-sm rounded-pill btn-icon btn-danger">
                                            <i class='bx bx-x'></i>
                                        </button>
                                    @else
                                        <button type="button" onclick="tambah_foto('{{ $a->berkas->id }}','2')"
                                            class="btn btn-sm rounded-pill btn-icon btn-success">
                                            <i class='bx bx-check'></i>
                                        </button>
                                    @endif
                                </td>
                                <td>
                                    @if ($a->berkas->up_3 == null)
                                        <button type="button" class="btn btn-sm rounded-pill btn-icon btn-danger">
                                            <i class='bx bx-x'></i>
                                        </button>
                                    @else
                                        <button type="button" onclick="tambah_foto('{{ $a->berkas->id }}','3')"
                                            class="btn btn-sm rounded-pill btn-icon btn-success">
                                            <i class='bx bx-check'></i>
                                        </button>
                                    @endif
                                </td>
                                <td>
                                    @if ($a->berkas->up_4 == null)
                                        <button type="button" class="btn btn-sm rounded-pill btn-icon btn-danger">
                                            <i class='bx bx-x'></i>
                                        </button>
                                    @else
                                        <button type="button" onclick="tambah_foto('{{ $a->berkas->id }}','4')"
                                            class="btn btn-sm rounded-pill btn-icon btn-success">
                                            <i class='bx bx-check'></i>
                                        </button>
                                    @endif
                                </td>
                                <td>
                                    @if ($a->berkas->up_5 == null)
                                        <button type="button" class="btn btn-sm rounded-pill btn-icon btn-danger">
                                            <i class='bx bx-x'></i>
                                        </button>
                                    @else
                                        <button type="button" onclick="tambah_foto('{{ $a->berkas->id }}','5')"
                                            class="btn btn-sm rounded-pill btn-icon btn-success">
                                            <i class='bx bx-check'></i>
                                        </button>
                                    @endif
                                </td>
                                <td>
                                    @if ($a->berkas->up_6 == null)
                                        <button type="button" class="btn btn-sm rounded-pill btn-icon btn-danger">
                                            <i class='bx bx-x'></i>
                                        </button>
                                    @else
                                        <button type="button" onclick="tambah_foto('{{ $a->berkas->id }}','6')"
                                            class="btn btn-sm rounded-pill btn-icon btn-success">
                                            <i class='bx bx-check'></i>
                                        </button>
                                    @endif
                                </td>
                                <td>
                                    @if ($a->berkas->up_7 == null)
                                        <button type="button" class="btn btn-sm rounded-pill btn-icon btn-danger">
                                            <i class='bx bx-x'></i>
                                        </button>
                                    @else
                                        <button type="button" onclick="tambah_foto('{{ $a->berkas->id }}','7')"
                                            class="btn btn-sm rounded-pill btn-icon btn-success">
                                            <i class='bx bx-check'></i>
                                        </button>
                                    @endif
                                </td>
                                <td>
                                    @if ($a->berkas->up_8 == null)
                                        <button type="button" class="btn btn-sm rounded-pill btn-icon btn-danger">
                                            <i class='bx bx-x'></i>
                                        </button>
                                    @else
                                        <button type="button" onclick="tambah_foto('{{ $a->berkas->id }}','8')"
                                            class="btn btn-sm rounded-pill btn-icon btn-success">
                                            <i class='bx bx-check'></i>
                                        </button>
                                    @endif
                                </td>
                                <td>
                                    @if ($a->berkas->up_9 == null)
                                        <button type="button" class="btn btn-sm rounded-pill btn-icon btn-danger">
                                            <i class='bx bx-x'></i>
                                        </button>
                                    @else
                                        <button type="button" onclick="tambah_foto('{{ $a->berkas->id }}','9')"
                                            class="btn btn-sm rounded-pill btn-icon btn-success">
                                            <i class='bx bx-check'></i>
                                        </button>
                                    @endif
                                </td>
                                <td>
                                    @php
                                        $uploads = [
                                            $a->berkas->up_1,
                                            $a->berkas->up_2,
                                            $a->berkas->up_3,
                                            $a->berkas->up_4,
                                            $a->berkas->up_5,
                                            $a->berkas->up_6,
                                            $a->berkas->up_7,
                                            $a->berkas->up_8,
                                            $a->berkas->up_9,
                                        ];
                                    @endphp

                                    @if (in_array(null, $uploads, true))
                                        <span class="badge rounded-pill bg-danger">Tidak Lengkap</span>
                                    @else
                                        <span class="badge rounded-pill bg-success">Lengkap</span>
                                    @endif

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
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

                    <form method="post" id="form-tambah-foto" action="{{ route('admin.monev.pengawasan.storefile') }}"
                        enctype="multipart/form-data">
                        @csrf
                        {{-- <div class="row">
                            <small class="text-dark fw-semibold">Surat Keterangan yang di upload</small>
                            <small class="text-dark fw-semibold">1. Bukti Dukung Tertib Usaha Jasa Konstruksi</small>
                            <small class="text-dark fw-semibold">2. Bukti Dukung Tertib Penyelenggaraan Jasa
                                Konstruksi</small>
                            <small class="text-dark fw-semibold">3. Bukti Dukung Tertib Pemanfaatan Jasa
                                Konstruksi</small>
                            <small class="text-dark fw-semibold">*File Maksimal 2 Mb</small>
                        </div> --}}
                        <div>
                            <input type="hidden" id="skpd_id_foto" name="skpd_id"
                                value="{{ auth()->user()->skpd_id }}">
                            <input type="hidden" id="tahun" name="tahun" value="{{ auth()->user()->tahun }}">
                            <div class="col-md-12 mt-4">
                                <small class="text-light fw-semibold">Upload :</small>
                                <table class="table" id="dynamic_field_lampiran">
                                    <tr>
                                        <td>
                                            <select name="berkas" id="berkas" style="width:100%" required>
                                                <option value="">Pilih Berkas</option>
                                                @foreach ($upload as $upload)
                                                    <option value="{{ $upload->id }}">U{{ $upload->id }} -
                                                        {{ $upload->nama }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <select name="trx_monev_id[]" id="trx_monev_id" style="width:100%" required
                                                multiple>
                                                <option value="">Pilih Proyek (bisa lebih dari satu)</option>
                                                @foreach ($monev as $monev)
                                                    <option value="{{ $monev->id }}">{{ $monev->paket }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="file" name="file" class="form-control" required>
                                            <small class="text-light fw-semibold">*File maksimal 2mb dan Format Pdf</small>
                                        </td>
                                    </tr>
                                </table>
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

    <div class="modal fade" role="dialog" id="modal-download" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Download</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">

                    <form method="post" id="form-download" action="{{ route('admin.monev.pengawasan.storefile') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div>
                            <div class="col-md-12 mt-4">
                                <table class="table" id="dynamic_field_lampiran">
                                    <tr>
                                        <td>
                                            U1 - Pernyataan Kesesuaian Pelaksanaan Pengadaan Barang/Jasa
                                        </td>
                                        <td>
                                            <a href="{{ asset('') }}logo/U1.doc" target="_blank" type="button"
                                                class="btn btn-sm rounded-pill btn-icon btn-success">
                                                <i class='bx bx-download'></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            U2 - Pernyataan tentang Penyusunan dan Pelaksanaan Kontrak Kerja Konstruksi
                                        </td>
                                        <td>
                                            <a href="{{ asset('') }}logo/U2.doc" target="_blank" type="button"
                                                class="btn btn-sm rounded-pill btn-icon btn-success">
                                                <i class='bx bx-download'></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            U3 - Pernyataan tentang penerapan Standar Keamanan, Keselamatan, Kesehatan, Dan
                                            Keberlanjutan Konstruksi
                                        </td>
                                        <td>
                                            <a href="{{ asset('') }}logo/U3.doc" target="_blank" type="button"
                                                class="btn btn-sm rounded-pill btn-icon btn-success">
                                                <i class='bx bx-download'></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            U4 - Pernyataan Tentang Penerapan Manajemen Mutu
                                        </td>
                                        <td>
                                            <a href="{{ asset('') }}logo/U4.doc" target="_blank" type="button"
                                                class="btn btn-sm rounded-pill btn-icon btn-success">
                                                <i class='bx bx-download'></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            U5 - Pernyataan tentang Pengelolaan dan Penggunaan Material, Peralatan, dan
                                            Teknologi
                                            Konstruksi
                                        </td>
                                        <td>
                                            <a href="{{ asset('') }}logo/U5.doc" target="_blank" type="button"
                                                class="btn btn-sm rounded-pill btn-icon btn-success">
                                                <i class='bx bx-download'></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            U6 - Pernyataan Tentang Pengelolaan dan Pemanfaatan Sumber Material Konstruksi
                                        </td>
                                        <td>
                                            <a href="{{ asset('') }}logo/U6.doc" target="_blank" type="button"
                                                class="btn btn-sm rounded-pill btn-icon btn-success">
                                                <i class='bx bx-download'></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            U7 - Pernyataan Tentang Pengelolaan dan Penggunaan Material, Peralatan, dan
                                            Teknologi
                                            Konstruksi
                                        </td>
                                        <td>
                                            <a href="{{ asset('') }}logo/U7.doc" target="_blank" type="button"
                                                class="btn btn-sm rounded-pill btn-icon btn-success">
                                                <i class='bx bx-download'></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            U8 - Pernyataan Tentang Pengelolaan dan Pemanfaatan Sumber Material Konstruksi
                                        </td>
                                        <td>
                                            <a href="{{ asset('') }}logo/U8.doc" target="_blank" type="button"
                                                class="btn btn-sm rounded-pill btn-icon btn-success">
                                                <i class='bx bx-download'></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            U9 - Pernyataan Tentang Pemeliharaan Bangunan Konstruksi
                                        </td>
                                        <td>
                                            <a href="{{ asset('') }}logo/U9.doc" target="_blank" type="button"
                                                class="btn btn-sm rounded-pill btn-icon btn-success">
                                                <i class='bx bx-download'></i>
                                            </a>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                </div>
                {{-- <div class="modal-footer bg-whitesmoke br">
                    <button type="submit" id="tombol" class="btn btn-primary">SIMPAN</button>
                    <button type="submit" id="loading" class="btn btn-warning" style="display: none;" readonly>
                        LOADING......
                    </button>
                </div> --}}
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" role="dialog" id="modal-detail" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Surat Keterangan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">

                    <form method="post" id="form-tambah-foto" action="{{ route('admin.monev.pengawasan.storefile') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="id_foto" name="id_foto">
                        <div id="pdf-container" style="display: none;">
                            <iframe id="pdf-frame" width="100%" height="500px"></iframe>
                        </div>
                </div>
                {{-- <div class="modal-footer bg-whitesmoke br">
                    <button type="submit" id="tombol" class="btn btn-primary">SIMPAN</button>
                    <button type="submit" id="loading" class="btn btn-warning" style="display: none;" readonly>
                        LOADING......
                    </button>
                </div> --}}
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
                        console.log(res)
                        swal('Gagal', res.message, 'error');
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

        $(document).ready(function() {
            new TomSelect("#trx_monev_id", {
                sortField: {
                    field: "text",
                    direction: "asc"
                },
                plugins: ['remove_button']
            });
        });

        $(document).ready(function() {
            new TomSelect("#berkas", {
                sortField: {
                    field: "text",
                    direction: "asc"
                }
            });
        });


        function tambah_foto(id, berkas) {

            $.ajax({
                url: "{{ url('') }}/admin/pengawasan/showfile",
                method: "POST",
                data: {
                    id,
                    berkas,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    $("#modal-detail").modal('show')
                    console.log(response)
                    const fileUrl = "{{ url('') }}/storage/" + response.file;

                    // Set the src of the iframe to the file URL
                    $('#pdf-frame').attr('src', fileUrl);
                    $('#id_foto').val(response.id);
                    // Show the PDF container
                    $('#pdf-container').show();
                }
            })
        }

        function hapus() {
            var id = $('#id_foto').val();
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
                            url: "{{ url('') }}/admin/pengawasan/delete",
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
