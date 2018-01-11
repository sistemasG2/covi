@extends('layouts.main')

@section('content')
  <h1 class="display-4">Covi Homepage</h1>
  @guest
      No estas logueado
  @else
      {{ Auth::user()->username }}
  @endguest

  <img src="{{ Avatar::create('Élexander Quesada')->toBase64() }}" />

  <v-card max-width="600">
    <v-card-title>Titulo</v-card-title>
  </v-card>
@endsection
