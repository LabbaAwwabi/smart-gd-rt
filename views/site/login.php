<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\assets\LoginAsset;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
</head>
<body>
    
    <?php
    echo "<br><br><br>";
    ?>

    <div id="logon">
        <h1 class="row" style="margin:0">
            <div class="col-md-8 col-md-offset-2">
                <?= Html::img('@web/assets/images/smartgdtriot.png', ['alt'=>'logo', 'class'=>'img-responsive']);?>
            </div>
        </h1>

        <?php $form = ActiveForm::begin([
            'id' => 'login-form',
        ]); ?>
            <?= $form->field($model, 'username') ?>

            <?= $form->field($model, 'password')->passwordInput() ?>

            <?= Html::submitButton('Login', ['class' => 'btn btn-primary col-lg-offset-10 ', 'name' => 'login-button', ]) ?>

        <?php ActiveForm::end(); ?>
    </div>
</body>
</html>