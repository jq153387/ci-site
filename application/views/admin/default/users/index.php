<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">使用者</h3>
            </div><!-- /.box-header -->
            <div class="box-body">
                <?php echo $this->session->flashdata('message'); ?>
                <p><a class="btn btn-default" href="<?php echo site_url('admin/users/add') ?>">New User</a></p>
                <table class="table table-bordered">
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>使用者名稱</th>
                        <th>Email</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>群組</th>
                        <th>狀態</th>
                        <th style="width: 100px">編輯</th>
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
                                    <?php //if (!in_array('admin', explode(',', $user['ggroups']))) : 
                                    ?>
                                    <a href="<?php echo site_url('admin/users/edit/' . $user['id']) ?>"><span class="badge bg-green">edit</span></a>
                                    <a href="<?php echo site_url('admin/users/delete/' . $user['id']) ?>" onclick="return confirm('Are you sure?')"><span class="badge bg-red">delete</span></a>
                                    <?php //endif; 
                                    ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="5">No record found</td>
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