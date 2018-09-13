@isset($breadcrumbs)
  <el-breadcrumb separator-class="el-icon-arrow-right">
    @foreach ($breadcrumbs as $key => $breadcrumb)
      <el-breadcrumb-item>
        @if($breadcrumb['link'] ?? false)<a href="{{ $breadcrumb['link'] }}">@endif
          {{ $breadcrumb['title'] ?? '' }}
        @if($breadcrumb['link'] ?? false)</a>@endif
      </el-breadcrumb-item>
    @endforeach
  </el-breadcrumb>
@endisset

@isset($title)
    <h1>{{ $title }}</h1>
@endisset
