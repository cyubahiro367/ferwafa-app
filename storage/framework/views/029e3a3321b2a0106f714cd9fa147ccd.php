<?php echo $__env->make('mainMenuBar', ['name' => 'Game Rules'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div class="container-fulid no-padding contactus">
    <div class="section-padding"></div>
    <div class="container">
        <div class="row">
            <div class="report-container" style="display: flex; gap: 12px">
                <?php $__currentLoopData = $gameRules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gameRule): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="report">
                        <div class="report-image">
                            <a><img alt="" src="/static/img/icons/document.png" /></a>
                            <a><img alt="" class="click-report" src="/static/img/icons/click.png" /></a>
                        </div>
                        <div class="report-title">
                            <a href="<?php echo e(route('report.doc', $gameRule['url'])); ?>" target="_blank">
                                <p><?php echo e($gameRule['title']); ?></p>
                            </a>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
    <div class="section-padding"></div>
</div>

<?php echo $__env->make('footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH /home/ferwafa/public_html/resources/views/gameRules.blade.php ENDPATH**/ ?>