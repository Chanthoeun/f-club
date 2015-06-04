<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php echo $this->template->print_meta(); ?>
        <title class="title"><?php echo $this->template->print_title(); ?></title>
        <link rel="shortcut icon" type="image/ico" href="<?php echo base_url('favicon.ico'); ?>" />
        
        <!-- Add this to your HEAD if you want to load the apple-touch-icons from another dir than your sites' root -->
        <link rel="apple-touch-icon" href="<?php echo base_url('apple-touch-icon-60x60.png'); ?>">
        <link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url('apple-touch-icon-76x76.png'); ?>">
        <link rel="apple-touch-icon" sizes="120x120" href="<?php echo base_url('apple-touch-icon-120x120.png'); ?>">
        <link rel="apple-touch-icon" sizes="144x144" href="<?php echo base_url('apple-touch-icon-114x114.png'); ?>">
        
        <!--basic styles-->
        <link href='http://fonts.googleapis.com/css?family=Hanuman:400,700|Open+Sans:400,600,600italic,700,700italic,400italic' rel='stylesheet' type='text/css'>
        <?php echo $this->template->print_css(); ?>
        
        <!-- Optional Javascript -->
        <?php echo $this->template->print_js_optional(); ?>
        
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->        
    </head>

    <body>
        <!-- Header page -->
        <?php echo $header; ?>
        <section class="container">
            <section class="row">
                <div class="col-sm-3 col-md-3 col-lg-3 hidden-xs">
                    <?php echo $sidebar; ?>
                </div><!-- end sidebar -->
                
                <div class="col-sm-9 col-md-9 col-lg-9">
                    <?php echo $content;?>
                </div><!-- end content -->
                
                <div class="col-sm-3 col-md-3 col-lg-3 visible-xs">
                    <?php echo $sidebar; ?>
                </div><!-- end sidebar -->
            </section>
        </section><!-- end body -->
        
        <!-- Footer -->
        <?php echo $footer; ?>
        
        <?php echo $this->template->print_js(); ?>
        
        <?php echo $this->template->print_jquery(); ?>
        
        <?php echo $this->template->print_script(); ?>
        <!-- Facebook API -->
        <div id="fb-root"></div>
        <script>(function(d, s, id) {
          var js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) return;
          js = d.createElement(s); js.id = id;
          js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.3&appId=1534352553487668";
          fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script><!-- end facebook API -->
        
        <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
        
        <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-54a358ff74914370" async="async"></script>
    </body>
</html>