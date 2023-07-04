<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\RefSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="ref-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'parentid') ?>

    <?= $form->field($model, 'code_name') ?>

    <?= $form->field($model, 'code') ?>

    <?= $form->field($model, 'sr_name') ?>

    <?php // echo $form->field($model, 'sort') ?>

    <?php // echo $form->field($model, 'active') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'created_date') ?>

    <?php // echo $form->field($model, 'modified_by') ?>

    <?php // echo $form->field($model, 'modified_date') ?>

    <?php // echo $form->field($model, 'addr1') ?>

    <?php // echo $form->field($model, 'addr2') ?>

    <?php // echo $form->field($model, 'addr3') ?>

    <?php // echo $form->field($model, 'addr_postcode') ?>

    <?php // echo $form->field($model, 'code_state') ?>

    <?php // echo $form->field($model, 'old_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
