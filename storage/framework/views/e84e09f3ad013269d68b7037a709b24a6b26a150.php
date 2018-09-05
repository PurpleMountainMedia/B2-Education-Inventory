<?php $__env->startSection('content'); ?>

  <el-row>
    <h1 class="text-center"><?php echo e(__('Select a School')); ?></h1>
    <school-selecter :data='<?php echo json_encode(Auth::User()->organisationsWithSchools(), 15, 512) ?>'
                     csrf-token='<?php echo e(csrf_token()); ?>'
                     selecter-size="medium"
                     form-url='<?php echo e(route('session')); ?>'>
    </school-selecter>
  </el-row>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('app.layouts.basic', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>