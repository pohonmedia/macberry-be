<div class="panel panel-default sidebar-menu">
<div class="panel-heading">
<h3 class="h4 panel-title">Categories</h3>
</div>
<div class="panel-body">
        <ul class="nav nav-pills flex-column text-sm category-menu">
            <?php
            if (!empty($result)) {
                foreach ($result as $key => $value) {
                    echo '<li class="nav-item"><a href="' . base_url('catalogs/category/' . $value->ct_slug) . '"><span style="padding-left:5px;"><strong>' . $value->ct_name . '</strong></span></a></li>';
                    if (!empty($value->child)) {
                        foreach ($value->child as $val) {
                            echo '<li><a href="' . base_url('catalogs/category/' . $val->ct_slug) . '"><span style="padding-left:10px;">' . $val->ct_name . '<span></a></li>';
                        }
                    }
                }
            }
            ?>
        </ul>
</div>
</div>

