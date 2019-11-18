<div class="page-title">                    
    <h2><span class="fa fa-sitemap"></span> Binary Tree View</h2>
</div>
<div class="page-content-wrap">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a class="btn btn-sm btn-default btn-flat" href="<?php echo base_url('member/binary/tree'); ?>"><i class="fa fa-arrow-circle-o-left text-danger"></i>&nbsp;&nbsp;Kembali</a>
                </div>
                <div class="panel-body">
                    <?php
                    if (!empty($tree)) {
                        echo '<div class="row">';
                        echo '<div class="tree">';
                        echo '<ul>';
                        echo '<li id="' . $tree['id'] . '">';
                        echo '<a href="' . base_url('member/binary/tree/show/' . $tree['id']) . '">';
                        echo '<div>';
                        echo '<h5><i class="fa fa-star"></i> ' . $tree['userName'] . '</h5>';
                        echo '</div>';
                        echo '</a>';
                        if (!empty($tree['child'])) {
                            echo '<ul>';
                            foreach ($tree['child'] as $key => $value) {
                                echo '<li id="' . $value['id'] . '">';
                                echo '<a href="' . base_url('member/binary/tree/show/' . $value['id']) . '">';
                                echo '<div>';
                                echo '<h5><i class="fa fa-star"></i> ' . $value['userName'] . '</h5>';
                                echo '</div>';
                                echo '</a>';
                                if (!empty($value['child'])) {
                                    echo '<ul>';
                                    foreach ($value['child'] as $k => $v) {
                                        echo '<li id="' . $v['id'] . '">';
                                        echo '<a href="' . base_url('member/binary/tree/show/' . $v['id']) . '">';
                                        echo '<div>';
                                        echo '<h5><i class="fa fa-star"></i> ' . $v['userName'] . '</h5>';
                                        echo '</div>';
                                        echo '</a>';
                                        echo '</li>';
                                    }
                                    echo '</ul>';
                                }
                                echo '</li>';
                            }
                            echo '</ul>';
                        }
                        echo '</li>';
                        echo '</ul>';
                        echo '</div>';
                        echo '</div>';
                        ?>
                        <br />
                    <?php } else { ?>
                        <h3 class="text-danger">Maaf, Belum ada data dalam titik ini.</h3>
                    <?php } ?>

                </div>
            </div>
        </div>
    </div>
</div>