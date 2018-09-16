@extends('app.layouts.app')

@section('content')
  @section('content')
    <report-edit-form report-id="{{ $report->id }}"
                       index-url="{{ route('web.reports.index') }}"
                       :breadcrumbs="(data) => { return [
                         {
                           'title': '{{ session('school')['name'] ?? '' }}',
                           'url': '{{ route('web.dashboard.index') }}'
                         },
                         {
                           'title': 'Reports',
                           'url': '{{ route('web.reports.index') }}'
                         },
                         {
                           'title': data.name
                         }
                       ]}">
    </report-edit-form>
@endsection
