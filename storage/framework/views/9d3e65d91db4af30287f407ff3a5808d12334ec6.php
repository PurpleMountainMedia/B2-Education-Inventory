<?php $__env->startSection('content'); ?>
    <?php $__env->startComponent('app.partials.page-header', [
        'breadcrumbs' => [
            [
              'title' => getTypeName('report', true, true)
            ]
        ],
        'title' => getTypeName('report', true, true)
    ]); ?>
    <?php echo $__env->renderComponent(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('app.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>