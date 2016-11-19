<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Pelanggan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pelanggan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'kode_registrasi')->textInput(['maxlength' => true, 'readonly' => !$model->isNewRecord]) ?>

    <?= $form->field($model, 'langganan')->textInput() ?>

    <?= $form->field($model, 'v')->textInput() ?>

    <?= $form->field($model, 'i')->textInput() ?>

    <?= $form->field($model, 'p')->textInput() ?>

    <?= $form->field($model, 'phasa')->dropDownList($model->phasaList) ?>    

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
