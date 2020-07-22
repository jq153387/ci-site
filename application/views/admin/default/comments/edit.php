<style>
    .panel-pic {
        display: flex;
    }

    .panel-content {
        margin-bottom: 15px;
        ;
    }

    picture {
        position: relative;
        margin-bottom: 20px;
    }

    .alert {
        margin-left: 0;
    }

    picture .pic-delete .bg-red {
        position: absolute;
        top: 0px;
        right: 0px;
        padding: 4px;
        border-radius: 100px;
        width: 25px;
        height: 25px;
        text-align: center;
    }

    .editer {
        float: right;
    }
</style>
<div class="row">
    <div class="col-md-12">
        <?php echo form_open_multipart('admin/comments/add'); ?>
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">求婚戒指 - 好友推薦</h3>
            </div><!-- /.box-header -->
            <div class="box-body">

                <?php if ($this->session->flashdata('error')) : ?>
                    <div class="alert alert-danger"><strong><?= $this->session->flashdata('error') ?></strong></div>
                    <?php unset($_SESSION['error']); ?>
                <?php endif; ?>
                <?php if ($this->session->flashdata('message')) : ?>
                    <div class="alert alert-success"><strong><?= $this->session->flashdata('message') ?></strong></div>
                    <?php unset($_SESSION['message']); ?>
                <?php endif; ?>
                <p><a class="btn btn-default" href="<?php echo site_url('admin/comments')
                                                    ?>"><i class="glyphicon glyphicon-chevron-left"></i> 返回</a></p>
                <h3>推薦</h3>
                <div class="comment">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">作者：<?php echo $comment['writer']; ?> 發佈時間：<?php echo $comment['news_date']; ?>
                                <div class="editer">
                                    狀態：<?php echo ($comment['published'] == "1") ? "<i class='glyphicon glyphicon-eye-open'></i>" : "<i class='glyphicon glyphicon-eye-close'></i>"; ?>&nbsp;&nbsp;
                                    <a href="#" onclick='editFordata(<?php echo json_encode($comment); ?>)'><span class="badge bg-green"><?php echo lang('admin_edit'); ?></span></a>
                                    <a href="<?php echo site_url('admin/comments/delete_edit/' . $comment['id'] . "-" . $comment['id']) ?>" onclick="return confirm('你確定要刪除嗎?')"><span class="badge bg-red"><?php echo lang('admin_delete'); ?></span></a>
                                </div>
                            </h3>


                        </div>

                        <div class="panel-body">
                            <div class="panel-pic">
                                <?php foreach ($comment['photo'] as $key => $photo) : ?>
                                    <picture style="padding: 10px;">
                                        <img class="img-thumbnail" style="width: 200px;" src="<?php echo site_url('assets/uploads/' . $photo['url']); ?>" />
                                        <div class="pic-delete">
                                            <a href="<?php echo site_url('admin/comments/delete_photo?id=' . $photo['id'] . "&name=" . $photo['url'] . "&parent_id=" . $comment['id']) ?>" onclick="return confirm('你確定要刪除嗎?')"><span class="bg-red"><i class="glyphicon glyphicon-remove"></i></span></a>
                                        </div>
                                    </picture>
                                <?php endforeach; ?>
                            </div>

                            <div class="panel-content"><?php echo $comment['content']; ?></div>
                        </div>


                    </div>
                </div>

                <h3>留言 <a href="#" onclick='editFordata({})'><span class="badge bg-green">回覆</span></a></h3>
                <div>
                    <?php foreach ($comment['review'] as $key => $item) : ?>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">作者：<?php echo $item['writer'] ?> 發佈時間：<?php echo $item['news_date'] ?>
                                    <div class="editer">
                                        狀態：<?php echo ($item['published'] == "1") ? "<i class='glyphicon glyphicon-eye-open'></i>" : "<i class='glyphicon glyphicon-eye-close'></i>"; ?>&nbsp;&nbsp;
                                        <a href="#" onclick='editFordata(<?php echo json_encode($item); ?>)'>
                                            <span class="badge bg-green"><?php echo lang('admin_edit'); ?></span>
                                        </a>
                                        <a href="<?php echo site_url('admin/comments/delete_edit/' . $item['id'] . "-" . $comment['id']) ?>" onclick="return confirm('你確定要刪除嗎?')"><span class="badge bg-red"><?php echo lang('admin_delete'); ?></span></a>
                                    </div>
                                </h3>
                            </div>

                            <div class="panel-body">
                                <div class="panel-pic">
                                    <?php foreach ($item['photo'] as $key => $photo) : ?>
                                        <picture style="padding: 10px;">
                                            <img class="img-thumbnail" style="width: 200px;" src="<?php echo site_url('assets/uploads/' . $photo['url']); ?>" />
                                            <div class="pic-delete">
                                                <a href="<?php echo site_url('admin/comments/delete_photo?id=' . $photo['id'] . "&name=" . $photo['url'] . "&parent_id=" . $comment['id']) ?>" onclick="return confirm('你確定要刪除嗎?')"><span class="bg-red"><i class="glyphicon glyphicon-remove"></i></span></a>
                                            </div>
                                        </picture>
                                    <?php endforeach; ?>
                                </div>
                                <div class="panel-content"><?php echo $item['content'] ?></div>

                            </div>
                        </div>
                </div>
            <?php endforeach; ?>
            </div>



            <!-- Button trigger modal -->
            <!-- <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
                Launch demo modal
            </button> -->

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
                            <input type="hidden" id="id" name="id" />
                            <input type="hidden" id="comment_id" name="comment_id" value="<?php echo $comment['id'] ?>" />
                            <input type="hidden" id="class_id" name="class_id" value="<?php echo $comment['id'] ?>" />
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                            <button type="submit" class="btn btn-primary">儲存</button>
                        </div>
                    </div>
                </div>
            </div>

        </div><!-- /.box-body -->

        </form>
    </div><!-- /.box -->

</div>