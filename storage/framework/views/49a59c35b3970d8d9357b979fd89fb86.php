<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title>Ferwafa - Add Goal Results</title>

    <link rel="shortcut icon" href="<?php echo e(asset('static/img/federation/ferwafa.png')); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/app.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/style.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/components.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/custom.css')); ?>">

    
    <link rel="stylesheet" href="<?php echo e(asset('assets/bundles/summernote/summernote-bs4.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/bundles/codemirror/lib/codemirror.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/bundles/codemirror/theme/duotone-dark.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/bundles/jquery-selectric/selectric.css')); ?>">
</head>

<body>
    <?php echo $__env->make('admin.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="main-content">
        <section class="section">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Add Goal Results</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST"
                                  action="<?php echo e(route('create.game.result', [request()->route('divisionID'), request()->route('categoryID'), $gameID])); ?>"
                                  enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('PUT'); ?>

                                
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3">
                                        <?php echo e($team->homeTeam); ?>

                                    </label>
                                    <input type="hidden" name="homeTeamID" value="<?php echo e($team->homeTeamID); ?>">
                                    <div class="col-sm-12 col-md-7">
                                        <input type="number" name="homeTeamGoals" class="form-control" min="0">
                                        <?php $__errorArgs = ['homeTeamGoals'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <div class="text-danger small mt-1"><?php echo e($message); ?></div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>

                                
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3">
                                        <?php echo e($team->awayTeam); ?>

                                    </label>
                                    <input type="hidden" name="awayTeamID" value="<?php echo e($team->awayTeamID); ?>">
                                    <div class="col-sm-12 col-md-7">
                                        <input type="number" name="awayTeamGoals" class="form-control" min="0">
                                        <?php $__errorArgs = ['awayTeamGoals'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <div class="text-danger small mt-1"><?php echo e($message); ?></div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>

                                
                                <div class="form-group row mb-4">
                                    <div class="col-sm-12 col-md-7 offset-md-3">
                                        <button type="submit" class="btn btn-primary">Add</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    
    <script src="<?php echo e(asset('assets/js/app.min.js')); ?>"></script>

    
    <script src="<?php echo e(asset('assets/bundles/summernote/summernote-bs4.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/bundles/codemirror/lib/codemirror.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/bundles/codemirror/mode/javascript/javascript.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/bundles/jquery-selectric/jquery.selectric.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/bundles/ckeditor/ckeditor.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/page/ckeditor.js')); ?>"></script>

    
    <script src="<?php echo e(asset('assets/js/scripts.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/custom.js')); ?>"></script>
</body>
</html><?php /**PATH /home/ferwafa/public_html/resources/views/admin/add-result.blade.php ENDPATH**/ ?>