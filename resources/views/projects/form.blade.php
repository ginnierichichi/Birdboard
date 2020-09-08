@csrf

    <div class="field">
        <label class="label text:md mb-4 block" for="title">Title</label>

        <div class="control">
            <input
                type="text"
                class="input bg-transparent border border-grey-light rounded p-2 text-xs w-full"
                name="title"
                placeholder="My next awesome project"
                required
                value="{{ $project->title }}">
        </div>

    <div class="field">
        <label class="label text:md mb-2 block" for="description">Description</label>

        <div class="control">
            <textarea
                name="description"
                rows="10"
                class="textarea bg-transparent border border-grey-light rounded mb-2 p-2 text-xs w-full"
                placeholder="Edit here:" required>{{ $project->description }}</textarea>
        </div>
    </div>

    <div class="field">
        <div class="control">
            <button type="submit" class="button is-link">Update Project</button>
            <a href="{{ $project->path() }}" class="pl-4">Cancel</a>
        </div>
    </div>

        @if  ($errors->any())
            <div class="field mt-6">
                @foreach($error->all() as $error)
                    <li class="text-sm text-red-700">{{ $error }}</li>
                @endforeach
            </div>
        @endif
