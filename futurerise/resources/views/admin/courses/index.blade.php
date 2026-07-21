@extends('admin.layout', ['title' => 'Courses Admin | Future Rise Foundation'])

@section('content')
    <div class="admin-topbar">
        <div>
            <p class="eyebrow">Course management</p>
            <h1>Courses</h1>
            <p>Create protected online learning offerings with notes, media, and access passwords.</p>
        </div>
    </div>

    @if(session('status'))
        <div class="form-success">{{ session('status') }}</div>
    @endif

    <section class="admin-form">
        <form action="{{ route('admin.courses.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="title">Course title</label>
                <input id="title" name="title" type="text" value="{{ old('title') }}" required>
                @error('title')
                    <p class="form-alert">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="summary">Short summary</label>
                <input id="summary" name="summary" type="text" value="{{ old('summary') }}" required>
                @error('summary')
                    <p class="form-alert">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="description">Course description</label>
                <textarea id="description" name="description" rows="5" required>{{ old('description') }}</textarea>
                @error('description')
                    <p class="form-alert">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="access_password">Access password</label>
                <input id="access_password" name="access_password" type="text" value="{{ old('access_password') }}" required>
                @error('access_password')
                    <p class="form-alert">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="notes">Course notes</label>
                <textarea id="notes" name="notes" rows="5">{{ old('notes') }}</textarea>
                @error('notes')
                    <p class="form-alert">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="video_url">Video link</label>
                <input id="video_url" name="video_url" type="url" value="{{ old('video_url') }}">
                @error('video_url')
                    <p class="form-alert">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="resource_links">Additional links or resources</label>
                <textarea id="resource_links" name="resource_links" rows="3">{{ old('resource_links') }}</textarea>
                @error('resource_links')
                    <p class="form-alert">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="image">Course image</label>
                <input id="image" name="image" type="file" accept="image/*">
                @error('image')
                    <p class="form-alert">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="attachment">Course notes file</label>
                <input id="attachment" name="attachment" type="file">
                @error('attachment')
                    <p class="form-alert">{{ $message }}</p>
                @enderror
            </div>

            <label class="checkbox-row">
                <input name="is_active" type="checkbox" value="1" checked>
                <span>Show course publicly</span>
            </label>

            <div class="form-actions">
                <button class="button primary" type="submit">Create Course</button>
            </div>
        </form>
    </section>

    <section class="admin-table-card">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Summary</th>
                    <th>Status</th>
                    <th>Edit course</th>
                    <th>Delete course</th>
                </tr>
            </thead>
            <tbody>
                @forelse($courses as $course)
                    <tr>
                        <td><strong>{{ $course->title }}</strong></td>
                        <td>{{ $course->summary }}</td>
                        <td>
                            <span @class(['status-pill', 'draft' => ! $course->is_active])>
                                {{ $course->is_active ? 'Visible' : 'Hidden' }}
                            </span>
                        </td>
                        <td><a class="button secondary" href="{{ route('admin.courses.edit', $course) }}">Edit</a></td>
                        <td>
                            <form action="{{ route('admin.courses.destroy', $course) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="button danger" type="submit">Delete</button>
                            </form>
                        </td>
                        <td class="table-actions legacy-inline-editor">
                            <form action="{{ route('admin.courses.update', $course) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label>Title
                                        <input name="title" value="{{ $course->title }}" required>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label>Summary
                                        <input name="summary" value="{{ $course->summary }}" required>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label>Description
                                        <textarea name="description" rows="4" required>{{ $course->description }}</textarea>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label>Access password
                                        <input name="access_password" value="{{ old('access_password') ?? 'course-password' }}" required>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label>Notes
                                        <textarea name="notes" rows="4">{{ $course->notes }}</textarea>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label>Video link
                                        <input name="video_url" value="{{ $course->video_url }}">
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label>Resources
                                        <textarea name="resource_links" rows="3">{{ $course->resource_links }}</textarea>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label>Image
                                        <input name="image" type="file" accept="image/*">
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label>Attachment
                                        <input name="attachment" type="file">
                                    </label>
                                </div>
                                <label class="checkbox-row">
                                    <input name="is_active" type="checkbox" value="1" {{ $course->is_active ? 'checked' : '' }}>
                                    <span>Visible</span>
                                </label>
                                <button class="button secondary" type="submit">Save</button>
                            </form>

                            <form action="{{ route('admin.courses.destroy', $course) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="button danger" type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">No courses have been created yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </section>
@endsection
