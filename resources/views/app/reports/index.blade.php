@extends('app.layouts.app')

@section('content')
    @component('app.partials.page-header', [
        'breadcrumbs' => [
            [
              'title' => getTypeName('report', true, true)
            ]
        ],
        'title' => getTypeName('report', true, true)
    ])
    @endcomponent
@endsection
