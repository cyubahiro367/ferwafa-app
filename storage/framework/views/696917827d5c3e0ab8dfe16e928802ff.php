<?php echo $__env->make('mainMenuBar', ['name' => 'News'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div
      class="container-fluid eventlist blog blogpost upcoming-event latest-blog no-padding"
    >
      <div class="section-padding"></div>
      <div class="container">
        <div class="row " style="display: flex; justify-content: center">
          <div class="col-md-19 col-sm-19 content-area">
            <article class="type-post">
              <!--<div class="entry-cover">-->
              <!--  <img-->
              <!--    src="<?php echo e(route('news.images.show', $url[0]['url'])); ?>"-->
              <!--    alt="blog-post"-->
              <!--    width="810"-->
              <!--    height="376"-->
              <!--  />-->
              <!--</div>-->
              <div class="entry-block">
            
                <div class="entry-title">
                  <h3>
                    <?php echo e($result['title']); ?>

                  </h3>
                </div>
                <div class="entry-content">
                    <?php echo $result['description']; ?>

                </div>
              </div>
            </article>
          </div>
        </div>
      </div>
      <div class="section-padding"></div>
    </div>

<?php echo $__env->make('footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH /home/ferwafa/public_html/resources/views/single_news.blade.php ENDPATH**/ ?>