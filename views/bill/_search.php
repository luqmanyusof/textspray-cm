<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\BillSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="bill-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'month') ?>

    <?= $form->field($model, 'amount') ?>

    <?= $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'last_pay_date') ?>

    <?php // echo $form->field($model, 'hash_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
