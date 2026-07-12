<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Future Rise Foundation is a non-governmental organisation supporting education, care, and community development.">
    <title>{{ $title ?? 'Future Rise Foundation' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <header class="site-header">
        <nav class="nav container" aria-label="Main navigation">
            <a class="brand" href="{{ route('home') }}" aria-label="Future Rise Foundation home">
                @if(isset($siteLogo) && $siteLogo->image_path)
                    <img class="brand-logo" src="{{ asset('storage/'.$siteLogo->image_path) }}" alt="Future Rise Foundation logo" width="60" height="60">
                @else
                    <span class="brand-mark">FR</span>
                @endif
                <span>
                    <strong>Future Rise</strong>
                    <small>Foundation</small>
                </span>
            </a>

            <button class="nav-toggle" type="button" aria-label="Toggle navigation" aria-controls="site-nav-links" aria-expanded="false">
                <span></span>
                <span></span>
                <span></span>
            </button>

            <div class="nav-links" id="site-nav-links">
                <a href="{{ route('home') }}" @class(['active' => request()->routeIs('home')])>Home</a>
                <a href="{{ route('about') }}" @class(['active' => request()->routeIs('about')])>About</a>
                <a href="{{ route('team') }}" @class(['active' => request()->routeIs('team')])>Our Team</a>
                <a href="{{ route('courses') }}" @class(['active' => request()->routeIs('courses') || request()->routeIs('courses.show') || request()->routeIs('courses.unlock')])>Courses</a>
                <a href="{{ route('updates') }}" @class(['active' => request()->routeIs('updates')])>Updates</a>
                <a href="{{ route('funding') }}" @class(['active' => request()->routeIs('funding')])>Funding</a>
                <a href="{{ route('contact') }}" @class(['active' => request()->routeIs('contact')])>Contact</a>
                <a class="nav-donate" href="{{ route('donate') }}">Donate</a>
            </div>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="footer">
        <div class="container footer-grid">
            <div>
                <a class="brand footer-brand" href="{{ route('home') }}">
                    @if(isset($siteLogo) && $siteLogo->image_path)
                        <img class="brand-logo" src="{{ asset('storage/'.$siteLogo->image_path) }}" alt="Future Rise Foundation logo" width="44" height="44">
                    @else
                        <span class="brand-mark">FR</span>
                    @endif
                    <span>
                        <strong>Future Rise</strong>
                        <small>Foundation</small>
                    </span>
                </a>
                <p>Raising hope through education, care, and community action.</p>
            </div>
            <div>
                <h2>Quick Links</h2>
                <a href="{{ route('about') }}">About us</a>
                <a href="{{ route('updates') }}">Updates</a>
                <a href="{{ route('funding') }}">Funding</a>
                <a href="{{ route('donate') }}">Donate</a>
            </div>
            <div>
                <h2>Contact</h2>
                <p>Email: info@futurerisefoundation.org</p>
                <p>Phone: +27 00 000 0000</p>
            </div>
            <div>
                <h2>Follow us</h2>
                @include('components.social-icons')
            </div>
        </div>
        <p class="copyright">© {{ date('Y') }} Future Rise Foundation. All rights reserved.</p>
    </footer>
</body>
</html>
