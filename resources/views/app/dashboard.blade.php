@extends('app.layouts.app')

@section('content')


<el-row :gutter="20" v-cloak>
    <el-row :gutter="20" class="mb">
        <el-col :md="{span: 15, offset: 4}" shadow="never">
            <el-card class="box-card bg-accent">
                <h2 class="text-center text-white">@lang('dashboard.welcome_back'), {{ Auth::User()->name }}</h2>
                <p class="text-center text-white">@lang('dashboard.currently_editing') <strong>{{ session('school')['name'] ?? '' }}</strong></p>
            </el-card>
        </el-col>
    </el-row>

    <school-selecter :data='@json(Auth::User()->organisationsWithSchools())'
                     csrf-token='{{ csrf_token() }}'
                     form-url='{{ route('session') }}'>
    </school-selecter>

    <el-row :gutter="20">
        <el-col :md="{span: 5, offset: 4}">
            <h1 class="text-center"><i class="fal fa-2x fa-building"></i></h1>

            <add-new-modal add-name="@buildingName(true)"
                           :button="{text: 'New @buildingName(true)', size: 'large', class: 'w-100'}"
                           :modal="{title: 'New @buildingName(true)'}"></add-new-modal>

            <a href="{{ route('buildings.index') }}" title="@buildingsName()">
                <el-button icon="el-icon-view" class="w-100 mt-sm">@lang('dashboard.view_all') @buildingsName()</el-button>
            </a>
        </el-col>

        <el-col :md="{span: 5}">
            <h1 class="text-center"><i class="fal fa-2x fa-door-open"></i></h1>
            <add-new-modal add-name="@roomName(true)"
                           :button="{text: 'New @roomName(true)', size: 'large', class: 'w-100'}"
                           :modal="{title: 'New @roomName(true)'}"></add-new-modal>
            <a href="{{ route('rooms.index') }}" title="@roomsName()">
                <el-button icon="el-icon-view" class="w-100 mt-sm">@lang('dashboard.view_all') @roomsName()</el-button>
            </a>
        </el-col>

        <el-col :md="{span: 5}">
            <h1 class="text-center"><i class="fal fa-2x fa-laptop"></i></h1>
            <add-new-modal add-name="@itemName(true)"
                           :button="{text: 'New @itemName(true)', size: 'large', class: 'w-100'}"
                           :modal="{title: 'New @itemName(true)'}"></add-new-modal>
            <a href="{{ route('items.index') }}" title="@itemsName()">
                <el-button icon="el-icon-view" class="w-100 mt-sm">@lang('dashboard.view_all') @itemsName()</el-button>
            </a>
        </el-col>
    </el-row>

    <el-row :gutter="20" class="mt">
        <el-col :md="{span: 5, offset: 4}">
            <add-new-modal add-name="@reportName(true)"
                           :button="{text: 'New @reportName(true)', size: 'large', class: 'w-100 mt-sm'}"
                           :modal="{title: 'New @reportName(true)'}"></add-new-modal>
            <el-button icon="el-icon-view" class="w-100 mt-sm">@lang('dashboard.view_all') @itemsName()</el-button>
        </el-col>

        <el-col :md="{span: 10}">
          <p><small>@lang('dashboard.latest_reports_for', ['reports' => getTypeName('report', true)])</small></p>
          <el-table :data="[]">
              <el-table-column label="ID"></el-table-column>
              <el-table-column label="Name"></el-table-column>
              <el-table-column label="Created"></el-table-column>
          </el-table>
        </el-col>
    </el-row>
</el-row>


@endsection
