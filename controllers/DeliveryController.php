<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use app\models\Delivery;
use app\models\DeliverySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\models\SendMail;

use app\models\ImageUpload;
use yii\web\UploadedFile;

/**
 * DeliveryController implements the CRUD actions for Delivery model.
 */
class DeliveryController extends Controller
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
                        'actions' => ['index', 'shop', 'ship', 'fromshop', 'toaddress', 'enjoy', 'balance', 'create', 'update', 'view', 'delete'],
                        'allow' => true,
                        'roles' => ['@'],
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

    public function beforeAction($action) {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    /**
     * Lists all Delivery models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DeliverySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionShop()
    {
        $searchModel = new DeliverySearch();
        $searchModel->findStatus = 0;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        return $this->render('shop', [
            'searchModel' => $searchModel,
            'status' => 'Купить в интернет магазине',
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionFromshop()
    {
        $searchModel = new DeliverySearch();
        $searchModel->findStatus = 1;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        return $this->render('ship', [
            'searchModel' => $searchModel,
            'status' => 'Совершается доставка на склад',
            'dataProvider' => $dataProvider,
            'step' => 5,
            'text' => 'Товар скоро доставят на склад !',
        ]);
    }

    public function actionShip()
    {
        $searchModel = new DeliverySearch();
        $searchModel->findStatus = 2;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        return $this->render('ship', [
            'searchModel' => $searchModel,
            'status' => 'На складе',
            'dataProvider' => $dataProvider,
            'step' => 3,
            'text' => 'Товары на складе !',
        ]);
    }

    public function actionToaddress()
    {
        $searchModel = new DeliverySearch();
        $searchModel->findStatus = 3;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        return $this->render('ship', [
            'searchModel' => $searchModel,
            'status' => 'Доставка отправленна',
            'dataProvider' => $dataProvider,
            'step' => 6,
            'text' => 'Доставка уже отправленна',
        ]);
    }

    public function actionEnjoy()
    {
        $searchModel = new DeliverySearch();
        $searchModel->findStatus = 4;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        return $this->render('enjoy', [
            'searchModel' => $searchModel,
            'status' => 'Посылка отправленна получетелю',
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single Delivery model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionBalance()
    {
        return $this->render('balance');
    }

    /**
     * Creates a new Delivery model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Delivery();
        $image = new ImageUpload();
        $image->imageRoot = 'delivery/'; 

        $model->createdBy = Yii::$app->user->identity->id;
        if ($model->load(Yii::$app->request->post())// &&  $model->uniqAlias('image')
            ) {
            $image->imageFile = UploadedFile::getInstance($image, 'imageFile');
            $image->upload($model->image);
            if ($model->save()) { 
                
                $contact = new SendMail();
                $contact->name = 'NiceShip';
                $contact->email = Yii::$app->params['adminEmail'];
                $contact->subject = 'Пользователь добавил товар для покупки. NiceShip.ru!';
                $contact->body = \Yii::$app->view->renderFile('@app/views/user/_signupMail.php', [
                    'deliver' => $model, 
                    ]);
                $contact->contact(Yii::$app->params['adminEmail']);

                return $this->redirect(['view', 'id' => $model->id]); 
            } else
            return $this->render('create', [
                'model' => $model,
                'image' => $image,
            ]);
        } else {

            if (isset($_POST['select'])){

                $model->name = $_POST['name'];
                $model->count = $_POST['count'];
                $model->weight = $_POST['weight'];
                $model->prize = $_POST['prize'];
                $model->product_url = $_POST['product_url'];
            }
            return $this->render('create', [
                'model' => $model,
                'image' => $image,
            ]);
        }
    }


    /**
     * Updates an existing Delivery model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $oldImage = $model->image;
        $image = new ImageUpload();
        $image->imageRoot = 'delivery/'; 

        

        if (\Yii::$app->user->can('updatePost', ['post' => $model])) {


            if ($model->load(Yii::$app->request->post())// &&  $model->uniqAlias('image')
                ) {

                $image->imageFile = UploadedFile::getInstance($image, 'imageFile');

                if ($oldImage == '') {
                    $image->upload($model->image);
                } else
                if ($image->imageFile != null) $image->upload($model->image, $oldImage);
                    else $image->aliasRename($oldImage, $model->image);

                if ($model->save()) {
                    if (isset(Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId())['admin']))
                        return $this->redirect(['view', 'id' => $model->id]); 
                        else return $this->redirect(['shop']);    
           
                }
            } else {
                return $this->render('update', [
                    'model' => $model,
                    'image' => $image,
                ]);
            }
        } else throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Deletes an existing Delivery model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        //$this->findModel($id)->delete();
        $model = $this->findModel($id);

        if (\Yii::$app->user->can('updatePost', ['post' => $model])) $model->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Delivery model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Delivery the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Delivery::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
