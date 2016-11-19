<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Gardu */

$this->title = $model->id_gardu;
$this->params['breadcrumbs'][] = ['label' => 'Gardu', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gardu-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_gardu',
            'loses',
            [
                'attribute'=>'status_unbalance',
                'value'=>$model->statusUnbalance->nama,
            ],
        ],
    ]) ?>

    <p>
        <?= Html::a('List Phasa', ['/phasa/list', 'id_gardu' => $model->id_gardu], ['class'=>'btn btn-primary']) ?>
        <?php
        $session = Yii::$app->session;
        if($session['session.user']['hak_akses']==1) { ?>
            <?= Html::a('Update', ['update', 'id' => $model->id_gardu], ['class' => 'btn btn-success']) ?>
            <?= Html::a('Delete', ['delete', 'id' => $model->id_gardu], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>
        <?php } ?>
    </p>

</div>
