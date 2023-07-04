<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\SysUser $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="sys-user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'su_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'su_email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'code_division')->textInput() ?>

    <?= $form->field($model, 'code_role')->textInput() ?>

    <?= $form->field($model, 'su_active')->textInput() ?>

    <?= $form->field($model, 'su_locked')->textInput() ?>

    <?= $form->field($model, 'su_login_attempt')->textInput() ?>

    <?= $form->field($model, 'su_login_date')->textInput() ?>

    <?= $form->field($model, 'su_last_login')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_date')->textInput() ?>

    <?= $form->field($model, 'modified_by')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'modified_date')->textInput() ?>

    <?= $form->field($model, 'sqc_id')->textInput() ?>

    <?= $form->field($model, 'su_phone_no')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
