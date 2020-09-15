{{--<div class="card mt-3">--}}
{{--    <ul class="text-xs">--}}
{{--        @foreach($project->activity as $activity)--}}
{{--            <li class={{ $loop->last ? '' : 'mb-1' }}>--}}
{{--                @if ($activity->description === 'created')--}}
{{--                You created {{ $activity->subject->body }}--}}
{{--                @elseif ($activity->description === 'created_task')--}}
{{--                    Created a task--}}
{{--                @elseif ($activity->description === 'completed_task')--}}
{{--                    You completed a task--}}
{{--                @else--}}
{{--                    {{ $activity->description }}--}}
{{--                @endif--}}
{{--                <span class="text-grey-600 ml-5">{{ $activity->created_at->diffForHumans() }}</span>--}}

{{--            </li>--}}
{{--        @endforeach--}}
{{--    </ul>--}}
{{--</div>--}}

<div class="card mt-6">
    <ul class="text-xs list-reset">
        @foreach ($project->activity as $activity)
            <li class="{{ $loop->last ? '' : 'pb-2' }}">
                @include ("projects.activity.{$activity->description}")
                <span class="text-muted ml-5">{{ $activity->created_at->diffForHumans() }}</span>
            </li>
        @endforeach
    </ul>
</div>
