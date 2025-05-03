<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Loux Ibiza</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    <section class="login_form container">
        @if(Session::has('fail'))
            <div class="alert alert-danger">
                {{Session::get('fail')}}
            </div>
        @endif

        <div class="login-container ">
            <div class="logo">
                <img src="{{asset('img/Group 1.svg')}}" class="img-fluid" alt="Loux Ibiza Logo">
            </div>
            <form class="login-form" action="/login_user" method="post">
                @csrf
                <h2>Welcome Back</h2>
                <div class="input-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit" class="login-button">Login</button>
            </form>
            <p class="signup-link">Don't have an account? <a href="/registration">Sign up</a></p>
        </div>
    </section>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>