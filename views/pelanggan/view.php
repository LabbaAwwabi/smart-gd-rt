<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Pelanggan */

$this->title = $model->kode_registrasi;
$this->params['breadcrumbs'][] = ['label' => 'Pelanggan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pelanggan-view">
    <p>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'kode_registrasi',
            'id_pelanggan',
            'langganan',
            'v',
            'i',
            'p',
            [
                'attribute'=>'status',
                'value'=> $model->statusLabel,
            ],
        ],
    ]) ?>
    </p>
    
    <p>
    <?php
        $session = Yii::$app->session;
        if($session['session.user']['hak_akses']==1) {
            if($model->status==1) { ?>
                <?= Html::a('Lock', ['lock', 'id' => $model->id_pelanggan], [
                    'class' => 'btn btn-warning',
                    'data' => [
                        'confirm' => 'Are you sure you want to lock this customer?',
                    ],
                ]) ?>
            <?php } else { ?>
                <?= Html::a('Unlock', ['unlock', 'id' => $model->id_pelanggan], [
                    'class' => 'btn btn-success',
                    'data' => [
                        'confirm' => 'Are you sure you want to unlock this customer?',
                    ],
                ]) ?>
            <?php } ?>
            <?= Html::a('Update', ['update', 'id' => $model->id_pelanggan], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Delete', ['delete', 'id' => $model->id_pelanggan], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>
         <?php }
    ?>
    </p>

</div>
