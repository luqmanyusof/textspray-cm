<?php

use app\models\Bill;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use app\models\SysUser;
use app\models\Ref;

/** @var yii\web\View $this */
/** @var app\models\BillSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Bills';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bill-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Bill', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            // 'user_id',
            [
                'attribute' => 'user_id',
                'value' => function($model){
                    return SysUser::findone($model->user_id)->su_name;
                }
            ],
            'month',
            // 'amount',
            [
                'attribute' => 'amount',
                'value' => function($model){
                    return number_format($model->amount, 2);
                },
                'options' => ['style'=>'text-align:right']
            ],
            // 'status',
            [
                'attribute' => 'status',
                'value' => function($model){
                    return Ref::find()->where(['code_name' => 'bill_status', 'code' => $model->status])->one()->sr_name;
                }
            ],
            //'last_pay_date',
            //'hash_id',
            ['class' => 'yii\grid\ActionColumn', "template"=>'{update}<br>{pdf}<br>{pay}',
                'contentOptions'=>['style'=>'width: 30px; text-align: center'],
                'header' => 'Action',
                'buttons' => [
                    'update' => function ($url, $model) {
                        return Html::a('<i class="fa fa-edit"></i>Edit', "index.php?r=bill/update&id=".$model->id, [
                                    'title' => Yii::t('app', 'Update'),
                        ]);
                    },


                    'pdf' => function ($url, $model) {

                        return Html::a('<i class="fa fa-file-pdf"></i>View', "index.php?r=bill/bill-pdf&id=".$model->id, [

                                    'title' => Yii::t('app', 'PDF'),
                                    'target' => '_blank'
                        ]);
                    },//,


                    'pay' => function ($url, $model) {

                        return Html::a('<i class="fa fa-dollar"></i>Pay', "index.php?r=billplzsb/pay&param=".$model->hash_id, [
                                    'target' => '_blank',
                                    'title' => Yii::t('app', 'Pay'),
                        ]);
                    }//,
           
//                    'delete' => function ($url, $model)
//                            {
//                                return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
//                                            'title' => Yii::t('yii', 'Delete'),
//                                            'onClick' => 'return doDelete()',
//                                            'data-method' => 'post',
//                                ]); 
//                                
//                            }
                ]
            ],
        ],
    ]); ?>


</div>
