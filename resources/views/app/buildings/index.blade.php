@extends('app.layouts.app')

@section('content')
    @component('app.partials.page-header', [
        'breadcrumbs' => [
            [
              'title' =>  session('school')['name'] ?? ''
            ],
            [
              'title' => getTypeName('building', true, true)
            ]
        ],
        'title' => getTypeName('building', true, true)
    ])
    @endcomponent

    <list-buildings school-id='{{ session('school')['id'] ?? '' }}'>
    </list-buildings>
@endsection
