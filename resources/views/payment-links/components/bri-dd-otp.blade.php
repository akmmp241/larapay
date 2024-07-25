<form action="{{route('validate.otp')}}" method="post">
    @csrf
    <input type="hidden" name="pr_id" value="{{$pr_id}}">
    <div id="form-bri-otp" class="d-flex flex-column align-items-center justify-content-center mb-5">
        <label for="reference-id" class="form-label text-muted ">Kode OTP BRI Direct Debit (6 Digit)</label>
        <input id="bri-otp" name="otp" type="text" class="form-control" required placeholder="XXX XXX">
        <div>
            <button type="submit" name="submit_otp" class="btn btn-primary m-4">Konfirmasi</button>
        </div>
    </div>
</form>
