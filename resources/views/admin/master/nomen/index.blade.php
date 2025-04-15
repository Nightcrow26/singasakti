@extends('layouts.app')

@section('custom_css')
    <link href='https://fonts.googleapis.com/css?family=Battambang' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.css" rel="stylesheet">
    <style>
        /* CSS yang telah Anda sediakan */
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

        /* CSS untuk memastikan Select2 muncul di atas modal */
        .modal {
            z-index: 1050 !important;
            /* Adjust as needed */
        }

        /* Ensure Select2 dropdown has higher z-index */
        .select2-container {
            z-index: 1060 !important;
            /* Adjust as needed */
        }

        .modal-backdrop {
            z-index: 1040 !important;
            /* Adjust as needed */
        }

        /* CSS untuk menyesuaikan lebar Select2 dengan modal */
        .select2-container .select2-selection--single {
            width: 100%;
            height: calc(1.5em + .75rem + 2px);
            padding: .375rem .75rem;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            border-radius: .25rem;
            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
        }

        /* CSS untuk menyesuaikan lebar dropdown Select2 dengan modal */
        .select2-container .select2-selection--single .select2-selection__arrow {
            height: calc(1.5em + .75rem + 2px);
        }

        /* CSS untuk menyesuaikan lebar dropdown Select2 dengan modal */
        .select2-container--open .select2-dropdown {
            top: calc(100% + 3px);
            left: 0;
            width: 100%;
        }
    </style>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-12">
                    <div class="alert alert-primary" role="alert">
                        TABEL MASTER NOMENKLATUR
                        {{-- <button style="float: right" type="button" data-bs-toggle="modal" data-bs-target="#modal-create"
                            class="btn btn-sm btn-primary">
                            Tambah
                        </button> --}}
                    </div>
                </div>
                <div class="col-xl-12 mb-xl-0 mb-0">
                    <div class="btn-toolbar justify-content-center" role="toolbar" aria-label="Toolbar with button groups">
                        <div class="btn-group" role="group" aria-label="First group">
                            <button type="button" data-bs-toggle="modal" data-bs-target="#modal-create"
                                class="btn btn-primary"><span class='bx bx-plus'></span>
                                Tambah Urusan
                            </button>

                            <button type="button" data-bs-toggle="modal" data-bs-target="#modal-create-bidang"
                                class="btn btn-success"><span class='bx bx-plus'></span>
                                Tambah Bidang Urusan
                            </button>

                            <button type="button" data-bs-toggle="modal" data-bs-target="#modal-create-program"
                                class="btn btn-warning"><span class='bx bx-plus'></span>
                                Tambah Program
                            </button>

                            <button type="button" data-bs-toggle="modal" data-bs-target="#modal-create-kegiatan"
                                class="btn btn-info"><span class='bx bx-plus'></span>
                                Tambah Kegiatan
                            </button>

                            <button type="button" data-bs-toggle="modal" data-bs-target="#modal-create-sub"
                                class="btn btn-danger"><span class='bx bx-plus'></span>
                                Tambah Sub Kegiatan
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body ">
            <div class="table-responsive">
                <table class="table  table-striped" id="table">
                    <thead class="bg bg-primary">
                        <th class="text-white">
                            No
                        </th>
                        <th class="text-white">
                            Kode
                        </th>
                        <th class="text-white">
                            Urusan
                        </th>
                        <th class="text-white">
                            Bidang
                        </th>
                        <th class="text-white">
                            Program
                        </th>
                        <th class="text-white">
                            Kegiatan
                        </th>
                        <th class="text-white">
                            Sub
                        </th>
                        <th class="text-white">
                            Jenis
                        </th>
                        <th class="text-white">
                            Aksi
                        </th>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @include('admin.master.nomen.form')
@endsection

@section('custom_js')
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#table').DataTable({});
        });

        function hanyaAngka(evt) {
            var charCode = (evt.which) ? evt.which : event.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57))

                return false;
            return true;
        }

        $(document).ready(function() {
            $('.select2').select2({
                theme: 'bootstrap4',
                search: true // Aktifkan pencarian
            });
        });

        $(document).ready(function() {
            new TomSelect("#urusan_id", {
                create: true,
                sortField: {
                    field: "text",
                    direction: "asc"
                }
            });
        });
        $(document).ready(function() {
            new TomSelect("#urusan_id_1", {
                create: true,
                sortField: {
                    field: "text",
                    direction: "asc"
                }
            });
        });

        $(document).ready(function() {
            new TomSelect("#urusan_id_2", {
                create: true,
                sortField: {
                    field: "text",
                    direction: "asc"
                }
            });
        });

        $(document).ready(function() {
            new TomSelect("#urusan_id_3", {
                create: true,
                sortField: {
                    field: "text",
                    direction: "asc"
                }
            });
        });

        $(document).ready(function() {
            new TomSelect("#urusan_id_4", {
                create: true,
                sortField: {
                    field: "text",
                    direction: "asc"
                }
            });
        });
    </script>
    <script src="{{ asset('js/master/nomen/main.js') }}"></script>
@endsection
