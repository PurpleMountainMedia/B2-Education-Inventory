<?php $__env->startSection('content'); ?>
    <?php $__env->startComponent('app.partials.page-header', [
        'breadcrumbs' => [
            [
              'title' =>  session('school')['name'] ?? ''
            ],
            [
              'title' => getTypeName('room', true, true)
            ]
        ],
        'title' => getTypeName('room', true, true)
    ]); ?>
    <?php echo $__env->renderComponent(); ?>

    <list-rooms school-id='<?php echo e(session('school')['id'] ?? ''); ?>'>
    </list-rooms>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('app.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>