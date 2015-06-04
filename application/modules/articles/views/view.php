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
    <div class="col-lg-6">
        <div class="table-responsive">
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td class="col-lg-3 warning"><?php echo lang('view_article_cateogry_th');?></td>
                        <td><?php echo $article->catcaption;?></td>
                    </tr>
                    <tr>
                        <td class="col-lg-3 warning"><?php echo lang('view_article_published_on_th');?></td>
                        <td><?php echo $article->published_on;?></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- /.table -->
        <h3 class="page-header">Video Description</h3>
        <p class="text-justify"><?php echo $article->detail; ?></p>
        
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header">Video Thumbnail</h3>
                <?php echo img(array('src' => youtube_thumbs($article->source, 'mq'), 'class' => 'img-thumbnail img-responsive')); ?>
            </div>
        </div>
        <a href="<?php echo site_url('articles/edit/'.$article->id); ?>" class="btn btn-primary" title="Edit Article"><i class="fa fa-pencil fa-lg"> Edit</i></a>
        <a href="<?php echo site_url('articles/destroy/'.$article->id); ?>" class="btn btn-danger" title="Delete Article" onclick="return confirm('Would you like to delete this article?')"><i class="fa fa-times fa-lg"> Delete</i></a>
    </div>
    <!-- /.col-lg-6 -->
    <div class="col-lg-6">
        <div class="embed-responsive-16by9">
            <?php echo youtube_embed($article->source, 700, 400, FALSE, FALSE, TRUE). '<br/>'; ?>
        </div>
    </div>
</div>