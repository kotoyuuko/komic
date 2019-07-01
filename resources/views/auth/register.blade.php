@extends('layouts.web')
@section('title', 'Register')

@section('content')
<form method="POST" action="{{ route('register') }}">
  @csrf

  <p>
    <input type="text" name="name" value="{{ old('name') }}" placeholder="name" required autocomplete="name" autofocus>
  </p>


  <p>
    <input type="email" name="email" value="{{ old('email') }}" placeholder="email" required autocomplete="email">
  </p>

  <p>
    <input type="password" name="password" placeholder="password" required autocomplete="password">
  </p>

  <p>
    <input type="password" class="form-control" name="password_confirmation" placeholder="conform password" required
      autocomplete="password">
  </p>

  <p>
    <button type="submit">register</button>
  </p>
</form>
@endsection
