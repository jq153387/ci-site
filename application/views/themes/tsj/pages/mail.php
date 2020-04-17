<dl class="contact">
    <dt>
        <h1>聯絡我們<i>/ Contact Us</i></h1>
    </dt>
    <dd class="contact-m"><img src="<?php echo $base_assets_url; ?>images/contact-us.gif" width="643" height="96">
        <form action="send-w.asp" method="post" name="send">
            <ul class="cont-list">
                <li>
                    <b>姓名</b><span id="sprytextfield1"><input name="name" type="text" id="name" size="60" autocomplete="off"><span class="textfieldRequiredMsg">必填</span></span></li>
                <li>
                    <b>電話</b><span id="sprytextfield2"><input name="tel" type="text" id="tel" size="60" autocomplete="off"></span></li>
                <li>
                    <b>行動電話</b><span id="sprytextfield3"><input name="phone" type="text" id="phone" size="60" autocomplete="off"><span class="textfieldRequiredMsg">必填</span></span></li>
                <li>
                    <b>信箱</b><span id="sprytextfield4"><input name="email" type="text" id="email" size="60" autocomplete="off"></span></li>
                <li>
                    <b>內容</b><span id="sprytextarea1"><textarea name="content1" id="content1" cols="80" rows="5" autocomplete="off"></textarea><span class="textareaRequiredMsg">&nbsp;&nbsp;必填</span></span></li>
                <li style="padding-left:70px;">
                    <img src="captcha.asp" alt="這是驗證碼" style="margin-right:10px;vertical-align:middle;"><input name="strCAPTCHA" type="text" size="10" style="background-color:#CCC">&nbsp;&nbsp;&nbsp;<span class="contact">請輸入左方的驗證碼(請注意大小寫)</span>&nbsp;&nbsp;<a href="#" onclick="window.location.href='mail.asp';">
                        <font color="#FF0000">換一個驗證碼</font>
                    </a></li>
            </ul>
            <div class="send"><input name="" type="submit" value="送出"><input name="type" type="hidden" value="contact"></div>
        </form>
    </dd>
</dl>