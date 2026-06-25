@extends('layouts.site', ['title' => 'Contact | Future Rise Foundation'])

@section('content')
    <section class="page-hero">
        <div class="container">
            <p class="eyebrow">Contact</p>
            <h1>Let us talk about how we can work together.</h1>
            <p>Reach out for volunteering, donations, partnerships, or community support enquiries.</p>
        </div>
    </section>

    <section class="section">
        <div class="container contact-grid">
            <div class="contact-panel">
                <h2>Get in touch</h2>
                <p><strong>Email:</strong> info@futurerisefoundation.org</p>
                <p><strong>Phone:</strong> +27 00 000 0000</p>
                <p><strong>Location:</strong> South Africa</p>
                <p>Replace these details with your official NGO contact information when ready.</p>
            </div>

            <form class="contact-form" action="#" method="post">
                <label>
                    Full name
                    <input type="text" name="name" placeholder="Your name">
                </label>
                <label>
                    Email address
                    <input type="email" name="email" placeholder="you@example.com">
                </label>
                <label>
                    Message
                    <textarea name="message" rows="6" placeholder="How can we help?"></textarea>
                </label>
                <button class="button primary" type="submit">Send Message</button>
            </form>
        </div>
    </section>
@endsection
