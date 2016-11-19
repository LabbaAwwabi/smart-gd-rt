<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Phasa */

$this->title = 'Create Phasa';
$this->params['breadcrumbs'][] = ['label' => 'Phasas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="phasa-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
