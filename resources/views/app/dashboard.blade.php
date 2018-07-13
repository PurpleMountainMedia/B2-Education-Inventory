@extends('app.layouts.app')

@section('content')

<el-row :gutter="20" v-cloak>
    <el-col :span="8">
        <el-card shadow="hover">
            <h4>@roomsName(true)</h4>
            <add-new-modal add-name="@roomName(true)"
                           :button="{text: 'New @roomName(true)'}"
                           :modal="{title: 'New @roomName(true)'}"/>
        </el-card>
    </el-col>
    <el-col :span="8">
        <el-card shadow="hover">
          <h4>@itemsName(true)</h4>
          <add-new-modal add-name="@itemName(true)"
                         :button="{text: 'New @itemName(true)'}"
                         :modal="{title: 'New @itemName(true)'}"/>
        </el-card>
    </el-col>
    <el-col :span="8">
        <el-card shadow="hover">
          <h4>@buildingsName(true)</h4>
          <add-new-modal add-name="@buildingName(true)"
                         :button="{text: 'New @buildingName(true)'}"
                         :modal="{title: 'New @buildingName(true)'}"/>
        </el-card>
    </el-col>
</el-row>


@endsection
