@extends('layouts.master')

@section('content')
    <main class="app-main d-flex flex-column gap-xl-5 p-xxl-5"> <!--begin::App Content Header-->
        <div class="card"> <!--begin::Profile Header-->
            <div class="card-body p-xl-4">
                <div class="d-flex flex-row justify-content-between align-items-center ">
                    <div class="d-flex flex-row align-items-center gap-3">
                        <img src="{{asset("dist/assets/img/avatar.png")}}" alt="Profile" width="80" height="80"
                             class="border border-1">
                        <div>
                            <h4>{{ $user->first_name . ' '  .  $user->last_name }}</h4>
                        </div>
                    </div>
                    <div>
                        <button class="btn btn-primary h-50">Upload Photo Profile</button>
                    </div>
                </div>
            </div>
        </div> <!--end::Profile Header-->
        @include('component.alert-success')
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header border-0">
                        <h2>Your Profile</h2>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('profile.update') }}" method="post" class="d-flex flex-column gap-5">
                            @method('PUT')
                            @csrf
                            <div id="user-information" class="row">
                                <div class="card-title mb-4">
                                    <h4 class="text-muted">User information</h4>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <label for="email" class="form-label">Email Address</label>
                                        <input type="text" name="email" class="form-control" id="email"
                                               value="{{ $user->email }}"
                                               placeholder="Enter your email address" required/>
                                        @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label for="firstname" class="form-label">First name</label>
                                        <input type="text" name="first_name" class="form-control" id="firstname"
                                               value="{{ $user->first_name }}"
                                               placeholder="Enter your first name"
                                               required/>
                                        @error('first_name')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <label for="lastname" class="form-label">Last name</label>
                                        <input type="text" name="last_name" class="form-control" id="lastname"
                                               value="{{ $user->last_name }}"
                                               placeholder="Enter your last name"/>
                                        @error('last_name')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div id="additional-information" class="row">
                                <div class="card-title mb-4">
                                    <h4 class="text-muted">Additional Information (optional)</h4>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <label for="mobile-number" class="form-label">Mobile number (optional)</label>
                                        <input type="text" name="mobile_number" class="form-control" id="mobile-number"
                                               value="{{ $user->mobile_number }}"
                                               placeholder="Enter your mobile number"
                                               required/>
                                        @error('mobile_number')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label for="address" class="form-label">Adress (optional)</label>
                                        <input type="text" name="address" class="form-control" id="address"
                                               value="{{ $user->address }}"
                                               placeholder="Enter your address"/>
                                        @error('address')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="col-3 btn btn-primary">Save</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card">
                    <div class="card-header border-0">
                        <h2>Change Password</h2>
                    </div>
                    <div class="card-body">
                        <form class="d-flex flex-column gap-5">
                            <div id="user-information" class="row">
                                <div class="row mb-3">
                                    <div class="col">
                                        <label for="current-password" class="form-label">Current Password</label>
                                        <input type="text" class="form-control" id="current-password"
                                               placeholder="Enter current password of your account"
                                               required/>
                                        <div class="text-danger">Min 3 characters</div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <label for="new-password" class="form-label">New Password</label>
                                        <input type="text" class="form-control" id="new-password"
                                               placeholder="Enter your new password"
                                               required/>
                                        <div class="text-danger">Min 3 characters</div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <label for="password-confirmation" class="form-label">Confirmation</label>
                                        <input type="text" class="form-control" id="password-confirmation"
                                               placeholder="Enter your new password again"
                                               required/>
                                        <div class="text-danger">Min 3 characters</div>
                                    </div>
                                </div>
                            </div>
                            <button class="col-4 btn btn-primary">Change Password</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main> <!--end::App Main--> <!--begin::Footer-->

@endsection
