@extends('layouts.master')

@section('content')
    <main class="app-main p-4">
        <div class="app-content-header">
            <h1>Set Xendit API Key</h1>
            <p>Set the activated payment methods by default in your payment links</p>
        </div>
        <div class="app-content">
            <form>
                <button class="col-1 btn btn-primary mb-3">Save</button>
                <div class="accordion col-5 border border-3" id="accordionExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="panelsStayOpen-headingEwallet">
                            <button class="accordion-button fw-bolder" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#panelsStayOpen-collapseEwallet" aria-expanded="true"
                                    aria-controls="panelsStayOpen-collapseEwallet">
                                EWallet
                            </button>
                        </h2>
                        <div id="panelsStayOpen-collapseEwallet" class="accordion-collapse collapse show"
                             aria-labelledby="panelsStayOpen-headingEwallet">
                            <div class="accordion-body">
                                <div class="mb-3">
                                    <div class="mb-3 form-check">
                                        <input type="checkbox" class="form-check-input" id="dana">
                                        <label class="form-check-label" for="dana">Dana</label>
                                    </div>
                                    <div class="mb-3 form-check">
                                        <input type="checkbox" class="form-check-input" id="linkaja">
                                        <label class="form-check-label" for="linkaja">Linkaja</label>
                                    </div>
                                    <div class="mb-3 form-check">
                                        <input type="checkbox" class="form-check-input" id="ovo">
                                        <label class="form-check-label" for="ovo">OVO</label>
                                    </div>
                                    <div class="mb-3 form-check">
                                        <input type="checkbox" class="form-check-input" id="shopeepay">
                                        <label class="form-check-label" for="shopeepay">ShopeePay</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="panelsStayOpen-headingVA">
                            <button class="accordion-button fw-bolder" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#panelsStayOpen-collapseVA" aria-expanded="true"
                                    aria-controls="panelsStayOpen-collapseVA">
                                Virtual Account
                            </button>
                        </h2>
                        <div id="panelsStayOpen-collapseVA" class="accordion-collapse collapse show"
                             aria-labelledby="panelsStayOpen-headingVA">
                            <div class="accordion-body">
                                <div class="mb-3">
                                    <div class="mb-3 form-check">
                                        <input type="checkbox" class="form-check-input" id="bjb">
                                        <label class="form-check-label" for="bjb">BJB</label>
                                    </div>
                                    <div class="mb-3 form-check">
                                        <input type="checkbox" class="form-check-input" id="bnc">
                                        <label class="form-check-label" for="bnc">BNC</label>
                                    </div>
                                    <div class="mb-3 form-check">
                                        <input type="checkbox" class="form-check-input" id="cimb">
                                        <label class="form-check-label" for="cimb">CIMB</label>
                                    </div>
                                    <div class="mb-3 form-check">
                                        <input type="checkbox" class="form-check-input" id="permata">
                                        <label class="form-check-label" for="permata">Permata</label>
                                    </div>
                                    <div class="mb-3 form-check">
                                        <input type="checkbox" class="form-check-input" id="mandiri">
                                        <label class="form-check-label" for="mandiri">Mandiri</label>
                                    </div>
                                    <div class="mb-3 form-check">
                                        <input type="checkbox" class="form-check-input" id="sahabat-sampoerna">
                                        <label class="form-check-label" for="sahabat-sampoerna">Sahabat Sampoerna</label>
                                    </div>
                                    <div class="mb-3 form-check">
                                        <input type="checkbox" class="form-check-input" id="bca">
                                        <label class="form-check-label" for="bca">BCA</label>
                                    </div>
                                    <div class="mb-3 form-check">
                                        <input type="checkbox" class="form-check-input" id="bri">
                                        <label class="form-check-label" for="bri">BRI</label>
                                    </div>
                                    <div class="mb-3 form-check">
                                        <input type="checkbox" class="form-check-input" id="bsi">
                                        <label class="form-check-label" for="bsi">BSI</label>
                                    </div>
                                    <div class="mb-3 form-check">
                                        <input type="checkbox" class="form-check-input" id="bni">
                                        <label class="form-check-label" for="bni">BNI</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="panelsStayOpen-headingOTC">
                            <button class="accordion-button fw-bolder" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#panelsStayOpen-collapseOTC" aria-expanded="true"
                                    aria-controls="panelsStayOpen-collapseOTC">
                                Over The Counter
                            </button>
                        </h2>
                        <div id="panelsStayOpen-collapseOTC" class="accordion-collapse collapse show"
                             aria-labelledby="panelsStayOpen-headingOTC">
                            <div class="accordion-body">
                                <div class="mb-3">
                                    <div class="mb-3 form-check">
                                        <input type="checkbox" class="form-check-input" id="indomaret">
                                        <label class="form-check-label" for="indomaret">Indomaret</label>
                                    </div>
                                    <div class="mb-3 form-check">
                                        <input type="checkbox" class="form-check-input" id="almamart">
                                        <label class="form-check-label" for="almamart">Alfamart</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="panelsStayOpen-headingQR">
                            <button class="accordion-button fw-bolder" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#panelsStayOpen-collapseQR" aria-expanded="true"
                                    aria-controls="panelsStayOpen-collapseQR">
                                QRCode (QRIS)
                            </button>
                        </h2>
                        <div id="panelsStayOpen-collapseQR" class="accordion-collapse collapse show"
                             aria-labelledby="panelsStayOpen-headingQR">
                            <div class="accordion-body">
                                <div class="mb-3">
                                    <div class="mb-3 form-check">
                                        <input type="checkbox" class="form-check-input" id="qris">
                                        <label class="form-check-label" for="qris">QRIS</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="panelsStayOpen-headingDD">
                            <button class="accordion-button fw-bolder" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#panelsStayOpen-collapseDD" aria-expanded="true"
                                    aria-controls="panelsStayOpen-collapseDD">
                                Direct Debit
                            </button>
                        </h2>
                        <div id="panelsStayOpen-collapseDD" class="accordion-collapse collapse show"
                             aria-labelledby="panelsStayOpen-headingDD">
                            <div class="accordion-body">
                                <div class="mb-3">
                                    <div class="mb-3 form-check">
                                        <input type="checkbox" class="form-check-input" id="bri-dd">
                                        <label class="form-check-label" for="bri-dd">BRI Direct Debit</label>
                                    </div>
                                    <div class="mb-3 form-check">
                                        <input type="checkbox" class="form-check-input" id="mandiri-dd">
                                        <label class="form-check-label" for="mandiri-dd">Mandiri Direct Debit</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="panelsStayOpen-headingCC">
                            <button class="accordion-button fw-bolder" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#panelsStayOpen-collapseCC" aria-expanded="true"
                                    aria-controls="panelsStayOpen-collapseCC">
                                Credit Card
                            </button>
                        </h2>
                        <div id="panelsStayOpen-collapseCC" class="accordion-collapse collapse show"
                             aria-labelledby="panelsStayOpen-headingCC">
                            <div class="accordion-body">
                                <div class="mb-3">
                                    <div class="mb-3 form-check">
                                        <input type="checkbox" class="form-check-input" id="cc">
                                        <label class="form-check-label" for="cc">Credit Card</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </main>
@endsection