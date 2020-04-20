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
                <b>暱稱</b><input name="username" type="text" id="username" size="30" value="<?php echo set_value('username'); ?>">
                <div class="from_error"><?php echo form_error('username'); ?></div>
            </li>
            <li>
                <b>信箱</b><input name="email" type="text" id="email" size="30" value="<?php echo set_value('email'); ?>">
                <div class="from_error"><?php echo form_error('email'); ?></div>
            </li>
            <li>
                <b>內容</b><textarea name="content" cols="80" rows="5"></textarea>
            </li>
            <li><b>上傳圖片</b>
                <input name="file" type="file" id="image_id">
            </li>
            <li>
                <b>驗證碼</b>
                <div style="padding: 10px 0px" class="g-recaptcha" data-sitekey="6Lf5O-sUAAAAAKtGSE1uSfCGP1PUwZVIa6u_qo3y"></div>
            </li>
        </ul>
        <div class="send"><button style="padding:3px 15px;">發表</button></div>
        <input type="hidden" name="mail" value="tsj4c@ms59.hinet.net;huang19711127@gmail.com;tim@otaku66.com;wenwen0212@gmail.com">
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
                            </font>&nbsp;&nbsp;&nbsp;&nbsp;<input type="image" name="send" src="<?php echo $base_assets_url; ?>img/res.gif" border="0" alt="回覆留言" onclick="window.location.href='reply.asp?cid=400'">
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
                    <tr>
                        <td colspan="3" valign="top"><img src="<?php echo $base_assets_url; ?>images/book-tb_03.gif"></td>
                    </tr>
                </tbody>
            </table>
        </dd>
    <?php endforeach; ?>
    <!-- footer-->
    <dd>
        <!--table width="500" border="0" class="new_table" cellpadding="0" cellspacing="5">
            <tbody>
                <tr>
                    <td width="8%" valign="middle">
                        <a href="guestbook.asp?page=1"><img src="<?php echo $base_assets_url; ?>images/btn1.gif" name="Image26" width="38" height="23" border="0" id="Image26"></a></td>
                    <td width="6%" valign="middle">
                        <a href="guestbook.asp?page=1"><img src="<?php echo $base_assets_url; ?>images/btn2.gif" name="Image27" width="27" height="23" border="0" id="Image27"></a></td>
                    <td width="70%" align="center" valign="middle" class="cont-font"><span>&nbsp;1</span><a href="guestbook.asp?page=2">&nbsp;&nbsp;2</a><a href="guestbook.asp?page=3">&nbsp;&nbsp;3</a><a href="guestbook.asp?page=4">&nbsp;&nbsp;4</a><a href="guestbook.asp?page=5">&nbsp;&nbsp;5</a><a href="guestbook.asp?page=6">&nbsp;&nbsp;6</a><a href="guestbook.asp?page=7">&nbsp;&nbsp;7</a><a href="guestbook.asp?page=8">&nbsp;&nbsp;8</a></td>
                    <td width="6%" valign="middle">
                        <a href="guestbook.asp?page=2"><img src="<?php echo $base_assets_url; ?>images/btn3.gif" name="Image28" width="28" height="23" border="0" id="Image28"></a></td>
                    <td width="10%" valign="middle">
                        <a href="guestbook.asp?page=8"><img src="<?php echo $base_assets_url; ?>images/btn4.gif" name="Image29" width="39" height="23" border="0" id="Image29"></a></td>
                </tr>
            </tbody>
        </table-->
        <div class="page-w">
            <?php echo $pagination; ?>
        </div>
        <style>
            .page-w {
                padding: 15px 0;
                display: flex;
                justify-content: center;
            }

            .pagination {
                display: inline-block;
                list-style-type: none;
            }

            .pagination li {
                float: left;
                margin: 0 5px;
            }

            .pagination li a {
                color: black;
                padding: 4px 8px;
                text-decoration: none;
                color: white;
                display: block;
            }

            .pagination li.active a {
                background-color: #8a0f22;
                color: white;
            }

            .pagination li:hover:not(.active) {
                background-color: #ddd;
            }

            .pagination li:hover:not(.active) a {
                color: black;
            }
        </style>
    </dd>
</dl>