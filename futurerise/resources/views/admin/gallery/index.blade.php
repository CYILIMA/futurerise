@extends('admin.layout', ['title' => 'Gallery Photos | Future Rise Foundation'])

@section('content')
    <div class="admin-topbar">
        <div>
            <p class="eyebrow">Photo gallery</p>
            <h1>Gallery Photos</h1>
            <p>Upload and manage website gallery images shown in the homepage slideshow.</p>
        </div>
    </div>

    @if(session('status'))
        <div class="form-success">{{ session('status') }}</div>
    @endif

    <section class="admin-card">
        <form action="{{ route('admin.gallery.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="photo">Photo</label>
                <input id="photo" name="photo" type="file" accept="image/*" required>
                @error('photo')
                    <p class="form-alert">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="caption">Caption</label>
                <input id="caption" name="caption" type="text" value="{{ old('caption') }}">
                @error('caption')
                    <p class="form-alert">{{ $message }}</p>
                @enderror
            </div>

            <button class="button primary" type="submit">Upload Photo</button>
        </form>
    </section>

    <section class="admin-card">
        <h2>Existing photos</h2>
        <div class="gallery-list">
            @forelse($photos as $photo)
                <article class="gallery-item">
                    <img src="{{ asset('storage/'.$photo->image_path) }}" alt="Gallery photo" width="180">
                    <form action="{{ route('admin.gallery.update', $photo) }}" method="post" class="gallery-item-form">
                        @csrf
                        @method('PUT')
                        <label>
                            Caption
                            <input name="caption" value="{{ $photo->caption }}" type="text">
                        </label>
                        <label>
                            Active
                            <input name="is_active" type="checkbox" value="1" {{ $photo->is_active ? 'checked' : '' }}>
                        </label>
                        <button class="button secondary" type="submit">Save</button>
                    </form>
                    <form action="{{ route('admin.gallery.destroy', $photo) }}" method="post" class="gallery-item-delete">
                        @csrf
                        @method('DELETE')
                        <button class="button danger" type="submit">Delete</button>
                    </form>
                </article>
            @empty
                <p>No photos have been uploaded yet.</p>
            @endforelse
        </div>
    </section>
@endsection
