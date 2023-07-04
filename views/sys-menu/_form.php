<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\SysMenu $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="sys-menu-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'sm_parent_id')->textInput() ?>

    <?= $form->field($model, 'sm_menu')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sm_url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'active')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_date')->textInput() ?>

    <?= $form->field($model, 'modified_by')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'modified_date')->textInput() ?>

    <?= $form->field($model, 'sm_icon')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sort')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
