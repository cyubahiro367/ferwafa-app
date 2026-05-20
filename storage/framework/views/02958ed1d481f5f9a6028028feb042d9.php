<?php echo $__env->make('mainMenuBar', ['name' => 'about'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<div>
    <!-- Team Section -->
    <div class="container-fluid no-padding team-section">
        <div class="section-padding"></div>
        <div class="section-header">
            <h3>Meet our great <?php echo e($title); ?> Members</h3>
            <span><?php echo e($title); ?></span>
        </div>
        <ul id="team-carousel">
            <?php $__currentLoopData = $committee; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if(is_null($value['url'])): ?>
                    <li data-thumb="<?php echo e(asset('../asset/images/default-pic.png')); ?>">
                        <div class="col-md-6 no-padding larg-thumb">
                            <img src="<?php echo e(asset('../asset/images/default-pic.png')); ?>" style="width: 400px; height: auto;"
                                alt="team1" />
                <?php else: ?>
                    <li data-thumb="<?php echo e(route('comitte.doc', $value['url'])); ?>">
                        <div class="col-md-6 no-padding larg-thumb">
                            <img src="<?php echo e(route('comitte.doc', $value['url'])); ?>" style="width: 400px; height: auto;"
                                alt="team1" />
                <?php endif; ?>
                </div>
                <div class="container">
                    <div class="col-md-6 no-padding">
                        <div class="team-content">
                            <h3><?php echo e($value['name']); ?></h3>
                            <a href="#" title="Public Speaker"><?php echo e($value['position']); ?></a>
                            <p>
                                
                            </p>
                            <ul>
                                <li class="fb">
                                    <a title="Facebook" href="#"><i class="fa fa-facebook"></i></a>
                                </li>
                                <li class="twt">
                                    <a title="Twitter" href="#"><i class="fa fa-twitter"></i></a>
                                </li>
                                <li class="gp">
                                    <a title="GooglePlus" href="#"><i class="fa fa-google-plus"></i></a>
                                </li>
                                <li class="lnk">
                                    <a title="LinkedIn" href="#"><i class="fa fa-linkedin"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
    <!-- Team Section /- -->
    <div class="container">
        <div class="row contact-form-section">
            <div class="col-md-12 col-sm-12">
                <div class="section-header">
                    <h3>Brief | Case</h3>
                    <span>Brief | Case</span>
                </div>
                <form method="POST" action="<?php echo e(route('independent.message')); ?>" enctype="multipart/form-data"
                    id="contact-form" class="contactus-form">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="committeeCategoryID" class="form-control" id="name"
                        value="<?php echo e($committeeCategoryID); ?>" required="" />
                    <?php $__errorArgs = ['name'];
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

                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <input type="text" name="name" class="form-control" id="name"
                                placeholder="Your Name*" required="" />
                            <?php $__errorArgs = ['name'];
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
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <input type="text" name="phone" class="form-control" id="input_phone"
                                placeholder="Phone" />
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <input type="email" name="email" class="form-control" id="email"
                                placeholder="Your E-mail" required="" />
                            <?php $__errorArgs = ['email'];
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
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <input type="text" name="subject" class="form-control" id="subject"
                                placeholder="Subject" />
                            <?php $__errorArgs = ['subject'];
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
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <textarea rows="10" name="message" class="form-control" id="message" placeholder="message"></textarea>
                            <p style="color: red" id="wordCount">0/300 words</p>
                            <?php $__errorArgs = ['message'];
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

                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <label class="col-form-label text-md-right col-12 col-md-12 col-lg-12">add supporting
                            document</label>
                        <div class="form-group">
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
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                        <div class="col-sm-12 col-md-7">
                            <button class="sendMessage">Send Message</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Footer Main -->
</div>

<script>
    const textarea = document.getElementById('message');
    const wordCountDisplay = document.getElementById('wordCount');
    const maxWords = 300;

    textarea.addEventListener('input', () => {
        const words = textarea.value.trim().split(/\s+/);
        const wordCount = words.filter(word => word).length;

        if (wordCount > maxWords) {
            // Allow editing but prevent new words from being added
            const trimmedText = words.slice(0, maxWords).join(' ');
            textarea.value = trimmedText;
            wordCountDisplay.textContent = `${maxWords}/${maxWords} words - Word limit reached`;
        } else {
            wordCountDisplay.textContent = `${wordCount}/${maxWords} words`;
        }
    });
</script>
<?php echo $__env->make('footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH /home/ferwafa/public_html/resources/views/independentBodies.blade.php ENDPATH**/ ?>