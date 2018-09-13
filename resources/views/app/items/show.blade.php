@extends('app.layouts.app')

@section('content')
    @component('app.partials.page-header', [
        'breadcrumbs' => [
            [
              'title' =>  session('school')['name'] ?? ''
            ],
            [
              'title' => getTypeName('item', true, true),
              'link' => route('web.items.index')
            ],
            [
              'title' => $item->name
            ]
        ],
        'title' => $item->name
    ])
    @endcomponent


@endsection
