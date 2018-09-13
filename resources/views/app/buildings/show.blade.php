@extends('app.layouts.app')

@section('content')
  <building-edit-form building-id="{{ $building->id }}"
                      index-url="{{ route('web.buildings.index') }}"
                      :breadcrumbs="(data) => { return [
                        {
                          'title': '{{ session('school')['name'] ?? '' }}'
                        },
                        {
                          'title': '{{ getTypeName('building', true, true) }}',
                          'url': '{{ route('web.buildings.index') }}'
                        },
                        {
                          'title': data.name
                        }
                      ]}">
  </building-edit-form>
@endsection
