@extends('app.layouts.app')

@section('content')
  <room-edit-form room-id="{{ $room->id }}"
                  index-url="{{ route('web.rooms.index') }}"
                  :breadcrumbs="(data) => { return [
                    {
                      'title': '{{ session('school')['name'] ?? '' }}'
                    },
                    {
                      'title': '{{ getTypeName('room', true, true) }}',
                      'url': '{{ route('web.rooms.index') }}'
                    },
                    {
                      'title': data.name
                    }
                  ]}">
  </room-edit-form>
@endsection
