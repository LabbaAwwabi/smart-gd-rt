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

    <p>
        <?php
            $session = Yii::$app->session;
            if($session['session.user']['hak_akses']==1) {
                echo Html::a('Create Pelanggan', ['create'], ['class' => 'btn btn-success']);
            }
        ?>
    </p>

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

            ['class' => 'yii\grid\ActionColumn', 'template' => '{view}'],
        ],
    ]); ?>
</div>
