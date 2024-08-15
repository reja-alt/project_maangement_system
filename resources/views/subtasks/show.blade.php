@extends('layouts.main')

@section('content')
<div class="container">
    <h1>{{ $project->name }}</h1>
    <p>{{ $project->description }}</p>

    <a href="{{ route('tasks.create', $project) }}" class="btn btn-primary">Create New Task</a>

    <ul>
        @foreach($project->tasks as $task)
        <li>
            <a href="{{ route('tasks.edit', [$project, $task]) }}">{{ $task->name }}</a>
            <ul>
                @foreach($task->subtasks as $subtask)
                <li>{{ $subtask->name }}</li>
                @endforeach
            </ul>
        </li>
        @endforeach
    </ul>
</div>
@endsection
