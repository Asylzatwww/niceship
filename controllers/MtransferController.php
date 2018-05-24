<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use app\models\Mtransfer;
use app\models\MtransferSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\SendMail;

/**
 * MtransferController implements the CRUD actions for Mtransfer model.
 */
class MtransferController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'toaddress', 'update', 'view', 'delete', 'create', 'https'],
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                    [
                        'actions' => ['alltransfer'],
                        'allow' => true,
                        'roles' => ['author'],
                    ],
                    [
                        'actions' => ['https'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Mtransfer models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MtransferSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Mtransfer model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Mtransfer model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Mtransfer();

        if ($model->load(Yii::$app->request->post())) {
            $model->datetime = date('Y-m-d') . 'T' . date('h:m:s') . 'Z';

            if (!empty($model->label)){
                $user = \app\models\User::findOne($model->label);
                $model->balance = $user->money = $user->money + $model->amount;
                $user->save(false);
            }

            if ($model->save()) return $this->redirect(['view', 'id' => $model->id]);

            return $this->render('create', [
                'model' => $model,
            ]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

//p2p-incoming,585.99,2016-08-03T08:13:11Z,false,41001000040,b311ada09e8f17cafa0e36b53bc8c7a02ef6df1d,true,,test-notification,643,
//p2p,2.99,2016-08-03T09:05:17Z,false,3.00,410014415916371,65cf1d6d783890953ce89518d6f8f7d67e07b615,false,1f33c76c-0009-5000-8000-000012796bb0,1047060634932012017,643,6
//p2p,2.99,2016-08-03T09:31:47Z,false,3.00,410014415916371,d7d357b8cd80944419c5c41740b2388dc586b7d9,false,1f33cd82-0009-5000-8000-00001279c043,1047063814976006017,643,6
//notification_type&operation_id&amount&currency&datetime&sender&codepro&notification_secret&label

    public function beforeAction($action) {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    public function actionHttps()
    {
        $model = new Mtransfer();
        
        if (isset($_POST['amount']) && isset($_POST['sha1_hash'])) {

            $model->amount = $_POST['amount'];
            if (isset($_POST['datetime']))          $model->datetime = $_POST['datetime'];
            if (isset($_POST['notification_type'])) $model->notification_type = $_POST['notification_type'];
            if (isset($_POST['operation_id']))      $model->operation_id = $_POST['operation_id'];
            if (isset($_POST['withdraw_amount']))   $model->withdraw_amount = $_POST['withdraw_amount'];
            if (isset($_POST['currency']))          $model->currency = $_POST['currency'];
            if (isset($_POST['sender']))            $model->sender = $_POST['sender'];
            if (isset($_POST['codepro']))           $model->codepro = $_POST['codepro'];
            if (isset($_POST['label']))           { $model->label = intval($_POST['label']); }

            //$model->datetime = implode(",", $_POST);
            if (!empty($model->label)){
                $user = \app\models\User::findOne($model->label);
                $model->balance = $user->money = $user->money + $model->amount;

                if ($model->checkHash($_POST['sha1_hash']) && $model->save()) {

                    $user->save(false);

                    $contact = new SendMail();
                    $contact->name = 'NiceShip';
                    $contact->email = Yii::$app->params['adminEmail'];
                    $contact->subject = 'Зачислен платеж : NiceShip.ru!';
                    $contact->body = \Yii::$app->view->renderFile('@app/views/user/_signupMail.php', [
                        'transfer' => 'nice', 
                        ]);
                    $contact->contact($user->email);


                    $contact = new SendMail();
                    $contact->name = 'NiceShip';
                    $contact->email = Yii::$app->params['adminEmail'];
                    $contact->subject = 'Поступили деньги от пользователя ' . $user->username . ' : NiceShip.ru!';
                    $contact->body = \Yii::$app->view->renderFile('@app/views/user/_signupMail.php', [
                        'transfer' => 'nice admin', 
                        ]);
                    $contact->contact($contact->email);
                }
            }
            
            return $this->render('https', [
                'model' => $model,
            ]);
            
        } else {
            return $this->render('https', [
                'model' => $model,
            ]);
        }
    }

    public function actionAlltransfer(){
        $searchModel = new MtransferSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('alltransfer', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Updates an existing Mtransfer model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Mtransfer model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Mtransfer model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Mtransfer the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Mtransfer::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
