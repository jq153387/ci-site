<div class="row">
    <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">設定</h3>
            </div><!-- /.box-header -->
            <!-- form start -->
            <?php echo form_open_multipart('admin/settings/'); ?>
            <div class="box-body">
                <?php echo $this->session->flashdata('message'); ?>
                <?php echo validation_errors(); ?>
                <?php if (!empty($settings)) : ?>
                    <?php foreach ($settings as $setting) : ?>
                        <?php if ($setting['key'] == "email_contact") : ?>
                            <div class="form-group">
                                <label for="category_name">email通知</label>
                                <input type="text" required="required" name="settings[<?php echo $setting['key'] ?>]" class="form-control" placeholder="<?php echo $setting['key'] ?>" value="<?php echo set_value('settings[]', isset($setting['value']) ? $setting['value'] : '') ?>">
                                <p style="padding: 5px;">* 設定接受者 E-mail 位址. 可以是單一郵件，或是以","逗號分隔名單</p>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div><!-- /.box-body -->

            <div class="box-footer">
                <button type="submit" class="btn btn-primary">確認</button>
                <button type="button" class="btn btn-default" onclick="javascript:history.back()">取消</button>
            </div>
            </form>
        </div><!-- /.box -->
    </div>
</div>