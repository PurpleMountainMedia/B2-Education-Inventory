@isset($breadcrumbs)
    <el-breadcrumb separator-class="el-icon-arrow-right">
        @foreach ($breadcrumbs as $key => $breadcrumb)
            @if($breadcrumb['link'] ?? false)<a href="{{ $breadcrumb['link'] }}">@endif
                <el-breadcrumb-item>{{ $breadcrumb['title'] ?? '' }}</el-breadcrumb-item>
            @if($breadcrumb['link'] ?? false)</a>@endif
        @endforeach
    </el-breadcrumb>
@endisset

@isset($title)
    <h1>{{ $title }}</h1>
@endisset
