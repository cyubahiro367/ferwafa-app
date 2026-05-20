<?php echo $__env->make('mainMenuBar', ['name' => 'Standing'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div class="container-fluid eventlist blog blogpost upcoming-event latest-blog no-padding">
    <div class="container">
        <div class="row " style="display: flex; justify-content: center">
            <div class="col-md-10 col-sm-10 col-xs-6 blog-box">
                <article class="type-post">
                    
                    <div class="container mt-5">
                        <div class="row">
                            <div style="margin-bottom: 10px" class="col-md-6 col-sm-12 offset-md-1 col-lg-6 offset-lg-1">
                                <div class="card card-primary">
                                            <div style="background-color: #133E8D;" class="col-12 col-md-12 card-header text-center">
                                                <ul class="menus">
                                                    <li><a style="color: white" href="<?php echo e(route('fixtures.show', [request()->route('seasonID'), request()->route('divisionID'), $categoryID, $days->dayID, request()->route('groupID')])); ?>">Results
                                                            &
                                                            Fixtures /</a>
                                                    </li>
                                                    <li><a style="color: white"
                                                            href="<?php echo e(route('men.first-division-table', [request()->route('seasonID'), request()->route('divisionID'), $categoryID, request()->route('groupID')])); ?>">Standing</a>
                                                    </li>
                                                </ul>
                                            </div>
                                                <table  class="table table-responsive table-bordered main-table">
                                                    <thead>
                                                        <tr>
                                                            <th style="width: 5%" scope="col">#</th>
                                                            <th style="width: 50%" scope="col">Team</th>
                                                            <th style="width: 10%" scope="col">P</th>
                                                            <th style="width: 10%" scope="col">GF</th>
                                                            <th style="width: 10%" scope="col">GL</th>
                                                            <th style="width: 10%" scope="col">GD</th>
                                                            <th style="width: 10%" scope="col">Pts</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $__currentLoopData = $teamStatistics; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $teamStatistic): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php if($key + 1 === count($teamStatistics) || $key + 1 === count($teamStatistics) - 1): ?>
                                                                <tr class="last-teams main">
                                                                <?php else: ?>
                                                                <tr>
                                                            <?php endif; ?>
        
                                                            <?php if($key + 1 == 1): ?>
                                                                <tr class="first-team">
                                                            <?php endif; ?>
                                                            <th scope="row"><?php echo e($key + 1); ?> </th>
                                                            <td><?php echo e($teamStatistic->name); ?></td>
                                                            <td><?php echo e($teamStatistic->matchPlayed); ?></td>
                                                            <td><?php echo e($teamStatistic->goalWin); ?></td>
                                                            <td><?php echo e($teamStatistic->goalLoss); ?></td>
                                                            <td><?php echo e($teamStatistic->goalDifference); ?></td>
                                                            <td><?php echo e($teamStatistic->score); ?></td>
                                                            </tr>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </tbody>
                                                </table>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12 offset-md-1 col-lg-3 offset-lg-1">
                                <div class="card card-primary">
                                        <div class="col-12 col-md-12 col-lg-12 p-0">
                                            <div class="col-12 col-md-12 card-header text-center">
                                                <ul class="menus">
                                                    <li><a><?php echo e($categoryName); ?> Top Scores</a></li>
                                                </ul>
                                            </div>
                                            <div class="row m-0">
                                                <table class="table table-responsive table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th style="width: 5%" scope="col">#</th>
                                                            <th style="width: 50%" scope="col">Name</th>
                                                            <th style="width: 10%" scope="col">Team</th>
                                                            <th style="width: 10%; background-color: #133E8D; color: white"
                                                                scope="col">Goals</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $__currentLoopData = $topScores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $topScore): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <tr>
                                                                <th scope="row"><?php echo e($key + 1); ?></th>
                                                                <td><?php echo e($topScore['name']); ?></td>
                                                                <td><?php echo e($topScore['teamName']); ?></td>
                                                                <td style="background-color: #133E8D; color: white">
                                                                    <?php echo e($topScore['goals']); ?></td>
                                                            </tr>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            </article>
        </div>

    </div>
</div>
        
<?php echo $__env->make('footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH /home/ferwafa/public_html/resources/views/menFirstDivisionTable.blade.php ENDPATH**/ ?>