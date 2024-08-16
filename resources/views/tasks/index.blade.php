@extends('layouts.main')

@section('content')
    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <!-- Alerts for Success and Error Messages -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @elseif(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <!-- Project Name Header -->
        <div class="mb-4">
            <h2 class="text-primary">Project Name:  {{ $project->name }}</h2>
        </div>

        <!-- CSV Import Form -->
        <div class="mb-4">
            <h4 class="mb-3">Import Tasks from CSV</h4>
            <form action="{{ route('tasks.import', $project->id) }}" method="POST" enctype="multipart/form-data" class="form-inline">
                @csrf
                <div class="form-group mb-2">
                    <label for="csv_file" class="sr-only">CSV File</label>
                    <input type="file" name="csv_file" id="csv_file" class="form-control-file" required>
                </div>
                <button type="submit" class="btn btn-success mb-2">Import Tasks</button>
            </form>
        </div>

        <!-- Add Task Button -->
        <div class="mb-4">
            <a href="{{ route('projects.tasks.create', $project->id) }}" class="btn btn-success">Add Task</a>
            <a href="{{ route('projects.index') }}" class="btn btn-info">Projects</a>
        </div>

        <!-- Tasks Table -->
        <table id="tasks-table" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Task Name</th>
                    <th>Task Description</th>
                    <th>SubTasks</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            var table = $('#tasks-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('tasks.data', $project->id) }}", // Pass the project ID correctly
                    type: 'GET'
                },
                columns: [
                    { data: 'name' },
                    { data: 'description' },
                    { data: 'subtasks' },
                    { data: 'action', orderable: false, searchable: false }
                ]
            });

            $('#tasks-table').on('click', '.deleteTask', function () {
                var taskId = $(this).data('id');
                var projectId = "{{ $project->id }}";

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '/projects/' + projectId + '/tasks/' + taskId,
                            type: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(result) {
                                table.draw();
                                
                                Swal.fire({
                                    title: 'Deleted!',
                                    text: 'Your task has been deleted.',
                                    icon: 'success',
                                    confirmButtonText: 'OK'
                                });
                            },
                            error: function() {
                                Swal.fire({
                                    title: 'Error!',
                                    text: 'There was a problem deleting the task. Please try again later.',
                                    icon: 'error',
                                    confirmButtonText: 'OK'
                                });
                            }
                        });
                    }
                });
            });
        });
    </script>
@endpush
