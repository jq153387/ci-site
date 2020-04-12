<div class="row">
    <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title"><?php echo lang('admin_edit_user');?></h3>
            </div><!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="<?php echo site_url('admin/users/edit') ?>" method="post">
                <input type="hidden" name="id" value="<?php echo $user['id'] ?>">
                <div class="box-body">
                    <?php echo $this->session->flashdata('message'); ?>
                    <?php echo validation_errors(); ?>
                    <div class="form-group">
                        <label for="username"><?php echo lang('admin_username');?></label>
                        <input type="text" readonly="readonly" name="username" class="form-control" id="username" placeholder="Username" value="<?php echo set_value('username', isset($user['username']) ? $user['username'] : '') ?>">
                    </div>
                    <div class="form-group">
                        <label for="username"><?php echo lang('admin_email');?></label>
                        <input type="text" readonly="readonly" name="email" class="form-control" id="username" placeholder="Username" value="<?php echo set_value('email', isset($user['email']) ? $user['email'] : '') ?>">
                    </div>
                    <div class="form-group">
                        <label for="username"><?php echo lang('admin_new_passowrd');?></label>
                        <input type="password" name="password" class="form-control" id="username" placeholder="New Password" value="">
                    </div>
                    <div class="form-group">
                        <label for="username"><?php echo lang('admin_confirm_password');?></label>
                        <input type="password" name="confirm_password" class="form-control" id="username" placeholder="Confirm Password" value="">
                    </div>
                    <div class="form-group">
                        <label for="username"><?php echo lang('admin_first_name');?></label>
                        <input type="text" name="first_name" class="form-control" id="username" placeholder="First name" value="<?php echo set_value('first_name', isset($user['first_name']) ? $user['first_name'] : '') ?>">
                    </div>
                    <div class="form-group">
                        <label for="username"><?php echo lang('admin_last_name');?></label>
                        <input type="text" name="last_name" class="form-control" id="username" placeholder="Last name" value="<?php echo set_value('last_name', isset($user['last_name']) ? $user['last_name'] : '') ?>">
                    </div>
                    <div class="form-group">
                        <label for="username"><?php echo lang('admin_company');?></label>
                        <input type="text" name="company" class="form-control" id="username" placeholder="Company" value="<?php echo set_value('company', isset($user['company']) ? $user['company'] : '') ?>">
                    </div>
                    <div class="form-group">
                        <label for="username"><?php echo lang('admin_phone');?></label>
                        <input type="text" name="phone" class="form-control" id="username" placeholder="Phone" value="<?php echo set_value('phone', isset($user['phone']) ? $user['phone'] : '') ?>">
                    </div>
                    <div class="form-group">
                        <label for="category_active"><?php echo lang('admin_groups');?></label>
                        <?php
                        echo form_dropdown('groups[]', $groups, explode(',', $user['group_ids']), array('class' => 'form-control', 'multiple' => true));
                        ?>
                    </div>
                    <div class="form-group">
                        <label for="category_active"><?php echo lang('admin_status');?></label>
                        <?php
                        echo form_dropdown('active', $user_status, isset($user['active']) ? $user['active'] : '', array('class' => 'form-control'));
                        ?>
                    </div>
                </div><!-- /.box-body -->

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary"><?php echo lang('admin_submit');?></button> 
                    <button type="button" class="btn btn-default" onclick="javascript:history.back()"><?php echo lang('admin_back');?></button>
                </div>
            </form>
        </div><!-- /.box -->
    </div>
</div>