<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Pelanggan */

$this->title = 'Update Pelanggan: ' . $model->kode_registrasi;
$this->params['breadcrumbs'][] = ['label' => 'Pelanggans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->kode_registrasi, 'url' => ['view', 'id' => $model->id_pelanggan]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pelanggan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
