<div class="page-title">                    
    <h2><span class="fa fa-file-text-o"></span> List All Articles</h2>
</div>

<div class="page-content-wrap">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a class="btn btn-sm btn-default btn-flat" href="<?php echo base_url('admin/articles'); ?>"><i class="fa fa-list"></i>&nbsp;&nbsp;Articles</a>
                    <a class="btn btn-sm btn-default btn-flat" href="<?php echo base_url('admin/articles/add'); ?>"><i class="fa fa-plus-square"></i>&nbsp;&nbsp;New Article</a>
                    <a class="btn btn-sm btn-default btn-flat" href="<?php echo base_url('admin/articles/categories'); ?>"><i class="fa fa-folder"></i>&nbsp;&nbsp;Categories</a>
                    <a class="btn btn-sm btn-default btn-flat hidden" href="<?php echo base_url('admin/articles/comments'); ?>"><i class="fa fa-comment"></i>&nbsp;&nbsp;Comments</a>
                </div>
                <div class="panel-body">
                    <div>
                        <?php echo form_open(uri_string()); ?>
                        <div class="input-group">
                            <input type="text" name="articles_search" class="form-control input-sm pull-right" placeholder="Search by Title">
                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-md btn-default btn-flat"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                        <?php
                        if (!empty($search)) {
                            ?>
                            <div class="input-group">
                                <p class="help-block">Search query : <strong>"<?php echo $search; ?>"</strong></p>
                            </div>
                        <?php } ?>
                        </form>
                    </div>
                    <br />

                    <div class="row table-responsive">
                        <?php
                        if (!empty($msg)) {
                            echo $msg;
                        }
                        ?>

                        <table class="table table-hover table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center" width="50">#</th>
                                    <th class="text-center" width="100"></th>
                                    <th width="350">Title </th>
                                    <th width="150">Category </th>
                                    <th width="100">Author </th>
                                    <th class="text-center" width="50">Published </th>
                                    <th class="text-center" width="100">Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!empty($list)) {
                                    foreach ($list as $key => $value) {
                                        echo '<tr>';
                                        echo '<td class="text-center">' . ($key + 1) . '</td>';
                                        echo '<td class="text-center"><img class="img-thumbnail" src="' . base_url($value->art_img . '?' . random_string('alnum', 6)) . '" width="50" height="30"></td>';
                                        echo '<td>';
                                        echo '<strong><a class="text-info" href="' . base_url('admin/articles/edit/' . $value->id) . '">' . $value->art_title . '</a></strong><br />';
                                        echo '<small>';
                                        echo ' <a target="_blank" class="text-info" href="' . base_url('articles/read/' . $value->art_slug) . '"><i class="fa fa-eye"></i> Preview</a>';
                                        echo '&nbsp;&nbsp;-&nbsp;&nbsp;';
                                        echo ' <a class="text-info" href="' . base_url('admin/articles/edit/' . $value->id) . '"><i class="fa fa-edit"></i> Edit</a>';
                                        echo '&nbsp;&nbsp;-&nbsp;&nbsp;';
                                        echo ' <a class="text-danger" href="' . base_url('admin/articles/del/' . $value->id) . '" onclick="return getConfirmation(\'Apakah anda akan menghapus data ini\')"><i class="fa fa-minus-circle"></i> Delete</a>';
                                        if ($value->art_img != 'assets/modules/articles/default-image.jpg') {
                                            echo '&nbsp;&nbsp;-&nbsp;&nbsp;';
                                            echo ' <a class="text-danger" href="' . base_url('admin/articles/rm_image/' . $value->id) . '"><i class="fa fa-image"></i> Remove Intro Image</a>';
                                        }
                                        echo '</small>';
                                        echo '</td>';
                                        echo '<td>' . ($value->ct_name == '' ? 'Uncategorized' : $value->ct_name) . '</td>';
                                        echo '<td>' . $value->username . '</td>';
                                        echo '<td class="text-center">';
                                        if ($value->art_is_publish == 1) {
                                            echo '<a href="' . base_url('admin/articles/unpublish/' . $value->id) . '"><i class="fa fa-check-circle text-success"></i></a>';
                                        } else {
                                            echo '<a href="' . base_url('admin/articles/publish/' . $value->id) . '"><i class="fa fa-minus-circle text-danger"></i></a>';
                                        }
                                        echo '</td>';
                                        echo '<td class="text-center"><small>' . mdate("%l", strtotime($value->date_create)) . '</small><br /><small>' . mdate("%d %M %Y", strtotime($value->date_create)) . '</small></td>';
                                        echo '</tr>';
                                    }
                                } else {
                                    echo '<tr>';
                                    echo '<td colspan="7"><span class="text-danger">Tidak ada data</span></td>';
                                    echo '</tr>';
                                }
                                ?>
                            </tbody>

                        </table>
                    </div><!-- /.box-body -->
                    <div class="box-footer text-center">
                        <?php
                        if (!empty($template['partials']['pagination'])) {
                            echo $template['partials']['pagination'];
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>