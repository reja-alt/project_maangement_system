@extends('layouts.main')

@section('content')
<div class="container">
    <div class="mb-4">
        <a href="{{ route('projects.tasks.subtasks.index', [$project, $task]) }}" class="btn btn-primary mt-2">
            <i class="fas fa-arrow-left"></i> Go Back to SubTask
        </a>
    </div>
    <div class="mb-4">
        <h2 class="text-primary">Edit Subtask for Task: {{ $task->name }}</h2>
    </div>

    <form action="{{ route('projects.tasks.subtasks.update', [$project, $task, $subtask]) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Subtask Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $subtask->name) }}" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control">{{ old('description', $subtask->description) }}</textarea>
        </div>
        <button type="submit" class="btn btn-success">Update Subtask</button>
    </form>
</div>
@endsection
