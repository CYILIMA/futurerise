@extends('admin.layout', ['title' => 'Team Members | Future Rise Foundation'])

@section('content')
    <div class="admin-topbar">
        <div>
            <p class="eyebrow">Staff management</p>
            <h1>Our Team</h1>
            <p>Add and manage the staff members featured on the public Our Team page.</p>
        </div>
        <a class="button secondary" href="{{ route('home') }}">View Website</a>
    </div>

    @if(session('status'))
        <div class="form-success">{{ session('status') }}</div>
    @endif

    <section class="admin-form">
        <form action="{{ route('admin.team.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="name">Full name</label>
                <input id="name" name="name" type="text" value="{{ old('name') }}" required>
                @error('name')
                    <p class="form-alert">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="role">Role</label>
                <input id="role" name="role" type="text" value="{{ old('role') }}" required>
                @error('role')
                    <p class="form-alert">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="background">Background</label>
                <textarea id="background" name="background" rows="5" required>{{ old('background') }}</textarea>
                @error('background')
                    <p class="form-alert">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="image">Profile image</label>
                <input id="image" name="image" type="file" accept="image/*">
                @error('image')
                    <p class="form-alert">{{ $message }}</p>
                @enderror
            </div>

            <label class="checkbox-row">
                <input name="is_active" type="checkbox" value="1" checked>
                <span>Show on public page</span>
            </label>

            <div class="form-actions">
                <button class="button primary" type="submit">Add Staff Member</button>
            </div>
        </form>
    </section>

    <section class="admin-table-card">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Role</th>
                    <th>Background</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($teamMembers as $member)
                    <tr>
                        <td>
                            <strong>{{ $member->name }}</strong>
                        </td>
                        <td>{{ $member->role }}</td>
                        <td>{{ $member->background }}</td>
                        <td>
                            <span @class(['status-pill', 'draft' => ! $member->is_active])>
                                {{ $member->is_active ? 'Visible' : 'Hidden' }}
                            </span>
                        </td>
                        <td class="table-actions">
                            <form action="{{ route('admin.team.update', $member) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label>Name
                                        <input name="name" value="{{ $member->name }}" required>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label>Role
                                        <input name="role" value="{{ $member->role }}" required>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label>Background
                                        <textarea name="background" rows="4" required>{{ $member->background }}</textarea>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label>Image
                                        <input name="image" type="file" accept="image/*">
                                    </label>
                                </div>
                                <label class="checkbox-row">
                                    <input name="is_active" type="checkbox" value="1" {{ $member->is_active ? 'checked' : '' }}>
                                    <span>Visible</span>
                                </label>
                                <button class="button secondary" type="submit">Save</button>
                            </form>

                            <form action="{{ route('admin.team.destroy', $member) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="button danger" type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">No staff members have been added yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </section>
@endsection
