@extends('app.layouts.app')

@section('content')
    @component('app.partials.page-header', [
        'breadcrumbs' => [
            [
              'title' => getTypeName('room', true, true)
            ]
        ],
        'title' => getTypeName('room', true, true)
    ])
    @endcomponent
@endsection
