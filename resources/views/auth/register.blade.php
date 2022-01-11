<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>KIoT Allowance</title>
        <meta name="description" content="OneUI - Bootstrap 4 Admin Template &amp; UI Framework created by pixelcave and published on Themeforest">
        <meta name="author" content="pixelcave">
        <meta name="robots" content="noindex, nofollow">
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

        <!-- You can include a specific file from css/themes/ folder to alter the default color theme of the template. eg: -->
        <!-- <link rel="stylesheet" id="css-theme" href="assets/css/themes/amethyst.min.css"> -->
        <!-- END Stylesheets -->
    </head>
    <body>
       
        <div id="page-container">

            <!-- Main Container -->
            <main id="main-container">
                <!-- Page Content -->
                <div class="hero-static">
                    <div class="content">
                        <div class="row justify-content-center">
                            <div class="col-md-8 col-lg-6 col-xl-4">
                                <!-- Sign Up Block -->
                                <div class="block block-rounded block-themed mb-0">
                                    <div class="block-header bg-primary-dark">
                                        <h3 class="block-title">Create Account</h3>
                                        <div class="block-options">
                                            <a class="btn-block-option" href="{{route('login')}}" data-toggle="tooltip" data-placement="left" title="Sign In">
                                                <i class="fa fa-sign-in-alt"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="block-content">
                                        <div class="p-sm-3 px-lg-4 py-lg-5">
                                            <h1 class="h2 mb-1">Hello Welcome</h1>
                                            <p class="text-muted">
                                                Please fill the following details to create a new account.
                                            </p>

                                            <!-- Sign Up Form -->
                                            <!-- jQuery Validation (.js-validation-signup class is initialized in js/pages/op_auth_signup.min.js which was auto compiled from _es6/pages/op_auth_signup.js) -->
                                            <!-- For more info and examples you can check out https://github.com/jzaefferer/jquery-validation -->
                                            <form class="js-validation-signup" action="{{ route('register')}}" method="POST">
                                                @csrf
                                                <div class="py-3">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control form-control-lg form-control-alt" id="name" name="name" placeholder="Username" value="{{ old('name')}}">
                                                        @error('name')
                                                            <div class="text-danger">{{ $message }}</div>    
                                                        @enderror                    
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="email" class="form-control form-control-lg form-control-alt" id="email" name="email" placeholder="Email" value="{{ old('email')}}">
                                                        @error('email')
                                                        <div class="text-danger">{{ $message }}</div>    
                                                    @enderror 
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control form-control-lg form-control-alt" id="employee_id" name="employee_id" placeholder="Employee Id" value="{{ old('employee_id')}}">
                                                        @error('employee_id')
                                                            <div class="text-danger">{{ $message }}</div>    
                                                        @enderror                    
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control form-control-lg form-control-alt" id="first_name" name="first_name" placeholder="First Name" value="{{ old('first_name')}}">
                                                        @error('first_name')
                                                            <div class="text-danger">{{ $message }}</div>    
                                                        @enderror                    
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control form-control-lg form-control-alt" id="middle_name" name="middle_name" placeholder="Middle Name" value="{{ old('middle_name')}}">
                                                        @error('middle_name')
                                                            <div class="text-danger">{{ $message }}</div>    
                                                        @enderror                    
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control form-control-lg form-control-alt" id="last_name" name="last_name" placeholder="Last Name" value="{{ old('last_name')}}">
                                                        @error('last_name')
                                                            <div class="text-danger">{{ $message }}</div>    
                                                        @enderror                    
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control form-control-lg form-control-alt" id="job_title" name="job_title" placeholder="Job Title" value="{{ old('job_title')}}">
                                                        @error('job_title')
                                                            <div class="text-danger">{{ $message }}</div>    
                                                        @enderror                    
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="number" class="form-control form-control-lg form-control-alt" id="salary" name="salary" placeholder="Salary" value="{{ old('salary')}}">
                                                        @error('salary')
                                                            <div class="text-danger">{{ $message }}</div>    
                                                        @enderror                    
                                                    </div>
                                                    
                                                    <div class="form-group">
                                                        <input type="password" class="form-control form-control-lg form-control-alt" id="password" name="password" placeholder="Password">
                                                        @error('password')
                                                        <div class="text-danger">{{ $message }}</div>    
                                                    @enderror 
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="password" class="form-control form-control-lg form-control-alt" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-6 col-xl-5">
                                                        <button type="submit" class="btn btn-block btn-alt-success">
                                                            <i class="fa fa-fw fa-plus mr-1"></i> Sign Up
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                            <!-- END Sign Up Form -->
                                        </div>
                                    </div>
                                </div>
                                <!-- END Sign Up Block -->
                            </div>
                        </div>
                    </div>
                    <div class="content content-full font-size-sm text-muted text-center">
                        &copy; <span data-toggle="year-copy"></span>
                    </div>
                </div>
                <!-- END Page Content -->
            </main>
            <!-- END Main Container -->
        </div>

        <!-- END Page Container -->
        <script src="{{ asset('OneUI/assets/js/oneui.core.min.js')}}"></script>
        <script src="{{ asset('OneUI/assets/js/oneui.app.min.js')}}"></script>
        <!-- Page JS Plugins -->
        <script src="{{ asset('OneUI/assets/js/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
        <!-- Page JS Code -->
        <script src="{{ asset('OneUI/assets/js/pages/op_auth_signin.min.js')}}"></script>
    </body>
</html>
