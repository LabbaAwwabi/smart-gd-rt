<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Gardu';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gardu-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
    <?php
        $session = Yii::$app->session;
        if($session['session.user']['hak_akses']==1) {
            echo Html::a('Create Gardu', ['create'], ['class' => 'btn btn-success']);
        }
    ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_gardu',
            'loses',
            [
                'attribute'=>'status_unbalance',
                'value'=>'statusUnbalance.nama',
            ],

            ['class' => 'yii\grid\ActionColumn', 'template' => '{view}'],
        ],
    ]); ?>
</div>
