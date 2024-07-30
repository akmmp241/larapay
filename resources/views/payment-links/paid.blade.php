@include('layouts.header')

<script>
    let date = new Date("{{$paymentLink->paid_at->format('Y-M-d H:i:s')}}")
    let dateIndoFormat = new Intl.DateTimeFormat('id-ID', {
        year: "numeric",
        month: "long",
        day: "2-digit",
        hour: "2-digit",
        minute: "2-digit",
    }).format(date)

    const formatRP = (number) => {
        return new Intl.NumberFormat("id-ID", {
            style: "currency",
            currency: "IDR",
            maximumFractionDigits: 0
        }).format(number);
    }

</script>

<main class="app-main col-8 mx-auto">
    <div class="app-content p-4 row">
        <div class="col-8 mx-auto">
            <div class="d-flex flex-column align-items-center justify-content-center mb-5">
                <h3 class="mb-0 text-success">Payment Link ini telah terbayarkan</h3>
                <p class="text-primary-emphasis">Link pembayaran dengan id #: <span class="text-primary">{{$paymentLink->id}}</span> telah terbayar</p>
            </div>
            <div class="d-flex flex-column align-items-center justify-content-center mb-5">
                <ul class="list-group list-unstyled">
                    <li>Terbayarkan pada: <span id="paid-date"></span></li>
                    <li>Jumlah dibayar: <span id="amount"></span></li>
                    <li>Channel Pembayaran: <span id="channel"></span></li>
                </ul>
            </div>
            <div class="d-flex flex-column align-items-center justify-content-center mb-5">
                <p>*Hubungi Larapay untuk bantuan lebih lanjut atau membuat link pembayaran baru</p>
            </div>
        </div>
    </div>
</main>

</div>

<script>
    document.getElementById('paid-date').innerText = dateIndoFormat
    document.getElementById('amount').innerText = formatRP('{{$paymentLink->amount}}')
    document.getElementById('channel').innerText = '{{$paymentLink->channel_code}}'
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
