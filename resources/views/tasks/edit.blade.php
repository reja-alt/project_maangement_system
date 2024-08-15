@extends('layouts.main')

@section('content')
    <div class="container">
        <h1>Edit Task for Project: {{ $project->name }}</h1>

        <form action="{{ route('projects.tasks.update', [$project->id, $task->id]) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Task Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $task->name }}" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control">{{ $task->description }}</textarea>
            </div>

            <button type="submit" class="btn btn-success">Update</button>
        </form>
    </div>
@endsection
