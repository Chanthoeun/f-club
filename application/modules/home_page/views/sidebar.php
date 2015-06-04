<?php if($populars != FALSE): ?>
<div class="list-group">
    <h4 class="title-headding"><i class="fa fa-youtube-play text-primary"></i> <?php echo lang('home_sidebar_popular'); ?></h4>
    <?php 
        foreach($populars as $popular){ 
    ?>
    <figure class="related_image">
        <a href="<?php echo site_url('view/'.$popular->id); ?>">
            <img src="<?php echo youtube_thumbs($popular->source); ?>" alt="<?php echo $popular->title ?>"/>
        </a>
        <figcaption><?php echo $popular->title ?></figcaption>
    </figure>
    <?php
        }
    ?>
</div>
<?php endif; ?>

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