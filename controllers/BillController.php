<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use app\models\Bill;
use app\models\BillSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use kartik\mpdf\Pdf;
use app\models\SysUser;

/**
 * BillController implements the CRUD actions for Bill model.
 */
class BillController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                // 'access' => [
                //     'class' => AccessControl::class,
                //     'rules' => [
                //         [
                //             'allow' => true,
                //             'actions' => ['index'],
                //             'roles' => ['@'],
                //         ],
                //     ],
                // ],
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Bill models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new BillSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Bill model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Bill model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Bill();

        if ($this->request->isPost) {
            if ($model->load(Yii::$app->request->post())) {
                $model->last_pay_date = date('Y-m-d', strtotime('+30 days'));
                $user = SysUser::findone($model->user_id);

                

                if($model->save()){
                    $model->hash_id = md5($model->getPrimaryKey().$model->user_id);
                    $model->save();

                    $this->textspray($user->su_phone_no, $model->amount, $user->su_name, $model->hash_id);
                    return $this->redirect(['index']);
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionBillPdf($id){
        $model = Bill::findOne($id);

        $htmlContent = $this->renderPartial('view_bill', ['model' => $model]);

        $pdf = new Pdf([
            'mode'          => 'utf-8',
            'format'        => 'A4',
            'orientation'   => 'P',
            'content'       => $htmlContent,
            'destination'   => 'I',
            'defaultFont'   => 'Arial',
            'options'       => [
                'title' => 'PDF Document Title',
                'defaultheaderline' => 0, 
                'defaultfooterline' => 0,
            ],
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/src/assets/kv-mpdf-bootstrap.min.css',
            'cssInline' => '
                .text-justify {
                    text-align: justify;
                }
                
                .list-outside {
                    list-style-position: outside !important;
                }
            ',
        ]);

        return $pdf->render();
    }

    /**
     * Updates an existing Bill model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Bill model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Bill model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Bill the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Bill::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionTextsprayOld(){
        $msg = 'Click Link Below to make payment.' . urlencode('http://'.$_SERVER['SERVER_NAME'].'/bill-ace/web/index.php?r=bill/index');
        $url = "http://188.166.197.141/wweb/send/12345/60174730875/".$msg;
        // Create a cURL resource
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Execute the request
        $response = curl_exec($ch);

        // Check for errors
        if(curl_errno($ch)){
            echo 'cURL error: ' . curl_error($ch);
        }

        // Close the cURL resource
        curl_close($ch);

        // Output the response
        echo $response;
    }

    function Textspray($contact = '', $bill = '', $name = '', $hash = ''){
        // echo $contact;echo $bill;echo $name;return;
        // API endpoint URL
        $url = "http://188.166.197.141/wweb/send";
        $first_character = substr($contact, 0, 1);
        if($first_character == '0'){
            $contact = '6'.$contact;
        }

        $payURL = 'http://'.$_SERVER['SERVER_NAME'].'/spray/web/index.php?r=billplzsb/pay&param='.$hash;

        // Request body data
        $data = array(
            "id" => $contact,
            "textMsg" => "<TextSpray>Dear Mr/Mrs" . ucwords($name) . " Click Link below to make payment RM" . $bill .  " \n\n" . $payURL . "\n\nThank You for using TextSpray."
        );

        // Convert data to JSON format
        $jsonData = json_encode($data);

        // Initialize cURL session
        $ch = curl_init();

        // Set the cURL options
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($jsonData)
        ));

        // Execute the cURL request
        $response = curl_exec($ch);

        // Check for errors
        if (curl_errno($ch)) {
            echo 'Error: ' . curl_error($ch);
        }

        // Close the cURL session
        curl_close($ch);

        // Process the response
        if ($response !== false) {
            $responseData = json_decode($response, true);
            // Handle the response data
            var_dump($responseData);
        } else {
            echo "No response received.";
        }
    }

    public function actionTest(){
        $model = Bill::findOne(9);
        $user = SysUser::findone($model->user_id);
        $this->attachspray('0174730875', 100, 'aizzat', $model->hash_id);
    }

    function Attachspray($contact = '', $name = '', $hash = ''){
        $url = "http://188.166.197.141/wweb/send/doc";

        $first_character = substr($contact, 0, 1);
        if($first_character == '0'){
            $contact = '6'.$contact;
        }

        $model = Bill::find()->where(['hash_id' => $hash])->one();

        // $htmlContent = $this->renderPartial('view_bill', ['model' => $model]);
        $htmlContent = Yii::$app->view->renderFile(Yii::getAlias('@app') . '/views/bill/view_bill.php', ['model' => $model]);
        $file = 'attachement/bill/Bill-' . $hash.'.pdf';

        $pdf = new Pdf([
            'mode'          => 'utf-8',
            'format'        => 'A4',
            'orientation'   => 'P',
            'content'       => $htmlContent,
            'destination'   => 'F',
            'filename'      => $file,
            'defaultFont'   => 'Arial',
            'options'       => [
                'title' => 'PDF Document Title',
                'defaultheaderline' => 0, 
                'defaultfooterline' => 0,
            ],
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/src/assets/kv-mpdf-bootstrap.min.css',
            'cssInline' => '
                .text-justify {
                    text-align: justify;
                }
                
                .list-outside {
                    list-style-position: outside !important;
                }
            ',
        ]);

        $attachment = $pdf->render();

        $attach = new \CURLFile(Yii::$app->basepath.'/web/'.$file, 'application/pdf','MyFile');

        // Request body data
        $data = array(
            "id" => $contact,
            "caption" => "<TextSpray>Dear Mr/Mrs" . ucwords($name) . " Attached is your TextSpray Bill",
            "doc" => $attach
        );

        // Convert data to JSON format
        $jsonData = json_encode($data);

        // Initialize cURL session
        $ch = curl_init();

        // Set the cURL options
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Execute the cURL request
        $response = curl_exec($ch);

        // Check for errors
        if (curl_errno($ch)) {
            echo 'Error: ' . curl_error($ch);
        }

        // Close the cURL session
        curl_close($ch);

        // Process the response
        if ($response !== false) {
            $responseData = json_decode($response, true);
            // Handle the response data
            var_dump($responseData);
        } else {
            echo "No response received.";
        }
    }
}
