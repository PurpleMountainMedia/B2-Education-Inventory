@extends('app.layouts.app')

@section('content')

    <layout-center-page class="mb">
      <help-card title="@lang('general.rooms_help')"
                 help-id="general_help"
                 video-link="https://www.youtube.com/embed/5udL-fdODTg"
                 list-title="@lang('general.top_tips')"
                 :list="[
                   {
                     text: 'View all rooms within current school.',
                   },
                   {
                     text: 'Establish room location with link to building.',
                   },
                   {
                     text: 'Search and filter with advanced filter tools.',
                   },
                   {
                     text: 'Click view to edit room.',
                   }
                 ]">
      </help-card>
    </layout-center-page>

    @component('app.partials.page-header', [
        'breadcrumbs' => [
            [
              'title' =>  session('school')['name'] ?? ''
            ],
            [
              'title' => getTypeName('room', true, true)
            ]
        ],
        'title' => getTypeName('room', true, true)
    ])
    @endcomponent

    <list-rooms school-id='{{ session('school')['id'] ?? '' }}'>
    </list-rooms>
@endsection
