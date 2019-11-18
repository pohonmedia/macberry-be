<!-- START PAGE SIDEBAR -->
<div class="page-sidebar">
    <!-- START X-NAVIGATION -->
    <ul class="x-navigation">
        <li class="xn-logo">
            <a href="<?php echo base_url(); ?>"><img src="<?php echo $admin_assets . 'img/logo_header.png'; ?>" alt="Bisnis Balik Modal"/></a>
            <a href="#" class="x-navigation-control"></a>
        </li>
        <li class="xn-profile">
            <a href="#" class="profile-mini">
                <img src="<?php echo base_url('assets/modules/users/no-image.jpg'); ?>" alt="User Photo"/>
            </a>
        </li>
        <li class="xn-title"><strong>Navigation</strong></li>
            <?php
            foreach ($menu_list as $key => $value) {
                $active = "";
                if ($value['ids'] == $nav_active) {
                    $active = 'active';
                }
                $tree_view = "";
                if ($value['is_header']) {
                    $tree_view = ' xn-openable';
                }
                echo '<li class="' . $active . $tree_view . '" id="' . $value['ids'] . '">';
                echo '<a href="' . base_url($value['url']) . '">';
                echo '<span class="' . $value['icon_class'] . '"></span> ';
                echo '<span class="xn-text">' . $value['name'] . '</span>';
                echo '</a>';
                if ($value['is_header']) {
                    echo '<ul>';
                    if (!isset($subnav_active)) {
                        $subnav_active = '';
                    }
                    if (!empty($value['child'])) {
                        foreach ($value['child'] as $k => $v) {
                            $sub_active = "";
                            if ($v->menu_id == $subnav_active) {
                                $sub_active = 'active';
                            }
                            echo '<li class="' . $sub_active . '" id="' . $v->menu_id . '"><a href="' . base_url($v->menu_link) . '"><span class="' . $v->menu_iclass . '"></span> ' . $v->menu_name . '</a></li>';
                        }
                    }
                    echo '</ul>';
                }
                echo '</li>';
            }
            ?>
    </ul>
    <!-- END X-NAVIGATION -->
</div>
<!-- END PAGE SIDEBAR