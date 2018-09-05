<div class="main_menu_wrap" id="main_menu">
    <div class="main_menu_left">
        <main-menu>
            <template slot="links" slot-scope="props">
                <ul :class="props.showNav ? 'main_menu_nav' : 'main_menu_nav --hide'">
                    <li class="main_nav_link <?php if(Request::url() === route('dashboard.index')): ?>--active <?php endif; ?>">
                        <a href="<?php echo e(route('dashboard.index')); ?>"><i class="fal fa-tachometer-alt"></i> <span>Dashboard</span></a>
                    </li>
                    <li class="main_nav_link <?php if(Request::url() === route('buildings.index')): ?>--active <?php endif; ?>">
                        <a href="<?php echo e(route('buildings.index')); ?>"><i class="fal fa-building"></i> <span>Buildings</span></a>
                    </li>
                    <li class="main_nav_link <?php if(Request::url() === route('rooms.index')): ?>--active <?php endif; ?>">
                        <a href="<?php echo e(route('rooms.index')); ?>"><i class="fal fa-door-open"></i> <span>Rooms</span></a>
                    </li>
                    <li class="main_nav_link <?php if(Request::url() === route('items.index')): ?>--active <?php endif; ?>">
                        <a href="<?php echo e(route('items.index')); ?>"><i class="fal fa-laptop"></i> <span>Items</span></a>
                    </li>
                    <li class="main_nav_link <?php if(Request::url() === route('reports.index')): ?>--active <?php endif; ?>">
                        <a href="<?php echo e(route('reports.index')); ?>"><i class="fal fa-chart-pie"></i> <span>Reports</span></a>
                    </li>
                </ul>
            </template>

            <template slot="button" slot-scope="props">
                <div class="mobile_nav_burger">
                    <i class="far fa-bars" @click="props.openMenu"></i>
                </div>
            </template>


            
        </main-menu>
    </div>
</div>
