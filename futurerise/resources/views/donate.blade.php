@extends('layouts.site', ['title' => 'Donate | Future Rise Foundation'])

@section('content')
    <section class="page-hero donate-hero">
        <div class="container">
            <p class="eyebrow">Donate</p>
            <h1>Give today. Help someone rise tomorrow.</h1>
            <p>Your donation helps provide education support, food relief, skills workshops, and care for families who need it most.</p>
        </div>
    </section>

    <section class="section">
        <div class="container donate-grid">
            <article class="donation-card">
                <h2>Once-off donation</h2>
                <p>Support an urgent project or community outreach activity.</p>
                <div class="amounts">
                    <span>R100</span>
                    <span>R250</span>
                    <span>R500</span>
                </div>
                <a class="button primary" href="{{ route('contact') }}">Request Donation Details</a>
            </article>
            <article class="donation-card highlighted">
                <h2>Monthly giving</h2>
                <p>Help us plan consistent support for learners, youth, and families.</p>
                <div class="amounts">
                    <span>R50</span>
                    <span>R150</span>
                    <span>R300</span>
                </div>
                <a class="button light" href="{{ route('contact') }}">Become a Monthly Donor</a>
            </article>
        </div>
    </section>

    <section class="section muted">
        <div class="container two-column">
            <div>
                <h2>Banking details</h2>
                <p>Add the official Future Rise Foundation bank account here once available.</p>
            </div>
            <div class="bank-box">
                <p><strong>Account name:</strong> Future Rise Foundation</p>
                <p><strong>Bank:</strong> To be added</p>
                <p><strong>Account number:</strong> To be added</p>
                <p><strong>Reference:</strong> Donation + your name</p>
            </div>
        </div>
    </section>
@endsection
