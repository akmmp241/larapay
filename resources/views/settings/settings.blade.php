@extends('layouts.master')

@section('content')
    <main class="app-main p-4">
        <div class="app-content-header">
            <h1>Settings</h1>
        </div>
        <div class="app-content">
            <div class="container-fluid mb-5">
                <a href="/settings/payment-methods" style="text-decoration: none; color: black">
                    <div class="col-4"> <!-- small box -->
                        <div class="small-box p-3 border border-dark border-2 d-flex align-items-center justify-content-between">
                            <div class="inner">
                                <h3>Default Payment Methods</h3>
                                <p>Set activated payment methods by default in your payment link</p>
                            </div>
                            <img src="{{asset("assets/arrow-right.png")}}" width="24" height="24" alt="default payment methods">
                        </div>
                    </div> <!-- ./col -->
                </a>
            </div>
            <div class="container-fluid mb-5">
                <a href="/settings/xendit/api-key" style="text-decoration: none; color: black">
                    <div class="col-4"> <!-- small box -->
                        <div class="small-box p-3 border border-dark border-2 d-flex align-items-center justify-content-between">
                            <div class="inner">
                                <h3>Xendit API Key</h3>
                                <p>Set your API key for integration with Xendit</p>
                            </div>
                            <img src="{{asset("assets/arrow-right.png")}}" width="24" height="24" alt="default payment methods">
                        </div>
                    </div> <!-- ./col -->
                </a>
            </div>
            <div class="container-fluid mb-5">
                <a href="/settings/xendit/webhook" style="text-decoration: none; color: black">
                    <div class="col-4"> <!-- small box -->
                        <div class="small-box p-3 border border-dark border-2 d-flex align-items-center justify-content-between">
                            <div class="inner">
                                <h3>Webhook Token</h3>
                                <p>Set the webhook token for security</p>
                            </div>
                            <img src="{{asset("assets/arrow-right.png")}}" width="24" height="24" alt="default payment methods">
                        </div>
                    </div> <!-- ./col -->
                </a>
            </div>
        </div>
    </main>
@endsection
