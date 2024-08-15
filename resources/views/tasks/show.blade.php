@extends('layouts.main')

@section('content')
    <div class="container">
        <h1>Tasks</h1>
        <h3>{{ $task->name }}</h1>
        <p>{{ $task->description }}</p>

        <a href="{{ route('projects.tasks.edit', [$project->id, $task->id]) }}" class="btn btn-warning">Edit</a>

        <form action="{{ route('projects.tasks.destroy', [$project->id, $task->id]) }}" method="POST" style="display:inline-block;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>

        <hr>

        <h2>Subtasks</h2>
        <a href="{{ route('projects.tasks.subtasks.create', [$project->id, $task->id]) }}" class="btn btn-primary">Add Subtask</a>

        <ul>
            @foreach ($task->subtasks as $subtask)
                <li>{{ $subtask->name }}</li>
            @endforeach
        </ul>
    </div>
@endsection
