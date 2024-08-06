@extends('layouts.master')

@section('content')
    @include('layouts.navbar')

    <main class="app-main">
        <div class="app-content-header">
            <div class="app-content-header d-flex justify-content-between align-items-center">
                <h1 class="mb-0">Payment Links</h1>
                <a href="{{"/payment-links/create"}}">
                    <button class="btn btn-lg btn-primary">
                        Create Payment Link
                    </button>
                </a>
            </div>
        </div>
        <div class="app-content">
            <div class="container-fluid">
                <div class="card mb-4" style="min-height: 600px">
                    <div class="card-header">
                        <form action="{{route('payment-links')}}" method="get">
                            <div class="d-flex justify-content-between align-items-center ">
                                <div class="d-flex align-items-center gap-5">
                                    <div class="d-flex gap-2 align-items-center">
                                        <div>
                                            <label for="from_date" class="form-label text-muted mb-0">From date</label>
                                            <input type="date" name="from_date" class="form-control border border-2"
                                                   id="from_date">
                                        </div>
                                        <div class="mt-4">
                                            <h2>-</h2>
                                        </div>
                                        <div>
                                            <label for="to_date" class="form-label text-muted mb-0">To date</label>
                                            <input type="date" name="to_date" class="form-control border border-2"
                                                   id="to_date">
                                        </div>
                                    </div>
                                    <div class="d-flex gap-2 align-items-center">
                                        <div>
                                            <label for="status" class="form-label text-muted mb-0">Status</label>
                                            <select name="status" class="form-control form-select" id="status">
                                                <option value="">Choose Status</option>
                                                <option value="PENDING">Pending</option>
                                                <option value="PAID">Paid</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex gap-5 col-5">
                                    <select name="search_by" class="col form-control form-select" id="search-by">
                                        <option value="">Search By</option>
                                        <option value="id">Reference ID</option>
                                        <option value="payer_name">Payer Name</option>
                                        <option value="created_at">Created At</option>
                                        <option value="amount">Amount</option>
                                    </select>
                                    <input type="search" name="search" placeholder="search..." class="col form-control">
                                    <button type="submit" class="col-2 btn btn-primary">Apply</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-body">
                        <table class="table mb-3">
                            <thead>
                            <tr>
                                <th style="width: 30%;">Reference ID</th>
                                <th>Status</th>
                                <th style="width: 18%">Date Created</th>
                                <th>Payer Name</th>
                                <th>Amount</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($paymentLinks as $paymentLink)
                                <tr class="align-middle">
                                    <td>
                                        <a class="text-decoration-none text-black" href="{{ route('payment-links.detail', $paymentLink->id) }}">
                                            {{$paymentLink->id}}
                                        </a>
                                    </td>
                                    <td>
                                        @if($paymentLink->status === "PAID")
                                            <span class="badge text-bg-primary">{{$paymentLink->status}}</span>
                                        @elseif($paymentLink->status === "PENDING")
                                            <span class="badge text-bg-warning">{{$paymentLink->status}}</span>
                                        @endif
                                    </td>
                                    <td>{{$paymentLink->created_at}}</td>
                                    <td>{{$paymentLink->payer_name}}</td>
                                    <td><span class="amount">{{$paymentLink->amount}}</span></td>
                                    <td class="d-flex flex-row gap-2">
                                        <a href="{{ route('payment-links.checkout', $paymentLink->id) }}">
                                            <button type="button" class="btn btn-primary btn-sm">Pay URL</button>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $paymentLinks->links() }}
                    </div>
                </div>
                @include('component.alert-success')
            </div>
        </div>
    </main>
    <script>
        const formatRP = (number) => {
            return new Intl.NumberFormat("id-ID", {
                currency: "IDR",
                style: "currency",
                maximumFractionDigits: 0
            }).format(number);
        }

        document.querySelectorAll('.amount').forEach(val => {
            val.innerText = formatRP(val.innerText)
        })
    </script>
@endsection
