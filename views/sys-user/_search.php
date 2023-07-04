<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\SysUserSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="sys-user-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'su_username') ?>

    <?= $form->field($model, 'su_password') ?>

    <?= $form->field($model, 'su_name') ?>

    <?= $form->field($model, 'su_email') ?>

    <?php // echo $form->field($model, 'code_division') ?>

    <?php // echo $form->field($model, 'code_role') ?>

    <?php // echo $form->field($model, 'su_active') ?>

    <?php // echo $form->field($model, 'su_locked') ?>

    <?php // echo $form->field($model, 'su_login_attempt') ?>

    <?php // echo $form->field($model, 'su_login_date') ?>

    <?php // echo $form->field($model, 'su_last_login') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'created_date') ?>

    <?php // echo $form->field($model, 'modified_by') ?>

    <?php // echo $form->field($model, 'modified_date') ?>

    <?php // echo $form->field($model, 'sqc_id') ?>

    <?php // echo $form->field($model, 'su_phone_no') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
