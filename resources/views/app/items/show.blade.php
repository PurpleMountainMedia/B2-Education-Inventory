@extends('app.layouts.app')

@section('content')
  <item-edit-form item-id="{{ $item->id }}"
                  index-url="{{ route('web.items.index') }}"
                  :breadcrumbs="(data) => { return [
                    {
                      'title': '{{ session('school')['name'] ?? '' }}',
                      'url': '{{ route('web.dashboard.index') }}'
                    },
                    {
                      'title': '{{ $item->building->name }}',
                      'url': '{{ route('web.buildings.show', $item->building) }}'
                    },
                    {
                      'title': '{{ $item->room->name }}',
                      'url': '{{ route('web.rooms.show', $item->room) }}'
                    },
                    {
                      'title': data.name
                    }
                  ]}">
  </item-edit-form>
@endsection
