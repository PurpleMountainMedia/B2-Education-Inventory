@extends('app.layouts.app')

@section('content')
    <layout-center-page class="mb">
      <help-card title="@lang('general.items_help')"
                 help-id="general_help"
                 video-link="https://www.youtube.com/embed/igLpdOBR5G4"
                 list-title="@lang('general.top_tips')"
                 :list="[
                   {
                     text: 'View all items within current school.',
                   },
                   {
                     text: 'Search and filter with advanced filter tools.',
                   },
                   {
                     text: 'Group items together for easier viewing.',
                   },
                   {
                     text: 'Generate reports.',
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
              'title' => getTypeName('item', true, true)
            ]
        ],
        'title' => getTypeName('item', true, true)
    ])
    @endcomponent

    <list-items school-id='{{ session('school')['id'] ?? '' }}'>
    </list-items>
@endsection
