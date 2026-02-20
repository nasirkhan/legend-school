<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>LEGEND - Student Area</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="LEGEND International School" name="description" />
    <meta content="LIS" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset(siteInfo('favicon')) }}">

    <!-- Bootstrap Css -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />

</head>

<body>
<div class="home-btn d-none d-sm-block">
    <a target="_blank" href="{{ route('/') }}" class="text-dark"><i class="fas fa-home h2"></i></a>
</div>
<div class="account-pages my-5 pt-sm-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="card overflow-hidden">
                    <div class="bg-soft-primary">
                        <div class="row">
                            <div class="col-7">
                                <div class="text-primary p-4">
                                    <h5 class="text-primary"> Student Area !!!</h5>
                                    <p>{{ siteInfo('name') }}</p>
                                </div>
                            </div>
                            <div class="col-5 align-self-end">
                                <img src="{{ asset('assets/images/profile-img.png') }}" alt="" class="img-fluid">
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div>
                            <a href="{{ route('/') }}" target="_blank">
                                <div class="avatar-md profile-user-wid mb-4">
                                    <span class="avatar-title rounded-circle bg-light">
                                        <img src="{{ siteInfo('favicon') }}" alt="" class="rounded-circle" height="60">
                                    </span>
                                </div>
                            </a>
                        </div>
                        <div class="p-2">
                            <form class="form-horizontal" method="POST" action="{{ route('student-login') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="student_id">{{ __('Student ID') }}</label>
                                    <input type="text" class="form-control" id="student_id" name="student_id" value="{{ old('student_id') }}" required autofocus>
                                </div>

                                <div class="form-group">
                                    <label for="student_pw">{{ __('Password') }}</label>
                                    <input type="password" class="form-control" id="student_pw" name="password" required>
                                </div>

                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customControlInline" onchange="changeInputType(this)">
                                    <label class="custom-control-label" for="customControlInline">Show Password</label>
                                </div>

                                <div class="mt-3">
                                    <button class="btn btn-primary btn-block waves-effect waves-light" type="submit">Log In</button>
                                </div>

                            </form>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- JAVASCRIPT -->
<script>
    function changeInputType(e){
        let input = document.querySelector('input[name=password]')
        if(e.checked){
            input.type = 'text'
        }else {
            input.type = 'password'
        }
    }
</script>
</body>
</html>
