@if($errors->any())
    <div class="form-alert">
        {{ $errors->first() }}
    </div>
@endif

<form class="admin-form" action="{{ $action }}" method="post" enctype="multipart/form-data">
    @csrf
    @if($method !== 'POST')
        @method($method)
    @endif

    <label>
        Update title
        <input type="text" name="title" value="{{ old('title', $update->title) }}" maxlength="140" required>
    </label>

    <label>
        Short summary
        <input type="text" name="summary" value="{{ old('summary', $update->summary) }}" maxlength="240">
    </label>

    <label>
        Full update
        <textarea name="body" rows="10" required>{{ old('body', $update->body) }}</textarea>
    </label>

    <label>
        Image
        <input type="file" name="image" accept="image/*">
    </label>

    @if($update->image_path)
        <img class="admin-preview" src="{{ asset('storage/'.$update->image_path) }}" alt="{{ $update->title }}">
    @endif

    <label class="checkbox-row">
        <input type="checkbox" name="is_published" value="1" @checked(old('is_published', $update->is_published))>
        Publish this update on the website
    </label>

    <div class="form-actions">
        <button class="button primary" type="submit">{{ $buttonText }}</button>
        <a class="button secondary" href="{{ route('admin.dashboard') }}">Cancel</a>
    </div>
</form>
