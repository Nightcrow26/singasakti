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
    </style>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-6">
                    <h4 class="card-title"> TABEL MASTER JAWABAN</h4>
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
            <div class="table-responsive">
                <table class="table table-striped" id="table">
                    <thead class="bg-gradient-primary" style="color: white;">
                        <th>
                            No
                        </th>
                        <th>
                            Indikator
                        </th>
                        <th>
                            Nilai Mandiri
                        </th>
                        <th>
                            Nilai Admin
                        </th>
                        <th>
                            Aksi
                        </th>
                    </thead>
                    <tbody>
                        @php
                            $total = 0;
                            $total_admin = 0;
                        @endphp
                        @foreach ($data as $data)
                            @php
                                // $countskpd = $data->count();
                                $map = $data->trxjawaban
                                    ->map(function ($row) {
                                        return $row->nilaiskpd->map(function ($row) {
                                            return $row->nilai;
                                        });
                                    })
                                    ->collapse()
                                    ->sum();

                                $mapadmin = $data->trxjawaban
                                    ->map(function ($row) {
                                        return $row->nilaiadmin->map(function ($row) {
                                            return $row->nilai;
                                        });
                                    })
                                    ->collapse()
                                    ->sum();

                                $nilai = $map / $count;
                                $nilaiadmin = $mapadmin / $count;
                                $total_nilai = $total += $nilai;
                                $total_nilai_admin = $total_admin += $nilaiadmin;
                            @endphp
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data->nama }}</td>
                                <td>
                                    @if ($nilai == 0)
                                        0
                                    @else
                                        {{ number_format($nilai, 2, ',', '.') }}
                                    @endif

                                </td>
                                <td>
                                    @if ($nilaiadmin == 0)
                                        0
                                    @else
                                        {{ number_format($nilaiadmin, 2, ',', '.') }}
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.spbe.detail', $data->id) }}"
                                        class="btn btn-sm btn-flat btn-primary my-2"><i class="bx bx-edit-alt"></i>
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td></td>
                            <td>Total</td>
                            <td>
                                @if ($total_nilai == 0)
                                    0
                                @else
                                    {{ number_format($total_nilai, 2, ',', '.') }}
                                @endif
                            </td>
                            <td>
                                @if ($total_nilai_admin == 0)
                                    0
                                @else
                                    {{ number_format($total_nilai_admin, 2, ',', '.') }}
                                @endif
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Rata-rata</td>
                            <td>
                                @if ($total_nilai != 0)
                                    {{ number_format($total_nilai / $countskpd, 2, ',', '.') }}
                                @else
                                    0
                                @endif
                            </td>
                            <td>
                                @if ($total_nilai_admin != 0)
                                    {{ number_format($total_nilai_admin / $countskpd, 2, ',', '.') }}
                                @else
                                    0
                                @endif
                            </td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    @include('admin.spbe.form')
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
    </script>
    <script src="{{ asset('js/admin/spbe/main.js') }}"></script>
@endsection
