@extends('layouts.app')

@section('content')
<div class="container">
    <div style="text-align: right; margin-bottom: 20px;">
        <!-- Logout Button -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" style="background: red; color: white; border: none; padding: 8px 16px; border-radius: 5px;">Logout</button>
        </form>
    </div>

    <h1>Admin Dashboard - All Users</h1>

    <!-- Display Success Message -->
    @if (session('success'))
        <div style="color: green;">
            {{ session('success') }}
        </div>
    @endif

    <!-- Table for Users -->
    <table border="1" cellpadding="10" cellspacing="0" style="width:100%; margin-top:20px;">
        <thead style="background-color: #f2f2f2;">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Registered At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->created_at->format('d-m-Y H:i') }}</td>
                <td>
                    <!-- Edit button -->
                    <a href="{{ route('admin.user.edit', $user->id) }}" style="margin-right: 10px;">Edit</a>

                    <!-- Delete button -->
                    <form action="{{ route('admin.user.destroy', $user->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Are you sure?')" style="color:red; background:none; border:none; cursor:pointer;">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach

            @if($users->isEmpty())
            <tr>
                <td colspan="5" style="text-align:center;">No users found.</td>
            </tr>
            @endif
        </tbody>
    </table>

    <!-- Display Pagination Links -->
    <div class="pagination">
        {{ $users->links() }}
    </div>
</div>
@endsection
