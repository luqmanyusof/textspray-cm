<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\SysRole $model */

$this->title = 'Create Sys Role';
$this->params['breadcrumbs'][] = ['label' => 'Sys Roles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sys-role-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
