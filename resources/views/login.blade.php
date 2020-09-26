<link rel="stylesheet" href="../css/login.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    <!-- Main Section -->
    <section class="main-section">
        <!-- Add Your Content Inside -->
        <div class = "header" id = "all-header">
            <div class="header stock">
                <h2>Stock List</h2>
            </div>
        </div>

        <div class="row">
            <div class="head_text">
                <h1>LOGIN</h1>
            </div>

            <div class="column side"></div>
            <div class="column middle">
                <div class="borderForm">
                    <!-- Remove This Before You Start -->
                    
                    @if(\Session::has('alert'))
                        <div class="alert alert-danger">
                            <div>{{Session::get('alert')}}</div>
                        </div>
                    @endif
                    @if(\Session::has('alert-success'))
                        <div class="alert alert-success">
                            <div>{{Session::get('alert-success')}}</div>
                        </div>
                    @endif
                    <form action="{{ url('/loginPost') }}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Username :') }}</label>
                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>
                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password :') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <div>
                                        <label for="remember"></label> <input type="checkbox" name="remember" value="First Choice">Remember Me</label>
                                    </div>
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Log in') }}
                                    </button>
                                    
                                    <a href="{{ url('/register') }}"class="register">Register</a>
                                    
                                </div>
                            </div>
                            
                    </form>
                </div>
            </div>
        </div>