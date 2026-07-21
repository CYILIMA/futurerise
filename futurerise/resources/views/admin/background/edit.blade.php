@extends('admin.layout', ['title' => 'Background Settings | Future Rise Foundation'])

@section('content')
    <div class="admin-topbar">
        <div>
            <p class="eyebrow">Appearance settings</p>
            <h1>Website Background</h1>
            <p>Upload an image to use as the background across the public website.</p>
        </div>
    </div>

    @if(session('status'))
        <div class="form-success">{{ session('status') }}</div>
    @endif

    <section class="admin-card">
        <form action="{{ route('admin.background.update') }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="background">Background image</label>
                <input id="background" name="background" type="file" accept="image/*" required>
                <p>Use a large landscape image for the best result (maximum 10 MB).</p>
                @error('background')
                    <p class="form-alert">{{ $message }}</p>
                @enderror
            </div>

            @if($background?->image_path)
                <div class="logo-preview">
                    <p>Current background:</p>
                    <img src="{{ asset('storage/'.$background->image_path) }}" alt="Current website background" style="width: min(100%, 520px); height: 220px; object-fit: cover;">
                </div>
            @endif

            <button class="button primary" type="submit">Save Background</button>
        </form>
    </section>
@endsection
