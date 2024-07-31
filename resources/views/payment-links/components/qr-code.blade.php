<div id="success-page-qrcode" class="d-flex flex-column align-items-center justify-content-center mb-5">
    <div class="card">
        <div class="card-header">
            <h3 class="fw-bolder text-center">QRIS Payment</h3>
            <p id="qr-date" class="mb-0">Expires at </p>
        </div>
        <div class="card-body d-flex justify-content-center align-items-center p-5">
            <canvas id="qr-string"></canvas>
        </div>
        <div class="card-footer mx-auto">
            <a download="qr.png" id="download" class="btn btn-primary" >Download</a>
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
        }).format().toUpperCase()

        document.getElementById('qr-date').innerText = 'BAYAR SEBELUM ' + qrDateIndo
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrious/4.0.2/qrious.min.js"></script>
    <script>
        new QRious({
            element: document.getElementById('qr-string'),
            value: "test",
            size: 240,
        }); // generate QR code in canvas

        const download = document.getElementById('download')
        download.href = document.getElementById('qr-string').toDataURL()
    </script>
</div>
