<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">求婚戒指 - 好友推薦</h3>
            </div><!-- /.box-header -->
            <div class="box-body">
                <?php echo form_open_multipart('comments/add'); ?>
                <?php echo $this->session->flashdata('message'); ?>
                <p><a class="btn btn-success" href="<?php echo site_url('admin/comments/add') ?>">新增留言</a></p>
                <table class="table table-bordered">
                    <tr>
                        <th style="width: 10px"></th>
                        <th style="width: 10px">#</th>
                        <th>留言內容</th>
                        <th>發布者</th>
                        <th>創建時間</th>
                        <th>顯示</th>
                        <th>ID</th>

                    </tr>
                    <?php if (!empty($comments)) : ?>
                        <?php foreach ($comments as $key => $item) : ?>
                            <tr>
                                <td>
                                    <a href="<?php echo site_url('admin/users/edit/' . $item['id']) ?>"><span class="badge bg-green"><?php echo lang('admin_edit'); ?></span></a>
                                    <a href="<?php echo site_url('admin/users/delete/' . $item['id']) ?>" onclick="return confirm('你確定要刪除嗎?')"><span class="badge bg-red"><?php echo lang('admin_delete'); ?></span></a>

                                </td>
                                <td><?php echo ($page_config['total_rows'] - $page_config['start']) - $key; ?></td>
                                <td><?php echo $item['content'] ?></td>
                                <td><?php echo $item['writer'] ?></td>
                                <td><?php echo $item['news_date'] ?></td>
                                <td><input type="checkbox" class="form-check-input">
                                    <input type="checkbox" onclick="displayComs()" <?php echo ($item['published']) ? "checked" : ""; ?> />
                                </td>
                                <td><?php echo $item['id'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="5"><?php echo lang('admin_no_record_found'); ?></td>
                        </tr>
                    <?php endif; ?>
                </table>
                </form>
            </div><!-- /.box-body -->
            <div class="box-footer clearfix">
                <?php echo $pagination ?>
            </div>
        </div><!-- /.box -->
    </div>
</div>