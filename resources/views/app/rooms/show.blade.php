@extends('app.layouts.app')

@section('content')
    @component('app.partials.page-header', [
        'breadcrumbs' => [
            [
              'title' =>  session('school')['name'] ?? ''
            ],
            [
              'title' => getTypeName('room', true, true),
              'link' => route('web.rooms.index')
            ],
            [
              'title' => $room->name
            ]
        ],
        'title' => $room->name
    ])
    @endcomponent


@endsection
