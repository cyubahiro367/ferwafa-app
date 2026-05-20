<!DOCTYPE html>
<html lang="en">


<!-- forms-editor.html  21 Nov 2019 03:55:08 GMT -->

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Ferwafa</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Custom style CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/custom.css')); ?>">
    <link href="<?php echo e(asset('static/img/federation/ferwafa.png')); ?>" rel="shortcut icon" />
    <!-- General CSS Files -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/app.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/bundles/summernote/summernote-bs4.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/bundles/codemirror/lib/codemirror.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/bundles/codemirror/theme/duotone-dark.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/bundles/jquery-selectric/selectric.css')); ?>">
    <!-- Template CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/style.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/components.css')); ?>">
</head>

<body>
    <?php echo $__env->make('admin.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="main-content">
        <section class="section">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Update News</h4>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card-body">

                                            <form method="POST" action="<?php echo e(route('news.page.update',$result->id)); ?>" enctype="multipart/form-data">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('PUT'); ?>
                                                <?php if(session()->has('message')): ?>
                                                <div style="color: red;">
                                                    <?php echo e(session()->get('message')); ?>

                                                </div>
                                                <?php endif; ?>
                                                <div class="form-group row mb-4">
                                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Title</label>
                                                    <div class="col-sm-12 col-md-7">
                                                        <input type="text" name="title" value="<?php echo e($result->title); ?>" class="form-control">
                                                        <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                        <div style="color: red;">
                                                            <?php echo e($message); ?>

                                                        </div>
                                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                    </div>
                                                </div>
                                                <div class="form-group row mb-4">
                                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Caption</label>
                                                    <div class="col-sm-12 col-md-7">
                                                        <input type="text" name="caption" value="<?php echo e($result->caption); ?>" class="form-control">
                                                        <?php $__errorArgs = ['caption'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                        <div style="color: red;">
                                                            <?php echo e($message); ?>

                                                        </div>
                                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                    </div>
                                                </div>
                                                <div class="form-group row mb-4">
                                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">status</label>
                                                    <div class="col-sm-12 col-md-7">
                                                        <select name="statusID" class="form-control selectric">
                                                            <?php $__currentLoopData = $statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($status->id); ?>"><?php echo e($status->name); ?></option>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row mb-4">
                                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">News Type</label>
                                                    <div class="col-sm-12 col-md-7">
                                                        <select name="newsTypeID" class="form-control selectric">
                                                            <?php $__currentLoopData = $newsTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $newsType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($newsType->id); ?>"><?php echo e($newsType->name); ?></option>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row mb-4">
                                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Is Top News</label>
                                                    <div class="col-sm-12 col-md-7">
                                                        <select name="is_top" class="form-control selectric">
                                                            <option value="0">False</option>
                                                            <option value="1">True</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row mb-4">
                                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Select Image</label>
                                                    <div class="col-sm-12 col-md-7">
                                                        <input type="file" id="imageInput" name="image" class="form-control">
                                                        <?php $__errorArgs = ['image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                        <div style="color: red;">
                                                            <?php echo e($message); ?>

                                                        </div>
                                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                    </div>
                                                </div>
                                                <div class="form-group row mb-4">
                                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Content</label>
                                                    <div class="col-sm-12 col-md-7">
                                                        <textarea name="description" class="summernote"><?php echo e($result->description); ?></textarea>
                                                        <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                        <div style="color: red;">
                                                            <?php echo e($message); ?>

                                                        </div>
                                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                    </div>
                                                </div>

                                                <div class="form-group row mb-4">
                                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                                    <div class="col-sm-12 col-md-7">
                                                        <button class="btn btn-primary">Update</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>



    <script src="<?php echo e(asset('assets/js/app.min.js')); ?>"></script>
    <!-- JS Libraies -->
    <script src="<?php echo e(asset('assets/bundles/summernote/summernote-bs4.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/bundles/codemirror/lib/codemirror.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/bundles/codemirror/mode/javascript/javascript.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/bundles/jquery-selectric/jquery.selectric.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/bundles/ckeditor/ckeditor.js')); ?>"></script>
    <!-- Page Specific JS File -->
    <script src="<?php echo e(asset('assets/js/page/ckeditor.js')); ?>"></script>
    <!-- Template JS File -->
    <script src="<?php echo e(asset('assets/js/scripts.js')); ?>"></script>
    <!-- Custom JS File -->
    <script src="<?php echo e(asset('assets/js/custom.js')); ?>"></script>
</body><?php /**PATH /home/ferwafa/public_html/resources/views/admin/update-news.blade.php ENDPATH**/ ?>