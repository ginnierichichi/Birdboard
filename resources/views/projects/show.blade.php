@extends ('layouts.app')

@section('content')

    <header class="flex items-center mb-3 py-4">
        <div class="flex justify-between items-centre w-full">
            <p class="text-gray-600" style="font-size: 20px;">
                <a href="/projects">My Projects</a> / {{$project->title}}
            </p>
            <a href="{{ $project->path() . '/edit' }}" class="button">Edit Project</a>
        </div>
    </header>

    <main>
          <div class="flex -mx-3">
              <div class="lg:w-3/4 px-3">
                  <div class="mb-6">
                        <h2 class="text-grey-600" style="font-size: 20px;">Tasks</h2>
                      {{--tasks--}}
                      @foreach ($project->tasks as $task)
                          <div class="card mb-3">
                              <form method="POST" action="{{ $project->path() . '/tasks/' . $task->id }}">
                                  @method('PATCH')
                                  @csrf
                                  <div class="flex">
                                      <input name="body" value="{{ $task->body }}" class="w-full {{ $task->completed ? 'text-grey-600' : '' }}">
                                      <input name="completed" type="checkbox" onChange="this.form.submit()" {{ $task->completed ? 'checked' : '' }}>
                                  </div>

                              </form>
                          </div>
                      @endforeach

                      <div class="card mb-3">
                          <form action="{{ $project->path() . '/tasks' }}" method="POST">
                              @csrf
                              <input placeholder="Add new tasks here" class="w-full" name="body">
                          </form>
                      </div>

                  </div>
                  <h2 class="text-grey-600" style="font-size: 20px;">General Notes</h2>
                  {{--general notes--}}
                  <form method="POST" action="{{ $project->path() }}">
                      @csrf
                      @method('PATCH')
                    <textarea
                        name="notes"
                        class="card w-full mb-4"
                        style="min-height: 200px"
                        placeholder="Put your thoughts here."
                    >{{ $project->notes }}</textarea>
                      <button type="submit" class="button">Save</button>
                  </form>
              </div>

              @if  ($errors->any())
                  <div class="field mt-6">
                      @foreach($error->all() as $error)
                          <li class="text-sm text-red-700">{{ $error }}</li>
                      @endforeach
                  </div>
              @endif

              <div class="lg:w-1/4 px-3">
                  @include('projects.card')
                  @include('projects.activity.card')

              </div>
          </div>

    </main>



@endsection
