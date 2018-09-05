@extends('app.layouts.app')

@section('content')
    @component('app.partials.page-header', [
        'breadcrumbs' => [
            [
              'title' => getTypeName('item', true, true)
            ]
        ],
        'title' => getTypeName('item', true, true)
    ])
    @endcomponent

    <list-items school-id='{{ session('school')['id'] ?? '' }}'>
    </list-items>
@endsection
