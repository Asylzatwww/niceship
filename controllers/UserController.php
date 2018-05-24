<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use app\models\User;
use app\models\UserSearch;
use yii\web\Controller;
use app\models\SendMail;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\ContactForm;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
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
                        'actions' => ['index', 'create', 'update', 'view', 'delete', 'test'],
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                    [
                        'actions' => ['personal', 'email', 'password'],
                        'allow' => true,
                        'roles' => ['author'],
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

    public function actionTest(){
        return $this->render('_signupMail', [
            'password' => 'test',
        ]);
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
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
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->passwordrepeat = User::setPassword($model->password);
            $model->password = User::setPassword($model->password);
            if ($model->save()) return $this->redirect(['view', 'id' => $model->id]); else
            return $this->render('update', [
                'model' => $model,
            ]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionPersonal($id)
    {
        $model = $this->findModel($id);
        $before = $model;

        if ($model->load(Yii::$app->request->post()) && User::dataControll($before, $model)) {
            $model->passwordrepeat = $model->password;
            if ($model->save()) return $this->redirect('/delivery');
        } else {
            return $this->render('update', [
                'model' => $model,
                'status' => 'personal',
            ]);
        }
    }


    public function actionEmail($id)
    {
        $model = $this->findModel($id);
        $before = $model;

        if ($model->load(Yii::$app->request->post()) && User::dataControll($before, $model)) {
            $model->passwordrepeat = $model->password;
            if ($model->save()) return $this->redirect('/delivery');
        } else {
            return $this->render('update', [
                'model' => $model,
                'status' => 'email',
            ]);
        }
    }


    public function actionPassword($id)
    {
        $model = $this->findModel($id);
        $before = $model;
        $model->password = '';
        $password = '';

        if ($model->load(Yii::$app->request->post()) && User::dataControll($before, $model)) {
            
            $model->passwordrepeat = $model->password = $password = $model->password . rand(1,1000);
            $model->password = User::setPassword($model->password);
            $model->passwordrepeat = User::setPassword($model->passwordrepeat);
            

            if ($model->save()) {
                $contact = new SendMail();
                $contact->name = 'NiceShip';
                $contact->email = Yii::$app->params['adminEmail'];
                $contact->subject = 'Вы сменили пароль на NiceShip.ru!';
                $contact->body = \Yii::$app->view->renderFile('@app/views/user/_signupMail.php', [
                    'password' => $password, 
                    ]);
                $contact->contact($model->email);

                 Yii::$app->user->logout(); return $this->redirect('/site/login'); } else {
            return $this->render('update', [
                'model' => $model,
                'status' => 'password',
            ]);

            }
        } else {
            return $this->render('update', [
                'model' => $model,
                'status' => 'password',
            ]);
        }
    }


    /**
     * Deletes an existing User model.
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
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
