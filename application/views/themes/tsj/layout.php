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
  <title><?php echo $page_title ?> - <?php echo $site_title ?></title>
  <?php
  //if(!empty($home_page)):
  ?>
  <link href="<?php echo $base_assets_url; ?>css/ind.css" rel="stylesheet" type="text/css">
  <link href="<?php echo $base_assets_url; ?>css/pager.css" rel="stylesheet" type="text/css">
  <link href="<?php echo $base_assets_url; ?>css/colorbox.css" rel="stylesheet" type="text/css">
  <script src="<?php echo $base_assets_url; ?>js/swfobject.js" type="text/javascript"></script>
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
    <div id="main-wrapper">
      <?php echo $nav; ?>
      <div id="content-wrapper">
        <?php echo $content; ?>
      </div>
      <?php echo $nav_bot; ?>
    </div>
  </div>
  <?php echo $footer; ?>
  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="<?php echo $base_assets_url; ?>js/jquery.js"></script>
  <script src="<?php echo $base_assets_url; ?>js/jquery.colorbox.js" type="text/javascript"></script>
  <script src="<?php echo $base_assets_url; ?>js/color.js" type="text/javascript"></script>
  <script src="<?php echo $base_assets_url; ?>js/jquery.pager.js" type="text/javascript"></script>
  <script src="<?php echo $base_assets_url; ?>js/jq-product.js" type="text/javascript"></script>
  <script src="<?php echo $base_assets_url; ?>js/main.js" type="text/javascript"></script>
  <?php if (isset($slug)) : ?>
    <?php if ($slug) : ?>
      <script type="text/javascript">
        ablum_init(<?php echo $slug; ?>);
      </script>
    <?php endif; ?>
  <?php endif; ?>

</html>