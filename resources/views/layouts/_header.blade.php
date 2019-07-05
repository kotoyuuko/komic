<header>
  <h1>{{ config('app.name') }}</h1>
  <nav>
    <ul>
      @guest
      <li><a href="{{ route('login') }}">login</a></li>
      <li><a href="{{ route('register') }}">register</a></li>
      @else
      <li><a href="{{ route('root') }}">home</a></li>
      <li><a href="{{ route('upload') }}">upload</a></li>
      <li><a href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();">logout</a></li>
      @endguest
    </ul>
  </nav>
</header>
<form id="logout-form" action="{{ route('logout') }}" method="POST">
  {{ csrf_field() }}
</form>
