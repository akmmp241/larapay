@extends('settings.settings')

@section('setting-content')
    <div class="card mb-3">
        <div class="card-header border-0">
            <div class="row gap-2 justify-content-between align-self-center">
                <h3 class="col mb-0">Default Redirect</h3>
                <h3 class="col mb-0">Information</h3>
            </div>
        </div>
        <div class="card-body">
            <div class="row gap-2">
                <div class="col">
                    <form action="{{route('settings.redirect.store')}}" method="post">
                        @csrf
                        @method('PATCH')
                        <div class="mb-3">
                            <label for="success_url" class="form-label text-muted">Payment Succeed</label>
                            <input name="success_url" type="text" class="form-control" required
                                   value="{{$successUrl ?? ''}}" placeholder="Enter your redirect url">
                            @error('success_url')
                            <div class="form-text text-danger">{{$message ?? ''}}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="failed_url" class="form-label text-muted">Payment Failed</label>
                            <input name="failed_url" type="text" class="form-control" value="{{$failedUrl}}"
                                   placeholder="Enter your redirect url" required>
                            @error('failed_url')
                            <div class="form-text text-danger">{{$message ?? ''}}</div>
                            @enderror
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary col-3">Save</button>
                    </form>
                </div>
                <div class="col">
                    <div class="mb-3">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi doloribus impedit
                            minima obcaecati porro similique! Accusamus animi at consequuntur corporis excepturi
                            id ipsum laudantium nemo obcaecati possimus quidem saepe, temporibus.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('component.alert-success')
@endsection
