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
                            <h4>Akmal Muhammad Pridianto</h4>
                            <p class="mb-0">@akmmp</p>
                        </div>
                    </div>
                    <div>
                        <button class="btn btn-primary h-50">Upload Photo Profile</button>
                    </div>
                </div>
            </div>
        </div> <!--end::Profile Header-->

        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header border-0">
                        <h2>Your Profile</h2>
                    </div>
                    <div class="card-body">
                        <form class="d-flex flex-column gap-5">
                            <div id="user-information" class="row">
                                <div class="card-title mb-4">
                                    <h4 class="text-muted">User information</h4>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <label for="username" class="form-label">Username</label>
                                        <input type="text" class="form-control" id="username"
                                               placeholder="Enter your name"
                                               required/>
                                        <div class="text-danger">Min 3 characters</div>
                                    </div>
                                    <div class="col">
                                        <label for="email" class="form-label">Email Address</label>
                                        <input type="text" class="form-control" id="email"
                                               placeholder="Enter your email address" required/>
                                        <div class="text-danger">Min 3 characters</div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label for="firstname" class="form-label">First name</label>
                                        <input type="text" class="form-control" id="firstname"
                                               placeholder="Enter your first name"
                                               required/>
                                        <div class="text-danger">Min 3 characters</div>
                                    </div>
                                    <div class="col">
                                        <label for="lastname" class="form-label">Last name</label>
                                        <input type="text" class="form-control" id="lastname"
                                               placeholder="Enter your last name"
                                               required/>
                                        <div class="text-danger">Min 3 characters</div>
                                    </div>
                                </div>
                            </div>
                            <div id="additional-information" class="row">
                                <div class="card-title mb-4">
                                    <h4 class="text-muted">Additional Information (optional)</h4>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <label for="mobile-number" class="form-label">Mobile number</label>
                                        <input type="text" class="form-control" id="mobile-number"
                                               placeholder="Enter your mobile number"
                                               required/>
                                        <div class="text-danger">Min 3 characters</div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label for="address" class="form-label">Adress</label>
                                        <input type="text" class="form-control" id="address"
                                               placeholder="Enter your address"
                                               required/>
                                        <div class="text-danger">Min 3 characters</div>
                                    </div>
                                </div>
                            </div>
                            <button class="col-3 btn btn-primary">Save</button>
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
