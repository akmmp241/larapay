<div id="form-ovo" class="visually-hidden d-flex flex-column align-items-center justify-content-center mb-5">
    <label for="reference-id" class="form-label text-muted ">Nomor Handphone (required)</label>
    <div class="input-group has-validation">
        <span class="input-group-text">+62</span>
        <input id="ovo-required" type="text" class="form-control" placeholder="851XXXXXXX">
    </div>
    <div>
        <button id="back-ovo" type="button" class="btn btn-outline-primary m-4">Kembali</button>
        <button type="submit" name="channel_code" value="OVO" class="btn btn-primary m-4">Bayar Sekarang</button>
        <script>
            document.getElementById('back-ovo').onclick = () => {
                document.getElementById('form-ovo').classList.add('visually-hidden')
                document.getElementById('payment-methods').classList.remove('visually-hidden')
                document.getElementById('ovo-required').removeAttribute('required')
                document.getElementById('ovo-required').removeAttribute('name')
            }
        </script>
    </div>
</div>
