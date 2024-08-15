@extends('layouts.main')

@section('content')
<div class="container">
    <h1>Edit Subtask for Task: {{ $task->name }}</h1>

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
        <button type="submit" class="btn btn-primary">Update Subtask</button>
    </form>
</div>
@endsection
