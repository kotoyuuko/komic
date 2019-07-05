@extends('layouts.app')

@section('app')
<div class="container">
  @include('layouts._header')
  <div class="content">
    @include('layouts._info')
    @yield('content')
  </div>
  @include('layouts._footer')
</div>
@stop
