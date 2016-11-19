<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Gardu */

$this->title = 'Create Gardu';
$this->params['breadcrumbs'][] = ['label' => 'Gardu', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gardu-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
