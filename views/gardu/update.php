<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Gardu */

$this->title = 'Update Gardu: ' . $model->id_gardu;
$this->params['breadcrumbs'][] = ['label' => 'Gardus', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_gardu, 'url' => ['view', 'id' => $model->id_gardu]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="gardu-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
