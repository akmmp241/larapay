@extends('layouts.master')

@section('content')
    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">Settings</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="app-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-2" style="min-height: 100vh;"> <!--begin::Sidebar Brand-->
                        <div class="sidebar-wrapper bg-secondary p-0 h-75">
                            <nav class="pt-2">
                                <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu"
                                    data-accordion="false">
                                    <li class="nav-item @if(request()->url() === route('settings.payment-methods')) bg-white border-start border-5 border-secondary @endif">
                                        <a href="{{ route('settings.payment-methods') }}"
                                           class="nav-link py-3 m-0 rounded-0 @if(request()->url() === route('settings.payment-methods')) text-black @else text-white @endif">
                                            <p>Default Payment Methods</p>
                                        </a>
                                    </li>
                                    <li class="nav-item @if(request()->url() === route('settings.api-key')) bg-white border-start border-5 border-secondary @endif">
                                        <a href="{{ route('settings.api-key') }}"
                                           class="nav-link py-3 m-0 rounded-0 @if(request()->url() === route('settings.api-key')) text-black @else text-white @endif">
                                            <p>Xendit API Key</p>
                                        </a>
                                    </li>
                                    <li class="nav-item @if(request()->url() === route('settings.webhook')) bg-white border-start border-5 border-secondary @endif">
                                        <a href="{{ route('settings.webhook') }}" class="nav-link py-3 m-0 rounded-0 @if(request()->url() === route('settings.webhook')) text-black @else text-white @endif">
                                            <p>Webhook</p>
                                        </a></li>
                                    <li class="nav-item @if(request()->url() === route('settings.redirect')) bg-white border-start border-5 border-secondary @endif">
                                        <a href="{{ route('settings.redirect') }}" class="nav-link py-3 m-0 rounded-0 @if(request()->url() === route('settings.redirect')) text-black @else text-white @endif">
                                            <p>Default Redirect</p>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="col" style="min-height: 100vh;">
                        @yield('setting-content')
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
