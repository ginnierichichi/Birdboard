@extends('layouts.app')

@section('content')

    <h1 class="text-2xl font-normal mb-10 text-center">Edit A Project.</h1>

    <form method="POST" action="{{ $project->path() }}"
          class="lg:w-1/2 lg:mx-auto bg-white py-12 px-16 rounded shadow">

        @method('PATCH')
        @include('projects.form', ['project => new App\Project'])
    </form>

@endsection
