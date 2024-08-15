@extends('layouts.main')

@section('content')
<div class="container">
    <h1>Create New Subtask for Task: {{ $task->name }}</h1>

    <form action="{{ route('projects.tasks.subtasks.store', [$project, $task]) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Subtask Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control">{{ old('description') }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Create Subtask</button>
    </form>
</div>
@endsection
