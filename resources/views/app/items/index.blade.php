@extends('app.layouts.app')

@section('content')
    <h1>Items</h1>

    <a href="{{ route('items.create.table') }}">
        <el-button>Add</el-button>
    </a>
@endsection
