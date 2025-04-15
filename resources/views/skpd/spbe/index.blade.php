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
                    <h4 class="card-title"> KUESIONER</h4>
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
                            Nilai
                        </th>
                        <th>
                            Nilai Admin
                        </th>
                        <th>
                            Aksi
                        </th>
                        <th>
                            Verifikasi
                        </th>
                    </thead>
                    <tbody>
                        @php
                            $total = 0;
                            $totaladmin = 0;
                            $count = $data->count();
                        @endphp
                        @foreach ($data as $data)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data->nama }}</td>
                                <td>
                                    @foreach ($data->trxjawabans->where('user_id', auth()->user()->id) as $nilai)
                                        @foreach ($nilai->nilaiskpd as $nilaiskpd)
                                            @php
                                                $total_nilai = $total += $nilaiskpd->nilai;
                                            @endphp
                                            {{ $nilaiskpd->nilai }}
                                        @endforeach
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($data->trxjawabans->where('user_id', auth()->user()->id) as $nilai)
                                        @foreach ($nilai->nilaiadmin as $nilaiadmin)
                                            @php
                                                $total_nilai = $totaladmin += $nilaiadmin->nilai;
                                            @endphp
                                            {{ $nilaiadmin->nilai }}
                                        @endforeach
                                    @endforeach
                                </td>
                                <td>
                                    @forelse($data->trxjawabans->where('user_id', auth()->user()->id) as $trx)
                                        <button onclick="detail('{{ $data->id }}','{{ $trx->id }}')"
                                            data-bs-toggle="modal" data-bs-target="#modal-detail"
                                            class="btn btn-sm btn-flat btn-primary my-2"><i class="bx bx-edit-alt"></i>
                                        @empty
                                            <button onclick="add('{{ $data->id }}')" data-bs-toggle="modal"
                                                data-bs-target="#modal-create"
                                                class="btn btn-sm btn-flat btn-primary my-2"><i class="bx bx-edit-alt"></i>
                                    @endforelse
                                </td>

                                <td>
                                    @forelse($data->trxjawabans->where('user_id', auth()->user()->id) as $trx)
                                        <button onclick="verif('{{ $data->id }}','{{ $trx->id }}')"
                                            data-bs-toggle="modal" data-bs-target="#modal-verif"
                                            class="btn btn-sm btn-flat btn-success my-2"><i class='bx bx-low-vision'></i>
                                        @empty
                                    @endforelse
                                </td>

                            </tr>
                        @endforeach
                        {{-- <tr>
                            <td></td>
                            <td>Total</td>
                            <td>{{ $total }}</td>
                            <td>{{ $totaladmin }}</td>
                            <td></td>
                            <td></td>
                        </tr> --}}
                        {{-- <tr>
                            <td></td>
                            <td>Rata-rata</td>
                            <td>
                                @if ($total != 0)
                                    {{ number_format($total / $count, 2, ',', '.') }}
                                @else
                                    0
                                @endif
                            </td>
                            <td>
                                @if ($totaladmin != 0)
                                    {{ number_format($totaladmin / $count, 2, ',', '.') }}
                                @else
                                    0
                                @endif
                            </td>
                            <td></td>
                            <td></td>
                        </tr> --}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    @include('skpd.spbe.form')
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
    <script src="{{ asset('js/skpd/spbe/main.js') }}"></script>
@endsection
