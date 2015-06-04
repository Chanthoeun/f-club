<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><i class="fa fa-book"></i> <?php echo $title; ?></h1>
    </div>
    <!-- /.col-lg-12 -->
    <div class="col-lg-12">
        <?php echo view_breadcrumb(); ?>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <?php echo lang('form_article_subheading'); ?>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <?php if($message != FALSE){ ?>
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <strong><?php echo $message;?></strong>
                </div>
                <?php } ?>
                <?php echo form_open("articles/modify", 'role="form"', $article_id);?>
                <div class="col-lg-6">
                    <div class="form-group">
                        <?php echo lang('form_article_title_label', 'title');?> <br />

                        <?php echo form_input($article_title);?>
                    </div>
                </div>

                <div class="col-lg-2">
                    <div class="form-group">
                        <?php echo lang('form_article_category_label', 'category');?> <br />

                        <?php echo $category;?>
                    </div>
                </div>

                <div class="col-lg-2">
                    <div class="form-group">
                        <?php echo lang('form_article_publish_label', 'publish');?> <br />

                        <div class="input-group date">
                            <?php echo form_input($publish);?>
                            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="form-group">
                        <?php echo lang('form_article_detail_label', 'detail');?> <br />
                        <textarea name="detail" id="detail" class="form-control"><?php echo $article->detail; ?></textarea>
                        <script>
                            CKEDITOR.replace( 'detail', {height: 400, filebrowserBrowseUrl: '/assets/pgrfilemanager/PGRFileManager.php',} );
                        </script>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="form-group">
                        <?php echo lang('form_article_source_label', 'source');?> <br />
                        <?php echo form_input($source);?>
                    </div>
                </div>

                <div class="col-lg-12">
                    <button type="submit" class="btn btn-primary"><?php echo lang('form_article_submit_btn') ?></button>
                    <a href="<?php echo site_url('articles'); ?>" class="btn btn-danger">Cancel</a>
                </div>
                <?php echo form_close();?>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>