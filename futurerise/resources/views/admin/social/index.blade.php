@extends('admin.layout', ['title' => 'Social Links | Future Rise Foundation'])

@section('content')
    <div class="admin-topbar">
        <div>
            <p class="eyebrow">Social manager</p>
            <h1>Social media links</h1>
            <p>All social icons are already shown on the site. Paste the public profile links below and save them.</p>
        </div>
    </div>

    @if(session('status'))
        <div class="form-success">{{ session('status') }}</div>
    @endif

    <section class="admin-table-card">
        <form action="{{ route('admin.social.store') }}" method="post">
            @csrf
            <table class="admin-table">
                <thead>
                    <tr>
                        <th scope="col">Platform</th>
                        <th scope="col">Profile link</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
            @foreach($platforms as $platformKey => $platformName)
                @php
                    $currentLink = $socialLinks->get($platformName)?->url ?? '';
                @endphp

                <tr>
                    <td><strong>{{ $platformName }}</strong></td>
                    <td><input
                        id="social-link-{{ $platformKey }}"
                        name="social_links[{{ $platformKey }}]"
                        type="url"
                        value="{{ old('social_links.' . $platformKey, $currentLink) }}"
                        placeholder="https://{{ strtolower($platformName) }}.com/your-page"
                    ></td>
                    <td><span @class(['status-pill', 'draft' => $currentLink === ''])>{{ $currentLink === '' ? 'Not set' : 'Configured' }}</span></td>
                </tr>
            @endforeach
                </tbody>
            </table>
            <div class="form-actions">
                <button class="button primary" type="submit">Save social links</button>
            </div>
        </form>
    </section>
@endsection
