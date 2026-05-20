<!DOCTYPE html>
<html lang="en">


<!-- forms-editor.html  21 Nov 2019 03:55:08 GMT -->

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Form</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Custom style CSS -->
    <link rel="stylesheet" href="./assets/css/custom.css">
    <link href="./static/img/federation/ferwafa.png" rel="shortcut icon" />
    <!-- General CSS Files -->
    <link rel="stylesheet" href="./assets/css/app.min.css">
    <link rel="stylesheet" href="./assets/bundles/summernote/summernote-bs4.css">
    <link rel="stylesheet" href="./assets/bundles/codemirror/lib/codemirror.css">
    <link rel="stylesheet" href="./assets/bundles/codemirror/theme/duotone-dark.css">
    <link rel="stylesheet" href="./assets/bundles/jquery-selectric/selectric.css">
    <!-- Template CSS -->
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./assets/css/components.css">
</head>

<body>
    <?php echo $__env->make('admin.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="main-content">
        <section class="section">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Add Document</h4>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card-body">
                                            <form method="POST" action="<?php echo e(route('create.report')); ?>" enctype="multipart/form-data">
                                                <?php echo csrf_field(); ?>
                                                <div class="form-group row mb-4">
                                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Title</label>
                                                    <div class="col-sm-12 col-md-7">
                                                        <input type="text" name="title" class="form-control">
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
                                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Type</label>
                                                    <div class="col-sm-12 col-md-7">
                                                        <select name="typeID" class="form-control selectric">
                                                            <?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($type->id); ?>"><?php echo e($type->name); ?></option>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row mb-4">
                                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Select PDF File</label>
                                                    <div class="col-sm-12 col-md-7">
                                                        <input type="file" name="reportFile" class="form-control">
                                                        <?php $__errorArgs = ['reportFile'];
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
                                                    <label class="col-form-label text-md-center col-12 col-md-3 col-lg-3"></label>
                                                    <div class="col-sm-12 col-md-7">
                                                        <button class="btn btn-primary">Add</button>
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



    <script src="./assets/js/app.min.js"></script>
    <!-- JS Libraies -->
    <script src="./assets/bundles/summernote/summernote-bs4.js"></script>
    <script src="./assets/bundles/codemirror/lib/codemirror.js"></script>
    <script src="./assets/bundles/codemirror/mode/javascript/javascript.js"></script>
    <script src="./assets/bundles/jquery-selectric/jquery.selectric.min.js"></script>
    <script src="./assets/bundles/ckeditor/ckeditor.js"></script>
    <!-- Page Specific JS File -->
    <script src="./assets/js/page/ckeditor.js"></script>
    <!-- Template JS File -->
    <script src="./assets/js/scripts.js"></script>
    <!-- Custom JS File -->
    <script src="./assets/js/custom.js"></script>
</body><?php /**PATH /home/ferwafa/public_html/resources/views/admin/create-document.blade.php ENDPATH**/ ?>