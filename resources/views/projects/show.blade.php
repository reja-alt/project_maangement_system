@extends('layouts.main')

@section('content')
    <div class="container">
        <h1>Projects</h1>
        <h3>{{ $project->name }}</h3>
        <p>{{ $project->description }}</p>

        <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-warning">Edit</a>

        <form action="{{ route('projects.destroy', $project->id) }}" method="POST" style="display:inline-block;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>

        <hr>

        <h2>Tasks</h2>
        <a href="{{ route('projects.tasks.create', $project->id) }}" class="btn btn-primary">Add Task</a>

        <ul>
            @foreach ($project->tasks as $task)
                <li> <a href="{{ route('projects.tasks.show', [$project->id, $task->id]) }}">{{ $task->name }}</a></li>
            @endforeach
        </ul>
    </div>
@endsection
