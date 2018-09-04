<?php if(isset($breadcrumbs)): ?>
    <el-breadcrumb separator-class="el-icon-arrow-right">
        <?php $__currentLoopData = $breadcrumbs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $breadcrumb): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($breadcrumb['link'] ?? false): ?><a href="<?php echo e($breadcrumb['link']); ?>"><?php endif; ?>
                <el-breadcrumb-item><?php echo e($breadcrumb['title'] ?? ''); ?></el-breadcrumb-item>
            <?php if($breadcrumb['link'] ?? false): ?></a><?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </el-breadcrumb>
<?php endif; ?>

<?php if(isset($title)): ?>
    <h1><?php echo e($title); ?></h1>
<?php endif; ?>
