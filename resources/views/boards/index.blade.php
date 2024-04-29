<x-app-layout>
    <div class="max-w-5xl mx-auto py-6 px-2">
        <h1 class="text-2xl font-semibold block text-white">Job Boards: <a href="{{ route('boards.create') }}">CREATE JOBS</a></h1>
        <ul class="divide-y">
            @foreach($boards as $board)
                <li class="py-4 px-2">
                    <a href="{{  route('boards.show', $board) }}" class="text-xl font-semibold block text-white">{{ $board->title }}</a>
                    <span class="text-sm text-gray-400">
                         {{ $board->description }} Date: {{ $board->created_at }}
                    </span>
                </li>
            @endforeach
        </ul>


        <div class="text-xl font-semibold block text-white"></div>


    </div>
</x-app-layout>

