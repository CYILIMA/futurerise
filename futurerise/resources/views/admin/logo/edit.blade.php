@extends('admin.layout', ['title' => 'Logo Settings | Future Rise Foundation'])

@section('content')
    <div class="admin-topbar">
        <div>
            <p class="eyebrow">Logo settings</p>
            <h1>Logo Management</h1>
            <p>Upload a new website logo. The selected image will display in the site header and footer.</p>
        </div>
    </div>

    @if(session('status'))
        <div class="form-success">{{ session('status') }}</div>
    @endif

    <section class="admin-card">
        <form action="{{ route('admin.logo.update') }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="logo">Logo image</label>
                <input id="logo" name="logo" type="file" accept="image/*">
                @error('logo')
                    <p class="form-alert">{{ $message }}</p>
                @enderror
            </div>

            @if($logo?->image_path)
                <div class="logo-preview">
                    <p>Current logo preview:</p>
                    <img src="{{ asset('storage/'.$logo->image_path) }}" alt="Current logo" width="120">
                </div>
            @endif

            <button class="button primary" type="submit">Save Logo</button>
        </form>
    </section>
@endsection
