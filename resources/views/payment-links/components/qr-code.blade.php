<div id="success-page-qrcode" class="d-flex flex-column align-items-center justify-content-center mb-5">
    <div class="card">
        <div class="card-header">
            <h3 class="fw-bolder text-center">QRIS Payment</h3>
            <p id="qr-date" class="mb-0">Expires at </p>
        </div>
        <div class="card-body d-flex justify-content-center align-items-center p-5">
            <div id="qr-string"></div>
        </div>
    </div>
    <script>
        let qrDate = new Date("{{$expires_at->format('Y-M-d H:i:s')}}")
        let qrDateIndo = new Intl.DateTimeFormat('id-ID', {
            year: "numeric",
            month: "long",
            day: "2-digit",
            hour: "2-digit",
            minute: "2-digit",
        }).format(qrDate).toUpperCase()

        document.getElementById('qr-date').innerText = 'BAYAR SEBELUM ' + qrDateIndo
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js" integrity="sha512-CNgIRecGo7nphbeZ04Sc13ka07paqdeTu0WR1IM4kNcpmBAUSHSQX0FslNhTDadL4O5SAGapGt4FodqL8My0mA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        new QRCode(document.getElementById('qr-string'), {
            text: "{{$qr_string}}",
            width: 240,
            height: 240,
        })
    </script>
</div>
