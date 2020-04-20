<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<dl class="contact">
    <dt>
        <h1>聯絡我們<i>/ Contact Us</i></h1>
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
        <img src="<?php echo $base_assets_url; ?>images/contact-us.gif" width="643" height="96">

        <?php echo form_open('pages/sendmail'); ?>
        <ul class="cont-list">
            <li>
                <b><span style="color:red;">*</span> 姓名</b>
                <input name="username" type="text" id="username" size="60" autocomplete="off">
                <div class="from_error"><?php echo form_error('username'); ?></div>
            </li>
            <li>
                <b>電話</b>
                <input name="tel" type="text" id="tel" size="60" autocomplete="off">
            </li>
            <li>
                <b><span style="color:red;">*</span> 行動電話</b>
                <input name="phone" type="text" id="phone" size="60" autocomplete="off">
                <div class="from_error"><?php echo form_error('phone'); ?></div>
            </li>
            <li>
                <b><span style="color:red;">*</span> 信箱</b>
                <input name="email" type="text" id="email" size="60" autocomplete="off">
                <div class="from_error"><?php echo form_error('email'); ?></div>
            </li>
            <li>
                <b>內容</b>
                <textarea style="margin-top:10px;" name="content" id="content" cols="80" rows="5" autocomplete="off"></textarea>
            </li>
            <li>
                <b>驗證碼</b>
                <div style="padding: 10px 0px" class="g-recaptcha" data-sitekey="6Lf5O-sUAAAAAKtGSE1uSfCGP1PUwZVIa6u_qo3y"></div>
            </li>
        </ul>
        <div class="send"><button style="padding:3px 15px;">送出</button></div>
        </form>
    </dd>
</dl>