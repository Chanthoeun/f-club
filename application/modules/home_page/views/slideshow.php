<?php 
    if(isset($ads_slide))
    {
        echo $ads_slide;
    }
    else
    {
?>
<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
        <div class="item active">
            <a href="<?php echo site_url('home/contact-us'); ?>">
                <img src="<?php echo get_image('001.jpg'); ?>">
            </a>
            <div class="carousel-caption">
                Advertise Here
            </div>
        </div>
        <div class="item">
            <a href="<?php echo site_url('home/contact-us'); ?>">
                <img src="<?php echo get_image('002.jpg'); ?>">
            </a>
            <div class="carousel-caption">
                Advertise Here
            </div>
        </div>
        <div class="item">
            <a href="<?php echo site_url('home/contact-us'); ?>">
                <img src="<?php echo get_image('003.jpg'); ?>">
            </a>
            <div class="carousel-caption">
                Advertise Here
            </div>
        </div>
    </div>

    <!-- Controls -->
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
</div><!-- end Slideshow -->
    <?php } ?>