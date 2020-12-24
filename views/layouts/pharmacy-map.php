<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\assets\AppAsset;
use app\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage()?>
<!DOCTYPE html>
<html lang="<?=Yii::$app->language?>">
<head>

<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-5MWV7HX');</script>
<!-- End Google Tag Manager -->

    <meta charset="<?=Yii::$app->charset?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta property="og:description" content="健保特約藥局口罩地圖">
    <meta name="description" content="my-lab ddns 健保特約藥局口罩地圖">
    <?php $this->registerCsrfMetaTags()?>
    <title>口罩地圖</title>
    <?php $this->head()?>
</head>
<style>
.pin2 {
  position: absolute;
  top: 40%;
  left: 50%;
  margin-left: 115px;

  border-radius: 50%;
  border: 8px solid #fff;
  width: 8px;
  height: 8px;
}

.pin2::after {
  position: absolute;
  content: '';
  width: 0px;
  height: 0px;
  bottom: -30px;
  left: -6px;
  border: 10px solid transparent;
  border-top: 17px solid #fff;
}
</style>
<body>

<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5MWV7HX"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<?php $this->beginBody()?>

<div class="wrap">
    <div>
        <?=Alert::widget()?>
        <?=$content?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-right"><?=Yii::powered()?></p>
    </div>
</footer>

<?php $this->endBody()?>
</body>
</html>
<?php $this->endPage()?>
