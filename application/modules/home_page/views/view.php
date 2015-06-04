<?php $this->load->view('search_box'); ?>

<?php $this->load->view('slideshow'); ?>

<?php echo view_breadcrumb('<ol class="breadcrumb">', '</ol>', '<i class="fa fa-home fa-fw"></i>Home'); ?>

<section class="row">
    <div class="col-sm-8 col-md-8 col-lg-8">
        <div class="embed-responsive-16by9">
            <!-- Large Raetangle -->
            <ins class="adsbygoogle"
                 style="display:inline-block;width:336px;height:280px"
                 data-ad-client="ca-pub-6487936670810560"
                 data-ad-slot="8480473536"></ins>
            <script>
            (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
        </div>        
        <h3 class="page-header">
            <?php echo $article->title; ?>
        </h3>
        <div class="embed-responsive-16by9">
            <!-- TopBanner -->
            <ins class="adsbygoogle"
                 style="display:block"
                 data-ad-client="ca-pub-6487936670810560"
                 data-ad-slot="5670614738"
                 data-ad-format="auto"></ins>
            <script>
            (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
        </div>
        <?php echo '<div class="embed-responsive embed-responsive-16by9">'.youtube_embed($article->source, 600, 500, FALSE, FALSE, TRUE). '</div>'; ?>
        <div class="embed-responsive-16by9">
            <!-- TopBanner -->
            <ins class="adsbygoogle"
                 style="display:block"
                 data-ad-client="ca-pub-6487936670810560"
                 data-ad-slot="5670614738"
                 data-ad-format="auto"></ins>
            <script>
            (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
        </div>
        <p><?php echo $article->detail; ?></p>
        <span class="addthis_sharing_toolbox pull-right"></span>
        <!-- Facebook Comment -->
        <br>
        <div class="fb-comments" data-href="<?php echo current_url(); ?>" data-numposts="5" data-colorscheme="light"></div>
    </div><!-- end content -->
    
    <div class="col-sm-4 col-md-4 col-lg-4">
        <?php if(isset($related_articles) && $related_articles != FALSE){ ?>
            <h3 class="page-header">
                <i class="fa fa-youtube-play text-primary"></i>
                <?php echo lang('home_relate_articles'); ?>
            </h3>
            <?php foreach ($related_articles as $related_article): ?>
            <figure class="related_image">
                <a href="<?php echo site_url('view/'.$related_article->id); ?>">
                    <img src="<?php echo youtube_thumbs($related_article->source); ?>" alt="<?php echo $related_article->title ?>"/>
                </a>
                <figcaption><?php echo $related_article->title ?></figcaption>
            </figure>
            <?php endforeach; ?>
        <?php } ?>
        
    </div><!-- end advertise -->
</section><!-- end Content -->
