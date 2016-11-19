<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Record Phasa';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="record-phasa-index">

    <h1><?= Html::encode($this->title) ?></h1>

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
    ]);
    ?>
</div>
