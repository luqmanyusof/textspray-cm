<?php

use app\models\SysUser;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\SysUserSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Sys Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sys-user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Sys User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'su_username',
            'su_password',
            'su_name',
            'su_email:email',
            //'code_division',
            //'code_role',
            //'su_active',
            //'su_locked',
            //'su_login_attempt',
            //'su_login_date',
            //'su_last_login',
            //'created_by',
            //'created_date',
            //'modified_by',
            //'modified_date',
            //'sqc_id',
            //'su_phone_no',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, SysUser $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
