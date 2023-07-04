<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Ref $model */

$this->title = 'Update Ref: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Refs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
