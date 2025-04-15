@extends('layouts.app')

@section('custom_css')
    <style>
        #chart {
            max-width: 100%;
            height: 100%;
            margin: 0px auto;

        }

        #chart2 {
            max-width: 100%;
            height: 100%;
            margin: 0px auto;
        }
    </style>
@endsection

@section('content')
    @php
        $skpd4 = 0;
        $admin4 = 0;
    @endphp
    @foreach ($domain4 as $domain4)
        @php
            $mapskpd = $domain4->aspeks
                ->map(function ($row) {
                    return $row->indikators->map(function ($row) {
                        return $row->trxjawabans->where('skpd_id', auth()->user()->skpd_id)->map(function ($row) {
                            return $row->nilaiskpd->map(function ($row) {
                                return $row->nilai;
                            });
                        });
                    });
                })
                ->collapse()
                ->collapse()
                ->collapse()
                ->sum();

            $mapadmin = $domain4->aspeks
                ->map(function ($row) {
                    return $row->indikators->map(function ($row) {
                        return $row->trxjawabans->where('skpd_id', auth()->user()->skpd_id)->map(function ($row) {
                            return $row->nilaiadmin->map(function ($row) {
                                return $row->nilai;
                            });
                        });
                    });
                })
                ->collapse()
                ->collapse()
                ->collapse()
                ->sum();

            $nilaiskpd = $mapskpd / $countindikator;
            $nilaiadmin = $mapadmin / $countindikator;

            $totalskpd4 = $skpd4 += $nilaiskpd;
            $totaladmin4 = $admin4 += $nilaiadmin;

        @endphp
    @endforeach

    {{--  <div class="row">
        <div class="col-lg-6 col-md-12 col-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="alert alert-primary" role="alert">Nilai Evaluasi Mandiri</div>
                    <h1 class="card-title mb-2">3.5</h1>
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-md-12 col-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="alert alert-primary" role="alert">Nilai Evaluasi Admin</div>
                    <h1 class="card-title mb-2">3.5</h1>
                </div>
            </div>
        </div>
    </div>  --}}
    <div class="row">
        <div class="col-lg-12 mb-4 order-0">
            <div class="card">
                <div class="card-header">
                    <p>Indeks SPBE</p>
                    <hr>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6 text-center text-sm-left" style=" margin-bottom: -50px;margin-top: -50px;">
                            <div class="card-body">
                                <div id="chart">
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="card shadow-none bg-transparent border border-primary mt-5">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="card-header text-center">
                                            <h5> Evaluasi Mandiri </h5>
                                        </div>
                                        <div class="card-body text-center">
                                            @if ($totalskpd4 != 0)
                                                <h1 style="font-size: 90px"> {{ number_format($totalskpd4, 2, ',', '.') }}
                                                </h1>
                                            @else
                                                <h1 style="font-size: 90px">0</h1>
                                            @endif

                                            @if ($totalskpd4 == 0)
                                            @elseif($totalskpd4 < 1.8)
                                                <h4> Predikat : <b>Kurang</b> </h4>
                                            @elseif ($totalskpd4 >= 1.8 && $totalskpd4 < 2.6)
                                                <h4> Predikat : <b>Cukup</b> </h4>
                                            @elseif ($totalskpd4 >= 2.6 && $totalskpd4 < 3.5)
                                                <h4> Predikat : <b>Baik</b> </h4>
                                            @elseif ($totalskpd4 >= 3.5 && $totalskpd4 < 4.2)
                                                <h4> Predikat : <b>Sangat Baik</b> </h4>
                                            @elseif ($totalskpd4 >= 4.2 && $totalskpd4 <= 5)
                                                <h4> Predikat : <b>Memuaskan</b> </h4>
                                            @elseif ($totalskpd4 >= 5)
                                                <h4> Predikat : <b>Memuaskan</b> </h4>
                                            @endif

                                        </div>

                                    </div>
                                    <div class="col-6">
                                        <div class="card-header text-center">
                                            <h5> Evaluasi Admin </h5>
                                        </div>
                                        <div class="card-body text-center">
                                            @if ($totaladmin4 != 0)
                                                <h1 style="font-size: 90px"> {{ number_format($totaladmin4, 2, ',', '.') }}
                                                </h1>
                                            @else
                                                <h1 style="font-size: 90px">0</h1>
                                            @endif

                                            @if ($totaladmin4 == 0)
                                            @elseif($totaladmin4 < 1.8)
                                                <h4> Predikat : <b>Kurang</b> </h4>
                                            @elseif ($totaladmin4 >= 1.8 && $totaladmin4 < 2.6)
                                                <h4> Predikat : <b>Cukup</b> </h4>
                                            @elseif ($totaladmin4 >= 2.6 && $totaladmin4 < 3.5)
                                                <h4> Predikat : <b>Baik</b> </h4>
                                            @elseif ($totaladmin4 >= 3.5 && $totaladmin4 < 4.2)
                                                <h4> Predikat : <b>Sangat Baik</b> </h4>
                                            @elseif ($totaladmin4 >= 4.2 && $totaladmin4 <= 5)
                                                <h4> Predikat : <b>Memuaskan</b> </h4>
                                            @elseif ($totaladmin4 >= 5)
                                                <h4> Predikat : <b>Memuaskan</b> </h4>
                                            @endif

                                        </div>

                                    </div>
                                </div>

                            </div>

                        </div>

                        <div class="col-sm-12">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="table">
                                        <thead class="bg-gradient-primary" style="color: white;">
                                            <th>
                                                No
                                            </th>
                                            <th>
                                                Domain
                                            </th>
                                            <th>
                                                Evaluasi Mandiri
                                            </th>
                                            <th>
                                                Evaluasi Admin
                                            </th>
                                        </thead>
                                        <tbody>
                                            @php
                                                $skpd = 0;
                                                $admin = 0;
                                                $x = 0;
                                            @endphp
                                            @foreach ($domain as $domain)
                                                @php
                                                    $mapskpd = $domain->aspeks
                                                        ->map(function ($row) {
                                                            return $row->indikators->map(function ($row) {
                                                                return $row->trxjawabans->where('skpd_id', auth()->user()->skpd_id)->map(function ($row) {
                                                                    return $row->nilaiskpd->map(function ($row) {
                                                                        return $row->nilai;
                                                                    });
                                                                });
                                                            });
                                                        })
                                                        ->collapse()
                                                        ->collapse()
                                                        ->collapse()
                                                        ->sum();

                                                    $mapadmin = $domain->aspeks
                                                        ->map(function ($row) {
                                                            return $row->indikators->map(function ($row) {
                                                                return $row->trxjawabans->where('skpd_id', auth()->user()->skpd_id)->map(function ($row) {
                                                                    return $row->nilaiadmin->map(function ($row) {
                                                                        return $row->nilai;
                                                                    });
                                                                });
                                                            });
                                                        })
                                                        ->collapse()
                                                        ->collapse()
                                                        ->collapse()
                                                        ->sum();

                                                    $countdomain = $domain->aspeks
                                                        ->map(function ($row) {
                                                            return $row->indikators->groupBy('domain_id');
                                                        })
                                                        ->collapse()
                                                        ->collapse()
                                                        ->count();

                                                    $nilaiskpd = $mapskpd / $countdomain;
                                                    $nilaiadmin = $mapadmin / $countdomain;

                                                    $totalskpd = $skpd += $nilaiskpd;
                                                    $totaladmin = $admin += $nilaiadmin;

                                                @endphp
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $domain->nama }}</td>
                                                    <td>
                                                        @if ($nilaiskpd != 0)
                                                            {{ number_format($nilaiskpd, 2, ',', '.') }}
                                                        @else
                                                            0
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($nilaiadmin != 0)
                                                            {{ number_format($nilaiadmin, 2, ',', '.') }}
                                                        @else
                                                            0
                                                        @endif
                                                    </td>

                                                </tr>
                                            @endforeach

                                            {{--  <tr>
                                                <td></td>
                                                <td>Total</td>
                                                <td>
                                                    @if ($totalskpd != 0)
                                                        {{ number_format($totalskpd / $countdomain, 2, ',', '.') }}
                                                    @else
                                                        0
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($totaladmin != 0)
                                                        {{ number_format($totaladmin / $countdomain, 2, ',', '.') }}
                                                    @else
                                                        0
                                                    @endif
                                                </td>
                                            </tr>  --}}

                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    @endsection

    @section('custom_js')
        <script>
            var options = {
                series: [{
                        name: 'Verifikasi Mandiri',
                        data: [
                            @foreach ($domain2 as $domain2)
                                @php
                                    $mapskpd = $domain2->aspeks
                                        ->map(function ($row) {
                                            return $row->indikators->map(function ($row) {
                                                return $row->trxjawabans->where('skpd_id', auth()->user()->skpd_id)->map(function ($row) {
                                                    return $row->nilaiskpd->map(function ($row) {
                                                        return $row->nilai;
                                                    });
                                                });
                                            });
                                        })
                                        ->collapse()
                                        ->collapse()
                                        ->collapse()
                                        ->sum();

                                    $mapadmin = $domain2->aspeks
                                        ->map(function ($row) {
                                            return $row->indikators->map(function ($row) {
                                                return $row->trxjawabans->where('skpd_id', auth()->user()->skpd_id)->map(function ($row) {
                                                    return $row->nilaiadmin->map(function ($row) {
                                                        return $row->nilai;
                                                    });
                                                });
                                            });
                                        })
                                        ->collapse()
                                        ->collapse()
                                        ->collapse()
                                        ->sum();

                                    $countdomain = $domain2->aspeks
                                        ->map(function ($row) {
                                            return $row->indikators->groupBy('domain_id');
                                        })
                                        ->collapse()
                                        ->collapse()
                                        ->count();

                                    $nilaiskpd = $mapskpd / $countdomain;
                                    $nilaiadmin = $mapadmin / $countdomain;

                                @endphp
                                {{ number_format($nilaiskpd, 2) }},
                            @endforeach
                        ],

                    },
                    {
                        name: "Verifikasi Admin",
                        data: [
                            @foreach ($domain3 as $domain3)
                                @php
                                    $mapskpd = $domain3->aspeks
                                        ->map(function ($row) {
                                            return $row->indikators->map(function ($row) {
                                                return $row->trxjawabans->where('skpd_id', auth()->user()->skpd_id)->map(function ($row) {
                                                    return $row->nilaiskpd->map(function ($row) {
                                                        return $row->nilai;
                                                    });
                                                });
                                            });
                                        })
                                        ->collapse()
                                        ->collapse()
                                        ->collapse()
                                        ->sum();

                                    $mapadmin = $domain3->aspeks
                                        ->map(function ($row) {
                                            return $row->indikators->map(function ($row) {
                                                return $row->trxjawabans->where('skpd_id', auth()->user()->skpd_id)->map(function ($row) {
                                                    return $row->nilaiadmin->map(function ($row) {
                                                        return $row->nilai;
                                                    });
                                                });
                                            });
                                        })
                                        ->collapse()
                                        ->collapse()
                                        ->collapse()
                                        ->sum();

                                    $countdomain = $domain3->aspeks
                                        ->map(function ($row) {
                                            return $row->indikators->groupBy('domain_id');
                                        })
                                        ->collapse()
                                        ->collapse()
                                        ->count();

                                    $nilaiskpd = $mapskpd / $countdomain;
                                    $nilaiadmin = $mapadmin / $countdomain;

                                @endphp
                                {{ number_format($nilaiadmin, 2) }},
                            @endforeach
                        ],
                    }
                ],
                chart: {
                    height: 350,
                    type: 'radar',
                },
                title: {
                    text: 'Indeks SPBE'
                },
                xaxis: {
                    categories: ['KEBIJAKAN', 'TATA KELOLA',
                        'MANAJEMEN', 'LAYANAN'
                    ]
                },

                yaxis: {
                    show: false,
                    showAlways: true,
                    showForNullSeries: true,
                    seriesName: undefined,
                    opposite: false,
                    reversed: false,
                    logarithmic: false,
                    logBase: 10,
                    tickAmount: 6,
                    min: 0,
                    max: 5,
                    forceNiceScale: false,
                    floating: false,
                    decimalsInFloat: undefined
                }
            };

            var chart = new ApexCharts(document.querySelector("#chart"), options);
            chart.render();
        </script>
    @endsection
