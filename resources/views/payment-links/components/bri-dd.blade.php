<div id="form-bri-dd" class="visually-hidden d-flex flex-column align-items-center justify-content-center mb-5">
    <label for="mobile_num" class="form-label text-muted ">Nomor Handphone (required)</label>
    <div class="input-group has-validation">
        <span class="input-group-text">+62</span>
        <input id="bri-dd-mobile" name="mobile_num" type="text" class="form-control" placeholder="851XXXXXXX">
    </div>
    <label for="email" class="form-label text-muted mt-4">Email (required)</label>
    <input id="bri-dd-email" name="email" type="email" class="form-control" placeholder="youremail@gmail.com">
    <label for="last_four_digits" class="form-label text-muted mt-4">4 digit terakhir kartu (required)</label>
    <input id="bri-dd-card" name="last_four_digits" type="text" class="form-control" placeholder="XXXX">
    <div>
        <button id="back-bri-dd" type="button" class="btn btn-outline-primary m-4">Kembali</button>
        <button type="submit" name="channel_code" value="BRI_DD" class="btn btn-primary m-4">Bayar Sekarang</button>
        <script>
            document.getElementById('back-bri-dd').onclick = () => {
                document.getElementById('form-bri-dd').classList.add('visually-hidden')
                document.getElementById('payment-methods').classList.remove('visually-hidden')
                document.getElementById('bri-dd-mobile').removeAttribute('required')
                document.getElementById('bri-dd-email').removeAttribute('required')
                document.getElementById('bri-dd-card').removeAttribute('required')
            }
        </script>
    </div>
</div>
