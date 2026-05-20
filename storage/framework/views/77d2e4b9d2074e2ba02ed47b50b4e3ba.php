<?php echo $__env->make('mainMenuBar', ['name' => 'Circular Documents'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div class="container-fulid no-padding contactus">
    <div class="section-padding"><center><h2>Circular</h2></center></div>
    <div class="container">
        <div class="row">
            <div class="report-container" style="display: flex; gap: 12px">
                <?php $__currentLoopData = $circularDocuments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $circularDocument): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="report">
                        <div class="report-image">
                            <a><img alt="" src="/static/img/icons/document.png" /></a>
                            <a><img alt="" class="click-report" src="/static/img/icons/click.png" /></a>
                        </div>
                        <div class="report-title">
                            <a href="<?php echo e(route('report.doc', $circularDocument['url'])); ?>" target="_blank">
                                <p><?php echo e($circularDocument['title']); ?></p>
                            </a>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>

</div>

<?php echo $__env->make('footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH /home/ferwafa/public_html/resources/views/circularDocument.blade.php ENDPATH**/ ?>