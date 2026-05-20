<?php echo $__env->make('mainMenuBar', ['name' => 'Gallery'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div class="container-fulid no-padding contactus">
    <div class="section-padding"></div>
    <div class="container">
        <div class="row">
            <div class="report-container" style="display: flex; gap: 12px">
                <?php $__currentLoopData = $galleries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gallery): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="gallery">
                        <img alt="gallery" class="single-image-gallery"
                            src="<?php echo e(route('gallery.doc', $gallery['url'])); ?>" /><i aria-hidden="true"
                            class="view-image-gallery"></i>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
    <div class="section-padding"></div>
</div>

<?php echo $__env->make('footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH /home/ferwafa/public_html/resources/views/gallery.blade.php ENDPATH**/ ?>