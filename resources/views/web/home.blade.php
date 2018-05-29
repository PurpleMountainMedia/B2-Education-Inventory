@guest
  <a href="{{ route('login') }}">Login</a>

@else
  <a href="{{ route('dashboard.index') }}">Dashboard</a>
@endguest
