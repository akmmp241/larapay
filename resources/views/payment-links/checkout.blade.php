@include('layouts.header')

<main class="app-main col-8 mx-auto">
    <div class="app-content p-4 row">
        <div class="col">
            <div class="d-flex align-items-center gap-4 mb-5">
                <img src="{{asset("dist/assets/img/avatar.png")}}" height="84" width="auto" alt="">
                <h3 class="text-primary-emphasis mb-0">Larapay</h3>
            </div>
            <div class="d-flex flex-column align-items-center justify-content-center mb-5">
                <h1 class="mb-0 text-primary-emphasis">IDR 15.000.000</h1>
                <p class="text-info-emphasis">BAYAR SEBELUM 20 JULI 2024 PUKUL 10:00</p>
            </div>
            <div class="d-flex justify-content-center mb-5">
                <div class="accordion col-10" id="accordionExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingThree">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                                <i class="bi bi-phone"></i>&nbsp;
                                E-Wallet
                            </button>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse collapse show" aria-labelledby="headingThree"
                             data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <div class="row gap-4 mx-auto">
                                    <div style="width: 30%;" class="card">
                                        <div class="card-body">
                                            DANA
                                        </div>
                                    </div>
                                    <div style="width: 30%;" class="card">
                                        <div class="card-body">
                                            SHOPEEPAY
                                        </div>
                                    </div>
                                    <div style="width: 30%;" class="card">
                                        <div class="card-body">
                                            OVO
                                        </div>
                                    </div>
                                    <div style="width: 30%;" class="card">
                                        <div class="card-body">
                                            Linkaja
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                <i class="bi bi-bank2"></i>&nbsp;
                                Virtual Account
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                             data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <div class="row gap-4 mx-auto">
                                    <div style="width: 30%;" class="card">
                                        <div class="card-body">
                                            BCA
                                        </div>
                                    </div>
                                    <div style="width: 30%;" class="card">
                                        <div class="card-body">
                                            MANDIRI
                                        </div>
                                    </div>
                                    <div style="width: 30%;" class="card">
                                        <div class="card-body">
                                            BRI
                                        </div>
                                    </div>
                                    <div style="width: 30%;" class="card">
                                        <div class="card-body">
                                            BSI
                                        </div>
                                    </div>
                                    <div style="width: 30%;" class="card">
                                        <div class="card-body">
                                            BNI
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingRO">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseRO" aria-expanded="false" aria-controls="collapseRO">
                                <i class="bi bi-shop"></i>&nbsp;
                                Retail Outlet
                            </button>
                        </h2>
                        <div id="collapseRO" class="accordion-collapse collapse" aria-labelledby="headingRO"
                             data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <div class="row gap-4 mx-auto">
                                    <div style="width: 30%;" class="card">
                                        <div class="card-body">
                                            Indomaret
                                        </div>
                                    </div>
                                    <div style="width: 30%;" class="card">
                                        <div class="card-body">
                                            Alfamart
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingFour">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                <i class="bi bi-qr-code-scan"></i>&nbsp;
                                QR Payments
                            </button>
                        </h2>
                        <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingOne"
                             data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <div class="row gap-4 mx-auto">
                                    <div style="width: 30%;" class="card">
                                        <div class="card-body">
                                            QRIS
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="d-flex align-items-center gap-4 mb-5">
                <div class="d-flex flex-column">
                    <h3 class="text-primary-emphasis mb-0">Ringkasan Pembayaran</h3>
                    <p class="text-info-emphasis mb-0">Transaksi id #: XXX-XXXX-XXX-XXXXXXXX</p>
                </div>
            </div>
            <div class="d-flex align-items-center gap-4 mb-4">
                <div class="col">
                    <div class="d-flex gap-5 float-end">
                        <span class="">Subtotal</span>
                        <span class="">IDR 15.000.000</span>
                    </div>
                </div>
            </div>
            <div class="d-flex align-items-center gap-4 border-top border-bottom border-2">
                <div class="col">
                    <div class="d-flex gap-5 justify-content-between align-items-center px-2">
                        <h5 class="mb-0">Jumlah Total</h5>
                        <h4 class="fw-bolder mb-0">IDR 15.000.000</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

</div>
<script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.3.0/browser/overlayscrollbars.browser.es6.min.js"
        integrity="sha256-H2VM7BKda+v2Z4+DRy69uknwxjyDRhszjXFhsL4gD3w="
        crossorigin="anonymous"></script> <!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha256-whL0tQWoY1Ku1iskqPFvmZ+CHsvmRWx/PIoEvIeWh4I="
        crossorigin="anonymous"></script> <!--end::Required Plugin(popperjs for Bootstrap 5)--><!--begin::Required Plugin(Bootstrap 5)-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha256-YMa+wAM6QkVyz999odX7lPRxkoYAan8suedu4k2Zur8="
        crossorigin="anonymous"></script> <!--end::Required Plugin(Bootstrap 5)--><!--begin::Required Plugin(AdminLTE)-->
<script
    src="{{asset("dist")}}/js/adminlte.js"></script> <!--end::Required Plugin(AdminLTE)--><!--begin::OverlayScrollbars Configure-->
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"
        integrity="sha256-ipiJrswvAR4VAx/th+6zWsdeYmVae0iJuiR+6OqHJHQ="
        crossorigin="anonymous"></script> <!-- sortablejs -->
