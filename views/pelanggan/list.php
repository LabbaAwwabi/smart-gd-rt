<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pelanggan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pelanggan-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'kode_registrasi',
            'langganan',
            'v',
            'i',
            'p',
            [
                'attribute'=>'status',
                'value'=> 'statusLabel',
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
