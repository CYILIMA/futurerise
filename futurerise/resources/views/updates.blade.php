@extends('layouts.site', ['title' => 'Updates | Future Rise Foundation'])

@section('content')
    <section class="page-hero">
        <div class="container">
            <p class="eyebrow">Updates</p>
            <h1>Latest news and community activities.</h1>
            <p>Read recent announcements, project reports, outreach stories, and opportunities to support Future Rise Foundation.</p>
        </div>
    </section>

    <section class="section">
        <div class="container updates-grid">
            @forelse($updates as $update)
                <article class="update-card">
                    @if($update->image_path)
                        <img src="{{ asset('storage/'.$update->image_path) }}" alt="{{ $update->title }}">
                    @endif
                    <div>
                        <time datetime="{{ $update->published_at->toDateString() }}">{{ $update->published_at->format('M d, Y') }}</time>
                        <h2>{{ $update->title }}</h2>
                        <p>{{ $update->summary ?: \Illuminate\Support\Str::limit($update->body, 180) }}</p>
                        <p>{{ $update->body }}</p>
                    </div>
                </article>
            @empty
                <div class="empty-state">
                    <h2>No updates yet</h2>
                    <p>New foundation updates will appear here after an admin publishes them.</p>
                </div>
            @endforelse
        </div>

        @if($updates->hasPages())
            <div class="container pagination-wrap">
                {{ $updates->links() }}
            </div>
        @endif
    </section>
@endsection
