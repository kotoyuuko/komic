@extends('layouts.web')
@section('title', 'Komic')

@section('content')
<section class="comic-list">
  @foreach ($comics as $comic)
  <div class="comic-item">
    <a href="{{ route('comic.viewer', $comic->name) }}">
      <img src="{{ $comic->cover }}">
    </a>
    <p>{{ $comic->title }}</p>
  </div>
  @endforeach
</section>
{{ $comics->links('layouts._pagination') }}
@stop
