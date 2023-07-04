<?php

namespace app\controllers;

use app\models\Bill; 
use app\models\SysUser;
use Yii;

Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
// Yii::$app->controller->enableCsrfValidation = false;

class ApiController extends \yii\web\Controller
{

    public function beforeAction($action) 
    { 
        $this->enableCsrfValidation = false; 
        return parent::beforeAction($action); 
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionClientStatus(){
        $contactNo = Yii::$app->request->post('accountId');

        $modelUser = SysUser::find()->where(['ws_no' => $contactNo])->one();

        $status = $modelUser->subscription == 1 ? true : false;

        $data = [
            'accountId' => $contactNo,
            'subscriptionStatus' => $status
        ];

        return json_encode($data);
    }

    public function actionClientAuth(){
        $contactNo = Yii::$app->request->post('accountId');
        $password = md5(Yii::$app->request->post('password'));

        $modelUser = SysUser::find()->where(['ws_no' => $contactNo, 'password' => $password])->one();

        if(!$modelUser){
            $data = [
                'status' => 'authentication failed.'
            ];
            Yii::$app->response->statusCode = 401;
            return json_encode($data);
        }

        $status = $modelUser->subscription == 1 ? true : false;

        $bill = Bill::find()->where(['user_id' => $modelUser->id])->orderBy('last_pay_date desc')->one();

        $data = [
            'status' => true,
            'applicationName' => $modelUser->app_name,
            'subscriptionStatus' => $status,
            'expiryDate' => $bill->last_pay_date
        ];

        return json_encode($data);
    }

}
