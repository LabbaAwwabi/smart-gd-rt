<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => 'User', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'nama',
            'username',
            'email:email',
            'password',
            [
                'attribute'=>'user_type',
                'value'=>$model->userType->nama,
            ],
            [
                'attribute'=>'hak_akses',
                'value'=>$model->hakAkses->nama,
            ],
        ],
    ]) ?>

    <p>
    <?php
        $session = Yii::$app->session;
        if($session['session.user']['hak_akses']==1) { ?>
            <?=Html::a('Update', ['update', 'id' => $model->id_user], ['class' => 'btn btn-primary'])?>
            <?=Html::a('Edit Hak Akses user', ['edit', 'id' => $model->id_user], ['class' => 'btn btn-success'])?>
        <?php }
        else if($session['session.user']['username']==$model->username) { ?>
            <?=Html::a('Update', ['update', 'id' => $model->id_user], ['class' => 'btn btn-primary'])?>
        <?php }
    ?>
    </p>

</div>
