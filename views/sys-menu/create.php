<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\SysMenu $model */

$this->title = 'Create Sys Menu';
$this->params['breadcrumbs'][] = ['label' => 'Sys Menus', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sys-menu-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
