<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

        <title>KIOT Allowance</title>

        <meta name="description" content="OneUI - Bootstrap 4 Admin Template &amp; UI Framework created by pixelcave and published on Themeforest">
        <meta name="author" content="pixelcave">
        <meta name="robots" content="noindex, nofollow">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Open Graph Meta -->
        <meta property="og:title" content="OneUI - Bootstrap 4 Admin Template &amp; UI Framework">
        <meta property="og:site_name" content="OneUI">
        <meta property="og:description" content="OneUI - Bootstrap 4 Admin Template &amp; UI Framework created by pixelcave and published on Themeforest">
        <meta property="og:type" content="website">
        <meta property="og:url" content="">
        <meta property="og:image" content="">

        <!-- Icons -->
        <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
        <link rel="shortcut icon" href="{{ asset('OneUI/assets/media/favicons/favicon.png')}}">
        <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('OneUI/assets/media/favicons/favicon-192x192.png')}}">
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('OneUI/assets/media/favicons/apple-touch-icon-180x180.png')}}">
        <!-- END Icons -->

        <!-- Stylesheets -->
        <!-- Fonts and OneUI framework -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap">
        <link rel="stylesheet" id="css-main" href="{{ asset('OneUI/assets/css/oneui.min.css')}}">
	    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

        @yield('style_lib')

        <!-- You can include a specific file from css/themes/ folder to alter the default color theme of the template. eg: -->
        <!-- <link rel="stylesheet" id="css-theme" href="assets/css/themes/amethyst.min.css"> -->
        <!-- END Stylesheets -->
    </head>
    <body>
        <div id="page-container" class="sidebar-o sidebar-dark enable-page-overlay side-scroll page-header-fixed main-content-narrow">
            <!-- Side Overlay-->
            <aside id="side-overlay">
                <!-- Side Header -->
                <!-- END Side Header -->

                <!-- Side Content -->
                <div class="content-side">
                    <!-- Side Overlay Tabs -->
                    <div class="block block-transparent pull-x pull-t">
                        <ul class="nav nav-tabs nav-tabs-alt nav-justified" data-toggle="tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" href="#so-overview">
                                    <i class="fa fa-fw fa-coffee text-gray mr-1"></i> Overview
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#so-sales">
                                    <i class="fa fa-fw fa-chart-line text-gray mr-1"></i> Sales
                                </a>
                            </li>
                        </ul>
                        
                    </div>
                    <!-- END Side Overlay Tabs -->
                </div>
                <!-- END Side Content -->
            </aside>
            <!-- END Side Overlay -->
            <nav id="sidebar" aria-label="Main Navigation">
                <!-- Side Header -->
                <div class="content-header bg-white-5">
                    <!-- Logo -->
                    <a class="font-w600 text-dual" href="{{route('home')}}">
                        <span class="smini-visible">
                            <i class="fa fa-circle-notch text-primary"></i>
                        </span>
                        <span class="smini-hide font-size-h5 tracking-wider">
                            KIOT<span class="font-w400">Allowance</span>
                        </span>
                    </a>
                    <!-- END Logo -->

                    <!-- Extra -->
                    <div>
                        <!-- Options -->
                        <div class="dropdown d-inline-block ml-2">
                            <a class="btn btn-sm btn-dual" id="sidebar-themes-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#">
                                <i class="si si-drop"></i>
                            </a>
                            
                        </div>
                        <!-- END Options -->

                        <!-- Close Sidebar, Visible only on mobile screens -->
                        <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                        <a class="d-lg-none btn btn-sm btn-dual ml-1" data-toggle="layout" data-action="sidebar_close" href="javascript:void(0)">
                            <i class="fa fa-fw fa-times"></i>
                        </a>
                        <!-- END Close Sidebar -->
                    </div>
                    <!-- END Extra -->
                </div>
                <!-- END Side Header -->

                <!-- Sidebar Scrolling -->
                <div class="js-sidebar-scroll">
                    <!-- Side Navigation -->
                    <div class="content-side">
                        <ul class="nav-main">
                            <li class="nav-main-item">
                                <a class="nav-main-link" href="{{ route('dashboard')}}">
                                    <i class="nav-main-link-icon si si-speedometer"></i>
                                    <span class="nav-main-link-name">Dashboard</span>
                                </a>
                            </li>
                            <li class="nav-main-item">
                                <a class="nav-main-link" href="{{ route('allowances.index')}}">
                                    <i class="nav-main-link-icon si si-speedometer"></i>
                                    <span class="nav-main-link-name">Allowances</span>
                                </a>
                            </li>
                            <li class="nav-main-item">
                                <a class="nav-main-link" href="{{ route('routes.index')}}">
                                    <i class="nav-main-link-icon si si-speedometer"></i>
                                    <span class="nav-main-link-name">Routes</span>
                                </a>
                            </li>
                            <li class="nav-main-item">
                                <a class="nav-main-link" href="{{ route('cities.index')}}">
                                    <i class="nav-main-link-icon si si-speedometer"></i>
                                    <span class="nav-main-link-name">City</span>
                                </a>
                            </li>
                            <li class="nav-main-item">
                                <a class="nav-main-link" href="{{ route('categories.index')}}">
                                    <i class="nav-main-link-icon si si-speedometer"></i>
                                    <span class="nav-main-link-name">Category</span>
                                </a>
                            </li>

                            <li class="nav-main-heading">User Interface</li>
                        </ul>
                    </div>
                    <!-- END Side Navigation -->
                </div>
                <!-- END Sidebar Scrolling -->
            </nav>
            <!-- END Sidebar -->
            <!-- Header -->
            <header id="page-header">
                <!-- Header Content -->
                <div class="content-header">
                    <!-- Left Section -->
                    <div class="d-flex align-items-center">
                        <!-- Toggle Sidebar -->
                        <!-- Layout API, functionality initialized in Template._uiApiLayout()-->
                        <button type="button" class="btn btn-sm btn-dual mr-2 d-lg-none" data-toggle="layout" data-action="sidebar_toggle">
                            <i class="fa fa-fw fa-bars"></i>
                        </button>
                        <!-- END Toggle Sidebar -->
                        <!-- Toggle Mini Sidebar -->
                        <!-- Layout API, functionality initialized in Template._uiApiLayout()-->
                        <button type="button" class="btn btn-sm btn-dual mr-2 d-none d-lg-inline-block" data-toggle="layout" data-action="sidebar_mini_toggle">
                            <i class="fa fa-fw fa-ellipsis-v"></i>
                        </button>
                        <!-- END Toggle Mini Sidebar -->
                        <!-- Apps Modal -->                      
                    </div>
                    <!-- END Left Section -->

                    <!-- Right Section -->
                    <div class="d-flex align-items-center">
                        <!-- User Dropdown -->
                        <div class="dropdown d-inline-block ml-2">
                            <button type="button" class="btn btn-sm btn-dual d-flex align-items-center" id="page-header-user-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="rounded-circle" src="{{ asset('OneUI/assets/media/avatars/avatar10.jpg')}}" alt="Header Avatar" style="width: 21px;">
                                <span class="d-none d-sm-inline-block ml-2">{{auth()->user()->name}}</span>
                                <i class="fa fa-fw fa-angle-down d-none d-sm-inline-block ml-1 mt-1"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-md dropdown-menu-right p-0 border-0" aria-labelledby="page-header-user-dropdown">
                                <div class="p-3 text-center bg-primary-dark rounded-top">
                                    <img class="img-avatar img-avatar48 img-avatar-thumb" src="{{ asset('OneUI/assets/media/avatars/avatar10.jpg')}}" alt="">
                                    <p class="mt-2 mb-0 text-white font-w500">{{auth()->user()->name}}</p>
                                    <p class="mb-0 text-white-50 font-size-sm">Web Developer</p>
                                </div>
                                <div class="p-2">
                                    <a class="dropdown-item d-flex align-items-center justify-content-between" href="be_pages_generic_inbox.html">
                                        <span class="font-size-sm font-w500">Inbox</span>
                                        <span class="badge badge-pill badge-primary ml-2">3</span>
                                    </a>
                                    <a class="dropdown-item d-flex align-items-center justify-content-between" href="be_pages_generic_profile.html">
                                        <span class="font-size-sm font-w500">Profile</span>
                                        <span class="badge badge-pill badge-primary ml-2">1</span>
                                    </a>
                                    <a class="dropdown-item d-flex align-items-center justify-content-between" href="javascript:void(0)">
                                        <span class="font-size-sm font-w500">Settings</span>
                                    </a>
                                    <div role="separator" class="dropdown-divider"></div>
                                    <a class="dropdown-item d-flex align-items-center justify-content-between" href="op_auth_lock.html">
                                        <span class="font-size-sm font-w500">Lock Account</span>
                                    </a>
                                    <a class="dropdown-item d-flex align-items-center justify-content-between" href="" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <span class="font-size-sm font-w500">Log Out</span>
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- END User Dropdown -->

                        <!-- Notifications Dropdown -->
                        
                        <!-- END Notifications Dropdown -->

                        <!-- Toggle Side Overlay -->
                        <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                        <button type="button" class="btn btn-sm btn-dual ml-2" data-toggle="layout" data-action="side_overlay_toggle">
                            <i class="fa fa-fw fa-list-ul fa-flip-horizontal"></i>
                        </button>
                        <!-- END Toggle Side Overlay -->
                    </div>
                    <!-- END Right Section -->
                </div>
                <!-- END Header Content -->

                <!-- Header Search -->
                
                <!-- END Header Search -->

                <!-- Header Loader -->
                <!-- Please check out the Loaders page under Components category to see examples of showing/hiding it -->
                
                <!-- END Header Loader -->
            </header>
            <!-- END Header -->

            <!-- Main Container -->
            <main id="main-container">
                @yield('content')
            </main>
            @include('layouts.footer')
        </div>
        <script src="{{ asset('OneUI/assets/js/oneui.core.min.js')}}"></script>
        <script src="{{ asset('OneUI/assets/js/oneui.app.min.js')}}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
        @yield('scripts_lib')
        @yield('scripts')
    </body>
</html>
