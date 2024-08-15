@extends('layouts.main')

@section('content')
    <div class="container">
        <h1>Edit Project</h1>

        <form action="{{ route('projects.update', $project->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Project Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $project->name }}" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control">{{ $project->description }}</textarea>
            </div>

            <button type="submit" class="btn btn-success">Update</button>
        </form>
    </div>
@endsection
