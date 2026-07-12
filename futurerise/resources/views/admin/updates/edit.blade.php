@extends('admin.layout', ['title' => 'Edit Update | Future Rise Foundation'])

@section('content')
    <div class="admin-topbar">
        <div>
            <p class="eyebrow">Edit update</p>
            <h1>{{ $update->title }}</h1>
            <p>Update the public website content or save it as a draft.</p>
        </div>
    </div>

    @include('admin.updates.form', [
        'action' => route('admin.updates.update', $update),
        'method' => 'PUT',
        'buttonText' => 'Save Update',
    ])
@endsection
