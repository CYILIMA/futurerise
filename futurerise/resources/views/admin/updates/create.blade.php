@extends('admin.layout', ['title' => 'New Update | Future Rise Foundation'])

@section('content')
    <div class="admin-topbar">
        <div>
            <p class="eyebrow">New update</p>
            <h1>Publish website news</h1>
            <p>Add an announcement, outreach story, funding notice, or programme report.</p>
        </div>
    </div>

    @include('admin.updates.form', [
        'action' => route('admin.updates.store'),
        'method' => 'POST',
        'buttonText' => 'Publish Update',
    ])
@endsection
