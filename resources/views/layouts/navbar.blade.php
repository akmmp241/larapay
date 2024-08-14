@php use App\Models\Setting; @endphp
<nav class="app-header navbar navbar-expand bg-body"> <!--begin::Container-->
    <div class="container-fluid"> <!--begin::Start Navbar Links-->
        <ul class="navbar-nav gap-4">
            <li class="nav-item">
                <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                    <i class="bi bi-list"></i>
                </a>
            </li>
            <li class="nav-item">
                <div class="nav-link form-check form-switch">
                    <form id="mode-switch" action="{{ route('settings.mode') }}" method="post">
                        @method('PATCH')
                        @csrf
                        <input class="form-check-input" name="mode" type="checkbox"
                               @checked(Setting::checkMode(Setting::$LIVE)) role="switch" id="mode">
                        <label class="form-check-label" for="mode" id="mode-label">MODE: {{ Setting::xenditMode() }}</label>
                    </form>
                    <script>
                        document.getElementById('mode').oninput = () => {
                            document.getElementById('mode-switch').submit()
                        }

                        const label = document.getElementById('mode-label');
                        label.innerText = label.innerText.toUpperCase()
                    </script>
                </div>
            </li>
        </ul> <!--end::Start Navbar Links--> <!--begin::End Navbar Links-->
        <ul class="navbar-nav ms-auto"> <!--begin::Navbar Search-->
            <!--begin::Messages Dropdown Menu-->
            <li class="nav-item">
                <a class="nav-link" href="#" data-lte-toggle="fullscreen">
                    <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i>
                    <i data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display: none;"></i>
                </a>
            </li>
            <!--end::Fullscreen Toggle--> <!--begin::User Menu Dropdown-->
            <li class="nav-item dropdown user-menu">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                    <img src="{{asset("dist/assets/img/avatar.png")}}" class="user-image rounded-circle shadow"
                         alt="User Image">
                    <span
                        class="d-none d-md-inline">{{ auth()->user()->first_name . " " . auth()->user()->last_name }}</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end"> <!--begin::User Image-->
                    <li class="user-header text-bg-primary">
                        <img src="{{asset("dist/assets/img/avatar.png")}}" class="rounded-circle shadow"
                             alt="User Image">
                        <p>
                            {{ auth()->user()->first_name . " " . auth()->user()->last_name }}
                            <small>Member since {{ auth()->user()->created_at->format("M, Y") }}</small>
                        </p>
                    </li> <!--end::User Image--> <!--begin::Menu Body-->
                    <li class="user-footer">
                        <a href="{{ route('profile') }}" class="btn btn-default btn-flat">Profile</a>
                        <a href="{{ route('logout') }}" class="btn btn-default btn-flat float-end">Log out</a></li>
                    <!--end::Menu Footer-->
                </ul>
            </li> <!--end::User Menu Dropdown-->
        </ul> <!--end::End Navbar Links-->-
    </div> <!--end::Container-->
</nav> <!--end::Header--> <!--begin::Sidebar-->
