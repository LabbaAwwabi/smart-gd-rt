<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Phasa */

$this->title = 'Update Phasa: ' . $model->id_phasa;
$this->params['breadcrumbs'][] = ['label' => 'Phasas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_phasa, 'url' => ['view', 'id' => $model->id_phasa]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="phasa-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
