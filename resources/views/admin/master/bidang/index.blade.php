@extends('layouts.app')

@section('custom_css')
    <link href='https://fonts.googleapis.com/css?family=Battambang' rel='stylesheet'>
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
                        TABEL MASTER BIDANG
                        <button style="float: right" type="button" data-bs-toggle="modal" data-bs-target="#modal-create"
                            class="btn btn-sm btn-primary">
                            Tambah
                        </button>
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
                            Nama
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

    @include('admin.master.bidang.form')
@endsection

@section('custom_js')
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
    </script>
    <script src="{{ asset('js/master/bidang/main.js') }}"></script>
@endsection
