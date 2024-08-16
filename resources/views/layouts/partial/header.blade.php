<nav class="navbar navbar-expand-lg navbar-light bg-primary">
  <div class="container-fluid">
      <a class="navbar-brand text-white" href="{{ route('projects.index') }}"><b>Project Management System</b></a>
      <form method="POST" action="{{ route('logout') }}" class="d-inline">
          @csrf
          <button class="btn btn-outline-light" type="submit">Logout</button>
      </form>
  </div>
</nav>
