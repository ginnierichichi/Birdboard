@extends ('layouts.app')

@section('content')

<body>
<h1>{{ $project->title }}</h1>
<div>{{$project->description}}</div>
<a href="/projects">Go Back</a>

@endsection
