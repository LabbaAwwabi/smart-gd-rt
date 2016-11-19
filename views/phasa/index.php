<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Phasa';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="phasa-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
    <?php
        $session = Yii::$app->session;
        if($session['session.user']['hak_akses']==1) {
            echo Html::a('Create Phasa', ['create'], ['class' => 'btn btn-success']);
        }
    ?>
    </p>

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
