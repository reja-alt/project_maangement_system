@extends('layouts.main')

@section('content')
    <div class="container">
        <h1>Tasks for Project: {{ $project->name }}</h1>
        <a href="{{ route('projects.tasks.create', $project->id) }}" class="btn btn-primary">Add Task</a>
        <a href="{{ route('projects.index') }}" class="btn btn-primary">Projects</a>

        <table id="tasks-table" class="display">
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
                                    text: 'Your Task has been deleted.',
                                    icon: 'success',
                                    confirmButtonText: 'OK'
                                });
                            },
                            error: function() {
                                Swal.fire({
                                    title: 'Error!',
                                    text: 'There was a problem deleting the project. Please try again later.',
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
