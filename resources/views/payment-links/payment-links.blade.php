@extends('layouts.master')

@section('content')
    @include('layouts.navbar')

    <main class="app-main">
        <div class="app-content-header">
            <div class="app-content-header d-flex justify-content-between align-items-center">
                <h1 class="mb-0">Payment Links</h1>
                <a href="{{"/payment-links/create"}}">
                    <button class="btn btn-lg btn-primary">
                        Create Payment Link
                    </button>
                </a>
            </div>
        </div>
        <div class="app-content">
            <div class="container-fluid">
                <div class="card mb-4" style="min-height: 600px">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center gap-5">
                                <div class="d-flex gap-2 align-items-center">
                                    <div>
                                        <label for="reference-id" class="form-label text-muted mb-0">From date</label>
                                        <input type="date" class="form-control border border-2"
                                               id="reference-id">
                                    </div>
                                    <div class="mt-4">
                                        <h2>-</h2>
                                    </div>
                                    <div>
                                        <label for="reference-id" class="form-label text-muted mb-0">To date</label>
                                        <input type="date" class="form-control border border-2"
                                               id="reference-id">
                                    </div>
                                </div>
                                <div class="d-flex gap-2 align-items-center">
                                    <div>
                                        <label for="role" class="form-label text-muted mb-0">Role</label>
                                        <select class="form-control form-select" id="role" required>
                                            <option value="">Choose Role</option>
                                            <option value="">Admin</option>
                                            <option value="">member</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <input type="text" placeholder="search..." class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th style="width: 30%;">Reference ID</th>
                                <th>Status</th>
                                <th style="width: 18%">Date Created</th>
                                <th>Payer Name</th>
                                <th>Amount</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="align-middle">
                                <td>32h2-yh54w-sj34438sjnr4j-23324h65747jh34nj</td>
                                <td><span class="badge text-bg-primary">Paid</span></td>
                                <td>12/12/2024 00:00:00</td>
                                <td>Akmal MP</td>
                                <td>Rp. 15.000</td>
                                <td class="d-flex flex-row gap-2">
                                    <a href="#">
                                        <button type="button" class="btn btn-danger btn-sm">Cancel</button>
                                    </a>
                                </td>
                            </tr>
                            <tr class="align-middle">
                                <td>32h2-yh54w-sj34438sjnr4j-23324h65747jh34nj</td>
                                <td><span class="badge text-bg-primary">Paid</span></td>
                                <td>12/12/2024 00:00:00</td>
                                <td>Akmal MP</td>
                                <td>Rp. 15.000</td>
                                <td class="d-flex flex-row gap-2">
                                    <a href="#">
                                        <button type="button" class="btn btn-danger btn-sm">Cancel</button>
                                    </a>
                                </td>
                            </tr>
                            <tr class="align-middle">
                                <td>32h2-yh54w-sj34438sjnr4j-23324h65747jh34nj</td>
                                <td><span class="badge text-bg-primary">Paid</span></td>
                                <td>12/12/2024 00:00:00</td>
                                <td>Akmal MP</td>
                                <td>Rp. 15.000</td>
                                <td class="d-flex flex-row gap-2">
                                    <a href="#">
                                        <button type="button" class="btn btn-danger btn-sm">Cancel</button>
                                    </a>
                                </td>
                            </tr>
                            <tr class="align-middle">
                                <td>32h2-yh54w-sj34438sjnr4j-23324h65747jh34nj</td>
                                <td><span class="badge text-bg-success">Settled</span></td>
                                <td>12/12/2024 00:00:00</td>
                                <td>Akmal MP</td>
                                <td>Rp. 15.000</td>
                                <td class="d-flex flex-row gap-2">
                                    <a href="#">
                                        <button type="button" class="btn btn-danger btn-sm">Cancel</button>
                                    </a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                @include('component.alert-success')
            </div>
        </div>
    </main>
@endsection
