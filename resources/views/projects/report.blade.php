@extends('layouts.main')
@push('css')
<style>
    
</style>
@endpush
@section('content')
<div class="container">
    <!-- Go Back Button -->
    <div class="mb-4">
        <a href="{{ route('projects.index') }}" class="btn btn-secondary mt-2">
            <i class="fas fa-arrow-left"></i> Back to Projects
        </a>
    </div>

    <!-- Report Header -->
    <div class="report-header text-center mb-5">
        <h1 class="display-4">{{ $project->name }} Report</h1>
        <p class="lead">Generated on: {{ now()->format('F j, Y') }}</p>
    </div>

    <!-- Task Overview -->
    <div class="task-overview">
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Task Name</th>
                        <th>Task Description</th>
                        <th>Subtasks</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($project->tasks as $task)
                        <tr>
                            <td>
                                <strong>{{ $task->name }}</strong>
                            </td>
                            <td>{{ $task->description }}</td>
                            <td>
                                @if ($task->subtasks->count())
                                    <ul class="list-unstyled mb-0">
                                        @foreach ($task->subtasks as $subtask)
                                            <li>
                                                <span class="badge badge-secondary">{{ $subtask->name }}</span>
                                                <small class="text-muted">{{ $subtask->description }}</small>
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <span class="text-muted">No subtasks available.</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
