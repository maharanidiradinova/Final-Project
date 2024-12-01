@foreach ($users as $user)
    <tr>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>{{ $user->email_verified_at ? 'Verified' : 'Not Verified' }}</td>
        @if (!$user->email_verified_at)
            <td>
                <form action="{{ route('admin.users.verify', $user->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary">Verify</button>
                </form>
            </td>
        @endif
    </tr>
@endforeach
