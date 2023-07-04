<?php

use app\models\SysMenu;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\SysMenuSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Sys Menus';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sys-menu-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Sys Menu', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'sm_parent_id',
            'sm_menu',
            'sm_url:url',
            'active',
            //'created_by',
            //'created_date',
            //'modified_by',
            //'modified_date',
            //'sm_icon',
            //'sort',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, SysMenu $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
