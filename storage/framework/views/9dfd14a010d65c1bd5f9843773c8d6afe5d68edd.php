<?php $__env->startSection('title', 'ホーム'); ?>

<?php $__env->startSection('menu'); ?>
    <a href="/tweeted">投稿済み一覧</a>
    <a href="/search">検索</a>
    <a href="/favorite">いいねする</a>
    <a href="/autofallow">自動化する</a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('main'); ?>
    <?php if ($errors->has('reservation_time')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('reservation_time'); ?>
        <p><?php echo e($message); ?></p>
    <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
    <?php if ($errors->has('content')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('content'); ?>
        <p><?php echo e($message); ?></p>
    <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
    <table>
    <form action="/" method="post">
        <?php echo csrf_field(); ?>
        <?php if(isset($userId)): ?>
        <input type="hidden" name="user_id" value="<?php echo e($userId); ?>">
        <?php endif; ?>
        <input type="hidden" name="del_flag" value="0">
        <tr>
            <th>日付</th>
        </tr>
        <tr>
            <td><input type="datetime-local" name="reservation_time" step="60" value="<?php echo e(old('reservation_time')); ?>"></td>
        </tr>
        <tr>
            <th>投稿内容</th>
        </tr>
        <tr>
            <td><textarea cols="30" rows="7" name="content" value="<?php echo e(old('content')); ?>"></textarea></td>
        </tr>
        <tr>
            <td><input class="button" type="submit" value="設定する"></td>
        </tr>
    </form>
    </table>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <section>
    <?php if(isset($items)): ?>
        <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="contents">
            <?php            
                $time1 = mb_substr($item->reservation_time , 0, 10);
                $year = mb_substr($time1 , 0, 4);
                $month = mb_substr($time1 , 5, 2);
                $day = mb_substr($time1 , 8, 2);
                $time2 = mb_substr($item->reservation_time , 11, 5);
                $total = $year . '/' . $month . '/' . $day . ' ' . $time2;   
            ?>
            <p class="reservation_time">予約時間：<?php echo e($total); ?></p>
            <h3>投稿内容</h3>
            <p class="content"><?php echo e($item->content); ?></p>
            <form action="/delete" method="post">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="id" value="<?php echo e($item->id); ?>">
                <input class="button" type="submit" value="取消">
            </form>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
    </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/sekimichiru/Desktop/laravellearning/twitterapi/resources/views/mypage/index.blade.php ENDPATH**/ ?>