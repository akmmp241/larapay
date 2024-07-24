@extends('layouts.master')

@section('content')
    @include('layouts.navbar')

    <main class="app-main p-2">
        <div class="app-content-header">
            <h1>Create Payment Link</h1>
        </div>
        <div class="app-content">
            <form action="{{route('payment-links.store')}}" method="post">
                @csrf
                <div class="container-fluid d-flex flex-row w-100 justify-content-between">
                    <div class="col-6 d-flex flex-column gap-4">
                        <div class="card mb-4">
                            <div class="card-header">
                                <h3 class="card-title fw-bold">Order Details *</h3>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="reference-id" class="form-label text-muted">Reference ID *</label>
                                    <input name="id" type="text" class="form-control" value="{{$referenceId ?? ''}}"
                                           id="reference-id" required>
{{--                                    <div class="form-text text-danger">We'll never share your email with anyone else.--}}
{{--                                    </div>--}}
                                </div>
                                <div class="mb-3">
                                    <label for="amount" class="form-label text-muted">Amount *</label>
                                    <div class="input-group has-validation">
                                        <span class="input-group-text">Rp.</span>
                                        <input name="amount" type="number" class="form-control" id="amount" required>
                                    </div>
                                    {{--                                <div class="form-text text-danger">We'll never share your email with anyone else.</div>--}}
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="form-label text-muted">Description(optional)</label>
                                    <textarea name="description" class="form-control" id="description"></textarea>
                                    {{--                                <div class="form-text text-danger">We'll never share your email with anyone else.</div>--}}
                                </div>
                            </div>
                        </div>
                        <div class="card collapsed-card mb-4">
                            <div class="card-header">
                                <h3 class="card-title fw-bold">Customer Details (optional)</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse">
                                        <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                                        <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="name" class="form-label text-muted">Name</label>
                                    <input name="payer_name" type="text" class="form-control" id="name">
                                    {{--                                <div class="form-text text-danger">We'll never share your email with anyone else.</div>--}}
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label text-muted">Email</label>
                                    <input name="payer_email" type="email" class="form-control" id="email">
                                    {{--                                <div class="form-text text-danger">We'll never share your email with anyone else.</div>--}}
                                </div>
                                <div class="mb-3">
                                    <label for="payer_mobile_num" class="form-label text-muted">Mobile Number</label>
                                    <div class="input-group has-validation">
                                        <span class="input-group-text">+62</span>
                                        <input name="payer_mobile_num" type="text" class="form-control" id="payer_mobile_num">
                                    </div>
                                    {{--                                <div class="form-text text-danger">Please choose a username.</div>--}}
                                </div>
                                <div class="mb-3">
                                    <label for="mobile-number" class="form-label text-muted">Send Payment Link
                                        via</label>
                                    <div class="mb-3 form-check">
                                        <input name="send_link_via[]" type="checkbox" class="form-check-input" id="send-payment">
                                        <label class="form-check-label" for="send-payment">Email</label>
                                    </div>
                                    <div class="mb-3 form-check">
                                        <input name="send_link_via[]" type="checkbox" class="form-check-input" id="send-payment">
                                        <label class="form-check-label" for="send-payment">Whatsapp</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card collapsed-card mb-4">
                            <div class="card-header">
                                <h3 class="card-title fw-bold">Other Settings (optional)</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse">
                                        <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                                        <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="name" class="form-label text-muted">Set Expire</label>
                                    <input name="expire_date" type="datetime-local" class="form-control" id="name">
                                    {{--                                <div class="form-text text-danger">We'll never share your email with anyone else.</div>--}}
                                </div>
                                <div class="mb-3">
                                    <label for="name" class="form-label text-muted">Success Payment Redirect URL</label>
                                    <input name="success_link" type="text" class="form-control" id="name">
                                    {{--                                <div class="form-text text-danger">We'll never share your email with anyone else.</div>--}}
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label text-muted">Failed Payment Redirect URL</label>
                                    <input name="failed_link" type="email" class="form-control" id="email">
                                    {{--                                <div class="form-text text-danger">We'll never share your email with anyone else.</div>--}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-5 d-flex flex-column">
                        <div class="card mb-4">
                            <div class="card-header">
                                <h3 class="card-title fw-bold">Payment Summary</h3>
                            </div>
                            <div class="card-body">
                                <div class="row align-items-center mb-3 border-bottom border-1 pb-2">
                                    <h4 class="col fw-bold mb-0">Total Amount</h4>
                                    <h4 class="col text-end mb-0">Rp. <span id="amount-summary">0</span></h4>
                                </div>
                            </div>
                            <div class="card-footer">
                                <input type="submit" name="submit" class="btn btn-primary">
                            </div> <!--end::Footer-->
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <script>
            const formatRP = (number) => {
                return new Intl.NumberFormat("id-ID", {
                    maximumFractionDigits: 0
                }).format(number);
            }


            const inputAmount = document.getElementById("amount")
            const totalAmount = document.getElementById("amount-summary")
            inputAmount.addEventListener('input', (e) => {
                totalAmount.innerHTML = formatRP(e.target.value)
            })
        </script>

    </main>
@endsection
