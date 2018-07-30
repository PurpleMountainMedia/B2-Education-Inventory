@extends('app.layouts.basic')

@section('content')

  <school-selecter :data='@json(Auth::User()->organisationsWithSchools())'
                   csrf-token='{{ csrf_token() }}'
                   form-url='{{ route('session') }}'>
  </school-selecter>

@endsection
