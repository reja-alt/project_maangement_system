<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Management System</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <!-- Toastr CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" rel="stylesheet">
    <!-- Datatable -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css">
    <style>
        body {
            background-color: #f4f7f6;
            color: #333;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .report-header {
            background-color: #2c3e50;
            color: #ecf0f1;
            padding: 30px;
            border-radius: 8px;
            text-align: center;
            margin-bottom: 40px;
        }
        .task-card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            background-color: #ffffff;
        }
        .task-card .card-title {
            color: #34495e;
            font-weight: 600;
        }
        .task-card .btn-link {
            color: #3498db;
            font-weight: 600;
        }
        .subtask-header {
            color: #2980b9;
            font-weight: 600;
            margin-top: 15px;
        }
        .list-group-item {
            border: none;
            border-radius: 5px;
            background-color: #f9f9f9;
            margin-bottom: 8px;
        }
        .badge-secondary {
            background-color: #7f8c8d;
        }
        .card-text {
            color: #7f8c8d;
        }
    </style>
</head>
<body>
    @include('layouts.partial.header')
    <div class="container">
        @yield('content')
    </div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<!-- Toastr JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

<!-- Datatable -->
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>

<!-- Sweetalert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    @if (Session::has('message'))
        var type = "{{ Session::get('alert-type', 'info') }}"
        switch (type) {
            case 'info':

                toastr.options.timeOut = 10000;
                toastr.info("{{ Session::get('message') }}");
                var audio = new Audio('audio.mp3');
                audio.play();
                break;
            case 'success':

                toastr.options.timeOut = 10000;
                toastr.success("{{ Session::get('message') }}");
                var audio = new Audio('audio.mp3');
                audio.play();

                break;
            case 'warning':

                toastr.options.timeOut = 10000;
                toastr.warning("{{ Session::get('message') }}");
                var audio = new Audio('audio.mp3');
                audio.play();

                break;
            case 'error':

                toastr.options.timeOut = 10000;
                toastr.error("{{ Session::get('message') }}");
                var audio = new Audio('audio.mp3');
                audio.play();

                break;
        }
    @endif
</script>
@stack('scripts')
</body>
</html>
