<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Admin | Future Rise Foundation' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="admin-body">
    <aside class="admin-sidebar">
        <a class="brand admin-brand" href="{{ route('admin.dashboard') }}">
            <span class="brand-mark">FR</span>
            <span>
                <strong>Future Rise</strong>
                <small>Admin</small>
            </span>
        </a>

        <nav class="admin-nav" aria-label="Admin navigation">
            <a href="{{ route('admin.dashboard') }}" @class(['active' => request()->routeIs('admin.dashboard')])>Updates</a>
            <a href="{{ route('admin.updates.create') }}" @class(['active' => request()->routeIs('admin.updates.create')])>New Update</a>
            <a href="{{ route('admin.gallery.index') }}" @class(['active' => request()->routeIs('admin.gallery.index')])>Gallery</a>
            <a href="{{ route('admin.team.index') }}" @class(['active' => request()->routeIs('admin.team.index')])>Our Team</a>
            <a href="{{ route('admin.courses.index') }}" @class(['active' => request()->routeIs('admin.courses.index')])>Courses</a>
            <a href="{{ route('admin.donations.index') }}" @class(['active' => request()->routeIs('admin.donations.index')])>Donations</a>
            <a href="{{ route('admin.social.index') }}" @class(['active' => request()->routeIs('admin.social.index')])>Social Manager</a>
            <a href="{{ route('admin.logo.edit') }}" @class(['active' => request()->routeIs('admin.logo.edit')])>Logo Settings</a>
            <a href="{{ route('home') }}">View Website</a>
        </nav>

        <form action="{{ route('admin.logout') }}" method="post">
            @csrf
            <button class="admin-logout" type="submit">Logout</button>
        </form>
    </aside>

    <main class="admin-main">
        @yield('content')
    </main>
</body>
</html>
