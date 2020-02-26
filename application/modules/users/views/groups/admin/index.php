<h2 class="section-title">List All Groups</h2>
<div class="row">
    <div class="col-12 col-md-12 col-lg-12">
        <a class="btn btn-sm btn-info" href="<?php echo base_url('admin/users'); ?>"><i class="fa fa-list"></i>&nbsp;&nbsp;List Users&nbsp;&nbsp;&nbsp;</span></a>
        <a class="btn btn-sm btn-info" href="<?php echo base_url('admin/users/groups'); ?>"><i class="fa fa-list"></i>&nbsp;&nbsp;Groups&nbsp;&nbsp;&nbsp;<span class="badge badge-primary"><?php echo!empty($count_data) ? $count_data : 0; ?></span></a>
        <a class="btn btn-sm btn-info" href="<?php echo base_url('admin/users/groups/add'); ?>"><i class="fa fa-plus-square"></i>&nbsp;&nbsp;New Group</a>
    </div>
</div>
</br>
<div class="row">
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-body table-responsive">
                <?php
                if (!empty($msg)) {
                    echo $msg;
                }
                ?>

                <br />

            <table class="table table-hover table-striped table-condensed">
                <thead>
                    <tr>
                        <th class="text-center" width="70">#</th>
                        <th width="250">Group Name</th>
                        <th>Description</th>
                        <th class="text-center" width="150">Actions</th>
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
                            echo '<a class="text-danger" href="' . base_url('admin/users/groups/del/' . $value->id) . '"onclick="return getConfirmation(\'Apakah anda akan menghapus data ini\')"><i class="fa fa-trash"></i> Delete</a>';
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
            </div>
            <div class="card-footer text-center">
            <?php echo $template['partials']['pagination'] ?>
            </div>

        </div>
    </div>
</div>