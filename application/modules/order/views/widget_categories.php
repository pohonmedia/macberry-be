<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">List Kategori</h3>
    </div>
    <div class="box-footer no-padding">
        <ul class="nav nav-stacked">
            <?php
            if (!empty($result)) {
                foreach ($result as $key => $value) {
                    echo '<li><a href="' . base_url('catalogs/category/' . $value->ct_slug) . '"><span style="padding-left:5px;"><strong>' . $value->ct_name . '</strong></span></a></li>';
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
