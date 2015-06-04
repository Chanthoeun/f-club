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
    <div class="col-sm-9 col-md-9 col-lg-9">
        <h3 class="page-header"><i class="fa fa-envelope-o text-primary"></i> <?php echo lang('home_contact_info'); ?></h3>
        <ul class="fa-ul">
            <li><i class="fa-li fa fa-map-marker fa-fw fa-lg"></i> <?php echo lang('home_contact_address') ?></li>
            <li><i class="fa-li fa fa-phone fa-fw fa-lg"></i> <?php echo lang('home_contact_telephone') ?></li>
            <li><i class="fa-li fa fa-envelope fa-fw fa-lg"></i> <?php echo lang('home_contact_email') ?></li>
            <li><i class="fa-li fa fa-globe fa-fw fa-lg"></i> <?php echo lang('home_contact_website') ?></li>
        </ul>
        <br><br>
        <h3 class="page-header"><i class="fa fa-comment-o text-primary"></i> <?php echo lang('home_contact_questiong'); ?></h3>
        
        <?php if($message != FALSE){ ?>
        <div class="alert alert-warning alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <strong><?php echo $message;?></strong>
        </div>
        <?php } ?>
        
        <?php echo form_open(current_url(), 'role="form"'); ?>
        <div class="col-lg-12">
            <div class="form-group">
                <?php echo lang('home_contact_fullname_label', 'name');?> <br />
                <?php echo form_input($name);?>
            </div>
        </div>
        
        <div class="col-md-6 col-lg-6">
            <div class="form-group">
                <?php echo lang('home_contact_email_lable', 'email');?> <br />
                <?php echo form_input($email);?>
            </div>
        </div>
        
        <div class="col-md-6 col-lg-6">
            <div class="form-group">
                <?php echo lang('home_contact_telephone_label', 'telephone');?> <br />
                <?php echo form_input($telephone);?>
            </div>
        </div>
        
        <div class="col-lg-12">
            <div class="form-group">
                <?php echo lang('home_contact_subject_label', 'subject');?> <br />
                <?php echo form_input($subject);?>
            </div>
        </div>
        
        <div class="col-lg-12">
            <div class="form-group">
                <?php echo lang('home_contact_comment_label', 'comment');?> <br />
                <?php echo form_textarea($comment);?>
            </div>
        </div>
        
        <div class="col-lg-12">
            <?php echo generate_captcha_image(ENVIRONMENT == 'development' ? 'http://localhost.f-club.ga//' : 'http://www.f-club.ga/'); ?>
        </div>
        
        <div class="col-md-6 col-lg-6">
            <div class="form-group">
                <?php echo lang('home_signup_captcha', 'captcha');?> <br />
                <?php echo form_input($captcha);?>
            </div>
        </div>
        
        <div class="col-lg-12">
            <button type="submit" style="margin: 10px 0; padding: 5px 40px; font-size: 22px;" class="btn btn-primary"><strong><i class="fa fa-send"></i> <?php echo lang('home_contact_send_btn') ?></strong></button>
        </div>        
        <?php echo form_close(); ?>
    </div>
    <div class="col-sm-3 col-md-3 col-lg-3">
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
    </div>
</section><!-- end Content -->