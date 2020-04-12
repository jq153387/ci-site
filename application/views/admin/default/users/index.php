<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><?php echo lang('admin_users');?></h3>
            </div><!-- /.box-header -->
            <div class="box-body">
                <?php echo $this->session->flashdata('message'); ?>
                <p><a class="btn btn-default" href="<?php echo site_url('admin/users/add') ?>"><?php echo lang('admin_new_user');?></a></p>
                <table class="table table-bordered">
                    <tr>
                        <th style="width: 10px">#</th>
                        <th><?php echo lang('admin_username');?></th>
                        <th><?php echo lang('admin_email');?></th>
                        <th><?php echo lang('admin_first_name');?></th>
                        <th><?php echo lang('admin_last_name');?></th>
                        <th><?php echo lang('admin_groups');?></th>
                        <th><?php echo lang('admin_status');?></th>
                        <th style="width: 100px"><?php echo lang('admin_action');?></th>
                    </tr>
                    <?php if (!empty($users)) : ?>
                        <?php foreach ($users as $user) : ?>
                            <tr>
                                <td><?php echo $user['id'] ?></td>
                                <td><?php echo $user['username'] ?></td>
                                <td><?php echo $user['email'] ?></td>
                                <td><?php echo $user['first_name'] ?></td>
                                <td><?php echo $user['last_name'] ?></td>
                                <td><?php echo $user['ggroups'] ?></td>
                                <td><?php echo $user_status[$user['active']] ?></td>
                                <td>
                                    <?php if (!in_array('admin', explode(',', $user['ggroups']))) : ?>
                                        <a href="<?php echo site_url('admin/users/edit/' . $user['id']) ?>"><span class="badge bg-green"><?php echo lang('admin_edit');?></span></a>
                                        <a href="<?php echo site_url('admin/users/delete/' . $user['id']) ?>" onclick="return confirm('Are you sure?')"><span class="badge bg-red"><?php echo lang('admin_delete');?></span></a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="5"><?php echo lang('admin_no_record_found');?></td>
                        </tr>
                    <?php endif; ?>
                </table>
            </div><!-- /.box-body -->
            <div class="box-footer clearfix">
                <?php echo $pagination ?>
            </div>
        </div><!-- /.box -->
    </div>
</div>