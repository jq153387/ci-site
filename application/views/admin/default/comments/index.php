<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">求婚戒指 - 好友推薦</h3>
            </div><!-- /.box-header -->
            <div class="box-body">
                <?php echo form_open_multipart('admin/comments/add'); ?>
                <?php echo $this->session->flashdata('message'); ?>
                <p><a onclick='editFordata({})' class="btn btn-success" href="#">新增</a></p>
                <table class="table table-bordered">
                    <tr>

                        <th style="width: 10px">#</th>
                        <th style="width: 700px">推薦內容</th>
                        <th>留言數量</th>
                        <th>發布者</th>
                        <th>創建時間</th>
                        <th>顯示狀態</th>
                        <!-- <th>ID</th> -->
                        <th style="width: 10px"></th>

                    </tr>
                    <?php if (!empty($comments)) : ?>
                        <?php foreach ($comments as $key => $item) : ?>
                            <tr data-id="<?php echo $item['id'] ?>">

                                <td><?php echo ($page_config['total_rows'] - $page_config['start']) - $key; ?></td>
                                <td><?php echo $item['content'] ?></td>
                                <td><?php echo $item['review_count'] ?></td>
                                <td><?php echo $item['writer'] ?></td>
                                <td><?php echo $item['news_date'] ?></td>
                                <td>
                                    <input data-id="<?php echo $item['id'] ?>" class="discomm-check" type="checkbox" <?php echo ($item['published']) ? "checked" : ""; ?> />
                                </td>
                                <!-- <td><?php //echo $item['id'] 
                                            ?></td> -->
                                <td>
                                    <a href="<?php echo site_url('admin/comments/edit/' . $item['id']) ?>"><span class="badge bg-green"><?php echo lang('admin_edit'); ?></span></a>
                                    <a href="<?php echo site_url('admin/comments/delete/' . $item['id'] . "-" . $page_config['page']) ?>" onclick="return confirm('你確定要刪除嗎?')"><span class="badge bg-red"><?php echo lang('admin_delete'); ?></span></a>

                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="5"><?php echo lang('admin_no_record_found'); ?></td>
                        </tr>
                    <?php endif; ?>
                </table>
                <!-- Modal -->
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4></h4>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label><span style="color:red;">*</span>&nbsp;作者</label>
                                    <input name="writer" type="text" class="form-control" id="writer">
                                </div>
                                <div class="form-group">
                                    <label>內容</label>
                                    <textarea name="content" class="form-control" rows="3" id="c-content"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>狀態</label>
                                    <select name="published">
                                        <option value="1">顯示</option>
                                        <option value="0">隱藏</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>上傳圖片</label>
                                    <input type="file" id="file" name="file" accept=".jpg,.gif,.png">
                                    <p class="help-block">支援圖片格式.jpg .png .gif</p>
                                </div>
                                <input type="hidden" id="id" name="id">
                                <input type="hidden" id="comment_id" name="comment_id" value="<?php echo $page_config['page'] ?>">
                                <input type="hidden" id="class_id" name="class_id" value="">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                                <button type="submit" class="btn btn-primary">儲存</button>
                            </div>
                        </div>
                    </div>
                </div>
                </form>
            </div><!-- /.box-body -->
            <div class="box-footer clearfix">
                <?php echo $pagination ?>
            </div>
        </div><!-- /.box -->
    </div>
</div>