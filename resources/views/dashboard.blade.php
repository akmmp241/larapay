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
                    <div class="col-lg-3 col-6">
                        <div class="small-box text-bg-primary">
                            <div class="inner">
                                <h3>Rp. 1.000.000.000</h3>
                                <p>Total saldo</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="small-box text-bg-success">
                            <div class="inner">
                                <h3>Rp. 1.000.000.000</h3>
                                <p>Uang Masuk hari ini</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="small-box text-bg-danger">
                            <div class="inner">
                                <h3>Rp. 1.000.000.000</h3>
                                <p>Uang Keluar hari ini</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
                                <h3 class="card-title">Payment links</h3>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th>ID</th>
                                        <th>Amount</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr class="align-middle">
                                        <td><span class="badge text-bg-primary">Paid</span></td>
                                        <td>12/12/12 10:10:10</td>
                                        <td>23b2-n239a-12jn3a92ne-n2j3nad</td>
                                        <td>Rp. 99.000</td>
                                    </tr>
                                    <tr class="align-middle">
                                        <td><span class="badge text-bg-success">Settled</span></td>
                                        <td>12/12/12 10:10:10</td>
                                        <td>23b2-n239a-12jn3a92ne-n2j3nad</td>
                                        <td>Rp. 99.000</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid mb-5">
                <div class="row justify-content-between">
                    <div class="col-3">
                        <a href="#" style="text-decoration: none; color: black">
                            <div class="small-box border border-warning border-2">
                                <div class="inner p-4 d-flex justify-content-between align-items-center">
                                    <div>
                                        <h4>Create Payment Link</h4>
                                        <p class="mb-0">Create and share it to get your payment</p>
                                    </div>
                                    <img src="{{asset("assets/arrow-right.png")}}" width="24" height="24"
                                         alt="arrow right">
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-3">
                        <a href="#" style="text-decoration: none; color: black">
                            <div class="small-box border border-info border-2">
                                <div class="inner p-4 d-flex justify-content-between align-items-center">
                                    <div>
                                        <h4>Set Xendit API Key</h4>
                                        <p class="mb-0">Integrate with your xendit account</p>
                                    </div>
                                    <img src="{{asset("assets/arrow-right.png")}}" width="24" height="24"
                                         alt="arrow right">
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-3">
                        <a href="#" style="text-decoration: none; color: black">
                            <div class="small-box border border-primary border-2">
                                <div class="inner p-4 d-flex justify-content-between align-items-center">
                                    <div>
                                        <h4>Set Webhook</h4>
                                        <p class="mb-0">Integrete webhook for security</p>
                                    </div>
                                    <img src="{{asset("assets/arrow-right.png")}}" width="24" height="24"
                                         alt="arrow right">
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-3">
                        <a href="#" style="text-decoration: none; color: black">
                            <div class="small-box border border-success border-2">
                                <div class="inner p-4 d-flex justify-content-between align-items-center">
                                    <div>
                                        <h4>Set Payment Methods</h4>
                                        <p class="mb-0">Set the default payment methods</p>
                                    </div>
                                    <img src="{{asset("assets/arrow-right.png")}}" width="24" height="24"
                                         alt="arrow right">
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- apexcharts -->
        <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.min.js"
                integrity="sha256-+vh8GkaU7C9/wbSLIcwq82tQ2wTf44aOHA8HlBMwRI8="
                crossorigin="anonymous"></script> <!-- ChartJS -->
        <script>
            const options = {
                series: [{
                    name: "Money in",
                    data: [200_000_000, 46_000_000, 112_000_000, 79_000_000, 134_000_000]
                }],
                chart: {
                    height: 300,
                    type: 'line',
                    zoom: {
                        enabled: false
                    }
                },
                dataLabels: {
                    enabled: false
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
                    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Okt', 'Nov', 'Des'],
                }
            };

            const chart = new ApexCharts(document.querySelector("#money-in-chart"), options);
            chart.render();
        </script>
    </main>
@endsection
