<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Phasas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="phasa-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'gardu',
            'v',
            'i',
            'p',
            'loses',
            [
                'attribute'=>'phasa_type',
                'value'=>'phasaType.nama',
            ],
            [
                'attribute'=>'status_voltage',
                'value'=>'statusVoltage.nama',
            ],
            ['class' => 'yii\grid\ActionColumn', 'template' => '{view}'],
        ],
    ]); ?>
</div>
