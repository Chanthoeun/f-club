<?php echo form_open('search', 'class="form-search" role="form"'); ?>
    <p>
        <input type="text" name="search" id="search" placeholder="<?php echo lang('home_search'); ?>" value="<?php echo set_value('search'); ?>" />
        <button type="submit">
            <i class="fa fa-search fa-fw fa-lg"></i>
        </button>
    </p>
<?php echo form_close(); ?>