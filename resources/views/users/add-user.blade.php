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
                            <label for="firstname" class="form-label">First name <span class="text-danger">(required)</span></label>
                            <input name="first_name" type="text" class="form-control" id="firstname"
                                   placeholder="Enter the first name" value="{{old('first_name', $_POST["first_name"] ?? '')}}"
                                   required>
                            @error('first_name')
                            <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div> <!--end::Col--> <!--begin::Col-->
                        <div class="col">
                            <label for="lastname" class="form-label">Last name</label>
                            <input name="last_name" type="text" class="form-control" id="lastname"
                                   value="{{old('last_name', $_POST["last_name"] ?? '')}}"
                                   placeholder="Enter the last name">
                            @error('last_name')
                            <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div> <!--end::Col--> <!--begin::Col-->
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="email" class="form-label">Email address <span class="text-danger">(required)</span></label>
                            <input name="email" type="email" class="form-control" id="email"
                                   value="{{old('email', $_POST["email"] ?? '')}}"
                                   placeholder="Enter the email" required>
                            @error('email')
                            <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div> <!--end::Col--> <!--begin::Col-->
                        <div class="col">
                            <label for="role" class="form-label">Role <span class="text-danger">(required)</span></label>
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
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="password" class="form-label">Initial password <span class="text-danger">(required)</span></label>
                            <input name="password" type="password" class="form-control" id="password"
                                   value="{{old('password', $_POST["password"] ?? '')}}"
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
