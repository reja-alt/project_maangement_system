@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="mb-4">
            <h2 class="text-primary">Projects</h2>
        </div>
        <a href="{{ route('projects.create') }}" class="btn btn-success mb-2">Create Project</a>

        <table id="projects-table" class="display">
            <thead>
                <tr>
                    <th>Project Name</th>
                    <th>Project Description</th>
                    <th>Tasks</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            var table = $('#projects-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('projects.data') }}',
                columns: [
                    { data: 'name' },
                    { data: 'description' },
                    { data: 'tasks' },
                    { data: 'action', orderable: false, searchable: false }
                ]
            });

            $('#projects-table').on('click', '.deleteProject', function () {
                var id = $(this).data('id');
                
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
                            url: '/projects/' + id,
                            type: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(result) {
                                table.draw();
                                
                                Swal.fire({
                                    title: 'Deleted!',
                                    text: 'Your project has been deleted.',
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
