<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Dashboard</title>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
    <link rel="stylesheet" href="../css/Master.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/css/bootstrap.min.css" integrity="sha384-VCmXjywReHh4PwowAiWNagnWcLhlEJLA5buUprzK8rxFgeH0kww/aWY76TfkUoSX" crossorigin="anonymous">
</head>
<body>
    <div id="app">
        <div class="topnav">
            <a class="active" href="/dashboard">Stock List</a>
            <div class="topnav-right">
                <a href="/cart-list"><img src="../image/cart.png" alt="cart"></a>
            </div>
        </div>
        <!-- Main Section -->
        <section class="main-section">
        <!-- Add Your Content Inside -->
        <div class="content">
            <!-- Remove This Before You Start -->
            <div class = "menuBar">
                <div class = "menus">
                    <a href="/dashboard">Dashboard</a>
                </div>
                <div class = "menus">
                    <a href="/stock-list">Stock List</a>
                </div>
                <div class = "menus">
                    <a href="/history">History</a>
                </div>
                @hasrole('Admin')
                <div class = "menus">
                    <a href="/account">Accounts</a>
                </div>
                @endhasrole
                <div class = "menus">
                    <a href="/myprofile">My Profile</a>
                </div>
                @if(Session::get('login')||Auth::getRecallerName())
                <a href="/logout"><button type="button" class="btn btn-danger btn-sm" id="logout">Log out</button></a>
                @endif
            </div>
            <main class="py-4">
                @yield('content')
            </main>
        </div>
        </section>
    </div>
</body>
</html>
