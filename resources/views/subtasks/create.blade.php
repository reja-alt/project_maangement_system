@extends('layouts.main')

@section('content')
<div class="container">
    <div class="mb-4">
        <a href="{{ route('projects.tasks.subtasks.index', [$project, $task]) }}" class="btn btn-primary mt-2">
            <i class="fas fa-arrow-left"></i> Go Back to SubTask
        </a>
    </div>
    <div class="mb-4">
        <h2 class="text-primary">Create New Subtask for Task: {{ $task->name }}</h2>
    </div>

    <form action="{{ route('projects.tasks.subtasks.store', [$project, $task]) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Subtask Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
            @error('name')
                    <div class="alert alert-danger mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control">{{ old('description') }}</textarea>
        </div>
        <button type="submit" class="btn btn-success">Create Subtask</button>
    </form>
</div>
@endsection
