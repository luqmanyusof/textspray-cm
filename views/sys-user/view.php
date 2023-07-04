<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\SysUser $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Sys Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="sys-user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'su_username',
            'su_password',
            'su_name',
            'su_email:email',
            'code_division',
            'code_role',
            'su_active',
            'su_locked',
            'su_login_attempt',
            'su_login_date',
            'su_last_login',
            'created_by',
            'created_date',
            'modified_by',
            'modified_date',
            'sqc_id',
            'su_phone_no',
        ],
    ]) ?>

</div>
