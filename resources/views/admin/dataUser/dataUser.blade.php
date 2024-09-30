<div id="layoutSidenav_content">
    @section('content')
<div class="container mx-auto mt-10">
    <h1 class="text-2xl font-bold mb-4">User Management</h1>

    @if (session('success'))
        <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-4">
        <a href="" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Create User</a>
    </div>

    <table class="min-w-full bg-white border">
        <thead class="bg-gray-800 text-white">
            <tr>
                <th class="py-2 px-4 text-left">ID</th>
                <th class="py-2 px-4 text-left">Name</th>
                <th class="py-2 px-4 text-left">Email</th>
                <th class="py-2 px-4 text-left">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr class="border-b">
                    <td class="py-2 px-4">{{ $user->id }}</td>
                    <td class="py-2 px-4">{{ $user->name }}</td>
                    <td class="py-2 px-4">{{ $user->email }}</td>
                    <td class="py-2 px-4">
                        <a href="" class="bg-yellow-500 hover:bg-yellow-700 text-white py-1 px-2 rounded">Edit</a>
                        <form action="">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white py-1 px-2 rounded" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
