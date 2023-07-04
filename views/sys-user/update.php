<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\SysUser $model */

$this->title = 'Update Sys User: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Sys Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="sys-user-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
