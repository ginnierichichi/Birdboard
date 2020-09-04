@extends ('layouts.app')

@section('content')

    <header class="flex items-center mb-3 py-4">
        <div class="flex justify-between items-centre w-full">
            <p class="text-gray-600" style="font-size: 20px;">
                <a href="/projects">My Projects</a> / {{$project->title}}
            </p>
            <a href="/projects/create" class="button">New Project</a>
        </div>
    </header>

    <main>
          <div class="flex -mx-3">
              <div class="lg:w-3/4 px-3">
                  <div class="mb-6">
                        <h2 class="text-grey-600" style="font-size: 20px;">Tasks</h2>
                        {{--tasks--}}
                  </div>
                  <h2 class="text-grey-600" style="font-size: 20px;">General Notes</h2>
                  {{--general notes--}}
                  <textarea class="card w-full" style="min-height: 200px">Lorem Ipsum</textarea>
              </div>


              <div class="lg:w-1/4 px-3">
                  @include('projects.card')
              </div>
          </div>

    </main>



@endsection
