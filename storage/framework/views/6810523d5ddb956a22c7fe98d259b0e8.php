<?php echo $__env->make('mainMenuBar', ['name' => 'Grassroots FootBall News'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- Blog News -->
<div
class="container-fluid eventlist blog upcoming-event latest-blog no-padding"
>
<div class="section-padding"></div>
<div class="container">
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12 content-area">
      <div class="row" >
        <?php $__currentLoopData = $result; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $news): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-md-12 col-sm-12 col-xs-12 blog-box">
          <article class="type-post">
            <div class="entry-cover">
              <a href="blogpost-page.html"
                ><img
                  src="<?php echo e(route('news.images.show', $news['image_url'])); ?>"
                  alt="blog"
                  width="297"
                  height="298"
              /></a>
            </div>
            <div class="entry-block">

              <div class="entry-meta">
                <div class="post-date">
                  <a href="#" title=""
                    ><i class="fa fa-calendar" aria-hidden="true"></i
                    ><span><?php echo e(date('jS M Y', strtotime($news['created_at']))); ?> </span></a
                  >
                </div>
              </div>
              <div class="entry-title">
                <a
                  href="blogpost-page.html"
                  title="We know Flipper lives in a world full of wonder flying there under under the sea"
                >
                  <h3>
                    <a href="<?php echo e(route('single.news', $news['id'])); ?>">
                        <?php echo e($news['title']); ?>

                    </a>
                  </h3>
                </a>
              </div>
              <div class="entry-content">
                <p>
                    <?php echo e($news['caption']); ?>

                </p>
              </div>
              <a
                href="<?php echo e(route('single.news', $news['id'])); ?>"
                class="learn-more"
                title="Learn More"
                >Learn More</a
              >
            </div>
          </article>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>

      <!-- Ow Pagination -->
      <div class="ow-pagination">
        <nav>
          <ul class="pager">
            <li class="page-prv">
              <a href="#" title="Previous"
                ><i class="fa fa-long-arrow-left" aria-hidden="true"></i
                >Previous Event</a
              >
            </li>
            <li>
              <a href="#"><i class="fa fa-th" aria-hidden="true"></i></a>
            </li>
            <li class="page-next">
              <a href="#" title="Next"
                >Next Event<i
                  class="fa fa-long-arrow-right"
                  aria-hidden="true"
                ></i
              ></a>
            </li>
          </ul>
        </nav>
      </div>
  </div>
</div>
<div class="section-padding"></div>
</div>
<!-- Latest News /- -->

<?php echo $__env->make('footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php /**PATH /home/ferwafa/public_html/resources/views/grassroots_news.blade.php ENDPATH**/ ?>