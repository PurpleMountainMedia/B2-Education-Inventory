<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'Laravel')); ?></title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="<?php echo e(mix('css/app.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(mix('css/theme.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(mix('css/reset.css')); ?>" rel="stylesheet">

  </head>
  <body>

      <div id="app" class="wrap">
          <?php $__env->startComponent('app.components.main-nav'); ?>
          <?php echo $__env->renderComponent(); ?>

          <div class="app_inner">
              <?php echo $__env->yieldContent('content'); ?>
          </div>
      </div>

      <script type="text/javascript">
          window.eiDefaults = {
              item_name: 'item',
              items_name: 'items',
              item_type_name: 'itemtype',
              item_types_name: 'itemtypes',
              room_name: 'room',
              rooms_name: 'rooms',
              building_name: 'building',
              buildings_name: 'buildings',
              site_url: '<?php echo e(config('app.url')); ?>',
              api_prefix: 'api',
          };
          window.eiSchool = <?php echo json_encode(session('school'), 15, 512) ?>
      </script>

      <!-- Scripts -->
      <script src="<?php echo e(mix('js/manifest.js')); ?>"></script>
      <script src="<?php echo e(mix('js/vendor.js')); ?>"></script>
      <script src="<?php echo e(mix('js/app.js')); ?>"></script>

      <?php echo $__env->yieldPushContent('scripts'); ?>

  </body>
</html>
