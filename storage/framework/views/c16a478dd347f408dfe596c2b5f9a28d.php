<?php echo $__env->make('mainMenuBar', ['name' => 'Fixtures'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div class="section-padding"></div>
<section class="section">
    <div class="container-fluid eventlist blog blogpost upcoming-event latest-blog no-padding">
        <div class="container mt-5">
            <div class="row" style=" display: flex; justify-contents: center; align-item: center; gap">
                <?php $__currentLoopData = $groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div style=" background-color: #133e8d; color: white; margin-left: 10px" class="col-6 col-md-6 offset-md-1 col-lg-6 offset-lg-1">
                  <div>
                      <a style="color:white" href="<?php echo e(route('fixtures.show', [$seasonID, request()->route('divisionID'), request()->route('categoryID'), 1, $group->id])); ?>"><h1><?php echo e($group->name); ?></h1></a>
                  </div>
              </div> 
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
    </div>
</section>
<div class="section-padding"></div>
<?php echo $__env->make('footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH /home/ferwafa/public_html/resources/views/divisionTwo.blade.php ENDPATH**/ ?>