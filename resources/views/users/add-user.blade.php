@extends('layouts.master')

@section('content')
    @include('layouts.navbar')

    <main class="app-main p-xl-5">
        <div class="card mb-5">
            <div class="card-header p-xl-4 border-0">
                <h3>Add new user</h3>
            </div>
            <div class="card-body">
                <form action="{{route('users.store')}}" method="post" class="d-flex flex-column gap-4">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <label for="firstname" class="form-label">First name</label>
                            <input name="first_name" type="text" class="form-control" id="firstname"
                                   placeholder="Enter the first name"
                                   required>
                            @error('first_name')
                            <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div> <!--end::Col--> <!--begin::Col-->
                        <div class="col">
                            <label for="lastname" class="form-label">Last name</label>
                            <input name="last_name" type="text" class="form-control" id="lastname"
                                   placeholder="Enter the last name">
                            @error('last_name')
                            <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div> <!--end::Col--> <!--begin::Col-->
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="username" class="form-label">username</label>
                            <input name="username" type="text" class="form-control" id="username"
                                   placeholder="Enter the username"
                                   required>
                            @error('username')
                            <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div> <!--end::Col--> <!--begin::Col-->
                        <div class="col">
                            <label for="email" class="form-label">Email address</label>
                            <input name="email" type="email" class="form-control" id="email"
                                   placeholder="Enter the email" required>
                            @error('email')
                            <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div> <!--end::Col--> <!--begin::Col-->
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="role" class="form-label">Role</label>
                            <select name="role_id" class="form-control" id="role" required>
                                <option value="">Choose Role</option>
                                @foreach($roles as $name => $role)
                                    <option value="{{$role}}">{{$name}}</option>
                                @endforeach
                            </select>
                            @error('role')
                            <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div> <!--end::Col--> <!--begin::Col-->
                        <div class="col">
                            <label for="password" class="form-label">Initial password</label>
                            <input name="password" type="password" class="form-control" id="password"
                                   placeholder="Enter the initial password" required>
                            @error('password')
                            <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div> <!--end::Col--> <!--begin::Col-->
                    </div>
                    <div class="row">
                        <div class="col">
                            <button type="submit" name="submit" class="btn btn-primary col-1">Add</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>

@endsection
