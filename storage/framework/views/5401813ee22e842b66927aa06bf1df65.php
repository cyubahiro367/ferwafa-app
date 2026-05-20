<?php echo $__env->make('mainMenuBar', ['name' => 'Tender'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- Blog News -->
<div
class="container-fluid eventlist blog upcoming-event latest-blog no-padding"
>
<div class="section-padding"></div>
<div class="container">
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12 content-area">
      <div class="row" >
        
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
<?php /**PATH /home/ferwafa/public_html/resources/views/tender.blade.php ENDPATH**/ ?>