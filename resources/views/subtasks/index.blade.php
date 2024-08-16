@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="mb-4">
            <h2 class="text-primary">Task Name:  {{ $task->name }}</h2>
        </div>
        <div class="mb-2">
            <a href="{{ route('projects.tasks.subtasks.create', [$task->project_id, $task->id]) }}" class="btn btn-success">Add Subtask</a>
            <a href="{{ route('projects.tasks.index', [$task->project_id, $task->id]) }}" class="btn btn-info">Tasks</a>
            <a href="{{ route('projects.index') }}" class="btn btn-primary">Projects</a>
        </div>

        <table id="subtasks-table" class="display">
            <thead>
                <tr>
                    <th>Subtask Name</th>
                    <th>Subtask Description</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            var table = $('#subtasks-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('subtasks.data', [$task->project_id, $task->id]) }}", // Pass the project ID correctly
                    type: 'GET'
                },
                columns: [
                    { data: 'name', name: 'name' },          // Display the subtask name
                    { data: 'description', name: 'description' },  // Display the subtask description
                    { data: 'action', orderable: false, searchable: false } // Display the action buttons
                ]
            });

            $('#subtasks-table').on('click', '.deleteSubtask', function () {
                var subtaskId = $(this).data('id');
                var taskId = "{{ $task->id }}";
                var projectId = "{{ $task->project_id }}";
                
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
                            url: '/projects/' + projectId + '/tasks/' + taskId + '/subtasks/' + subtaskId,
                            type: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(result) {
                                table.draw();
                                
                                Swal.fire({
                                    title: 'Deleted!',
                                    text: 'Your Subtask has been deleted.',
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

