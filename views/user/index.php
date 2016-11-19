<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gardu-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
    <?php
        $session = Yii::$app->session;
        if($session['session.user']['hak_akses']==1) {
            echo Html::a('Create User', ['create'], ['class' => 'btn btn-success']);
        }
    ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'nama',
            'username',
            'email:email',
            [
                'attribute'=>'user_type',
                'value'=>'userType.nama',
            ],
            [
                'attribute'=>'hak_akses',
                'value'=>'hakAkses.nama',
            ],

            ['class' => 'yii\grid\ActionColumn', 'template' => '{view}'],
        ],
    ]); ?>
</div>
