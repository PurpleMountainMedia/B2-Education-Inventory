@extends('app.layouts.app')

@section('content')

<el-row :gutter="20" v-cloak>
  <layout-center-page>
    <el-card class="box-card bg-accent">
      <h2 class="text-center text-white">@lang('dashboard.welcome_back'),
        <el-tooltip class="item" effect="dark" content="ID: {{ Auth::user()->id }}" placement="top-start">
          <span>{{ Auth::User()->name }}</span>
        </el-tooltip>
      </h2>
      <p class="text-center text-white">@lang('dashboard.currently_editing')
        <a class="change_school_link text-white" href="{{ route('web.session') }}"><strong>{{ session('school')['name'] ?? '' }}</strong></a>
      </p>
    </el-card>
  </layout-center-page>

  <layout-center-page class="mt">
    <help-card title="@lang('dashboard.introduction')"
               help-id="general_help">
    </help-card>
  </layout-center-page>

  {{-- <user-logout csrf-token="{{ csrf_token() }}">
    <button slot="text" slot-scope="scope" @click="scope.submit">Log Off</button>
  </user-logout> --}}

  <layout-center-page class="mt">
    <el-row :gutter="10">
      <el-col :md="{span: 8}">
        <h1 class="text-center"><i class="fal fa-2x fa-building"></i></h1>

        <add-new-building-button school-id="{{ session('school')['id'] }}"></add-new-building-button>

        <a href="{{ route('web.buildings.index') }}" title="@buildingsName()">
          <el-button icon="el-icon-view" class="w-100 mt-sm">@lang('dashboard.view_all') @buildingsName()</el-button>
        </a>
      </el-col>

      <el-col :md="{span: 8}">
        <h1 class="text-center"><i class="fal fa-2x fa-door-open"></i></h1>

        <add-new-room-button school-id="{{ session('school')['id'] }}"></add-new-room-button>

        <a href="{{ route('web.rooms.index') }}" title="@roomsName()">
          <el-button icon="el-icon-view" class="w-100 mt-sm">@lang('dashboard.view_all') @roomsName()</el-button>
        </a>
      </el-col>

      <el-col :md="{span: 8}">
        <h1 class="text-center"><i class="fal fa-2x fa-laptop"></i></h1>

        <add-new-item-button school-id="{{ session('school')['id'] }}"></add-new-item-button>

          <a href="{{ route('web.items.index') }}" title="@itemsName()">
              <el-button icon="el-icon-view" class="w-100 mt-sm">@lang('dashboard.view_all') @itemsName()</el-button>
          </a>
      </el-col>
    </el-row>
  </layout-center-page>

  <layout-center-page class="mt">
    <el-row :gutter="10">
      <el-col :md="{ span: 8 }">
        <add-new-modal add-name="@reportName(true)"
                       data-url="reports"
                       :button="{text: 'New @reportName(true)', size: 'large', class: 'w-100 mt-sm', plain: true}"
                       :modal="{title: 'New @reportName(true)'}"></add-new-modal>
        <el-button icon="el-icon-view" class="w-100 mt-sm">@lang('dashboard.view_all') @reportsName()</el-button>
      </el-col>

      <el-col :md="{ span: 16 }">
        <p><small>@lang('dashboard.latest_reports_for', ['reports' => getTypeName('report', true)]) <strong>{{ session('school')['name'] ?? null }}</strong></small></p>
        <el-table :data="{{ App\Report::inSchool(session('school')['id'] ?? null)->get() }}">
          <el-table-column label="Name" prop="name"></el-table-column>
        </el-table>
      </el-col>
    </el-row>
  </layout-center-page>
</el-row>


@endsection
