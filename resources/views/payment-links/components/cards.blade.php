<div id="form-cards" class="visually-hidden d-flex flex-column justify-content-center gap-4 mb-5">
    <div class="row">
        <div class="col">
            <label for="card_number" class="form-label text-muted ">Nomor Kartu</label>
            <input id="card_number" name="card_number" type="text" class="form-control" placeholder="XXXX XXXX XXXX 4567">
        </div>
    </div>
    <div class="row">
        <div class="col">
            <label for="valid_thru" class="form-label text-muted ">Berlaku Hingga</label>
            <input id="valid_thru" name="valid_thru" type="text" class="form-control" placeholder="MM/YY">
        </div>
        <div class="col">
            <label for="cvn" class="form-label text-muted ">CVN</label>
            <input id="cvn" name="cvn" type="text" class="form-control" placeholder="XXX">
        </div>
    </div>
    <div class="mx-auto">
        <button id="back-cards" type="button" class="btn btn-outline-primary m-4">Kembali</button>
        <button type="submit" name="channel_code" value="CARD" class="btn btn-primary m-4">Bayar Sekarang</button>
        <script>
            document.getElementById('back-cards').onclick = () => {
                document.getElementById('form-cards').classList.add('visually-hidden')
                document.getElementById('payment-methods').classList.remove('visually-hidden')
                document.getElementById('card_number').removeAttribute('required')
                document.getElementById('valid_thru').removeAttribute('required')
                document.getElementById('cvn').removeAttribute('required')
            }
        </script>
    </div>
</div>
