<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 col-sm-12 col-xs-12 bg-red rounded shadow-sm p-4">
            <div class="entry-meta text-center">
                <br>
                <!-- Season Select -->
                <form action="<?php echo e(route('fixtures.show', [request()->route('seasonID'), request()->route('divisionID'), $categoryID, $day->id, request()->route('groupID')])); ?>" method="GET">
                    
                        <label for="seasonSelect" class="form-label fs-5">Select Season:</label>
                        <select id="seasonSelect" name="seasonID" class="form-select form-select-lg" required>
                            <?php $__currentLoopData = $seasons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $season): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($season['id']); ?>"  <?php echo e($seasonID === $season['id'] ? 'selected' : ''); ?>>
                                    <?php echo e($season['from']); ?> - <?php echo e($season['to']); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>

                        <label for="daySelect" class="form-label fs-5">Select Day:</label>
                        <select id="daySelect" name="dayID" class="form-select form-select-lg" required>
                            <?php $__currentLoopData = $days; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($value->id); ?>"  <?php echo e($day->id === $value->id ? 'selected' : ''); ?>>
                                    <?php echo e($value->abbreviation); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>

                        <button type="submit" class="btn btn-primary btn-md">Show match</button>
                    
                </form>

                <!-- Day Results and Fixtures -->
                <div class="mb-4">
                    <?php if($day): ?>
                        <div class="btn-group">
                            <a href="<?php echo e(route('fixtures.show', [request()->route('seasonID'), request()->route('divisionID'), $categoryID, $day->id, request()->route('groupID')])); ?>" class="btn btn-primary">
                                Results & Fixtures
                            </a>
                            <a href="<?php echo e(route('men.first-division-table', [request()->route('seasonID'), request()->route('divisionID'), $categoryID, request()->route('groupID')])); ?>" class="btn btn-secondary">
                                Standing
                            </a>
                        </div>
                    <?php else: ?>
                        <h4 class="text-danger">No Available Fixtures</h4>
                    <?php endif; ?>
                </div>
                <!-- Day Select -->
                <div class="days-select mb-4">
                    <br>
                    
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /home/ferwafa/public_html/resources/views/competition-menus.blade.php ENDPATH**/ ?>