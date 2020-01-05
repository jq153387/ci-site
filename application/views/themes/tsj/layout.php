<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="新人婚戒第一品牌 專屬訂製求婚鑽戒,結婚對戒,幸福婚戒" />
  <meta name="keywords" content="鑽石,婚戒,GIA,彩鑽,1克拉,求婚戒,鑽石價格,戒指,克拉,鑽戒">
  <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title><?php echo $page_title ?> - CI Blog</title>
  <?php //if(!empty($home_page)):?>
  <link href="<?php echo $base_assets_url; ?>css/ind.css" rel="stylesheet" type="text/css">
  <?php //else:?>
  <!-- Main Css -->
  <!-- <link href="<?php //echo $base_assets_url; ?>css/style.css" rel="stylesheet" type="text/css"> -->
  <?php //endif;?>
  <script src="<?php echo $base_assets_url; ?>js/swfobject.js" type="text/javascript"></script>
  <script src="http://static.ak.fbcdn.net/connect.php/js/FB.Share" type="text/javascript"></script>
  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
  <div id="outer-wrapper">
    <?php echo $header; ?>
    <?php echo $nav; ?>
    <div id="flash-wrapper">
      <div class="fb-share">
        <a name="fb_share" type="button" share_url="http://www.tsj-diamond.com/" href="http://www.facebook.com/sharer.php">分享TSJ鑽石工場</a>
      </div>
      <div id="iflash2"><img src="<?php echo $base_assets_url; ?>images/ind_12.gif"></div>
      <script type="text/javascript">
        var flashvars = {};
        var params = {};
        params.menu = "false";
        params.wmode = "transparent";
        params.bgcolor = "#CCCCCC";
        params.allowfullscreen = "true";
        params.allowscriptaccess = "always";
        var attributes = {};
        attributes.id = "iflash2";
        attributes.name = "iflash2";
        swfobject.embedSWF("swf/ind-ban1.swf", "iflash2", "840", "325", "10.0.2", "false", flashvars, params, attributes);
      </script>
    </div>
    <section>
      <!--#include file="dw-menu.html" -->
    </section>

  </div>
  <?php echo $footer; ?>
  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="<?php echo $base_assets_url; ?>js/jquery.js"></script>

</html>