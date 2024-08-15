<nav class="navbar navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand">Project Mangement System</a>
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button class="btn btn-outline-success" type="submit">Logout</button>
      </form>
    </div>
  </nav>