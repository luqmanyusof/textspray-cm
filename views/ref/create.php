<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Ref $model */

$this->title = 'Create Ref';
$this->params['breadcrumbs'][] = ['label' => 'Refs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
