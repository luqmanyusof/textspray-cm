<?php
namespace app\helpme;
use \yii\bootstrap\ActiveForm;

class Form {
    public function start($param) {
        return ActiveForm::begin($param);
    }
    
    public function end() {
        return ActiveForm::end();
    }
    
    public function dropDown($form, $model, $name='xx', $arr = []) {
        return $form->field($model, $name)->dropDownList($arr)->label(false);
    }
    
    public function text($form, $model, $name='', $prop=[]) {
        return $form->field($model, $name)->textInput($prop)->label(false);
    }
    
    public function textArea($form, $model, $name='', $prop=[]) {
        return $form->field($model, $name)->textArea($prop)->label(false);
    }
    
    public function radioList($form, $model, $name='', $data=[]) {
        return $form->field($model, $name)->radioList($data)->label(false);
    }

    public function checkbox($form, $model, $name='', $data=[]) {
        return $form->field($model, $name)->checkbox($data)->label(false);
    }
}