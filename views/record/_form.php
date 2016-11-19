<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RecordPhasa */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="record-phasa-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'phasa')->dropDownList($model->phasaList) ?>

    <?= $form->field($model, 'v')->textInput() ?>

    <?= $form->field($model, 'i')->textInput() ?>

    <?= $form->field($model, 'p')->textInput() ?>

    <?= $form->field($model, 'loses')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
