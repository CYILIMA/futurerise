@extends('layouts.site', ['title' => 'Courses | Future Rise Foundation'])

@section('content')
    <section class="page-hero">
        <div class="container">
            <p class="eyebrow">COURSES</p>
            <h1>Online learning opportunities for members</h1>
            <p>Access protected training resources shared by Future Rise Foundation. Each course is unlocked with an access password provided by the admin.</p>
        </div>
    </section>

    <section class="section">
        <div class="container card-grid">
            @forelse($courses as $course)
                <article class="info-card">
                    @if($course->image_path)
                        <img src="{{ asset('storage/'.$course->image_path) }}" alt="{{ $course->title }}" style="width: 100%; border-radius: 12px; aspect-ratio: 16 / 10; object-fit: cover; margin-bottom: 20px;">
                    @endif
                    <p class="eyebrow">Protected course</p>
                    <h2>{{ $course->title }}</h2>
                    <p>{{ $course->summary }}</p>
                    <a class="button secondary" href="{{ route('courses.show', $course) }}">Open Course</a>
                </article>
            @empty
                <div class="empty-state">
                    <h2>No courses are available yet.</h2>
                    <p>The admin will publish learning content here when new courses are ready.</p>
                </div>
            @endforelse
        </div>
    </section>
@endsection
