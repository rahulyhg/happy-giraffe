<?php
/**
 * @var PersonalAreaController $this
 */
?><!DOCTYPE html><!--[if lt IE 10]>     <html class="no-js lt-ie10"> <![endif]-->
<!--[if gt IE 10]><!--> <html class="no-js "> <!--<![endif]-->
 <head>
        <meta charset="utf-8" />
        <meta http-equiv="x-ua-compatible" content="ie=edge" />
        <title><?=$this->pageTitle?></title>
        <meta content="" name="description" />
        <meta content="" name="keywords" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta content="telephone=no" name="format-detection" />
        <meta name="HandheldFriendly" content="true" />

        <!--[if (gt IE 9)|!(IE)]><!-->
        <!-- <link href="static/css/main.min.css" rel="stylesheet" type="text/css"> -->
        <!--<![endif]-->
        <meta property="og:title" content="Happy Girafe" />
        <meta property="og:title" content="" />
        <meta property="og:url" content="" />
        <meta property="og:description" content="" />
        <meta property="og:image" content="" />
        <meta property="og:image:type" content="image/jpeg" />
        <meta property="og:image:width" content="500" />
        <meta property="og:image:height" content="300" />
        <meta property="twitter:description" content="" />
        <link rel="image_src" href="" />
        <link rel="icon" type="image/x-icon" href="/favicon.bmp" />
        <script>
            (function(H){H.className=H.className.replace(/\bno-js\b/,'js')})(document.documentElement)
        </script>
    </head>
     <body class="page--bg">
        <div class="js-overlay-menu overlay-menu"></div>
        <div class="js-overlay-user overlay-user"></div>
        <?php Yii::app()->ads->showCounters(); ?>
        <div class="b-layout b-container b-container--white b-container--style">
        	<?php //Yii::app()->ads->showCounters(); ?>
        	<?php if (Yii::app()->user->checkAccess('editMeta')):?>
                <a id="btn-seo" href="/ajax/editMeta/?route=<?=urlencode(Yii::app()->controller->route) ?>&params=<?=urlencode(serialize(Yii::app()->controller->actionParams)) ?>" class="fancy" data-theme="white-square"></a>
            <?php endif ?>
                <?php $this->renderPartial('//_alerts'); ?>

                    <?= $content ?>
            <div class="popup-container display-n">
            </div>
            <!--[if lt IE 9]> <script type="text/javascript" src="/lite/javascript/respond.min.js"></script> <![endif]-->
        </div>
    </body>
</html>
