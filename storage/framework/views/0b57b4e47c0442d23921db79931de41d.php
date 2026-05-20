<!DOCTYPE html>

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./assets/css/app.min.css">
    <!-- Template CSS -->
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./assets/css/components.css">
    <!-- Custom style CSS -->
    <link rel="stylesheet" href="./assets/css/custom.css">
    <link href="./static/img/federation/ferwafa.png" rel="shortcut icon" />
    <title>Ferwafa</title>
</head>


<body>
    <?php echo $__env->make('admin.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="main-content">
        <section class="section">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Available Users</h4>
                            <div class="card-header-form">
                                <form>
                                    <div class="input-group">
                                        <a href="<?php echo e(route('send.key')); ?>" class="btn btn-primary">
                                            <i class="far fa-user"> &nbsp;</i>Add User
                                        </a>
                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="text" class="form-control" placeholder="Search" />
                                        <div class="input-group-btn">
                                            <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <tr>
                                        <th>#</th>
                                        <th>name</th>
                                        <th>email</th>
                                        <th>Permission</th>
                                        <th>since</th>
                                        <th colspan="2">Action</th>
                                    </tr>
                                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($key+1); ?> </td>
                                        <td><?php echo e($user['name']); ?> </td>
                                        <td><?php echo e($user['email']); ?> </td>
                                        <td>
                                            <div class="badge badge-success"><?php echo e($user['status']); ?></div>
                                        </td>
                                        <td><?php echo e(date('jS M Y', strtotime($user['since']))); ?></td>
                                        <td>
                                            <div>
                                                <button type="button" class="btn btn-outline-danger delete-game" data-toggle="modal" data-target="#confirmDeleteModal" data-game-id="<?php echo e($user['id']); ?>">Delete</button>

                                            </div>
                                        </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this user ?
                </div>
                <div class="modal-footer">
                    <form id="deleteGameForm" method="POST" action="<?php echo e(route('users.delete', 0)); ?>">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script type="module" src="/src/main.js"></script>
    <script src="./assets/js/app.min.js"></script>
    <script src="./assets/js/custom.js"></script>
    <script src="./assets/js/scripts.js"></script>
    <script src="./assets/js/scripts.js"></script>
    <script src="./assets/js/custom.js"></script>
    <script>
        $(document).ready(function() {
            $('.delete-game').click(function() {
                var gameId = $(this).data('game-id');
                var form = $('#deleteGameForm');
                var action = form.attr('action');
                // Update the form action with the correct game ID
                form.attr('action', action.replace('0', gameId));
            });
        });
    </script>

</body><?php /**PATH /home/ferwafa/public_html/resources/views/admin/users.blade.php ENDPATH**/ ?>