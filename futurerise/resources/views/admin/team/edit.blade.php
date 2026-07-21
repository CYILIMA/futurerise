@extends('admin.layout', ['title' => 'Edit Team Member | Future Rise Foundation'])

@section('content')
    <div class="admin-topbar">
        <div>
            <p class="eyebrow">Team management</p>
            <h1>Edit {{ $teamMember->name }}</h1>
        </div>
    </div>

    <form class="admin-form" action="{{ route('admin.team.update', $teamMember) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <label>Name<input name="name" value="{{ old('name', $teamMember->name) }}" required></label>
        <label>Role<input name="role" value="{{ old('role', $teamMember->role) }}" required></label>
        <label>Background<textarea name="background" rows="6" required>{{ old('background', $teamMember->background) }}</textarea></label>
        <label>Profile image<input name="image" type="file" accept="image/*"></label>
        <label class="checkbox-row"><input name="is_active" type="checkbox" value="1" @checked(old('is_active', $teamMember->is_active))><span>Show staff member publicly</span></label>
        <div class="form-actions">
            <button class="button primary" type="submit">Save changes</button>
            <a class="button secondary" href="{{ route('admin.team.index') }}">Cancel</a>
        </div>
    </form>
@endsection
