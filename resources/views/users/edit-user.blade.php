@extends('layouts.master')

@section('content')
    @include('layouts.navbar')

    <main class="app-main p-xl-5">
        <div class="card mb-5">
            <div class="card-header p-xl-4 border-0">
                <h3>Edit user</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('users.update', ['id' => $user->id]) }}" class="d-flex flex-column gap-4" method="post">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col">
                            <label for="first_name" class="form-label">First name</label>
                            <input type="text" class="form-control" name="first_name" value="{{ $user->first_name }}" id="firstname" placeholder="Enter the first name"
                                   required>
                            @error('first_name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div> <!--end::Col--> <!--begin::Col-->
                        <div class="col">
                            <label for="last_name" class="form-label">Last name</label>
                            <input type="text" class="form-control" name="last_name" value="{{ $user->last_name }}" id="lastname" placeholder="Enter the last name">
                            @error('last_name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div> <!--end::Col--> <!--begin::Col-->
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" name="email" value="{{ $user->email }}" id="email" placeholder="Enter the email" required>
                            @error('email')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div> <!--end::Col--> <!--begin::Col-->
                        <div class="col">
                            <label for="role" class="form-label">Role</label>
                            <select class="form-control" id="role" name="role_id" required>
                                <option value="">Choose Role</option>
                                <option value="{{ $user::$ADMIN }}">Admin</option>
                                <option value="{{ $user::$MEMBER }}">member</option>
                            </select>
                            @error('role_id')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div> <!--end::Col--> <!--begin::Col-->
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="password" class="form-label">Initial password</label>
                            <input type="password" class="form-control" name="password" id="password"
                                   placeholder="Enter the initial password" required>
                            @error('password')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div> <!--end::Col--> <!--begin::Col-->
                    </div>
                    <div class="row">
                        <div class="col">
                            <button type="submit" name="submit" class="btn btn-primary col-1">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>

@endsection
