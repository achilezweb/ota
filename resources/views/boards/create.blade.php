<x-app-layout>
    <div class="max-w-5xl mx-auto py-6 px-4">
        <h1 class="text-3xl font-semibold mb-6 text-white">Create Job Posting</h1>

        <form method="POST" action="{{ route('boards.store') }}" class="w-full max-w-lg">
            <input type="hidden" id="user_id" name="user_id" value="{{ Auth::user()->id }}">
            @csrf
            <div class="mb-4">
                <label for="title" class="block text-white text-sm font-bold mb-2">Title:</label>
                <input type="text" id="title" name="title" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>
            <div class="mb-4">
                <label for="description" class="block text-white text-sm font-bold mb-2">Description:</label>
                <textarea id="description" name="description" rows="5" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required></textarea>
            </div>
            <div class="mb-6">
                <label for="email" class="block text-white   text-sm font-bold mb-2">Email:</label>
                <input type="email" id="email" name="email" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>
            <button type="submit" class="bg-white hover:bg-white text-black font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Submit</button>
        </form>
    </div>
</x-app-layout>
