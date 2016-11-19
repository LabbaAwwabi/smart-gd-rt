<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Log';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="log-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php
        $session = Yii::$app->session;
        if($session['session.user']['hak_akses']==1) { ?>
            <?= Html::a('Delete log hari ini', ['delete'], ['class' => 'btn btn-warning','data' => [
                    'confirm' => 'Are you sure you want to delete todays log?',
                    'method' => 'post',
                ]]) ?>
            <?= Html::a('Delete semua log', ['empty'], ['class' => 'btn btn-danger','data' => [
                    'confirm' => 'Are you sure you want to delete all log?',
                    'method' => 'post',
                ]]) ?>
    <?php } ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'user',
            'activity',
            'date',
        ],
    ]); ?>
</div>
