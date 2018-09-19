@extends('app.layouts.app')

@section('content')

    <layout-center-page class="mb">
      <help-card title="@lang('general.buildings_help')"
                 help-id="general_help"
                 video-link="https://www.youtube.com/embed/TiMVsHwji_w"
                 list-title="@lang('general.top_tips')"
                 :list="[
                   {
                     text: 'View all buildings within current school.',
                   },
                   {
                     text: 'Establish building size with room count.',
                   },
                   {
                     text: 'Search and filter with advanced filter tools.',
                   },
                   {
                     text: 'Click view to edit buildng.',
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
              'title' => getTypeName('building', true, true)
            ]
        ],
        'title' => getTypeName('building', true, true)
    ])
    @endcomponent

    <list-buildings school-id='{{ session('school')['id'] ?? '' }}'>
    </list-buildings>
@endsection
