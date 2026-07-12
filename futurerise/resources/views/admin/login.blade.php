<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | Future Rise Foundation</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="login-body">
    <main class="login-card">
        <a class="brand" href="{{ route('home') }}">
            <span class="brand-mark">FR</span>
            <span>
                <strong>Future Rise</strong>
                <small>Foundation Admin</small>
            </span>
        </a>

        <div>
            <p class="eyebrow">Admin access</p>
            <h1>Sign in to publish updates.</h1>
        </div>

        @if($errors->any())
            <div class="form-alert">{{ $errors->first() }}</div>
        @endif

        <form class="contact-form" action="{{ route('admin.login.store') }}" method="post">
            @csrf
            <label>
                Email address
                <input type="email" name="email" value="{{ old('email') }}" required autofocus>
            </label>
            <label>
                Password
                <input type="password" name="password" required>
            </label>
            <button class="button primary" type="submit">Login</button>
        </form>
    </main>
</body>
</html>
