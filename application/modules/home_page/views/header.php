<header class="header">
    <?php $this->load->view('top_menu'); ?>

    <section class="container">
        <section class="row">
            <div class="col-sm-3 col-md-3 col-lg-3">
                <a href="<?php echo site_url(); ?>" class="logo">
                    <img src="<?php echo get_image('logo-white.png') ?>" alt="Funny Clup" width="260" height="70" class="img-responsive"/>
                </a>
            </div><!-- End Logo -->    
            <div class="col-sm-9 col-md-9 col-lg-9 hidden-xs">
                <!-- TopBanner -->
                <ins class="adsbygoogle"
                     style="display:block"
                     data-ad-client="ca-pub-6487936670810560"
                     data-ad-slot="5670614738"
                     data-ad-format="auto"></ins>
                <script>
                (adsbygoogle = window.adsbygoogle || []).push({});
                </script>
                <br>
            </div>
        </section><!-- End Header -->

        <div class="navbar navbar-default hidden-xs">
            <ul class="nav navbar-nav">
                <?php foreach($categories as $category): ?>
                <li <?php echo $this->uri->segment(2) != FALSE && $this->uri->segment(2) == $category->slug ? 'class="active"' : ''; ?>>
                    <a href="<?php echo site_url('videos/'.$category->slug); ?>"><i class="fa fa-film fa-fw"></i> <strong><?php echo $category->caption; ?></strong></a>
                </li>
                <li class="divider"></li>
                <?php endforeach; ?>
            </ul>
        </div><!-- end menu -->
    </section>
</header>