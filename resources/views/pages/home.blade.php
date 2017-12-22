@extends('layouts.main')

@section('content')
  <h1 class="display-4">Covi Homepage</h1>
  @guest
      No estas logueado
  @else
      {{ Auth::user()->username }}
  @endguest

  <h1>{{ storage_path('app/public/accounts_logos/').str_shuffle('avatar').date('mmddyy'.time()).".jpg" }}</h1>
  <h2>{{ Storage::disk('s3')->url('images/') }}</h2>
@endsection
