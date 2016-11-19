<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RecordPhasa */

$this->title = 'Create Record Phasa';
$this->params['breadcrumbs'][] = ['label' => 'Record Phasas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="record-phasa-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
