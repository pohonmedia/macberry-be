<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="<?php echo site_url() ?>"><?php echo $this->config->item('website_name');?></a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="<?php echo site_url() ?>"><?php echo $this->config->item('website_shortname');?></a>
        </div>
        <ul class="sidebar-menu">
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="menu-header">GENERAL</li>
                <?php
                foreach ($menu_list as $key => $value) {
                    $active = "";
                    if ($value['ids'] == $nav_active) {
                        $active = 'active';
                    }
                    $tree_view = "";
                    $has_dropdown = "";
                    if ($value['is_header']) {
                        $tree_view = ' dropdown';
                        $has_dropdown = ' has-dropdown';
                    }
                    echo '<li class="' . $active . $tree_view . '" id="' . $value['ids'] . '">';
                    echo '<a href="' . base_url($value['url']) . '" class="nav-link' . $has_dropdown . '">';
                    echo '<i class="' . $value['icon_class'] . '"></i> ';
                    echo '<span>' . $value['name'] . '</span>';
                    echo '</a>';
                    if ($value['is_header']) {
                        echo '<ul class="dropdown-menu">';
                        if(!isset($subnav_active)) {
                            $subnav_active = '';
                        }
                        if (!empty($value['child'])) {
                            foreach ($value['child'] as $k => $v) {
                                $sub_active = "";
                                if ($v->menu_id == $subnav_active) {
                                    $sub_active = 'active';
                                }
                                echo '<li class="' . $sub_active .  '" id="' . $v->menu_id . '"><a class="nav-link" href="' . base_url($v->menu_link) . '">' . $v->menu_name . '</a></li>';
                            }
                        }
                        echo '</ul>';
                    }
                    echo '</li>';
                }
                ?>
        </ul>
    </aside>
</div>