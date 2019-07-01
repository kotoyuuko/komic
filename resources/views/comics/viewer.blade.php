@extends('layouts.app')
@section('title', $comic->title)

@section('app')
<viewer token="{{ $token }}" name="{{ $comic->name }}"></viewer>
@stop
