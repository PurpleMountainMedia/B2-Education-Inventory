@guest
  <a href="{{ route('login') }}">Login</a>

@else
  <a href="{{ route('web.dashboard.index') }}">Dashboard</a>
@endguest
