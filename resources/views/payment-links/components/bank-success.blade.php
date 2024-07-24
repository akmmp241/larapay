<div id="success-page-bank" class="d-flex flex-column align-items-center justify-content-center mb-5">
    <div class="card">
        <div class="card-body">
            <h1>Nomer Virtual Account: {{$vaNumber}}</h1>
            <h1>Nama Virtual Account: {{$vaName}}</h1>
            <h1 id="va-amount">Nominal:</h1>
        </div>
    </div>
    <script>
        document.getElementById('va-amount').innerText = 'Nominal: IDR ' + rpFormat
    </script>
</div>
