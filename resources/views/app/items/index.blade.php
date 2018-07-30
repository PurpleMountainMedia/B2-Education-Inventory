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

    <a href="{{ route('items.create.table') }}">
        <el-button>Add</el-button>
    </a>
@endsection
