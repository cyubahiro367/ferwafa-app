<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title>Ferwafa - Fixtures</title>

    <link rel="shortcut icon" href="<?php echo e(asset('static/img/federation/ferwafa.png')); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/app.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/style.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/components.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/custom.css')); ?>">
</head>

<body>
    <?php echo $__env->make('admin.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php $divisionID = request()->route('divisionID'); ?>

    <div class="main-content">
        <section class="section">
            <div class="row">
                <div class="col-12">
                    <div class="card">

                        
                        <div class="card-header">
                            <h4>Fixtures</h4>
                            <div class="card-header-form">
                                <div class="input-group">
                                    <a href="<?php echo e(route('add.game', [request()->route('divisionID'), request()->route('categoryID')])); ?>"
                                       class="btn btn-primary">
                                        <i class="far fa-user"></i>&nbsp; Add Match
                                    </a>
                                    &nbsp;&nbsp;
                                    
                                    <form action="<?php echo e(route('fixtures', [request()->route('divisionID'), request()->route('categoryID')])); ?>"
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
                            <div class="row">

                                
                                <div class="<?php echo e($divisionID == 2 ? 'table-responsive col-sm-12 col-md-6 col-xl-6' : 'table-responsive col-12'); ?>">
                                    <?php if($divisionID == 2): ?>
                                        <h2 class="px-3 pt-3">Group A</h2>
                                    <?php endif; ?>

                                    <?php $__currentLoopData = $games; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th colspan="9" style="text-align:center; background-color:#133E8D; color:#fff;">
                                                        <?php echo e($data[0]['dayName']); ?>

                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Home Team</th>
                                                    <th>Away Team</th>
                                                    <th>Stade</th>
                                                    <th>Date</th>
                                                    <th>Home Goals</th>
                                                    <th>Away Goals</th>
                                                    <th colspan="2">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $game): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if($game['groupID'] == 1 || is_null($game['groupID'])): ?>
                                                        <tr <?php if($game['isPlayed']): ?> style="font-weight:bold" <?php endif; ?>>
                                                            <td><?php echo e($key + 1); ?></td>
                                                            <td><?php echo e($game['homeTeam']); ?></td>
                                                            <td><?php echo e($game['awayTeam']); ?></td>
                                                            <td><?php echo e($game['stadium']); ?></td>
                                                            <td><?php echo e($game['date']); ?></td>
                                                            <td><?php echo e($game['isPlayed'] ? $game['homeTeamGoals'] : '-'); ?></td>
                                                            <td><?php echo e($game['isPlayed'] ? $game['awayTeamGoals'] : '-'); ?></td>
                                                            <td>
                                                                <a href="<?php echo e(route('game.page.edit', [request()->route('divisionID'), request()->route('categoryID'), $game['id']])); ?>"
                                                                   class="btn btn-outline-primary btn-sm">Add Scores</a>
                                                            </td>
                                                            <td>
                                                                <button type="button"
                                                                        class="btn btn-outline-danger btn-sm delete-game"
                                                                        data-toggle="modal"
                                                                        data-target="#confirmDeleteModal"
                                                                        data-game-id="<?php echo e($game['id']); ?>"
                                                                        data-category-id="<?php echo e(request()->route('categoryID')); ?>">
                                                                    Delete
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </tbody>
                                        </table>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>

                                
                                <?php if($divisionID == 2): ?>
                                    <div class="table-responsive col-sm-12 col-md-6 col-xl-6">
                                        <h2 class="px-3 pt-3">Group B</h2>

                                        <?php $__currentLoopData = $games; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th colspan="9" style="text-align:center; background-color:#133E8D; color:#fff;">
                                                            <?php echo e($data[0]['dayName']); ?>

                                                        </th>
                                                    </tr>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Home Team</th>
                                                        <th>Away Team</th>
                                                        <th>Stade</th>
                                                        <th>Date</th>
                                                        <th>Home Goals</th>
                                                        <th>Away Goals</th>
                                                        <th colspan="2">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $game): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php if($game['groupID'] == 2): ?>
                                                            <tr <?php if($game['isPlayed']): ?> style="font-weight:bold" <?php endif; ?>>
                                                                <td><?php echo e($key + 1); ?></td>
                                                                <td><?php echo e($game['homeTeam']); ?></td>
                                                                <td><?php echo e($game['awayTeam']); ?></td>
                                                                <td><?php echo e($game['stadium']); ?></td>
                                                                <td><?php echo e($game['date']); ?></td>
                                                                <td><?php echo e($game['isPlayed'] ? $game['homeTeamGoals'] : '-'); ?></td>
                                                                <td><?php echo e($game['isPlayed'] ? $game['awayTeamGoals'] : '-'); ?></td>
                                                                <td>
                                                                    <a href="<?php echo e(route('game.page.edit', [request()->route('divisionID'), request()->route('categoryID'), $game['id']])); ?>"
                                                                       class="btn btn-outline-primary btn-sm">Add Scores</a>
                                                                </td>
                                                                <td>
                                                                    <button type="button"
                                                                            class="btn btn-outline-danger btn-sm delete-game"
                                                                            data-toggle="modal"
                                                                            data-target="#confirmDeleteModal"
                                                                            data-game-id="<?php echo e($game['id']); ?>"
                                                                            data-category-id="<?php echo e(request()->route('categoryID')); ?>">
                                                                        Delete
                                                                    </button>
                                                                </td>
                                                            </tr>
                                                        <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </tbody>
                                            </table>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                <?php endif; ?>

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
                    Are you sure you want to delete this game?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <form id="deleteGameForm" method="POST" action="">
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
            $('.delete-game').on('click', function () {
                var gameId     = $(this).data('game-id');
                var categoryId = $(this).data('category-id');

                var actionUrl = "<?php echo e(route('delete.game', [':category', ':game'])); ?>"
                    .replace(':category', categoryId)
                    .replace(':game', gameId);

                $('#deleteGameForm').attr('action', actionUrl);
            });
        });
    </script>
</body>
</html><?php /**PATH /home/ferwafa/public_html/resources/views/admin/games.blade.php ENDPATH**/ ?>