<?php echo $__env->make('mainMenuBar', ['name' => 'Fixtures'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>



<div class="section-padding"></div>
<section class="section">
    <div class="container-fluid eventlist blog blogpost upcoming-event latest-blog no-padding">
    <div class="container mt-5">
        <div class="row">
            <div class="col-12 col-md-12 offset-md-1 col-lg-12 offset-lg-1">
                <div class="card card-primary">
                    
                        <div class="col-12 col-md-12 col-lg-12 p-0">
                            <?php echo $__env->make('competition-menus', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <div class="row m-0">
                                <?php if(!is_null($day)): ?>
                                    <table class="table table-bordered" height="40%">
                                        <thead>
                                            <tr style="background-color: #133E8D;">
                                                <th colspan="3" style="text-align: center; color: white"
                                                    scope="col"><?php echo e($day->name); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $games; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $game): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr style="height: 10px">
                                                    <td
                                                        style="width: 30%; text-align: center; vertical-align: middle;">
                                                        <?php echo e($game->homeTeam); ?>

                                                    </td>
                                                    <td
                                                        style="width: 20%; text-align: center; vertical-align: middle;">
                                                        <?php if($game->isPlayed): ?>
                                                            <?php echo e($game->homeTeamGoals); ?> -
                                                            <?php echo e($game->awayTeamGoals); ?>

                                                        <?php else: ?>
                                                            <small><?php echo e(date('d/m/Y', strtotime($game->date))); ?>

                                                                <?php echo e(date('H:i', strtotime($game->date))); ?></small>
                                                            <br>
                                                            VS <br>
                                                            <small><?php echo e($game->stadium); ?></small>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td
                                                        style="width: 30%; text-align: center; vertical-align: middle;">
                                                        <?php echo e($game->awayTeam); ?>

                                                    </td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                <?php endif; ?>
                            </div>
                        </div>
                    
                </div>
            </div>
        </div>
    </div>
    </div>
</section>

</div>

<?php echo $__env->make('footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH /home/ferwafa/public_html/resources/views/fixtures.blade.php ENDPATH**/ ?>