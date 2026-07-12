@extends('layouts.site', ['title' => 'Our Team | Future Rise Foundation'])

@section('content')
    <section class="page-hero">
        <div class="container">
            <p class="eyebrow">OUR TEAM</p>
            <h1>Meet the people behind Future Rise Foundation</h1>
            <p>Our team brings together committed professionals, volunteers, and community advocates who help young people and families move forward with dignity and opportunity.</p>
        </div>
    </section>

    <section class="section">
        <div class="container card-grid">
            @forelse($teamMembers as $member)
                <article class="info-card">
                    @if($member->image_path)
                        <img src="{{ asset('storage/'.$member->image_path) }}" alt="{{ $member->name }}" style="width: 100%; border-radius: 12px; aspect-ratio: 4 / 4; object-fit: cover; margin-bottom: 20px;">
                    @else
                        <div style="display:grid; place-items:center; width:100%; aspect-ratio:4/4; border-radius:12px; background:var(--green-50); color:var(--green-800); font-size:2rem; font-weight:900; margin-bottom:20px;">{{ strtoupper(substr($member->name, 0, 1)) }}</div>
                    @endif
                    <p class="eyebrow">{{ $member->role }}</p>
                    <h2>{{ $member->name }}</h2>
                    <p>{{ $member->background }}</p>
                </article>
            @empty
                <div class="empty-state">
                    <h2>No staff members have been added yet.</h2>
                    <p>The team page will appear here once the admin publishes staff profiles.</p>
                </div>
            @endforelse
        </div>
    </section>
@endsection
