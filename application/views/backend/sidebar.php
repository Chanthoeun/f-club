<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li class="sidebar-search">
                <div class="input-group custom-search-form">
                    <input type="text" class="form-control" placeholder="Search...">
                    <span class="input-group-btn">
                    <button class="btn btn-default" type="button">
                        <i class="fa fa-search"></i>
                    </button>
                </span>
                </div>
                <!-- /input-group -->
            </li>
            <li>
                <a <?php echo isset($dashboad_menu) ? 'class="active"' : ''; ?> href="<?php echo home_url(); ?>"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
            </li>
            <li <?php echo isset($account_menu) ? 'class="active"' : ''; ?>>
                <a href="#"><i class="fa fa-user fa-fw"></i> Account<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a <?php echo isset($user_menu) ? 'class="active"' : ''; ?> href="<?php echo site_url('auth'); ?>"><i class="fa fa-user"></i> Users</a>
                    </li>
                    
                    <li>
                        <a <?php echo isset($group_menu) ? 'class="active"' : ''; ?> href="<?php echo site_url('groups'); ?>"><i class="fa fa-users"></i> Group</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li <?php echo isset($setting_menu) ? 'class="active"' : ''; ?>>
                <a href="#"><i class="fa fa-cog fa-fw"></i> Setting<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a <?php echo isset($category_menu) ? 'class="active"' : ''; ?> href="<?php echo site_url('categories'); ?>"><i class="fa fa-list fa-fw"></i> Categories</a>
                    </li>
                    <li>
                        <a <?php echo isset($system_log_menu) ? 'class="active"' : ''; ?> href="<?php echo site_url('system_log'); ?>"><i class="fa fa-wrench"></i> System Logs</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            
            <li <?php echo isset($article_group_menu) ? 'class="active"' : ''; ?>>
                <a href="#"><i class="fa fa-book fa-fw"></i> Articles<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a <?php echo isset($create_menu) ? 'class="active"' : ''; ?> href="<?php echo site_url('articles/create'); ?>"><i class="fa fa-book"></i> Create</a>
                    </li>
                    <li>
                        <a <?php echo isset($recently_menu) ? 'class="active"' : ''; ?> href="<?php echo site_url('articles'); ?>"><i class="fa fa-book"></i> Recently Posted</a>
                    </li>
                    <li>
                        <a <?php echo isset($search_menu) ? 'class="active"' : ''; ?> href="<?php echo site_url('articles/search'); ?>"><i class="fa fa-search"></i> Search</a>
                    </li>
                    <li>
                        <a <?php echo isset($filter_category_menu) ? 'class="active"' : ''; ?> href="<?php echo site_url('articles/filter-by-category'); ?>"><i class="fa fa-filter"></i> Filter by Category</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            
            <li>
                <a href="<?php echo site_url(); ?>" target="_blank"><i class="fa fa-eye"></i> Visit Site</a>
            </li>
        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>
<!-- /.navbar-static-side -->