<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Phasa */

$this->title = $model->id_phasa;
$this->params['breadcrumbs'][] = ['label' => 'Phasa', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="phasa-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_phasa',
            'gardu',
            'v',
            'i',
            'p',
            'loses',
            [
                'attribute'=>'phasa_type',
                'value'=>$model->phasaType->nama,
            ],
            [
                'attribute'=>'status_voltage',
                'value'=>$model->statusVoltage->nama,
            ],
        ],
    ]) ?>

    <p>
        <?= Html::a('List Pelanggan', ['/pelanggan/list', 'id_phasa' => $model->id_phasa], ['class'=>'btn btn-primary']) ?>
        <?php
        $session = Yii::$app->session;
        if($session['session.user']['hak_akses']==1) { ?>
            <?= Html::a('Update', ['update', 'id' => $model->id_phasa], ['class' => 'btn btn-success']) ?>
            <?= Html::a('Delete', ['delete', 'id' => $model->id_phasa], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>
        <?php } ?>
    </p>

</div>
