@extends('layouts.app2')

@section('title')
  Superadmin Panel
@endsection

@section('content')
  <superadmin-accounts imagesurl="{{ Storage::url('images') }}"></superadmin-accounts>
@endsection
