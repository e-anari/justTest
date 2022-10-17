@extends('layouts.app')

@section('content')

<body class="login">
    <div>
        <div class="login_wrapper">
            <div class="">
                <section class="login_content">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <h1>Login Form</h1>
                        <div>
                            <input type="text" id="usernsme" name="username"
                                class="form-control @error('username') is-invalid @enderror" placeholder="Username"
                                value="{{ old('username') }}" required autocomplete="username" autofocus />
                            @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div>
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" placeholder="Password"
                                name="password" required autocomplete="current-password" />
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div>
                            <x-recaptcha></x-recaptcha>
                        </div>

                        <div>
                            <button type="submit" class="btn btn-default submit">Log in</button>
                            <a class="reset_pass" href="#">Lost your password?</a>
                        </div>

                        <div class="clearfix"></div>

                        <div class="separator">
                            <p class="change_link">New to site?
                                <a href="{{ route('register')}}" class="to_register"> Create Account </a>
                            </p>

                            <div class="clearfix"></div>
                            <br />


                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>
</body>
@endsection