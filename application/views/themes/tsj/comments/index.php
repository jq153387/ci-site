<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<dl class="guest">
    <dt>
        <h1>求婚戒指 - 好友推薦<i>/ Friends Introduced</i></h1>
    </dt>
    <dd class="contact-m">
        <?php if ($this->session->flashdata('error')) : ?>
            <div class="alert alert-danger"><strong><?= $this->session->flashdata('error') ?></strong></div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>
        <?php if ($this->session->flashdata('message')) : ?>
            <div class="alert alert-success"><strong><?= $this->session->flashdata('message') ?></strong></div>
            <?php unset($_SESSION['message']); ?>
        <?php endif; ?>
        <?php echo form_open_multipart('comments/add'); ?>
        <ul class="cont-list" style="width:650px">
            <li>
                <b><span style="color:red;">*</span> 暱稱</b>
                <input name="username" type="text" id="username" size="30" value="<?php echo set_value('username'); ?>">
                <div class="from_error"><?php echo form_error('username'); ?></div>
            </li>
            <li>
                <b><span style="color:red;">*</span> 信箱</b>
                <input name="email" type="text" id="email" size="30" value="<?php echo set_value('email'); ?>">
                <div class="from_error"><?php echo form_error('email'); ?></div>
            </li>
            <li>
                <b>內容</b><textarea name="content" cols="80" rows="5"></textarea>
            </li>
            <li>
                <b>上傳圖片</b>
                <input name="file" type="file" id="image_id">
            </li>
            <li>
                <b>驗證碼</b>
                <div style="padding: 10px 0px" class="g-recaptcha" data-sitekey="6Lf5O-sUAAAAAKtGSE1uSfCGP1PUwZVIa6u_qo3y"></div>
            </li>
        </ul>
        <div class="send"><button style="padding:3px 15px;cursor:pointer;">發表</button></div>
        <!-- <input type="hidden" name="mail" value="tsj4c@ms59.hinet.net;huang19711127@gmail.com;tim@otaku66.com;wenwen0212@gmail.com"> -->
        <input type="hidden" name="page" value="<?php echo $page_config['page']; ?>">
        </form>
    </dd>
    <!--body-->
    <?php foreach ($comments as $key => $item) : ?>
        <dd style="padding-top:10px; padding-left:80px; padding-bottom:18px">
            <table width="656" border="0" cellpadding="0" cellspacing="0">
                <tbody>
                    <tr>
                        <td colspan="3" valign="top" bgcolor="#e7e7e7"><img src="<?php echo $base_assets_url; ?>images/book-tb_01.gif"></td>
                    </tr>
                    <tr>
                        <td width="17" bgcolor="#e7e7e7">&nbsp;</td>
                        <td width="625" height="25" valign="top" bgcolor="#e7e7e7">
                            <font color="#36052E"><?php echo $item['writer'] ?><span style="font-size:8pt;"> ～ 第<span face="Tahoma, Verdana, Arial"><?php echo ($page_config['total_rows'] - $page_config['start']) - $key; ?></span>篇～</span>

                        </td>
                        <td width="14" valign="top" bgcolor="#e7e7e7">&nbsp;</td>
                    </tr>
                    <tr>
                        <td width="17" bgcolor="#e7e7e7"></td>
                        <td bgcolor="#e7e7e7">
                            <hr size="1" noshade="" color="#d8d7d7">
                            <table width="100%" border="0" cellpadding="3" cellspacing="0" class="g-table">
                                <tbody>
                                    <tr>
                                        <td width="54%" valign="top" bgcolor="#e7e7e7" class="g-font">
                                            <?php echo $item['content'] ?>
                                        </td>

                                        <?php if (!empty($item['photo'])) : ?>
                                            <td width="43%" valign="top" bgcolor="#e7e7e7">
                                                <div style="padding: 10px">
                                                    <?php foreach ($item['photo'] as $key => $comments_photo) : ?>
                                                        <img src="/assets/uploads/<?php echo $comments_photo['url']; ?>" width="240" style="margin-bottom:10px;">
                                                    <?php endforeach; ?>
                                                </div>
                                            </td>
                                        <?php endif; ?>
                                    </tr>
                                    <tr>
                                        <td colspan="2" bgcolor="#e7e7e7" class="g-date"><?php echo $item['news_date']; ?></td>
                                    </tr>
                                </tbody>
                            </table>

                            <?php foreach ($item['comments_review'] as $key2 => $review) : ?>
                                <hr size="1" noshade="" color="#d8d7d7">

                                <table width="100%" border="0" cellpadding="3" cellspacing="0">
                                    <tbody>
                                        <tr>
                                            <td width="3%" rowspan="2" bgcolor="#e7e7e7">&nbsp;
                                            </td>
                                            <td bgcolor="#e7e7e7" width="55%" valign="top"><br>
                                                <p style="margin-top:8px;color:black;" class="g-font">
                                                    <?php echo $review['writer']; ?>
                                                </p>
                                                <p style="margin-top:8px;color:black;" class="g-font">
                                                    <?php echo $review['content']; ?>
                                                </p>
                                            </td>
                                            <?php if (!empty($review['photo'])) : ?>
                                                <td width="43%" valign="top" bgcolor="#e7e7e7">
                                                    <div style="padding: 10px">
                                                        <?php foreach ($review['photo'] as $key => $comments_photo) : ?>
                                                            <img src="/assets/uploads/<?php echo $comments_photo['url']; ?>" width="240" style="margin-bottom:10px;">
                                                        <?php endforeach; ?>
                                                    </div>
                                                </td>
                                            <?php endif; ?>
                                        </tr>
                                        <tr>
                                            <td align="right" valign="bottom" bgcolor="#e7e7e7" class="g-date"><?php echo $review['news_date']; ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            <?php endforeach; ?>
                            <hr size="1" noshade="" color="#d8d7d7">

                        </td>
                        <td bgcolor="#e7e7e7">&nbsp;</td>
                    </tr>
                    <tr bgcolor="#e7e7e7">
                        <td colspan="3" valign="top">
                            <form class="review-repo" id="review-re-<?php echo $item["id"]; ?>">
                                <div class="alert alert-danger print-error-msg" style="display: none"></div>
                                <input name="review_name" type="text" value="" placeholder="暱稱" style="width: 80px" />
                                <input name="review_mail" type="text" value="" placeholder="信箱" />
                                <div style="padding-top: 10px; ">
                                    <textarea name="review_message" placeholder="留言....." style="width:100%; height:100%; box-sizing:border-box;"></textarea>
                                </div>
                                <div style="padding-top: 10px; ">
                                    <input name="id" type="hidden" value="<?php echo $item['id'] ?>" />
                                    <button style="padding:3px 15px;cursor:pointer;" onclick="postReview(event,<?php echo $item['id'] ?>)">回覆</button>
                                </div>
                            </form>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" valign="top"><img src="<?php echo $base_assets_url; ?>images/book-tb_03.gif"></td>
                    </tr>
                </tbody>
            </table>
        </dd>
    <?php endforeach; ?>
    <!-- footer-->
    <dd>
        <div class="page-w">
            <?php echo $pagination; ?>
        </div>
    </dd>
</dl>