@extends('layouts.app')

@section('content')

    <div class="lg:w-1/2 lg:mx-auto bg-card p-6 md:py-12 md:px-16 rounded shadow">
        <h1 class="text-2xl font-normal mb-10 text-center">
            Let's start something new
        </h1>

        <form
            method="POST"
            action="/projects"
        >
            @include ('projects.form', [
                'project' => new App\Project,
                'buttonText' => 'Create Project'
            ])
        </form>
    </div>

{{--<form method="POST" action="/projects"--}}
{{--      class="lg:w-1/2 lg:mx-auto bg-white py-12 px-16 rounded shadow">--}}

{{--    @csrf--}}

{{--    <h1 class="text-2xl font-normal mb-10 text-center">Create A Project.</h1>--}}


{{--    <div class="field">--}}
{{--        <label class="label text:md mb-4 block" for="title">Title</label>--}}

{{--        <div class="control">--}}
{{--            <input type="text" class="input bg-transparent border border-grey-light rounded mb-2 p-2 text-xs w-full" name="title" placeholder="Title">--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    <div class="field">--}}
{{--        <label class="label text:md mb-2 block" for="description">Description</label>--}}

{{--        <div class="control">--}}
{{--            <textarea name="description" class="textarea bg-transparent border border-grey-light rounded mb-2 p-2 text-xs w-full"></textarea>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    <div class="field">--}}
{{--            <div class="control">--}}
{{--                <button type="submit" class="button is-link">Create Project</button>--}}
{{--                <a href="/projects" class="pl-4">Cancel</a>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</form>--}}

@endsection
