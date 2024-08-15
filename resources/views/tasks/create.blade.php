@extends('layouts.main')

@section('content')
    <div class="container">
        <h1>Create Task for Project: {{ $project->name }}</h1>

        <form action="{{ route('projects.tasks.store', $project->id) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Task Name</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control"></textarea>
            </div>

            <button type="submit" class="btn btn-success">Create</button>
        </form>
    </div>
@endsection
