@extends('layouts.site', ['title' => 'FutureRise Foundation | Home'])

@section('content')
    <section class="hero">
        <div class="container hero-grid">
            <div class="hero-copy">
                <p class="eyebrow">Non-governmental organisation</p>
                <h1>Empowering Refugee &amp; Displaced Youth Across Africa</h1>
                <p class="hero-lead">The Guard Family Foundation provides education, mentorship, and community support to refugee and displaced youth. We believe every young person deserves a chance to build a brighter future, regardless of their circumstances.</p>
                <div class="hero-actions">
                    <a class="button primary" href="{{ route('donate') }}">Donate Now</a>
                    <a class="button secondary" href="{{ route('about') }}">Learn About Us</a>
                </div>
            </div>

            <div class="hero-visual" aria-label="Photo slideshow">
                @if($galleryPhotos->isNotEmpty())
                    <div class="hero-slider" data-carousel>
                        <div class="carousel-track" data-carousel-track>
                            @foreach($galleryPhotos as $photo)
                                <article class="hero-slide" data-carousel-slide>
                                    <img src="{{ asset('storage/'.$photo->image_path) }}" alt="Gallery photo">
                                    @if($photo->caption)
                                        <div class="hero-caption">{{ $photo->caption }}</div>
                                    @endif
                                </article>
                            @endforeach
                        </div>

                        <div class="carousel-cont                                                                                                                                                                                                                                                                                                     rols">
                            <button class="carousel-button prev" type="button" aria-label="Previous photo">&#10094;</button>
                            <button class="carousel-button next" type="button" aria-label="Next photo">&#10095;</button>
                        </div>

                        <div class="carousel-indicators">
                            @foreach($galleryPhotos as $photo)
                                <button class="carousel-indicator" type="button" aria-label="Show photo {{ $loop->iteration }}" @if($loop->first) aria-current="true" @endif></button>
                            @endforeach
                        </div>
                    </div>
                @else
                    <div class="hero-fallback">
                        <div class="sun"></div>
                        <div class="hill hill-one"></div>
                        <div class="hill hill-two"></div>
                        <div class="people">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                        <div class="tree">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container intro-grid">
            <div>
                <p class="eyebrow">Our focus</p>
                <h2>Helping communities build stronger futures</h2>
            </div>
            <p>Future Rise Foundation works with local partners, volunteers, and donors to respond to real needs with practical programmes that protect dignity and create opportunity.</p>
        </div>

        <div class="container card-grid">
            <article class="info-card">
                <span class="icon">01</span>
                <h3>Education Support</h3>
                <p>School supplies, mentorship, tutoring, and learning resources for children and young people.</p>
            </article>
            <article class="info-card">
                <span class="icon">02</span>
                <h3>Community Care</h3>
                <p>Food parcels, family support, outreach visits, and referrals for vulnerable households.</p>
            </article>
            <article class="info-card">
                <span class="icon">03</span>
                <h3>Youth Development</h3>
                <p>Skills workshops, leadership activities, and guidance that helps young people prepare for work and life.</p>
            </article>
        </div>
    </section>

    <section class="impact-band">
        <div class="container impact-grid">
            <div>
                <strong>250+</strong>
                <span>Learners supported</span>
            </div>
            <div>
                <strong>40+</strong>
                <span>Active volunteers</span>
            </div>
            <div>
                <strong>12</strong>
                <span>Community projects</span>
            </div>
        </div>
    </section>

    @if($updates->isNotEmpty())
        <section class="section">
            <div class="container intro-grid">
                <div>
                    <p class="eyebrow">Latest updates</p>
                    <h2>News from the foundation</h2>
                </div>
                <p>Follow recent activities, outreach work, fundraising notices, and community stories from Future Rise Foundation.</p>
            </div>

            <div class="container updates-carousel" data-carousel>
                <div class="carousel-track" data-carousel-track>
                    @foreach($updates as $update)
                        <article class="update-card update-slide" data-carousel-slide>
                            @if($update->image_path)
                                <img src="{{ asset('storage/'.$update->image_path) }}" alt="{{ $update->title }}">
                            @endif
                            <div>
                                <time datetime="{{ $update->published_at->toDateString() }}">{{ $update->published_at->format('M d, Y') }}</time>
                                <h3>{{ $update->title }}</h3>
                                <p>{{ $update->summary ?: \Illuminate\Support\Str::limit($update->body, 130) }}</p>
                            </div>
                        </article>
                    @endforeach
                </div>

                <div class="carousel-controls">
                    <button class="carousel-button prev" type="button" aria-label="Previous update">&#10094;</button>
                    <button class="carousel-button next" type="button" aria-label="Next update">&#10095;</button>
                </div>

                <div class="carousel-indicators">
                    @foreach($updates as $update)
                        <button class="carousel-indicator" type="button" aria-label="Show update {{ $loop->iteration }}" @if($loop->first) aria-current="true" @endif></button>
                    @endforeach
                </div>
            </div>

            <div class="container section-link">
                <a class="button secondary" href="{{ route('updates') }}">View All Updates</a>
            </div>
        </section>
    @endif

    <section class="section cta-section">
        <div class="container cta">
            <div>
                <p class="eyebrow">Be part of the rise</p>
                <h2>Your support can move a family forward.</h2>
            </div>
            <a class="button primary" href="{{ route('donate') }}">Support the Mission</a>
        </div>
    </section>
@endsection
