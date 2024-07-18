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
                    <div class="row">
                        <div class="col">
                            <button class="btn btn-primary col-1">Add</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>

@endsection
