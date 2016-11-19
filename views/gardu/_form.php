<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Gardu */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="gardu-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_gardu')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'loses')->textInput() ?>

    <!-- <?= $form->field($model, 'status_unbalance')->dropDownList($model->unbalanceList) ?> -->

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
