@extends('layouts.main')

@section('content')
<div class="container">
    <!-- Go Back Button -->
    <div class="mb-4">
        <a href="{{ route('projects.index') }}" class="btn btn-secondary mt-2">
            <i class="fas fa-arrow-left"></i> Go Back to Project
        </a>
    </div>

    <!-- Report Header -->
    <div class="report-header">
        <h1>Project Report</h1>
        <h2>{{ $project->name }}</h2>
        <p>Generated on: {{ now()->format('F j, Y') }}</p>
    </div>

    <!-- Task Overview -->
    <div class="task-overview">
        @foreach ($project->tasks as $task)
            <div class="card task-card mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="card-title mb-0">{{ $task->name }}</h4>
                        <button class="btn btn-link text-decoration-none" data-toggle="collapse" data-target="#collapse-{{ $task->id }}" aria-expanded="false" aria-controls="collapse-{{ $task->id }}">
                            <i class="fas fa-chevron-down"></i> View Subtasks
                        </button>
                    </div>
                    <div class="collapse mt-3" id="collapse-{{ $task->id }}">
                        <p class="card-text">{{ $task->description }}</p>
                        @if ($task->subtasks->count())
                            <div class="subtask-list">
                                <h5 class="subtask-header">Subtasks</h5>
                                <ul class="list-group list-group-flush">
                                    @foreach ($task->subtasks as $subtask)
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <span>{{ $subtask->name }}</span>
                                            <span class="badge badge-secondary">Subtask</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @else
                            <p class="text-muted">No subtasks available.</p>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
