<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <h2 class="text-2xl font-bold mb-4">Welcome, {{ Auth::user()->name }}</h2>

                    {{-- Admin ko Users Table dikhao --}}
                    @if(Auth::user()->role == 'admin')
                        <h2 class="text-3xl font-bold mt-8 mb-4">All Users</h2>

                        <table class="min-w-full bg-white">
                            <thead class="bg-gray-200">
                                <tr>
                                    <th class="py-2 px-4 border-b">ID</th>
                                    <th class="py-2 px-4 border-b">Name</th>
                                    <th class="py-2 px-4 border-b">Email</th>
                                    <th class="py-2 px-4 border-b">Created At</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td class="py-2 px-4 border-b">{{ $user->id }}</td>
                                        <td class="py-2 px-4 border-b">{{ $user->name }}</td>
                                        <td class="py-2 px-4 border-b">{{ $user->email }}</td>
                                        <td class="py-2 px-4 border-b">{{ $user->created_at->format('d M Y') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    {{-- Normal User ko News dikhao --}}
                    @else
                        <h2 class="text-3xl font-bold mt-10 mb-6 text-center text-gray-800">📰 Latest News</h2>

                        @if(isset($news['results']) && count($news['results']) > 0)
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                                @foreach($news['results'] as $article)
                                    <div class="bg-white p-6 rounded-2xl shadow-lg hover:shadow-2xl transition duration-300 border">
                                        <div class="mb-4">
                                            <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ $article['title'] }}</h3>
                                            <p class="text-gray-600 text-sm">{{ \Illuminate\Support\Str::limit($article['summary'], 120) }}</p>
                                        </div>
                                        <div class="mt-4">
                                            <a href="{{ $article['url'] }}" target="_blank" class="inline-block px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">Read More</a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-center text-gray-500 mt-8">No news found.</p>
                        @endif
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
