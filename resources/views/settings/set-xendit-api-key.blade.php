@extends('layouts.master')

@section('content')
    <main class="app-main p-4">
        <div class="app-content-header">
            <h1>Set Xendit API Key</h1>
        </div>
        <div class="app-content">
            @include('component.alert-success')
            <div class="card p-2">
                <div class="card-header border-0">
                    <div class="row gap-2 justify-content-between align-self-center">
                        <h3 class="col mb-0">Xendit API Key</h3>
                        <h3 class="col mb-0">Information</h3>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row gap-2">
                        <div class="col">
                            <form action="{{route("settings.api-key.store")}}" method="post">
                                @csrf
                                @method('PATCH')
                                <div class="mb-3">
                                    <input name="key" type="text" class="form-control" value="{{$key ?? ''}}"
                                           placeholder="Enter your xendit api key">
                                    @error('key')
                                    <div class="form-text text-danger">Error message</div>
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
        </div>
    </main>
@endsection
