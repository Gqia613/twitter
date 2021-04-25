<?php $__env->startSection('title', 'いいね'); ?>

<?php $__env->startSection('menu'); ?>
    <a href="/">マイページに戻る</a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <form action="/favorite" method="post">
        <?php echo csrf_field(); ?>
        <table>
            <tr>
                <th>キーワード</th>
                <td><input type="text" name="keyword"></td>
            </tr>
            <tr>
                <th>数</th>
                <td><input type="text" name="num"></td>
            </tr>
            <tr>
                <th></th>
                <td><input type="submit" value="いいねする"></td>
            </tr>
        </table>
    </form>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/sekimichiru/Desktop/laravellearning/twitterapi/resources/views/mypage/favorite.blade.php ENDPATH**/ ?>