<div class="page-title">                    
    <h2><span class="fa fa-users"></span> List All Groups</h2>
</div>

<div class="page-content-wrap">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a class="btn btn-sm btn-default btn-flat" href="<?php echo base_url('admin/users'); ?>"><i class="fa fa-list"></i>&nbsp;&nbsp;List Users</a>
                    <a class="btn btn-sm btn-default btn-flat" href="<?php echo base_url('admin/users/groups'); ?>"><i class="fa fa-list"></i>&nbsp;&nbsp;Groups</a>
                    <a class="btn btn-sm btn-default btn-flat" href="<?php echo base_url('admin/users/groups/add'); ?>"><i class="fa fa-plus-square"></i>&nbsp;&nbsp;New Group</a>
                </div>
                <div class="panel-body">
                    <div>
                        <?php echo form_open(uri_string()); ?>
                        <div class="input-group">
                            <input type="text" name="pages_search" class="form-control input-sm pull-right" placeholder="Search by Title">
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

                    <div class="box-body table-responsive">
                        <?php
                        if (!empty($msg)) {
                            echo $msg;
                        }
                        ?>

                        <table class="table table-hover table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center" width="70">#</th>
                                    <th width="250">Group Name</th>
                                    <th>Description</th>
                                    <th class="text-center" width="200">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!empty($list)) {
                                    foreach ($list as $key => $value) {
                                        echo '<tr>';
                                        echo '<td class="text-center">' . ($key + 1) . '</td>';
                                        echo '<td><a class="text-info" href="' . base_url('admin/users/groups/edit/' . $value->id) . '"><b>' . ucwords($value->name) . '</b></a></td>';
                                        echo '<td>' . $value->description . '</td>';
                                        echo '<td class="text-center small">';
                                        echo '<a class="text-info" href="' . base_url('admin/users/groups/edit/' . $value->id) . '"><i class="fa fa-edit"></i> Edit</a>&nbsp;&nbsp;-&nbsp;&nbsp;';
                                        echo '<a class="text-success" href="' . base_url('admin/users/groups/role/' . $value->id) . '"onclick="return getConfirmation(\'Apakah anda akan menghapus data ini\')"><i class="fa fa-gear"></i> Role Setting</a>&nbsp;&nbsp;-&nbsp;&nbsp;';
                                        echo '<a class="text-danger" href="' . base_url('admin/users/groups/del/' . $value->id) . '"onclick="return getConfirmation(\'Apakah anda akan menghapus data ini\')"><i class="fa fa-minus-circle"></i> Delete</a>';
                                        echo '</td>';
                                        echo '</tr>';
                                    }
                                } else {
                                    echo '<tr>';
                                    echo '<td colspan="4"><span class="text-danger">Tidak ada data</span></td>';
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