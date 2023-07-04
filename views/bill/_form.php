<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\SysUser;
use app\models\Ref;

/** @var yii\web\View $this */
/** @var app\models\Bill $model */
/** @var yii\widgets\ActiveForm $form */

$month[] = '--Please Select--';

for($i = date('m'); $i <= 12; $i++){
    $month[$i.'-'.date('Y')] = $i.'-'.date('Y');
}
?>

<div class="bill-form well">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->dropDownList(SysUser::getClient(),['id' => 'user_id']) ?>

    <?= $form->field($model, 'month')->dropDownList($month, ['id' => 'month']) ?>

    <?= $form->field($model, 'amount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList(Ref::getList('bill_status')) ?>

    <?//= $form->field($model, 'last_pay_date')->textInput() ?>

    <?//= $form->field($model, 'hash_id')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        <button onclick="history.go(-1);" class="btn btn-danger">Back </button>
    </div>

    <?php ActiveForm::end(); ?>

</div>
