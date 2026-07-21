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

    <section class="admin-form">
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

    <section class="admin-table-card">
        <h2>Existing photos</h2>
        <table class="admin-table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Photo</th>
                    <th scope="col">Caption</th>
                    <th scope="col">Visibility</th>
                    <th scope="col">Save</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody>
            @forelse($photos as $photo)
                <tr>
                    <td>
                        {{ $loop->iteration }}
                        <form id="gallery-photo-{{ $photo->id }}" action="{{ route('admin.gallery.update', $photo) }}" method="post">
                            @csrf
                            @method('PUT')
                        </form>
                    </td>
                    <td><img class="admin-table-image" src="{{ asset('storage/'.$photo->image_path) }}" alt="Gallery photo"></td>
                    <td>
                            <input form="gallery-photo-{{ $photo->id }}" aria-label="Caption for photo {{ $loop->iteration }}" name="caption" value="{{ $photo->caption }}" type="text" placeholder="No caption">
                    </td>
                    <td>
                            <label class="checkbox-row">
                                <input form="gallery-photo-{{ $photo->id }}" name="is_active" type="checkbox" value="1" {{ $photo->is_active ? 'checked' : '' }}>
                                <span>{{ $photo->is_active ? 'Visible' : 'Hidden' }}</span>
                            </label>
                    </td>
                    <td>
                            <button form="gallery-photo-{{ $photo->id }}" class="button secondary" type="submit">Save</button>
                    </td>
                    <td>
                        <form action="{{ route('admin.gallery.destroy', $photo) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="button danger" type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">No photos have been uploaded yet.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </section>
@endsection
