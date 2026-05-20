<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title>Ferwafa - Top Scores</title>

    <link rel="shortcut icon" href="<?php echo e(asset('static/img/federation/ferwafa.png')); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/app.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/style.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/components.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/custom.css')); ?>">
</head>

<body>
    <?php echo $__env->make('admin.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="main-content">
        <section class="section">
            <div class="row">
                <div class="col-12">
                    <div class="card">

                        
                        <div class="card-header">
                            <h4>Available Top Scores</h4>
                            <div class="card-header-form">
                                <div class="input-group">
                                    <a href="<?php echo e(route('add.top-score', [request()->route('divisionID'), request()->route('categoryID')])); ?>"
                                       class="btn btn-primary">
                                        <i class="far fa-user"></i>&nbsp; Add Top Score
                                    </a>
                                    &nbsp;&nbsp;
                                    
                                    <form action="<?php echo e(route('top-score', [request()->route('divisionID'), request()->route('categoryID')])); ?>"
                                          method="GET" class="d-flex align-items-center">
                                        <select class="btn btn-primary" name="seasonID">
                                            <?php $__currentLoopData = $seasons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $season): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($season['id']); ?>"
                                                    <?php echo e($seasonID === $season['id'] ? 'selected' : ''); ?>>
                                                    <?php echo e($season['from']); ?> - <?php echo e($season['to']); ?>

                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <button type="submit" class="btn btn-primary ml-1">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <?php if(session('error')): ?>
                            <div class="alert alert-danger m-3"><?php echo e(session('error')); ?></div>
                        <?php endif; ?>

                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Goals</th>
                                            <th>Team Name</th>
                                            <th colspan="2">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $topScores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $topScore): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($key + 1); ?></td>
                                                <td><?php echo e($topScore['name']); ?></td>
                                                <td><?php echo e($topScore['goals']); ?></td>
                                                <td><?php echo e($topScore['teamName']); ?></td>
                                                <td>
                                                    <a href="<?php echo e(route('top-score.page.edit', [request()->route('divisionID'), request()->route('categoryID'), $topScore['id']])); ?>"
                                                       class="btn btn-outline-primary btn-sm">Edit</a>
                                                </td>
                                                <td>
                                                    <button type="button"
                                                            class="btn btn-outline-danger btn-sm delete-top-score"
                                                            data-toggle="modal"
                                                            data-target="#confirmDeleteModal"
                                                            data-score-id="<?php echo e($topScore['id']); ?>"
                                                            data-category-id="<?php echo e(request()->route('categoryID')); ?>">
                                                        Delete
                                                    </button>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </div>

    
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog"
         aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Delete</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this player from the top scorers?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <form id="deleteScoreForm" method="POST" action="">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    
    <script src="<?php echo e(asset('assets/js/app.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/bundles/jquery-selectric/jquery.selectric.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/scripts.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/custom.js')); ?>"></script>

    <script>
        $(document).ready(function () {
            $('.delete-top-score').on('click', function () {
                var scoreId    = $(this).data('score-id');
                var categoryId = $(this).data('category-id');

                var actionUrl = "<?php echo e(route('delete.top-score', [':category', ':score'])); ?>"
                    .replace(':category', categoryId)
                    .replace(':score', scoreId);

                $('#deleteScoreForm').attr('action', actionUrl);
            });
        });
    </script>
</body>
</html><?php /**PATH /home/ferwafa/public_html/resources/views/admin/topScore.blade.php ENDPATH**/ ?>