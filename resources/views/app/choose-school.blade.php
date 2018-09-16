@extends('app.layouts.basic')

@section('content')

<el-row justify="center" type="flex" class="mt">
  <el-col :xl="8" :lg="12" :sm="20">
    <el-card>
      <span slot="header" class="">{{ __('Select a School') }}</span>
      <school-selecter :data='@json(Auth::User()->organisationsWithSchools())'
                       csrf-token='{{ csrf_token() }}'
                       selecter-size="medium"
                       form-url='{{ route('web.session') }}'>
      </school-selecter>
    </el-card>
  </el-col>
</el-row>


@endsection
