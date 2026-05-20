<?php echo $__env->make('mainMenuBar', ['name' => 'whistleblowers'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div class="container-fulid no-padding contactus">
    <div class="section-padding"></div>
    <div class="container">
      <div class="row">
        <div class="contactus-info-block">
          <div class="col-md-4 col-sm-4 col-xs-4">
            <div class="contactinfo-box">
              <span class="icon icon-House"></span>
              <div class="infobox">
                <h3>Our Location</h3>
                <span>Remera next to Amahoro stadium.</span>
              </div>
            </div>
          </div>
          <div class="col-md-4 col-sm-4 col-xs-4">
            <div class="contactinfo-box">
              <span class="icon icon-Phone2"></span>
              <div class="infobox">
                <h3>Call Us On</h3>
                
                <a href="tel:PO. Box:2000 Kigali-Rwanda" title="PO. Box:2000 Kigali-Rwanda"
                  >PO. Box:2000 Kigali-Rwanda</a
                >
              </div>
            </div>
          </div>
          <div class="col-md-4 col-sm-4 col-xs-4">
            <div class="contactinfo-box">
              <span class="icon icon-Mail"></span>
              <div class="infobox">
                <h3>Send a Message</h3>
                <a href="#" title="contact@ferwafa.rw,"
                  >ferwafa.info@ferwafa.rw,</a
                >
                <a href="#" title="sgoffice@ferwafa.com"
                  >sgoffice@ferwafa.com</a
                >
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="map">
      <div class="section-padding"></div>
    </div>
    <div class="container">
      <div class="row contact-form-section">
        <div class="col-md-5 col-sm-12">
          <div class="section-header">
            <h3>Leave A Message</h3>
            <span>Feel Free to Contact Us</span>
          </div>
          <form method="POST" action="<?php echo e(route('post.send.whistle')); ?>" id="contact-form" class="contactus-form">
            <?php echo csrf_field(); ?>
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="form-group">
                <textarea
                rows="20" cols="50"
                  name="content"
                  class="form-control"
                  id="content"
                  placeholder="message"
                ></textarea>
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
              <div class="form-group">
                <input
                  type="submit"
                  value="Send Message"
                  id="btn_submit"
                  title="Send"
                  name="post"
                />
              </div>
            </div>
            <div id="alert-msg" class="alert-msg"></div>
          </form>
        </div>
        <div class="col-md-7 col-sm-12">
            <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3987.5040318930764!2d30.114316874739334!3d-1.951599998030699!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x19dca703a72ebd1f%3A0xe2a239a98d1f7d83!2sRwanda%20Football%20Federation!5e0!3m2!1sen!2srw!4v1690366633904!5m2!1sen!2srw"
            width="800" height="500" style="border:0; height: 500px"
            allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
      </div>
    </div>
    <div class="section-padding"></div>
  </div>

<?php echo $__env->make('footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH /home/ferwafa/public_html/resources/views/whistleblowers.blade.php ENDPATH**/ ?>