<h2 class="section-title">List All Users</h2>
<div class="row">
    <div class="col-12 col-md-12 col-lg-12">
        <a class="btn btn-sm btn-info" href="<?php echo base_url('admin/users'); ?>"><i class="fa fa-list"></i>&nbsp;&nbsp;Users&nbsp;&nbsp;&nbsp;<span class="badge badge-primary"><?php echo!empty($count_data) ? $count_data : 0; ?></span></a>
        <a class="btn btn-sm btn-info" href="<?php echo base_url('admin/users/add'); ?>"><i class="fa fa-plus-square"></i>&nbsp;&nbsp;New User</a>
        <a class="btn btn-sm btn-info" href="<?php echo base_url('admin/users/groups'); ?>"><i class="fa fa-users"></i>&nbsp;&nbsp;Groups</a>
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

                <div>
                    <?php echo form_open(uri_string()); ?>
                        <div class="input-group">
                            <input type="text" name="user_search" class="form-control" placeholder="Search by Name">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
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

                <table class="table table-hover table-striped table-condensed">
                <thead>
                    <tr>
                        <th class="text-center" width="70">#</th>
                        <th width="300">Full Name</th>
                        <th width="200">Username</th>
                        <th width="200">Email</th>
                        <th width="180">Last Login</th>
                        <th class="text-center" width="150">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($list)) {
                        foreach ($list as $key => $value) {
                            echo '<tr>';
                            echo '<td class="text-center">' . ($key + 1) . '</td>';
                            echo '<td><a class="text-info" href="' . base_url('admin/users/edit/' . $value->id) . '"><b>' . $value->first_name . '</b></a></td>';
                            echo '<td>' . $value->username . '</td>';
                            echo '<td>' . $value->email . '</td>';
                            echo '<td class="small">' . date('l, d M Y h:i:s', $value->last_login) . '</td>';
                            echo '<td class="text-center small">';
                            echo '<a class="text-info" href="' . base_url('admin/users/edit/' . $value->id) . '"><i class="fa fa-edit"></i> Edit</a>&nbsp;&nbsp;-&nbsp;&nbsp;';
                            echo '<a class="text-danger" href="' . base_url('admin/users/del/' . $value->id) . '"onclick="return getConfirmation(\'Apakah anda akan menghapus data ini\')"><i class="fa fa-trash"></i> Delete</a>';
                            echo '</td>';
                            echo '</tr>';
                        }
                    } else {
                        echo '<tr>';
                        echo '<td colspan="6"><span class="text-danger">Tidak ada data</span></td>';
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