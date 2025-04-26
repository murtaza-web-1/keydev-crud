<x-app-layout>
    <div class="container">
        <h1>Edit User</h1>

        <form action="{{ route('admin.user.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div style="margin-bottom:10px;">
                <label>Name:</label><br>
                <input type="text" name="name" value="{{ $user->name }}" required>
            </div>

            <div style="margin-bottom:10px;">
                <label>Email:</label><br>
                <input type="email" name="email" value="{{ $user->email }}" required>
            </div>

            <button type="submit">Update User</button>
        </form>
    </div>
</x-app-layout>
