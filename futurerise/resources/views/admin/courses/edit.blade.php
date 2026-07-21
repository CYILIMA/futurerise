@extends('admin.layout', ['title' => 'Edit Course | Future Rise Foundation'])

@section('content')
    <div class="admin-topbar">
        <div>
            <p class="eyebrow">Course management</p>
            <h1>Edit {{ $course->title }}</h1>
        </div>
    </div>

    <form class="admin-form" action="{{ route('admin.courses.update', $course) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <label>Title<input name="title" value="{{ old('title', $course->title) }}" required></label>
        <label>Summary<input name="summary" value="{{ old('summary', $course->summary) }}" required></label>
        <label>Description<textarea name="description" rows="6" required>{{ old('description', $course->description) }}</textarea></label>
        <label>New access password<input name="access_password" type="text" required></label>
        <label>Notes<textarea name="notes" rows="5">{{ old('notes', $course->notes) }}</textarea></label>
        <label>Video link<input name="video_url" type="url" value="{{ old('video_url', $course->video_url) }}"></label>
        <label>Additional links or resources<textarea name="resource_links" rows="4">{{ old('resource_links', $course->resource_links) }}</textarea></label>
        <label>Course image<input name="image" type="file" accept="image/*"></label>
        <label>Course notes file<input name="attachment" type="file"></label>
        <label class="checkbox-row"><input name="is_active" type="checkbox" value="1" @checked(old('is_active', $course->is_active))><span>Show course publicly</span></label>
        <div class="form-actions">
            <button class="button primary" type="submit">Save changes</button>
            <a class="button secondary" href="{{ route('admin.courses.index') }}">Cancel</a>
        </div>
    </form>
@endsection
