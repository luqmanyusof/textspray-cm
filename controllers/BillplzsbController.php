<?php

namespace app\controllers;
use app\models\Bill;
use app\models\SysUser;
use app\models\Callback;

class BillplzsbController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    function Billplz($email,$name,$amount,$param){
        // Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        // Billplz API credentials
        $apiKey = 'a56ade92-f6bb-408e-ab99-ae7836d30631';
        $collectionId = '2mplmdyw';

        // Create a new bill
        $data = array(
            'collection_id' => $collectionId,
            'email' => $email ? $email : 'customer@example.com',
            'name' => $name ? $name : 'John Doe',
            'amount' => $amount ? $amount : 1000, // Amount in cents
            'callback_url' => 'http://'.$_SERVER['SERVER_NAME'].'/spray/web/index.php?r=billplzsb/callback&param='.$param,
            'description' => "some desc.",
            'redirect_url' => 'http://'.$_SERVER['SERVER_NAME'].'/spray/web/index.php?r=billplzsb/callback&param='.$param
            // Add other required parameters for your specific use case
        );

        // Send the API request
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://www.billplz-sandbox.com/api/v3/bills');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Authorization: Basic ' . base64_encode($apiKey . ':')
        ));

        $response = curl_exec($ch);
        curl_close($ch);

        // Process the response
        $responseData = json_decode($response, true);

        // var_dump($responseData);
        if (isset($responseData['id'])) {
            // Bill created successfully
            $billId = $responseData['id'];

            // Redirect the customer to the Billplz payment page
            header('Location: ' . $responseData['url']);
            exit();

            // $this->spray($responseData['url']);

            // return $this->redirect(['/bill/index']);
        } else {
            // Error handling
            echo 'Error creating bill: ' . $responseData['error']['message'];
        }
    }

    public function actionTryCollection(){
        // Billplz API credentials
        $apiKey = 'a56ade92-f6bb-408e-ab99-ae7836d30631';
        // $collectionId = 'b95fc9ba-3a0e-4737-9750-4380b961d7da';

        // Create a new bill
        $data = array(
            'title' => 'testing',
        );

        // Send the API request
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://www.billplz-sandbox.com/api/v3/collections');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Authorization: Basic ' . base64_encode($apiKey . ':')
        ));

        $response = curl_exec($ch);
        curl_close($ch);

        // Process the response
        $responseData = json_decode($response, true);

        var_dump($responseData);
        // if (isset($responseData['id'])) {
        //     // Bill created successfully
        //     $billId = $responseData['id'];

        //     // Redirect the customer to the Billplz payment page
        //     header('Location: ' . $responseData['url']);
        //     exit();
        // } else {
        //     // Error handling
        //     echo 'Error creating bill: ' . $responseData['error']['message'];
        // }
    }

    public function actionSpray($url){
        $msg = 'Go to ' . $responseData['url'] . 'to proceed with payment';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'http://188.166.204.226/wweb/send/12345/60193697274/'.$msg);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 0);

        $response = curl_exec($ch);
        curl_close($ch);

        return true;
    }

    public function actionCallback($param){
        // var_dump(json_decode(Yii::$app->request->post(), true));

        $bill = Bill::find()->where(['hash_id' => $param])->one();
        if($bill){
            $bill->status = 2;
            $bill->save();

            $modelUser = SysUser::findone($bill->user_id);

            $modelUser->ws_status = 1;
            $modelUser->save();
        }

        $model = new Callback();

        $model->callback = json_encode(\Yii::$app->request);
        $model->get = json_encode(\Yii::$app->request->get());
        $model->save();

        $user = SysUser::findone($bill->user_id);
        BillController::attachspray($user->su_phone_no, $user->su_name, $bill->hash_id);

        $this->goHome();
    }

    public function actionPay($param){
        $model = Bill::find()->where(['hash_id' => $param])->one();

        if($model->status == 1){
            $user = SysUser::findone($model->user_id);
            return $this->billplz($user->su_email, $user->su_name, $model->amount*100, $param); 
        }elseif($model->status == 2){
            echo 'Payment has been made. Thank You';
        }else{
            echo 'Bill is Canceled. For more information please contact Lukman!';
        }
    }

}
