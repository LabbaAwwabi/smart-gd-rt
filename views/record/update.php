<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RecordPhasa */

$this->title = 'Update Record Phasa: ' . $model->id_record_phasa;
$this->params['breadcrumbs'][] = ['label' => 'Record Phasas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_record_phasa, 'url' => ['view', 'id' => $model->id_record_phasa]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="record-phasa-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
