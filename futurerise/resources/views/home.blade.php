@extends('layouts.site', ['title' => 'Future Rise Foundation | Home'])

@section('content')
    <section class="hero">
        <div class="container hero-grid">
            <div class="hero-copy">
                <p class="eyebrow">Non-governmental organisation</p>
                <h1>FutureRise Foundation</h1>
                <p class="hero-lead">We help children, youth, and vulnerable families rise through education support, community care, skills development, and sustainable local projects.</p>
                <div class="hero-actions">
                    <a class="button primary" href="{{ route('donate') }}">Donate Now</a>
                    <a class="button secondary" href="{{ route('about') }}">Learn About Us</a>
                </div>
            </div>
            <div class="hero-visual" aria-label="Community support illustration">
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
