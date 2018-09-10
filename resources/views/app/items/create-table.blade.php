@extends('app.layouts.app')

@section('content')
    <items-create-table school-id='{{ session('school')['id'] ?? '' }}'>
    </items-create-table>
@endsection
