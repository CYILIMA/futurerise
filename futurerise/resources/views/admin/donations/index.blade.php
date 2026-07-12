@extends('admin.layout', ['title' => 'Donation Requests | Future Rise Foundation'])

@section('content')
    <div class="admin-topbar">
        <div>
            <p class="eyebrow">Donation Requests</p>
            <h1>Donor enquiries</h1>
            <p>Review donations submitted through the public donation page and follow up with the donor.</p>
        </div>
    </div>

    @if(session('status'))
        <div class="form-success">{{ session('status') }}</div>
    @endif

    <section class="admin-table-card">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Donation</th>
                    <th>Message</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($donations as $donation)
                    <tr>
                        <td><strong>{{ $donation->name }}</strong></td>
                        <td>{{ $donation->email }}</td>
                        <td>{{ $donation->phone ?: 'Not provided' }}</td>
                        <td>
                            <strong>{{ $donation->donation_type }}</strong>
                            <span>{{ $donation->amount ?: 'No amount provided' }}</span>
                        </td>
                        <td>{{ $donation->message ?: 'No message provided' }}</td>
                        <td>
                            <form action="{{ route('admin.donations.update', $donation) }}" method="post">
                                @csrf
                                @method('PUT')
                                <label class="checkbox-row">
                                    <input name="is_contacted" type="checkbox" value="1" {{ $donation->is_contacted ? 'checked' : '' }}>
                                    <span>Contacted</span>
                                </label>
                                <button class="button secondary" type="submit">Save</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">No donation requests have been received yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </section>

    @if($donations->hasPages())
        <div class="pagination-wrap">
            {{ $donations->links() }}
        </div>
    @endif
@endsection
