@extends('layouts.master')

@section('content')
    @include('layouts.navbar')

    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <h1 class="text-center">Selamat datang Akmal</h1>
            </div>
        </div>
        <div class="app-content">
            <div class="container-fluid mb-5">
                <div class="row justify-content-between">
                    <div class="col-6 connectedSortable">
                        <div class="card mb-4">
                            <div class="card-header">
                                <h3 class="card-title">Sales Value</h3>
                            </div>
                            <div class="card-body">
                                <div id="money-in-chart"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card mb-4">
                            <div class="card-header">
                                <h3 class="card-title">5 Latest Payment Links</h3>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Status</th>
                                        <th>Date Created</th>
                                        <th>ID</th>
                                        <th>Amount</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($latestPaymentLinks as $paymentLink)
                                        <tr class="align-middle">
                                            <td>
                                                @if($paymentLink->status === "PAID")
                                                    <span class="badge text-bg-primary">{{$paymentLink->status}}</span>
                                                @elseif($paymentLink->status === "PENDING")
                                                    <span class="badge text-bg-warning">{{$paymentLink->status}}</span>
                                                @endif
                                            </td>
                                            <td>{{ $paymentLink->created_at }}</td>
                                            <td>{{ $paymentLink->id }}</td>
                                            <td><span class="amount">{{ $paymentLink->amount }}</span></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid mb-5">
                <div class="row justify-content-between">
                    <div class="col-lg-3 col-6">
                        <div class="small-box text-bg-success">
                            <div class="inner">
                                <h3>Rp. 1.000.000.000</h3>
                                <p>Uang Masuk hari ini</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- apexcharts -->
        <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.min.js"
                integrity="sha256-+vh8GkaU7C9/wbSLIcwq82tQ2wTf44aOHA8HlBMwRI8="
                crossorigin="anonymous"></script> <!-- ChartJS -->
        <script>
            const formatRP = (number) => {
                return new Intl.NumberFormat("id-ID", {
                    style: "currency",
                    currency: "IDR",
                    maximumFractionDigits: 0
                }).format(number);
            }


            document.querySelectorAll('.amount').forEach(val => {
                val.innerText = formatRP(val.innerText)
            })

            const options = {
                series: [{
                    name: "Money in",
                    data: [
                        @foreach($incomeByMonth as $income)
                                {{ $income->total . "," }}
                                @endforeach
                    ]
                }],
                chart: {
                    height: 300,
                    type: 'line',
                    zoom: {
                        enabled: false
                    }
                },
                dataLabels: {
                    enabled: false,
                },
                stroke: {
                    curve: 'straight'
                },
                title: {
                    text: 'Money in by months',
                    align: 'left'
                },
                grid: {
                    row: {
                        colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                        opacity: 1
                    },
                },
                xaxis: {
                    categories: [
                        @foreach($incomeByMonth as $income)
                            "{{ $income->month , }}",
                        @endforeach
                    ]
                },
                yaxis: {
                    labels: {
                        show: true,
                        formatter: (value) => {
                            return formatRP(value)
                        }
                    }
                }
            };

            const chart = new ApexCharts(document.querySelector("#money-in-chart"), options);
            chart.render();
        </script>
    </main>
@endsection
