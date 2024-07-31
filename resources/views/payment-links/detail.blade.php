@extends('layouts.master')

@section('content')
    @include('layouts.navbar')

    <main class="app-main">
        <div class="app-content-header">
            <div class="app-content-header d-flex justify-content-between align-items-center">
                <h2 class="mb-0">Payment Link Details</h2>
            </div>
        </div>
        <div class="app-content">
            <div class="container-fluid">
                <div class="card col-8 mb-4">
                    <div class="card-header">
                        <div class="row">
                            <h5 class="col-3 mb-0">Transaction ID </h5>
                            <h5 class="col-2 mb-0">: </h5>
                            <h5 class="col text-muted mb-0">{{ $paymentLink->id  }}</h5>
                        </div>
                    </div>
                    <div class="card-header">
                        <div class="row">
                            <h5 class="mb-0 col-3">Xendit Payment Request ID </h5>
                            <h5 class="mb-0 col-2">: </h5>
                            <h5 class="mb-0 col">{{ $paymentLink->xendit_pr_id }}</h5>
                        </div>
                    </div>
                    <div class="card-header">
                        <div class="row">
                            <h5 class="mb-0 col-3">Status </h5>
                            <h5 class="mb-0 col-2">: </h5>
                            <h5 class="mb-0 col">
                                @if($paymentLink->status === "PAID")
                                    <span class="badge text-bg-primary">{{$paymentLink->status}}</span>
                                @elseif($paymentLink->status === "PENDING")
                                    <span class="badge text-bg-warning">{{$paymentLink->status}}</span>
                                @endif
                            </h5>
                        </div>
                    </div>
                    <div class="card-header">
                        <div class="row">
                            <h5 class="mb-0 col-3">Description </h5>
                            <h5 class="mb-0 col-2">: </h5>
                            <h5 class="mb-0 col">{{ $paymentLink->description ?? "-" }}</h5>
                        </div>
                    </div>
                    <div class="card-header">
                        <div class="row">
                            <h5 class="mb-0 col-3">Expire date </h5>
                            <h5 class="mb-0 col-2">: </h5>
                            <h5 class="mb-0 col">{{ $paymentLink->expire_date }}</h5>
                        </div>
                    </div>
                    <div class="card-header">
                        <div class="row">
                            <h5 class="mb-0 col-3">Paid at </h5>
                            <h5 class="mb-0 col-2">: </h5>
                            <h5 class="mb-0 col">{{ $paymentLink->paid_at ?? '-' }}</h5>
                        </div>
                    </div>
                    <div class="card-header">
                        <div class="row">
                            <h5 class="mb-0 col-3">Payment channel </h5>
                            <h5 class="mb-0 col-2">: </h5>
                            <h5 class="mb-0 col">{{ $paymentLink->channel_code }}</h5>
                        </div>
                    </div>
                    <div class="card-header">
                        <div class="row">
                            <h5 class="mb-0 col-3">Failure code </h5>
                            <h5 class="mb-0 col-2">: </h5>
                            <h5 class="mb-0 col">{{ $paymentLink->failure_code }}</h5>
                        </div>
                    </div>
                    <div class="card-header">
                        <div class="row">
                            <h5 class="mb-0 col-3">Customer </h5>
                            <h5 class="mb-0 col-2">: </h5>
                            <div class="mb-0 col">

                            </div>
                        </div>
                    </div>
                    <div class="card-header">
                        <div class="row">
                            <h5 class="mb-0 col-3">Created at </h5>
                            <h5 class="mb-0 col-2">: </h5>
                            <h5 class="mb-0 col">{{ $paymentLink->created_at }}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
