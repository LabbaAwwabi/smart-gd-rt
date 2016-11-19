<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Phasa */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="phasa-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'gardu')->dropDownList($model->garduList) ?>

    <?= $form->field($model, 'v')->textInput() ?>

    <?php if(!$model->isNewRecord) { ?>
        <?= $form->field($model, 'i')->textInput() ?>
    <?php } ?>

    <?= $form->field($model, 'phasa_type')->dropDownList($model->phasaTypeList) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
