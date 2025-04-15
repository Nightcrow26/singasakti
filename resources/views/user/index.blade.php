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
                <div class="col-6">
                    <h4 class="card-title"> Ganti Password</h4>
                </div>
                {{--  <div class="col-6">
                    <button style="float: right" type="button" data-bs-toggle="modal" data-bs-target="#modal-create"
                        class="btn btn-md btn-icon me-2 btn-primary">
                        <span class='bx bx-plus'></span>
                    </button>
                </div>  --}}
            </div>
        </div>
        <div class="card-body ">
            <form method="post" id="form-edit" action="{{ route('user.update') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ auth()->user()->id }}">
                <div class="form-floating">
                    <input type="text" class="form-control" placeholder="Username" aria-describedby="floatingInputHelp"
                        name="username" value="{{ auth()->user()->username }}">
                    <label for="floatingInput">Username</label>
                </div>
                <div class="form-floating mt-5">
                    <input type="password" class="form-control" placeholder="password" aria-describedby="floatingInputHelp"
                        name="password">
                    <label for="floatingInput">Password</label>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="submit" id="tombol" class="btn btn-primary">Simpan</button>
                    <button type="submit" id="loading" class="btn btn-warning" style="display: none;"
                        disabled>LOADING......</button>
                </div>
            </form>
        </div>
    </div>


    {{-- @include('skpd.spbe.form') --}}
@endsection

@section('custom_js')
    <script>
        // $(document).ready(function() {
        //     $('#table').DataTable({});
        // });

        function hanyaAngka(evt) {
            var charCode = (evt.which) ? evt.which : event.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57))

                return false;
            return true;
        }

        $('#form-edit').on('submit', function(e) {
            e.preventDefault()

            $("#form-edit").ajaxSubmit({
                beforeSend: function() {
                    $('#tombol').hide();
                    $('#loading').show();
                },
                success: function(res) {
                    if (res.status == "failed") {
                        swal('Username sudah terdaftar', '', 'error');
                        $('#tombol').show();
                        $('#loading').hide();
                    } else if (res.status = "success") {
                        // $('#table').DataTable().ajax.reload();

                        swal('Data Berhasil Di Simpan', '', 'success');
                        location.reload();
                        //set semua ke default
                        $("#form-edit input:not([name='_token']").val('')
                        $("#modal-edit").modal('hide')
                        $('#tombol').show();
                        $('#loading').hide();
                    }
                }
            })
            return true;

        })
    </script>
    {{-- <script src="{{ asset('js/skpd/spbe/main.js') }}"></script> --}}
@endsection
