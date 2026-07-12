@extends('admin.layout', ['title' => 'Updates Admin | Future Rise Foundation'])

@section('content')
    <div class="admin-topbar">
        <div>
            <p class="eyebrow">Admin panel</p>
            <h1>Website Updates</h1>
            <p>Create, edit, publish, and remove news updates shown on the public website.</p>
        </div>
        <a class="button primary" href="{{ route('admin.updates.create') }}">New Update</a>
    </div>

    @if(session('status'))
        <div class="form-success">{{ session('status') }}</div>
    @endif

    <section class="admin-table-card">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($updates as $update)
                    <tr>
                        <td>
                            <strong>{{ $update->title }}</strong>
                            <span>{{ $update->summary ?: \Illuminate\Support\Str::limit($update->body, 90) }}</span>
                        </td>
                        <td>
                            <span @class(['status-pill', 'draft' => ! $update->is_published])>
                                {{ $update->is_published ? 'Published' : 'Draft' }}
                            </span>
                        </td>
                        <td>{{ $update->published_at?->format('M d, Y') ?? 'Not published' }}</td>
                        <td class="table-actions">
                            <a href="{{ route('admin.updates.edit', $update) }}">Edit</a>
                            <form action="{{ route('admin.updates.destroy', $update) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">No updates have been created yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </section>

    @if($updates->hasPages())
        <div class="pagination-wrap">
            {{ $updates->links() }}
        </div>
    @endif
@endsection
