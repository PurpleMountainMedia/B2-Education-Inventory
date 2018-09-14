@extends('app.layouts.app')

@section('content')
  <list-reports school-id='{{ session('school')['id'] ?? '' }}'>
  </list-reports>
@endsection
