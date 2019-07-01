@extends('layouts.web')
@section('title', 'Upload')

@section('content')
<form method="POST" action="{{ route('upload') }}" enctype="multipart/form-data">
  @csrf

  <p>
    <input type="file" name="file" placeholder="select zip file">
  </p>

  <p>
    <button type="submit">upload</button>
  </p>

</form>
@stop
