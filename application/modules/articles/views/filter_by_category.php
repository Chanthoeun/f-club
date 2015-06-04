<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><i class="fa fa-building-o"></i> <?php echo $title; ?></h1>
    </div>
    <!-- /.col-lg-12 -->
    <div class="col-lg-12">
        <?php echo view_breadcrumb(); ?>
    </div>
    <!-- /.col-lg-12 -->
    <div class="col-lg-12">
        <!-- search form -->
        <?php echo form_open(current_url(), 'class="form-inline" role="form"'); ?>
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-addon">Search</div>
                    <?php echo $category; ?>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">
                <i class="fa fa-search fa-fw fa-lg"></i>
                Search
            </button>
        <?php echo form_close(); ?>
        <br>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <?php echo lang('index_article_subheading'); ?>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">                
                <?php if($message != FALSE){ ?>
                <div class="alert alert-warning alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <strong><?php echo $message;?></strong>
                </div>
                <?php } ?>
                <?php if(isset($articles) && $articles != FALSE){ ?>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th class="text-center"><?php echo lang('index_article_id_th'); ?></th>
                                <th><?php echo lang('index_article_title_th');?></th>
                                <th><?php echo lang('index_article_publish_th');?></th>
                                <th><?php echo lang('index_article_category_th');?></th>
                                <th><?php echo lang('index_article_source_th');?></th>
                                <th class="col-lg-2 text-center"><?php echo lang('index_article_action_th');?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($articles as $article):?>
                            <tr>
                                <td class="text-center"><?php echo $article->id;?></td>
                                <td><?php echo anchor('articles/view/'.$article->id, $article->title, 'title= "View Article" target="_blank"');?></td>
                                <td><?php echo $article->published_on;?></td>
                                <td><?php echo $article->catcaption;?></td>
                                <td>
                                    <?php 
                                        echo $article->source;
                                    ?>
                                </td>
                                <td class="text-center">
                                    <?php echo link_edit("articles/edit/".$article->id, 'Edit', array('title' => 'Edit Article'));?> | 
                                    <?php echo link_delete('articles/destroy/'.$article->id, 'Delete', 'Delete Article'); ?>
                                </td>
                            </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
                <?php }else{ ?>
                <div class="alert alert-info">No Records in database!</div>
                <?php } ?>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>