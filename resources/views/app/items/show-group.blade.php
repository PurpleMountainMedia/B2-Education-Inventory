@extends('app.layouts.app')

@section('content')
  <show-item-group :category="{{ $itemCategory }}"
                   :room="{{ $room }}"
                   item-name="{{ $itemName }}"
                   school-id="{{ session('school')['id'] ?? null }}"
                   :breadcrumbs="[
                     {
                       'title': '{{ session('school')['name'] ?? '' }}',
                       'url': '{{ route('web.dashboard.index') }}'
                     },
                     {
                       'title': '{{ $room->name }}',
                       'url': '{{ route('web.rooms.show', $room) }}'
                     },
                     {
                       'title': '{{ __('Group') }}'
                     }
                   ]">
  </show-item-group>
@endsection
