<x-app-layout>
    <div class="max-w-5xl mx-auto py-6 px-2">
        <ul class="divide-y">
            @foreach($jobs as $job)
                <li class="py-4 px-2">
                    <a href="{{  route('jobs.index', $job) }}" class="text-xl font-semibold block text-white">{{ $job->title }}</a>
                    <span class="text-sm text-gray-400">
                         {{ $job->description }}
                    </span>
                </li>
            @endforeach
        </ul>


        {{ $posts->links() }}


        <div class="text-xl font-semibold block text-white">Pages:</div>


    </div>
</x-app-layout>
