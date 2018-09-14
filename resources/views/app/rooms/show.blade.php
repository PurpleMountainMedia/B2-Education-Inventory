@extends('app.layouts.app')

@section('content')
  <room-edit-form room-id="{{ $room->id }}"
                  index-url="{{ route('web.rooms.index') }}"
                  :breadcrumbs="(data) => { return [
                    {
                      'title': '{{ session('school')['name'] ?? '' }}',
                      'url': '{{ route('web.dashboard.index') }}'
                    },
                    {
                      'title': '{{ $room->building->name }}',
                      'url': '{{ route('web.buildings.show', $room->building) }}'
                    },
                    {
                      'title': data.name
                    }
                  ]}">
  </room-edit-form>
@endsection
