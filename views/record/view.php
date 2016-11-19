<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use miloschuman\highcharts\Highcharts;

/* @var $this yii\web\View */
/* @var $model app\models\RecordPhasa */

$this->title = 'Record Gardu '.$gardu;
// $this->params['breadcrumbs'][] = ['label' => 'Record Phasa', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="record-phasa-view">

    <?= Html::a('Lihat data hari ini', ['view', 'id'=>$gardu, 'kode'=>1], ['class' => 'btn btn-success'])?>
    <?= Html::a('Lihat data bulan ini', ['view', 'id'=>$gardu, 'kode'=>2], ['class' => 'btn btn-primary'])?>

    <?= Highcharts::widget([
        'options' => [
        'title' => ['text' => 'Record Gardu '.$gardu ],
        'xAxis' => [
             'categories' => $date,
        ],
        'yAxis' => [
             'title' => ['text' => 'Daya'],
        ],
        'series' => [
            ['name' => 'Phasa R', 'data' => $r],
            ['name' => 'Phasa S', 'data' => $s],
            ['name' => 'Phasa T', 'data' => $t],
        ],
        ]
    ]);
    echo '<br/>';
    ?>

    <?= Html::a('Print Record', ['report', 'id_gardu'=>$gardu, 'id_min'=>$id_min, 'id_max'=>$id_max], ['class' => 'btn btn-warning']) ?>

</div>
