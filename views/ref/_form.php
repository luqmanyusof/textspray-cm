<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Ref $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="ref-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'parentid')->textInput() ?>

    <?= $form->field($model, 'code_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sr_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sort')->textInput() ?>

    <?= $form->field($model, 'active')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_date')->textInput() ?>

    <?= $form->field($model, 'modified_by')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'modified_date')->textInput() ?>

    <?= $form->field($model, 'addr1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'addr2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'addr3')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'addr_postcode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'code_state')->textInput() ?>

    <?= $form->field($model, 'old_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
