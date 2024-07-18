@extends('layouts.master')

@section('content')
    <main class="app-main p-4">
        <div class="app-content-header">
            <h1>Set Xendit API Key</h1>
        </div>
        <div class="app-content">
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
                            <div class="mb-3">
                                <label for="email" class="form-label text-muted">Payment Succeed</label>
                                <input type="text" class="form-control" placeholder="Enter your redirect url">
                                <div class="form-text text-danger">Error message</div>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label text-muted">Payment Failed</label>
                                <input type="text" class="form-control" placeholder="Enter your redirect url">
                                <div class="form-text text-danger">Error message</div>
                            </div>
                            <button class="btn btn-primary col-3">Save</button>
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
