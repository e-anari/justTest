@component('layouts.content',['title' => ''])

<body class="login">
    <div>
        <div class="login_wrapper">
            <div id="register" class="">
                <section class="login_content">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <h1>Create Account</h1>
                        <div>
                            <input id="username" type="text" name="username"
                                class="form-control @error('username') is-invalid @enderror" placeholder="Username"
                                required value="{{ old('username') }}" />
                            @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div>
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required
                                autocomplete="new-password" placeholder="Password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div>
                            <input id="password-confirm" type="password" class="form-control"
                                name="password_confirmation" required autocomplete="new-password"
                                placeholder="Confirm Password">

                        </div>
                        <div>
                            <x-recaptcha></x-recaptcha>
                        </div>

                        <div>
                            <button type="submit" class="btn btn-default submit">Submit</button>
                        </div>

                        <div class="clearfix"></div>

                        <div class="separator">
                            <p class="change_link">Already a member ?
                                <a href="{{ route('login')}}" class="to_register"> Log in </a>
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

@endcomponent