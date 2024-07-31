@extends('layouts.master')

@section('content')
    @include('layouts.navbar')

    <main class="app-main p-xl-5">
        @if(session()->has('success'))
            <div class="alert alert-success mb-5" role="alert">
                {{session('success') }}
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
                    @foreach($users as $key => $user)
                        <tr class="align-middle">
                            <td>{{$key + 1}}.</td>
                            <td>{{ $user->first_name }}</td>
                            <td>{{ \App\Models\User::$ROLES[$user->role_id - 1] }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->created_at }}</td>
                            <td class="d-flex flex-row justify-content-evenly">
                                @if($user->id === auth()->id())
                                    This is you
                                @else
                                    <a href="/users/{{ $user->id }}/edit">
                                        <button type="button" class="btn btn-primary btn-sm">Update</button>
                                    </a>
                                    <a href="#">
                                        <button type="button" class="btn btn-danger btn-sm">Delete</button>
                                    </a>
                                @endauth
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </main>
@endsection
