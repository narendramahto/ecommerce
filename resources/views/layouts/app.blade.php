<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>
<body>

<header>
    <nav>
        <ul>
            <li><a href="{{ route('home') }}">Home</a></li>
            <li><a href="{{ route('products') }}">Products</a></li>
            <li><a href="{{ route('login') }}" id="login-link">Login</a></li>
            <li><a href="{{ route('cart') }}">Cart</a></li>
        </ul>
    </nav>
</header>

<div id="app">
    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    let user = localStorage.getItem('user_token');

    // Show/hide login/logout based on user's authentication state
    if (user) {
        document.getElementById('login-link').innerText = 'Logout';
        document.getElementById('login-link').href = '/logout';
    } else {
        document.getElementById('login-link').innerText = 'Login';
    }
</script>

</body>
</html>
