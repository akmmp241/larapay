@extends('layouts.master')

@section('content')
    @include('layouts.navbar')

    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">Dashboard</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="app-content">
            <div class="container-fluid mb-5">
                <div class="row justify-content-between">
                    <div class="col-6">
                        <div class="card mb-4" id="chart" style="min-height: 400px">
                            <div class="card-header">
                                <h3 class="card-title">Money in</h3>
                            </div>
                            <div class="card-body">
                                <div id="money-in-chart"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card mb-4" id="table" style="min-height: 400px">
                            <div class="card-header">
                                <h3 class="card-title">5 Latest Payment Links</h3>
                            </div>
                            <div class="card-body p-0">
                                <table class="table">
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
                        <div class="small-box px-2 text-bg-success">
                            <div class="inner">
                                <h3 id="today-income">{{ $todayIncome->total ?? 0 }}</h3>
                                <p>Uang Masuk hari ini (telah terbayar)</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="small-box px-2 text-bg-primary">
                            <div class="inner">
                                <h3 id="this-week-income">{{ $thisWeekIncome->total ?? 0 }}</h3>
                                <p>Uang Masuk minggu ini (telah terbayar)</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="small-box px-2 text-bg-warning">
                            <div class="inner">
                                <h3 id="">{{ $pendingTransaction }}</h3>
                                <p>Jumlah transaksi pending</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="small-box px-2 text-bg-danger">
                            <div class="inner">
                                <h3 id="">{{ $expireToday ?? 0 }}</h3>
                                <p>Jumlah transaksi yang akan expire hari ini</p>
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

            const todayIncome = document.getElementById('today-income')
            todayIncome.innerText = formatRP(todayIncome.innerText)

            const thisWeekIncome = document.getElementById('this-week-income')
            thisWeekIncome.innerText = formatRP(thisWeekIncome.innerText)

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
                }, {
                    name: "Pending money",
                    data: [
                        @foreach($pendingIncome as $income)
                            {{ $income->total . "," }}
                        @endforeach
                    ]
                }],
                chart: {
                    height: 300,
                    type: 'area',
                    toolbar: false
                },
                dataLabels: {
                    enabled: false,
                },
                stroke: {
                    curve: 'smooth'
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
                        @if(sizeof($incomeByMonth) > sizeof($pendingIncome))
                            @foreach($incomeByMonth as $income)
                                "{{ $income->month , }}",
                            @endforeach
                        @else
                            @foreach($pendingIncome as $income)
                                "{{ $income->month , }}",
                            @endforeach
                        @endif
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
