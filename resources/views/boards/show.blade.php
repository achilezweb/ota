<x-app-layout>
    <div class="max-w-5xl mx-auto py-6 px-2">
        <h1 class="text-2xl font-semibold block text-white">BOARD:</h1>
        <ul class="divide-y">

                <li class="py-4 px-2">
                    <a href="#" class="text-xl font-semibold block text-white">{{ $board->title }}</a>
                    <span class="text-sm text-gray-400">
                         {{ $board->description }}
                    </span>
                </li>

        </ul>


        <div class="text-xl font-semibold block text-white"></div>


    </div>
</x-app-layout>
