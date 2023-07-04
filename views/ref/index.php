<?php

use app\models\Ref;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\RefSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Refs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Ref', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'parentid',
            'code_name',
            'code',
            'sr_name',
            //'sort',
            //'active',
            //'created_by',
            //'created_date',
            //'modified_by',
            //'modified_date',
            //'addr1',
            //'addr2',
            //'addr3',
            //'addr_postcode',
            //'code_state',
            //'old_id',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Ref $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
