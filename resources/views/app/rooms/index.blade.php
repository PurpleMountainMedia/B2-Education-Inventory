@extends('app.layouts.app')

@section('content')
    @component('app.partials.page-header', [
        'breadcrumbs' => [
            [
              'title' =>  session('school')['name'] ?? ''
            ],
            [
              'title' => getTypeName('room', true, true)
            ]
        ],
        'title' => getTypeName('room', true, true)
    ])
    @endcomponent

    <list-rooms school-id='{{ session('school')['id'] ?? '' }}'>
    </list-rooms>
@endsection
