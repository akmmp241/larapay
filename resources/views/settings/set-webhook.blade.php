@extends('layouts.master')

@section('content')
    <main class="app-main p-4">
        <div class="app-content-header">
            <h1>Webhook Settings</h1>
        </div>
        <div class="app-content">
            <div class="col-10 card p-2 mb-5">
                <div class="card-header border-0">
                    <div class="row gap-2 justify-content-between align-self-center">
                        <h3 class="col mb-0">Set Xendit Webhook verification token</h3>
                        <h3 class="col mb-0">Information</h3>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row gap-2">
                        <div class="col">
                            <div class="mb-3">
                                <input type="text" class="form-control" placeholder="Enter your xendit webhook token">
                                <div class="form-text text-danger">Error message</div>
                            </div>
                            <button class="btn btn-primary col-3">Save</button>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <p>Get your Xendit Verification Token from <a href="https://dashboard.xendit.co/settings/developers#webhooks">https://dashboard.xendit.co/settings/developers#webhooks.</a> This token will securing all the payments</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-10 card p-2 mb-5">
                <div class="card-header border-0 mb-2">
                        <h3 class="col mb-0">Webhook URLs</h3>
                        <p class="col mb-0">Set URLs on below to xendit Payment API Webhook (Payment Request). <a
                                href="https://dashboard.xendit.co/settings/developers#webhooks">https://dashboard.xendit.co/settings/developers#webhooks</a></p>
                </div>
                <div class="card-body">
                    <div class="row align-items-center mb-4">
                        <h4 class="col-2 mb-0 fw-bolder">Payment Succeed</h4>
                        <p class="col mb-0">This URL is used to notify that a payment success.</p>
                        <div class="col card">
                            <div class="card-body p-1">
                                <button id="payment-success-btn" class="btn">
                                    <img src="{{asset("assets/clipboard.png")}}" alt="clipboard" width="24" height="24">
                                </button>
                                <span>https://yoursite.com/webhook/payment/success</span>
                            </div>
                        </div>
                    </div>
                    <div class="row align-items-center mb-4">
                        <h4 class="col-2 mb-0 fw-bolder">Payment Pending</h4>
                        <p class="col mb-0">This URL is used to notify that a payment is on pending.</p>
                        <div class="col card">
                            <div class="card-body p-1">
                                <button id="payment-pending-btn" class="btn">
                                    <img src="{{asset("assets/clipboard.png")}}" alt="clipboard" width="24" height="24">
                                </button>
                                <span>https://yoursite.com/webhook/payment/pending</span>
                            </div>
                        </div>
                    </div>
                    <div class="row align-items-center mb-4">
                        <h4 class="col-2 mb-0 fw-bolder">Payment Failed</h4>
                        <p class="col mb-0">This URL is used to notify that a payment is failed.</p>
                        <div class="col card">
                            <div class="card-body p-1">
                                <button id="payment-failed-btn" class="btn">
                                    <img src="{{asset("assets/clipboard.png")}}" alt="clipboard" width="24" height="24">
                                </button>
                                <span>https://yoursite.com/webhook/payment/failed</span>
                            </div>
                        </div>
                    </div>
                    <div class="row align-items-center mb-4">
                        <h4 class="col-2 mb-0 fw-bolder">Payment Method</h4>
                        <p class="col mb-0">This URL is used to notify that a payment method is ready to use or not.</p>
                        <div class="col card">
                            <div class="card-body p-1">
                                <button id="payment-method-btn" class="btn">
                                    <img src="{{asset("assets/clipboard.png")}}" alt="clipboard" width="24" height="24">
                                </button>
                                <span>https://yoursite.com/webhook/payment/method</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Toast success copy to clipboard --}}
        <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
            <div id="success-copy" class="toast bg-success-subtle" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-body">
                    <div class="d-flex align-items-center gap-4">
                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                        <span class="fs-6">Success copy to clipboard</span>
                    </div>
                </div>
            </div>
        </div>


        <script>
            // Toast success copy clipboard
            const success_copy_toast = document.getElementById('success-copy')


            const payment_success_btn = document.querySelector("#payment-success-btn")
            payment_success_btn.addEventListener('click', (e) => {
                navigator.clipboard.writeText(payment_success_btn.nextElementSibling.innerHTML).then(function () {
                    (new bootstrap.Toast(success_copy_toast)).show()
                })
            })

            const payment_pending_btn = document.querySelector("#payment-pending-btn")
            payment_pending_btn.addEventListener('click', (e) => {
                navigator.clipboard.writeText(payment_pending_btn.nextElementSibling.innerHTML).then(function () {
                    (new bootstrap.Toast(success_copy_toast)).show()
                })
            })

            const payment_failed_btn = document.querySelector("#payment-failed-btn")
            payment_failed_btn.addEventListener('click', (e) => {
                navigator.clipboard.writeText(payment_failed_btn.nextElementSibling.innerHTML).then(function () {
                    (new bootstrap.Toast(success_copy_toast)).show()
                })
            })

            const payment_method_btn = document.querySelector("#payment-method-btn")
            payment_method_btn.addEventListener('click', (e) => {
                navigator.clipboard.writeText(payment_method_btn.nextElementSibling.innerHTML).then(function () {
                    (new bootstrap.Toast(success_copy_toast)).show()
                })
            })
        </script>
    </main>
@endsection
