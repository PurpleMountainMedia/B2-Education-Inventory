<?php $__env->startSection('content'); ?>
    <?php $__env->startComponent('app.partials.page-header', [
        'breadcrumbs' => [
            [
              'title' => getTypeName('item', true, true)
            ]
        ],
        'title' => getTypeName('item', true, true)
    ]); ?>
    <?php echo $__env->renderComponent(); ?>

    <a href="<?php echo e(route('items.create.table')); ?>">
        <el-button>Add</el-button>
    </a>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('app.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>