@extends('layouts.main')

@section('content')
    <div class="container">
         <!-- Go Back Button -->
        <div class="mb-4">
            <a href="{{ route('projects.index') }}" class="btn btn-primary mt-2">
                <i class="fas fa-arrow-left"></i> Go Back to Project
            </a>
        </div>
        <div class="mb-4">
            <h2 class="text-primary">Create Project</h2>
        </div>

        <form action="{{ route('projects.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Project Name</label>
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
