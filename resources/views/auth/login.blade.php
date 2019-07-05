@extends('layouts.web')
@section('title', 'Login')

@section('content')
<form method="POST" action="{{ route('login') }}">
  @csrf

  <p>
    <input type="email" name="email" value="{{ old('email') }}" placeholder="email" required autocomplete="email"
      autofocus>
  </p>
  @error('email')
  <span class="error">{{ $message }}</span>
  @enderror

  <p>
    <input type="password" name="password" placeholder="password" required autocomplete="password">
  </p>
  @error('password')
  <span class="error">{{ $message }}</span>
  @enderror

  <p>
    <input type="hidden" name="remember" value="1">
    <button type="submit">login</button>
  </p>
</form>
@endsection
