<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title>Ferwafa - Available Teams</title>

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
                        <h4>Available Teams</h4>
                        <div class="card-header-form">
                            <div class="input-group">
                                <a href="<?php echo e(route('add.team', [request()->route('divisionID'), request()->route('categoryID')])); ?>"
                                   class="btn btn-primary">
                                    <i class="far fa-user"></i>&nbsp; Add Team
                                </a>
                                &nbsp;&nbsp;
                                <input type="text" class="form-control" placeholder="Search">
                                <div class="input-group-btn">
                                    <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php if(session('error')): ?>
                        <div class="alert alert-danger m-3"><?php echo e(session('error')); ?></div>
                    <?php endif; ?>

                    <?php if($errors->any()): ?>
                        <div class="alert alert-danger m-3">
                            <ul class="mb-0">
                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($error); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th colspan="2">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $teams; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $team): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td>
                                            <ul class="list-unstyled order-list m-b-0">
                                                <li class="team-member team-member-sm">
                                                    <img class="rounded-circle"
                                                         src="<?php echo e(route('team.doc', $team['url'])); ?>"
                                                         alt="<?php echo e($team['name']); ?>"
                                                         data-toggle="tooltip"
                                                         title="<?php echo e($team['name']); ?>">
                                                </li>
                                            </ul>
                                        </td>
                                        <td><?php echo e($team['name']); ?></td>
                                        <td><?php echo e($team['category']); ?></td>
                                        <td>
                                            <a href="<?php echo e(route('team.page.edit', [request()->route('divisionID'), request()->route('categoryID'), $team['id']])); ?>"
                                               class="btn btn-outline-primary btn-sm">Edit</a>
                                        </td>
                                        <td>
                                            <button type="button"
                                                    class="btn btn-outline-danger btn-sm delete-team"
                                                    data-toggle="modal"
                                                    data-target="#confirmDeleteModal"
                                                    data-team-id="<?php echo e($team['id']); ?>"
                                                    data-category-id="<?php echo e(request()->route('categoryID')); ?>"
                                                    data-division-id="<?php echo e(request()->route('divisionID')); ?>">
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


<div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this team?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <form id="deleteTeamForm" method="POST" action="">
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
        $('.delete-team').on('click', function () {
            var teamId     = $(this).data('team-id');
            var categoryId = $(this).data('category-id');
            var divisionId = $(this).data('division-id');

            var actionUrl  = "<?php echo e(route('delete.team', [':division', ':category', ':team'])); ?>"
                .replace(':division', divisionId)
                .replace(':category', categoryId)
                .replace(':team', teamId);

            $('#deleteTeamForm').attr('action', actionUrl);
        });
    });
</script>
</body>
</html>
<?php /**PATH /home/ferwafa/public_html/resources/views/admin/teams.blade.php ENDPATH**/ ?>