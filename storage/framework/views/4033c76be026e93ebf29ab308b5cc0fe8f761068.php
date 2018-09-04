<?php if(auth()->guard()->guest()): ?>
  <a href="<?php echo e(route('login')); ?>">Login</a>

<?php else: ?>
  <a href="<?php echo e(route('dashboard.index')); ?>">Dashboard</a>
<?php endif; ?>
