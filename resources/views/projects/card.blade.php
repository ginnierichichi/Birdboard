
    <div class="card" style="height: 200px" >
        <h3 class="font-normal text-xl mb-2 py-4 -ml-5 border-l-4 border-blue-300 pl-4">
            <a href="{{ $project->path() }}" class="text-black focus:no-underline">{{ $project->title }}</a>
        </h3>

        <div class="text-gray-600">{{ Illuminate\Support\Str::limit($project->description, 150) }}</div>
    </div>
