<?php $__env->startSection('title', 'ツイート検索'); ?>

<?php $__env->startSection('menu'); ?>
    <a href="/mypage">マイページに戻る</a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <form action="/mypage/search" method="post">
        <?php echo csrf_field(); ?>
        <input type="text" name="keyword">
        <input type="submit" value="検索">
    </form>



    <section>
    <?php if(isset($tweets)): ?>
        <?php $__currentLoopData = $tweets->statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tweet): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="contents">
            <p class="reservation_time">ユーザー名：<?php echo e($tweet->user->name); ?></p>
            <h3>投稿内容</h3>
            <p class="content"><?php echo e($tweet->text); ?></p>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <?php endif; ?>
    </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/sekimichiru/Desktop/laravellearning/twitterapi/resources/views/mypage/search.blade.php ENDPATH**/ ?>