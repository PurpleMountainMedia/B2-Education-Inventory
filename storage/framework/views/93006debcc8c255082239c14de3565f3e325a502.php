<?php $__env->startSection('content'); ?>


<el-row :gutter="20" v-cloak>
    <el-row :gutter="20" class="mb">
        <el-col :md="{span: 15, offset: 4}" shadow="never">
            <el-card class="box-card bg-accent">
                <h2 class="text-center text-white"><?php echo app('translator')->getFromJson('dashboard.welcome_back'); ?>, <?php echo e(Auth::User()->name); ?></h2>
                <p class="text-center text-white"><?php echo app('translator')->getFromJson('dashboard.currently_editing'); ?> <strong><?php echo e(session('school')['name'] ?? ''); ?></strong></p>
            </el-card>
        </el-col>
    </el-row>


    <a class="dropdown-item" href="<?php echo e(route('logout')); ?>"
       onclick="event.preventDefault();
                     document.getElementById('logout-form').submit();">
        <?php echo e(__('Logout')); ?>

    </a>

    <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
        <?php echo csrf_field(); ?>
    </form>

    <school-selecter :data='<?php echo json_encode(Auth::User()->organisationsWithSchools(), 15, 512) ?>'
                     csrf-token='<?php echo e(csrf_token()); ?>'
                     form-url='<?php echo e(route('session')); ?>'>
    </school-selecter>

    <el-row :gutter="20">
        <el-col :md="{span: 5, offset: 4}">
            <h1 class="text-center"><i class="fal fa-2x fa-building"></i></h1>

            <add-new-modal add-name="Building"
                           :button="{text: 'New Building', size: 'large', class: 'w-100'}"
                           :modal="{title: 'New Building'}"></add-new-modal>

            <a href="<?php echo e(route('buildings.index')); ?>" title="buildings">
                <el-button icon="el-icon-view" class="w-100 mt-sm"><?php echo app('translator')->getFromJson('dashboard.view_all'); ?> buildings</el-button>
            </a>
        </el-col>

        <el-col :md="{span: 5}">
            <h1 class="text-center"><i class="fal fa-2x fa-door-open"></i></h1>
            <add-new-modal add-name="Room"
                           :button="{text: 'New Room', size: 'large', class: 'w-100'}"
                           :modal="{title: 'New Room'}"></add-new-modal>
            <a href="<?php echo e(route('rooms.index')); ?>" title="rooms">
                <el-button icon="el-icon-view" class="w-100 mt-sm"><?php echo app('translator')->getFromJson('dashboard.view_all'); ?> rooms</el-button>
            </a>
        </el-col>

        <el-col :md="{span: 5}">
            <h1 class="text-center"><i class="fal fa-2x fa-laptop"></i></h1>
            <add-new-modal add-name="Item"
                           :button="{text: 'New Item', size: 'large', class: 'w-100'}"
                           :modal="{title: 'New Item'}"></add-new-modal>
            <a href="<?php echo e(route('items.index')); ?>" title="items">
                <el-button icon="el-icon-view" class="w-100 mt-sm"><?php echo app('translator')->getFromJson('dashboard.view_all'); ?> items</el-button>
            </a>
        </el-col>
    </el-row>

    <el-row :gutter="20" class="mt">
        <el-col :md="{span: 5, offset: 4}">
            <add-new-modal add-name="Report"
                           :button="{text: 'New Report', size: 'large', class: 'w-100 mt-sm'}"
                           :modal="{title: 'New Report'}"></add-new-modal>
            <el-button icon="el-icon-view" class="w-100 mt-sm"><?php echo app('translator')->getFromJson('dashboard.view_all'); ?> items</el-button>
        </el-col>

        <el-col :md="{span: 10}">
          <p><small><?php echo app('translator')->getFromJson('dashboard.latest_reports_for', ['reports' => getTypeName('report', true)]); ?></small></p>
          <el-table :data="[]">
              <el-table-column label="ID"></el-table-column>
              <el-table-column label="Name"></el-table-column>
              <el-table-column label="Created"></el-table-column>
          </el-table>
        </el-col>
    </el-row>
</el-row>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('app.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>