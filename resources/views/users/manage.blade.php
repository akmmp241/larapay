@extends('layouts.master')

@section('content')
    @include('layouts.navbar')

    <main class="app-main p-xl-5">
        @if(session()->has('success'))
            <div class="alert alert-success mb-5" role="alert">
                {{session('success') }}
                awikwiok
            </div>
        @endif
        <div class="card p-3">
            <div class="card-header p-xl-4 border-0">
                <div class="col d-flex justify-content-between">
                    <h3 class="mb-0">Users</h3>
                    <a href="/users/new">
                        <button class="btn btn-success">Add User</button>
                    </a>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th style="width: 10px">No.</th>
                        <th>Name</th>
                        <th style="width: 10%">Role</th>
                        <th>Email</th>
                        <th style="width: 12%;">Created at</th>
                        <th style="width: 12%">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="align-middle">
                        <td>1.</td>
                        <td>Akmal Muhammad Pridianto</td>
                        <td>Admin</td>
                        <td>akmal@gmail.com</td>
                        <td>12/12/12 10:10:10</td>
                        <td class="d-flex flex-row justify-content-evenly">
                            <a href="/users/iduser">
                                <button type="button" class="btn btn-primary btn-sm">Update</button>
                            </a>
                            <a href="#">
                                <button type="button" class="btn btn-danger btn-sm">Delete</button>
                            </a>
                        </td>
                    </tr>
                    <tr class="align-middle">
                        <td>2.</td>
                        <td>Joko purnomo</td>
                        <td>Member</td>
                        <td>joko@gmail.com</td>
                        <td>12/12/12 10:10:10</td>
                        <td class="d-flex flex-row justify-content-evenly">
                            <a href="/users/iduser">
                                <button type="button" class="btn btn-primary btn-sm">Update</button>
                            </a>
                            <a href="#">
                                <button type="button" class="btn btn-danger btn-sm">Delete</button>
                            </a>
                        </td>
                    </tr>
                    <tr class="align-middle">
                        <td>3.</td>
                        <td>Iskandar</td>
                        <td>Member</td>
                        <td>iska@gmail.com</td>
                        <td>12/12/12 10:10:10</td>
                        <td class="d-flex flex-row justify-content-evenly">
                            <a href="/users/iduser">
                                <button type="button" class="btn btn-primary btn-sm">Update</button>
                            </a>
                            <a href="#">
                                <button type="button" class="btn btn-danger btn-sm">Delete</button>
                            </a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
@endsection
