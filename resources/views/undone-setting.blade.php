@extends('layouts.master')

@section('content')
    <main class="app-main p-4">
        <div class="app-content-header">
            <h1>Finish all settings to advance</h1>
        </div>
        <div class="app-content">
            <div class="mb-5">
                <div class="progress border rounded" style="height: 20px;">
                    <div class="progress-bar bg-primary" role="progressbar"
                         style="width: {{$progress}}%;" aria-valuenow="{{$progress}}" aria-valuemin="0" aria-valuemax="100">{{$progress}}%</div>
                </div>
            </div>
            <div class="mb-2">
                <a href="/settings/payment-methods" class="d-flex align-items-center gap-4" style="text-decoration: none; color: black">
                    <div>
                        <img src="@if(isset($settings["payment-methods"])) {{$unchecked}} @else {{$checked}} @endif" width="38" height="38" alt="checklist">
                    </div>
                    <div class="col-4"> <!-- small box -->
                        <div class="small-box p-3 border border-dark border-2 d-flex align-items-center justify-content-between">
                            <div class="inner">
                                <h3>Default Payment Methods</h3>
                                <p class="mb-0">Set activated payment methods by default in your payment link</p>
                            </div>
                            <img src="{{asset("assets/arrow-right.png")}}" width="24" height="24" alt="default payment methods">
                        </div>
                    </div> <!-- ./col -->
                </a>
            </div>
            <div class="mb-2">
                <a href="/settings/xendit/api-key" class="d-flex align-items-center gap-4" style="text-decoration: none; color: black">
                    <div>
                        <img src="@if(isset($settings["api-key"])) {{$unchecked}} @else {{$checked}} @endif" width="38" height="38" alt="checklist">
                    </div>
                    <div class="col-4"> <!-- small box -->
                        <div class="small-box p-3 border border-dark border-2 d-flex align-items-center justify-content-between">
                            <div class="inner">
                                <h3>Xendit API Key</h3>
                                <p class="mb-0">Set your API key for integration with Xendit</p>
                            </div>
                            <img src="{{asset("assets/arrow-right.png")}}" width="24" height="24" alt="default payment methods">
                        </div>
                    </div> <!-- ./col -->
                </a>
            </div>
            <div class="mb-2">
                <a href="/settings/xendit/webhook" class="d-flex align-items-center gap-4" style="text-decoration: none; color: black">
                    <div>
                        <img src="@if(isset($settings["webhook-token"])) {{$unchecked}} @else {{$checked}} @endif" width="38" height="38" alt="checklist">
                    </div>
                    <div class="col-4"> <!-- small box -->
                        <div class="small-box p-3 border border-dark border-2 d-flex align-items-center justify-content-between">
                            <div class="inner">
                                <h3>Webhook Token</h3>
                                <p class="mb-0">Set the webhook token for security</p>
                            </div>
                            <img src="{{asset("assets/arrow-right.png")}}" width="24" height="24" alt="default payment methods">
                        </div>
                    </div> <!-- ./col -->
                </a>
            </div>
            <div class="mb-5">
                <a href="/settings/redirect" class="d-flex align-items-center gap-4" style="text-decoration: none; color: black">
                    <div>
                        <img src="@if(isset($settings["success-redirect-url"])) {{$unchecked}} @else {{$checked}} @endif" width="38" height="38" alt="checklist">
                    </div>
                    <div class="col-4"> <!-- small box -->
                        <div class="small-box p-3 border border-dark border-2 d-flex align-items-center justify-content-between">
                            <div class="inner">
                                <h3>Default Redirect</h3>
                                <p class="mb-0">Set the default redirect after payment success/failed</p>
                            </div>
                            <img src="{{asset("assets/arrow-right.png")}}" width="24" height="24" alt="default payment methods">
                        </div>
                    </div> <!-- ./col -->
                </a>
            </div>
        </div>
    </main>
@endsection
