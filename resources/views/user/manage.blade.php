@extends('layouts.master')

@section('content')
    @include('layouts.navbar')

    <main class="app-main p-xl-5">
        <div class="card mb-5">
            <div class="card-header p-xl-4 border-0">
                <h3>Add new user</h3>
            </div>
            <div class="card-body">
                <form class="d-flex flex-column gap-4">
                    <div class="row">
                        <div class="col">
                            <label for="firstname" class="form-label">First name</label>
                            <input type="text" class="form-control" id="firstname" placeholder="Enter the first name"
                                   required>
                            <div class="text-danger">something error</div>
                        </div> <!--end::Col--> <!--begin::Col-->
                        <div class="col">
                            <label for="lastname" class="form-label">Last name</label>
                            <input type="text" class="form-control" id="lastname" placeholder="Enter the last name">
                            <div class="text-danger">something error</div>
                        </div> <!--end::Col--> <!--begin::Col-->
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="username" class="form-label">username</label>
                            <input type="text" class="form-control" id="username" placeholder="Enter the username"
                                   required>
                            <div class="text-danger">something error</div>
                        </div> <!--end::Col--> <!--begin::Col-->
                        <div class="col">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="email" placeholder="Enter the email" required>
                            <div class="text-danger">something error</div>
                        </div> <!--end::Col--> <!--begin::Col-->
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="role" class="form-label">Role</label>
                            <select class="form-control" id="role" required>
                                <option value="">Choose Role</option>
                                <option value="">Admin</option>
                                <option value="">member</option>
                            </select>
                            <div class="text-danger">something error</div>
                        </div> <!--end::Col--> <!--begin::Col-->
                        <div class="col">
                            <label for="password" class="form-label">Initial password</label>
                            <input type="password" class="form-control" id="password"
                                   placeholder="Enter the initial password" required>
                            <div class="text-danger">something error</div>
                        </div> <!--end::Col--> <!--begin::Col-->
                    </div>
                </form>
            </div>
        </div>
        <div class="card">
            <div class="card-header p-xl-4 border-0">
                <h3>Users</h3>
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
                            <a href="#">
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
                            <a href="#">
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
                            <a href="#">
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
