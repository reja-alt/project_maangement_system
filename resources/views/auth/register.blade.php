
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Project Management System</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa"
            crossorigin="anonymous"></script>
    </head>

    <body>
        <div class="vh-100 d-flex justify-content-center align-items-center ">
            <div class="col-md-5 p-5 shadow-sm border rounded-5 border-primary bg-white">
                <h2 class="text-center mb-4 text-primary">Sign Up Form</h2>
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Name</label>
                        <input type="text" class="form-control border border-primary" name="name" id="exampleInputEmail1" aria-describedby="emailHelp">
                        @error('name')
                            <div class="alert alert-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input type="email" class="form-control border border-primary" name="email" id="exampleInputEmail1" aria-describedby="emailHelp">
                        @error('email')
                            <div class="alert alert-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control border border-primary" id="exampleInputPassword1">
                        @error('password')
                            <div class="alert alert-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Confirm Password</label>
                        <input type="password" name="password_confirmation" class="form-control border border-primary" id="exampleInputPassword1">
                    </div>
                    <div class="d-grid">
                        <button class="btn btn-primary" type="submit">Sign Up</button>
                    </div>
                </form>
                <div class="mt-3">
                    <p class="mb-0  text-center">Already have an account? <a href="{{ route('login') }}"
                            class="text-primary fw-bold">Login
                            </a></p>
                </div>
            </div>
        </div>
    </body>

</html>
