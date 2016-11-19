<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use app\assets\AppAsset;
use yii\bootstrap\Nav;
use yii\helpers\Url;

AppAsset::register($this);

$page_id = Yii::$app->controller->id;

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div class="fixed-header left-menu hide-side-menu">
    <div class="page_header">
        <div class="header-links hidden-xs">
            <div class="dropdown hidden-sm hidden-xs">
                <a href="<?= Yii::$app->urlManager->createUrl("site/logout") ?>" data-method="post" data-toggle="dropdown" class="header-link"><i class="fa fa-power-off"></i> Logout </a>
            </div>
        </div>
        <a class="current logo hidden-xs" href="<?=Yii::$app->urlManager->createUrl('site/')?>">
            <?= Html::img('@web/assets/images/launcher.png', ['alt'=>'logo', 'class'=>'img-responsive', 'style'=>'padding:10px']);?>
        </a>
        <h1>Smart-GD Management</h1>
    </div>
    <div class="side">
        <div class="sidebar-wrapper">
            <ul>
                <li class="<?php echo ($page_id === "gardu") ? "current" : ""; ?>" >
                    <a href="<?php echo Yii::$app->urlManager->createUrl('gardu/'); ?>" class="current" data-toggle="tooltip" data-placement="right" title="" data-original-title="Gardu Management">
                        <i class="fa fa-cube"></i>
                    </a>
                </li>
                <li class="<?php echo ($page_id === "phasa") ? "current" : ""; ?>" >
                    <a href="<?php echo Yii::$app->urlManager->createUrl('phasa/'); ?>" class="current" data-toggle="tooltip" data-placement="right" title="" data-original-title="Phasa Management">
                        <i class="fa fa-bolt"></i>
                    </a>
                </li>
                <li class="<?php echo ($page_id === "pelanggan") ? "current" : ""; ?>" >
                    <a href="<?php echo Yii::$app->urlManager->createUrl('pelanggan/'); ?>" class="current" data-toggle="tooltip" data-placement="right" title="" data-original-title="Pelanggan Management">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li class="<?php echo ($page_id === "record") ? "current" : ""; ?>" >
                    <a href="<?php echo Yii::$app->urlManager->createUrl('record/'); ?>" class="current" data-toggle="tooltip" data-placement="right" title="" data-original-title="Record Management">
                        <i class="fa fa-line-chart"></i>
                    </a>
                </li>
                <li class="<?php echo ($page_id === "user") ? "current" : ""; ?>" >
                    <a href="<?php echo Yii::$app->urlManager->createUrl('user/'); ?>" class="current" data-toggle="tooltip" data-placement="right" title="" data-original-title="User Management">
                        <i class="fa fa-users"></i>
                    </a>
                </li>
                <li class="<?php echo ($page_id === "log") ? "current" : ""; ?>" >
                    <a href="<?php echo Yii::$app->urlManager->createUrl('log/'); ?>" class="current" data-toggle="tooltip" data-placement="right" title="" data-original-title="Log Management">
                        <i class="fa fa-file-text-o"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="container main-content">
    <?= $content ?>
</div>
    
    <!-- <div class="page-footer">
        © 2013 Saturn Admin Template.
    </div>
 -->


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
