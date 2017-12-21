@extends('layouts.main')

@section('content')
  <h1 class="display-4">Covi Homepage</h1>
  @guest
      No estas logueado
  @else
      {{ Auth::user()->username }}
  @endguest
@endsection
