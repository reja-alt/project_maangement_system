@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="mb-4">
            <a href="{{ route('projects.tasks.index', $project->id) }}" class="btn btn-primary mt-2">
                <i class="fas fa-arrow-left"></i> Go Back to Task
            </a>
        </div>

        <div class="mb-4">
            <h2 class="text-primary">Create Task for Project: {{ $project->name }}</h2>
        </div>

        <form action="{{ route('projects.tasks.store', $project->id) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Task Name</label>
                <input type="text" name="name" id="name" class="form-control">
                @error('name')
                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control"></textarea>
            </div>

            <button type="submit" class="btn btn-success">Create</button>
        </form>
    </div>
@endsection
