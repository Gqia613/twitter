<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/css/style.css">
    <title><?php echo $__env->yieldContent('title'); ?></title>
</head>
<body>
<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
    <a class="dropdown-item" href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
       <?php echo e(__('Logout')); ?>

    </a>
    <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
        <?php echo csrf_field(); ?>
    </form>
</div>
    <h1><?php echo $__env->yieldContent('title'); ?></h1>
    <?php echo $__env->yieldContent('menu'); ?>

    <?php echo $__env->yieldContent('main'); ?>

    <?php echo $__env->yieldContent('content'); ?>

    <?php echo $__env->yieldContent('menu'); ?>
</body>
</html><?php /**PATH /Users/sekimichiru/Desktop/laravellearning/twitterapi/resources/views/layouts/index.blade.php ENDPATH**/ ?>