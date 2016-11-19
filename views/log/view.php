<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Log */

$this->title = $model->id_log;
$this->params['breadcrumbs'][] = ['label' => 'Log', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="log-view">
    <!-- <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_log], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_log], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p> -->

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_log',
            'user',
            'activity',
            'date',
        ],
    ]) ?>

</div>
