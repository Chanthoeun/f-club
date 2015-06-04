<nav class="navbar navbar-default" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo site_url(); ?>"><strong><i class="fa fa-home fa-lg"></i> <?php echo site_name(); ?></strong></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1">
            <ul class="nav navbar-nav navbar-left visible-xs">
                <?php foreach($categories as $category): ?>
                <li <?php echo $this->uri->segment(2) != FALSE && $this->uri->segment(2) == $category->slug ? 'class="active"' : ''; ?>>
                    <a href="<?php echo site_url('videos/'.$category->slug); ?>"><i class="fa fa-film fa-fw"></i> <strong><?php echo $category->caption; ?></strong></a>
                </li>
                <li class="divider"></li>
                <?php endforeach; ?>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li <?php echo isset($menu_about_us) ? 'class="active"' : ''; ?>><a href="<?php echo site_url('about-us'); ?>"><i class="fa fa-home fa-fw"></i> <?php echo lang('home_menu_about_us'); ?></a></li>
                <li class="divider"></li>
                <li <?php echo isset($menu_contact_us) ? 'class="active"' : ''; ?>><a href="<?php echo site_url('contact-us'); ?>"><i class="fa fa-envelope fa-fw"></i> <?php echo lang('home_menu_contact_us'); ?></a></li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div>
</nav>