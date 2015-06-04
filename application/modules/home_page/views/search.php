<?php $this->load->view('search_box'); ?>

<?php $this->load->view('slideshow'); ?>

<?php echo view_breadcrumb('<ol class="breadcrumb">', '</ol>', '<i class="fa fa-home fa-fw"></i>Home'); ?>

<?php if(isset($ads_midle)): ?>
<section class="row">
    <div class="col-lg-12 ads-bottom">
        <?php echo $ads_midle; ?>
    </div>
</section>
<?php endif; ?>

<section class="row">
    <div class="col-lg-12">
        <h3 class="page-header"><i class="fa fa-search fa-fw"></i> <?php echo $search_result; ?></h3>
        <?php if(isset($result_articles) && !empty($result_articles)){ ?>
        
        <?php
            $i = 1;
            foreach ($result_articles as $article){
        ?>
        <?php 
            if($i == 10)
            {
                $i = 1;
            }
            if($i == 1)
            {
        ?>
        <div class="embed-responsive-16by9">
            <!-- Left -->
            <ins class="adsbygoogle"
                 style="display:block"
                 data-ad-client="ca-pub-6487936670810560"
                 data-ad-slot="7147347936"
                 data-ad-format="auto"></ins>
            <script>
            (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
        </div>
        <?php
            }
        ?>
        <div class="news">
            <h3 class="caption"><a href="<?php echo site_url('view/'.$video->slug); ?>"><?php echo $video->title; ?></a></h3>
            <div class="news-detail">
                <a href="<?php echo site_url('view/'.$video->slug); ?>">
                    <img src="<?php echo youtube_thumbs($video->source); ?>" alt="<?php echo $video->title; ?>" />
                </a>
                <div class="description">
                    <span><?php echo date('l, d F Y', strtotime($video->published_on)); ?></span>
                    <p><?php echo word_limiter($video->detail, 30); ?></p>
                </div>
            </div>
        </div><!-- end new item -->
        <?php
            $i += 1;
            }
        ?>
        <?php } ?>
    </div>
</section><!-- end Content -->