<?php echo $__env->make('mainMenuBar', ['name' => 'Documents'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div class="container-fulid no-padding contactus">
    <div class="section-padding"><center><h2>Documents</h2></center></div>
    <div class="container">
        <div class="row">
            <div class="report-container" style="display: flex; gap: 12px">
                <?php $__currentLoopData = $documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $document): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="report">
                        <div class="report-image">
                            <a href="<?php echo e(route('report.doc', $document['url'])); ?>" target="_blank"><img alt="" src="/static/img/icons/document.png" /></a>
                            <a href="<?php echo e(route('report.doc', $document['url'])); ?>" target="_blank"><img alt="" class="click-report" src="/static/img/icons/click.png" /></a>
                        </div>
                        <div class="report-title">
                            <a href="<?php echo e(route('report.doc', $document['url'])); ?>" target="_blank">
                                <p><?php echo e($document['title']); ?></p>
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
<?php /**PATH /home/ferwafa/public_html/resources/views/document.blade.php ENDPATH**/ ?>