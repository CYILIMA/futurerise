@extends('layouts.site', ['title' => $course->title . ' | Future Rise Foundation'])

@section('content')
    <section class="page-hero">
        <div class="container">
            <p class="eyebrow">COURSES</p>
            <h1>{{ $course->title }}</h1>
            <p>{{ $course->summary }}</p>
        </div>
    </section>

    <section class="section">
        <div class="container">
            @if(session('status'))
                <div class="form-success">{{ session('status') }}</div>
            @endif

            @if($errors->any())
                <div class="form-alert">{{ $errors->first('password') }}</div>
            @endif

            @if($isUnlocked)
                <div class="card-grid">
                    <article class="info-card">
                        <h2>Course overview</h2>
                        <p>{{ $course->description }}</p>
                    </article>

                    @if($course->notes)
                        <article class="info-card">
                            <h2>Notes</h2>
                            <p>{!! nl2br(e($course->notes)) !!}</p>
                        </article>
                    @endif

                    @if($course->video_url)
                        <article class="info-card">
                            <h2>Video</h2>
                            <a class="button secondary" href="{{ $course->video_url }}" target="_blank" rel="noopener noreferrer">Watch video</a>
                        </article>
                    @endif

                    @if($course->resource_links)
                        <article class="info-card">
                            <h2>Resources</h2>
                            <p>{!! nl2br(e($course->resource_links)) !!}</p>
                        </article>
                    @endif

                    @if($course->attachment_path)
                        <article class="info-card">
                            <h2>Download</h2>
                            <a class="button primary" href="{{ asset('storage/'.$course->attachment_path) }}" target="_blank" rel="noopener noreferrer">Download attached material</a>
                        </article>
                    @endif
                </div>
            @else
                <div class="admin-form">
                    <form action="{{ route('courses.unlock', $course) }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="password">Enter the course password</label>
                            <input id="password" name="password" type="password" placeholder="Enter password" required>
                        </div>
                        <button class="button primary" type="submit">Unlock course</button>
                    </form>
                </div>
            @endif
        </div>
    </section>
@endsection
