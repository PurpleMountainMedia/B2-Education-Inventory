<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <link href="{{ mix('css/theme.css') }}" rel="stylesheet">
    <link href="{{ mix('css/reset.css') }}" rel="stylesheet">

  </head>
  <body>

      <div id="app" class="wrap">
          @component('app.components.main-nav')
          @endcomponent

          <div class="app_inner">
              @yield('content')
          </div>
      </div>

      <script type="text/javascript">
          window.eiDefaults = {
              item_name: '@itemName',
              items_name: '@itemsName',
              item_type_name: '@itemTypeName',
              item_types_name: '@itemTypesName',
              room_name: '@roomName',
              rooms_name: '@roomsName',
              building_name: '@buildingName',
              buildings_name: '@buildingsName',
              site_url: '{{ config('app.url') }}',
              api_prefix: 'api',
          };
          window.eiSchool = @json(session('school'))
      </script>

      <!-- Scripts -->
      <script src="{{ mix('js/manifest.js') }}"></script>
      <script src="{{ mix('js/vendor.js') }}"></script>
      <script src="{{ mix('js/app.js') }}"></script>

      @stack('scripts')

  </body>
</html>
