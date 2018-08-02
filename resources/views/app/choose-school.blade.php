@extends('app.layouts.basic')

@section('content')

  <el-row>
    <h1 class="text-center">{{ __('Select a School') }}</h1>
    <school-selecter :data='@json(Auth::User()->organisationsWithSchools())'
                     csrf-token='{{ csrf_token() }}'
                     selecter-size="medium"
                     form-url='{{ route('session') }}'>
    </school-selecter>
  </el-row>

@endsection
