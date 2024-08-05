@include('layouts.header')

<script>
    const formatRP = (number) => {
        return new Intl.NumberFormat("id-ID", {
            maximumFractionDigits: 0
        }).format(number);
    }

    let amount = {{$paymentLink->amount}};
    let rpFormat = formatRP(amount)
    let date = new Date("{{$paymentLink->expire_date->format('Y-M-d H:i:s')}}")
    let dateIndoFormat = new Intl.DateTimeFormat('id-ID', {
        year: "numeric",
        month: "long",
        day: "2-digit",
        hour: "2-digit",
        minute: "2-digit",
    }).format(date).toUpperCase()
</script>

<main class="app-main col-8 mx-auto">
    <div class="app-content p-4 row">
        <div class="col">
            <div class="d-flex align-items-center gap-4 mb-5">
                <img src="{{asset("dist/assets/img/avatar.png")}}" height="84" width="auto" alt="">
                <h3 class="text-primary-emphasis mb-0">Larapay</h3>
            </div>
            <div class="d-flex flex-column align-items-center justify-content-center mb-5">
                <h1 id="amount" class="mb-0 text-primary-emphasis">IDR </h1>
                <p id="expire-date" class="text-info-emphasis">BAYAR SEBELUM</p>
            </div>
            @if(session()->has('otp-bri'))
                {!! session('otp-bri') !!}
            @endif
            <form action="{{ route('charge') }}" method="post">
                @csrf
                <input type="hidden" name="id" value="{{$paymentLink->id}}">
                @isset($activatedPaymentMethods["ewallet"]["ovo"])
                    {!! $ovo !!}
                    @if(session()->has('success-page-ovo'))
                        @include('payment-links.components.' . session('success-page-ovo'))
                    @endif
                @endisset
                @isset($activatedPaymentMethods["dd"]["bri_dd"])
                    {!! $bri_dd !!}
                @endisset
                @isset($activatedPaymentMethods["cc"])
                    @include('payment-links.components.cards')
                @endisset
                @isset($activatedPaymentMethods["dd"]["bri_dd"])
                    {!! $bri_dd !!}
                @endisset
                @isset($activatedPaymentMethods["va"])
                    @if(session()->has('success-page-bank'))
                        {!! session('success-page-bank') !!}
                    @endif
                @endisset
                @isset($activatedPaymentMethods["qris"])
                    @if(session()->has('success-page-qrcode'))
                        {!! session('success-page-qrcode') !!}
                    @endif
                @endisset
                <div id="payment-methods" class="d-flex justify-content-center mb-5">
                    <div class="accordion col" id="accordionExample">
                        @isset($activatedPaymentMethods["ewallet"])
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingThree">
                                    <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#collapseThree" aria-expanded="true"
                                            aria-controls="collapseThree">
                                        <i class="bi bi-phone"></i>&nbsp;
                                        E-Wallet
                                    </button>
                                </h2>
                                <div id="collapseThree" class="accordion-collapse collapse show"
                                     aria-labelledby="headingThree"
                                     data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="row gap-4 mx-auto">
                                            @isset($activatedPaymentMethods["ewallet"]["dana"])
                                                <div style="width: 30%;" class="card">
                                                    <button type="submit" name="channel_code" value="DANA"
                                                            class="btn d-flex align-items-center justify-content-center card-body p-4 border-0"
                                                            style="cursor: pointer;">
                                                        <img src="{{asset('assets/dana.webp')}}" alt="dana"
                                                             width="120">
                                                    </button>
                                                </div>
                                            @endisset
                                            @isset($activatedPaymentMethods["ewallet"]["shopeepay"])
                                                <div style="width: 30%;" class="card">
                                                    <button type="submit" name="channel_code" value="SHOPEEPAY"
                                                            class="btn d-flex align-items-center justify-content-center card-body p-4 border-0"
                                                            style="cursor: pointer;">
                                                        <img src="{{asset('assets/shopeepay.png')}}" alt="shopeepay"
                                                             width="80">
                                                    </button>
                                                </div>
                                            @endisset
                                            @isset($activatedPaymentMethods["ewallet"]["ovo"])
                                                <div style="width: 30%;" class="card">
                                                    <button type="button" id="ovo"
                                                            class="btn d-flex align-items-center justify-content-center card-body p-4 border-0"
                                                            style="cursor: pointer;">
                                                        <img src="{{asset('assets/ovo.png')}}" alt="ovo" width="25">
                                                    </button>
                                                </div>
                                            @endisset
                                            @isset($activatedPaymentMethods["ewallet"]["linkaja"])
                                                <div style="width: 30%;" class="card">
                                                    <button type="submit" name="channel_code" value="LINKAJA"
                                                            class="btn d-flex align-items-center justify-content-center card-body p-4 border-0"
                                                            style="cursor: pointer;">
                                                        <img src="{{asset('assets/linkaja.png')}}" alt="linkaja"
                                                             width="30">
                                                    </button>
                                                </div>
                                            @endisset
                                            @isset($activatedPaymentMethods["ewallet"]["astrapay"])
                                                <div style="width: 30%;" class="card">
                                                    <button type="submit" name="channel_code" value="ASTRAPAY"
                                                            class="btn d-flex align-items-center justify-content-center card-body p-4 border-0"
                                                            style="cursor: pointer;">
                                                        <img src="{{asset('assets/astrapay.png')}}" alt="astrapay"
                                                             width="40">
                                                    </button>
                                                </div>
                                            @endisset
                                            @isset($activatedPaymentMethods["ewallet"]["ovo"])
                                                <div style="width: 30%;" class="card">
                                                    <button type="submit" name="channel_code" value="JENIUSPAY"
                                                            class="btn d-flex align-items-center justify-content-center card-body p-4 border-0"
                                                            style="cursor: pointer;">
                                                        <img src="{{asset('assets/jenius.png')}}" alt="jeniuspay"
                                                             width="60">
                                                    </button>
                                                </div>
                                            @endisset
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endisset
                        @isset($activatedPaymentMethods["va"])
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTwo">
                                    <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#collapseTwo" aria-expanded="false"
                                            aria-controls="collapseTwo">
                                        <i class="bi bi-bank2"></i>&nbsp;
                                        Virtual Account
                                    </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse"
                                     aria-labelledby="headingTwo"
                                     data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="row gap-4 mx-auto">
                                            @isset($activatedPaymentMethods["va"]["bca"])
                                                <div style="width: 30%;" class="card">
                                                    <button type="submit" name="channel_code" value="BCA"
                                                            class="btn d-flex align-items-center justify-content-center card-body p-4 border-0"
                                                            style="cursor: pointer;">
                                                        <img src="{{asset('assets/bca.png')}}" alt="dana"
                                                             width="80">
                                                    </button>
                                                </div>
                                            @endisset
                                            @isset($activatedPaymentMethods["va"]["mandiri"])
                                                <div style="width: 30%;" class="card">
                                                    <button type="submit" name="channel_code" value="MANDIRI"
                                                            class="btn d-flex align-items-center justify-content-center card-body p-4 border-0"
                                                            style="cursor: pointer;">
                                                        <img src="{{asset('assets/mandiri.png')}}" alt="dana"
                                                             width="100">
                                                    </button>
                                                </div>
                                            @endisset
                                            @isset($activatedPaymentMethods["va"]["bri"])
                                                <div style="width: 30%;" class="card">
                                                    <button type="submit" name="channel_code" value="BRI"
                                                            class="btn d-flex align-items-center justify-content-center card-body p-4 border-0"
                                                            style="cursor: pointer;">
                                                        <img src="{{asset('assets/bri.png')}}" alt="dana" width="50">
                                                    </button>
                                                </div>
                                            @endisset
                                            @isset($activatedPaymentMethods["va"]["bsi"])
                                                <div style="width: 30%;" class="card">
                                                    <button type="submit" name="channel_code" value="BSI"
                                                            class="btn d-flex align-items-center justify-content-center card-body p-4 border-0"
                                                            style="cursor: pointer;">
                                                        <img src="{{asset('assets/bsi.png')}}" alt="dana" width="100">
                                                    </button>
                                                </div>
                                            @endisset
                                            @isset($activatedPaymentMethods["va"]["bni"])
                                                <div style="width: 30%;" class="card">
                                                    <button type="submit" name="channel_code" value="BNI"
                                                            class="btn d-flex align-items-center justify-content-center card-body p-4 border-0"
                                                            style="cursor: pointer;">
                                                        <img src="{{asset('assets/bni.png')}}" alt="dana" width="80">
                                                    </button>
                                                </div>
                                            @endisset
                                            @isset($activatedPaymentMethods["va"]["bjb"])
                                                <div style="width: 30%;" class="card">
                                                    <button type="submit" name="channel_code" value="BJB"
                                                            class="btn d-flex align-items-center justify-content-center card-body p-4 border-0"
                                                            style="cursor: pointer;">
                                                        <img src="{{asset('assets/bjb.png')}}" alt="dana" width="80">
                                                    </button>
                                                </div>
                                            @endisset
                                            @isset($activatedPaymentMethods["va"]["cimb"])
                                                <div style="width: 30%;" class="card">
                                                    <button type="submit" name="channel_code" value="CIMB"
                                                            class="btn d-flex align-items-center justify-content-center card-body p-4 border-0"
                                                            style="cursor: pointer;">
                                                        <img src="{{asset('assets/cimb.png')}}" alt="cimb" width=80">
                                                    </button>
                                                </div>
                                            @endisset
                                            @isset($activatedPaymentMethods["va"]["permata"])
                                                <div style="width: 30%;" class="card">
                                                    <button type="submit" name="channel_code" value="PERMATA"
                                                            class="btn d-flex align-items-center justify-content-center card-body p-4 border-0"
                                                            style="cursor: pointer;">
                                                        <img src="{{asset('assets/permata.png')}}" alt="permata"
                                                             width="80">
                                                    </button>
                                                </div>
                                            @endisset
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endisset
                        @isset($activatedPaymentMethods["otc"])
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingRO">
                                    <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#collapseRO" aria-expanded="false"
                                            aria-controls="collapseRO">
                                        <i class="bi bi-shop"></i>&nbsp;
                                        Retail Outlet
                                    </button>
                                </h2>
                                <div id="collapseRO" class="accordion-collapse collapse" aria-labelledby="headingRO"
                                     data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="row gap-4 mx-auto">
                                            @isset($activatedPaymentMethods["otc"]["indomaret"])
                                                <div style="width: 30%;" class="card">
                                                    <div class="card-body">
                                                        Indomaret
                                                    </div>
                                                </div>
                                            @endisset
                                            @isset($activatedPaymentMethods["otc"]["alfamart"])
                                                <div style="width: 30%;" class="card">
                                                    <div class="card-body">
                                                        Alfamart
                                                    </div>
                                                </div>
                                            @endisset
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endisset
                        @isset($activatedPaymentMethods["qris"])
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingFour">
                                    <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#collapseFour" aria-expanded="false"
                                            aria-controls="collapseFour">
                                        <i class="bi bi-qr-code-scan"></i>&nbsp;
                                        QR Payments
                                    </button>
                                </h2>
                                <div id="collapseFour" class="accordion-collapse collapse"
                                     aria-labelledby="headingOne"
                                     data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="row gap-4 mx-auto">
                                            <div style="width: 30%;" class="card">
                                                <button type="submit" name="channel_code" value="QRIS"
                                                        class="btn d-flex align-items-center justify-content-center card-body p-4 border-0"
                                                        style="cursor: pointer;">
                                                    <img src="{{asset('assets/qris.png')}}" alt="qris" width="80">
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endisset
                        @isset($activatedPaymentMethods["dd"])
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingFive">
                                    <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#collapseFive" aria-expanded="false"
                                            aria-controls="collapseFive">
                                        <i class="bi bi-bank"></i>&nbsp;
                                        Direct Debit
                                    </button>
                                </h2>
                                <div id="collapseFive" class="accordion-collapse collapse"
                                     aria-labelledby="headingOne"
                                     data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="row gap-4 mx-auto">
                                            @isset($activatedPaymentMethods["dd"]["bri_dd"])
                                                <div style="width: 30%;" class="card">
                                                    <button type="button" id="bri-dd"
                                                            class="btn d-flex align-items-center justify-content-center card-body p-4 border-0"
                                                            style="cursor: pointer;">
                                                        <img src="{{asset('assets/bri.png')}}" alt="bri-dd" width="40">
                                                    </button>
                                                </div>
                                            @endisset
                                            @isset($activatedPaymentMethods["dd"]["mandiri_dd"])
                                                <div style="width: 30%;" class="card">
                                                    <button type="submit" name="channel_code" value="MANDIRI_DD"
                                                            class="btn d-flex align-items-center justify-content-center card-body p-4 border-0"
                                                            style="cursor: pointer;">
                                                        <img src="{{asset('assets/mandiri.png')}}"
                                                             alt="mandiri direct debit"
                                                             width="80">
                                                    </button>
                                                </div>
                                            @endisset

                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endisset
                        @isset($activatedPaymentMethods["cc"])
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingFive">
                                    <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#collapseSix" aria-expanded="false"
                                            aria-controls="collapseSix">
                                        <i class="bi bi-credit-card"></i>&nbsp;
                                        Cards (Credit/Debit)
                                    </button>
                                </h2>
                                <div id="collapseSix" class="accordion-collapse collapse"
                                     aria-labelledby="headingOne"
                                     data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="row gap-4 mx-auto">
                                            <div style="width: 30%;" class="card">
                                                <button type="button" id="cards"
                                                        class="btn d-flex align-items-center justify-content-center card-body p-4 border-0"
                                                        style="cursor: pointer;">
                                                    <span class="h3"><i class="bi bi-credit-card-fill"></i></span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endisset
                    </div>
                </div>
            </form>
        </div>
        <div class="col-4">
            <div class="d-flex align-items-center gap-4 mb-5">
                <div class="d-flex flex-column">
                    <h3 class="text-primary-emphasis mb-0">Ringkasan Pembayaran</h3>
                    <p class="text-info-emphasis mb-0">Transaksi id #: {{$paymentLink->id}}</p>
                </div>
            </div>
            <div class="d-flex align-items-center gap-4 mb-4">
                <div class="col">
                    <div class="d-flex gap-5 float-end">
                        <span class="">Subtotal</span>
                        <span id="subtotal" class="">IDR 15.000.000</span>
                    </div>
                </div>
            </div>
            <div class="d-flex align-items-center gap-4 border-top border-bottom border-2 mb-4">
                <div class="col">
                    <div class="d-flex gap-5 justify-content-between align-items-center px-2">
                        <h5 class="mb-0">Jumlah Total</h5>
                        <h4 id="total" class="fw-bolder mb-0">IDR 15.000.000</h4>
                    </div>
                </div>
            </div>
            @include('component.alert-error')
        </div>
    </div>
</main>


<script>
    let successPageOvo = document.getElementById('success-page-ovo')
    let successPageBank = document.getElementById('success-page-bank')
    let successPageQrcode = document.getElementById('success-page-qrcode')
    let otpPageBri = document.getElementById('form-bri-otp')

    if (successPageOvo !== null) document.getElementById('payment-methods').classList.add('visually-hidden')
    if (successPageBank !== null) document.getElementById('payment-methods').classList.add('visually-hidden')
    if (successPageQrcode !== null) document.getElementById('payment-methods').classList.add('visually-hidden')
    if (successPageQrcode !== null) document.getElementById('payment-methods').classList.add('visually-hidden')
    if (otpPageBri !== null) document.getElementById('payment-methods').classList.add('visually-hidden')

    document.getElementById('amount').innerText = 'IDR ' + rpFormat
    document.getElementById('expire-date').innerText = 'BAYAR SEBELUM ' + dateIndoFormat
    document.getElementById('subtotal').innerText = 'IDR ' + rpFormat
    document.getElementById('total').innerText = 'IDR ' + rpFormat
</script>

<script>
    document.getElementById('ovo').onclick = () => {
        document.getElementById('form-ovo').classList.remove('visually-hidden')
        document.getElementById('payment-methods').classList.add('visually-hidden')
        document.getElementById('ovo-required').setAttribute('required', "true")
    }
    document.getElementById('bri-dd').onclick = () => {
        document.getElementById('form-bri-dd').classList.remove('visually-hidden')
        document.getElementById('payment-methods').classList.add('visually-hidden')
        document.getElementById('bri-dd-mobile').setAttribute('required', "true")
        document.getElementById('bri-dd-email').setAttribute('required', "true")
        document.getElementById('bri-dd-card').setAttribute('required', "true")
    }
    document.getElementById('cards').onclick = () => {
        document.getElementById('form-cards').classList.remove('visually-hidden')
        document.getElementById('payment-methods').classList.add('visually-hidden')
        document.getElementById('card_number').setAttribute('required', "true")
        document.getElementById('valid_thru').setAttribute('required', "true")
        document.getElementById('cvn').setAttribute('required', "true")
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.3.0/browser/overlayscrollbars.browser.es6.min.js"
        integrity="sha256-H2VM7BKda+v2Z4+DRy69uknwxjyDRhszjXFhsL4gD3w="
        crossorigin="anonymous"></script> <!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->
<script src="https://cdn.js delivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
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
