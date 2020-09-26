

<link rel="stylesheet" href="../css/Register.css">
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
                <h1>REGISTER</h1>
            </div>

            <div class="column side"></div>
            <div class="column middle">
                <div class="borderForm">
                    <!-- Remove This Before You Start -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    
                    <form action="{{ url('/registerPost') }}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="alamat"></label>
                            <input type="text"  class="form-control" id="name" name="name"placeholder="Full Name">
                        </div>
                        <div class="form-group">
                            <label for="username"></label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Username">
                        </div>
                        <div class="form-group">
                            <label for="alamat"></label>
                            <input type="password" class="form-control" id="password" name="password"placeholder="Password">
                        </div>
                        <div class="form-group">
                            <label for="alamat"></label>
                            <input type="password" class="form-control" id="confirmation" name="confirmation"placeholder="Confirm Password">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-md btn-primary">Submit</button>
                            <button type="reset" class="btn btn-md btn-danger">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /.content -->
    </section>
    <!-- /.main-section -->
