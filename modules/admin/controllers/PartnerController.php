<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\admin\Partner;
use app\models\admin\search\PartnerSearch;
use app\models\crm\Signup;
use app\models\crm\User;
use app\models\crm\Worker;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use app\models\crm\Massage;
use yii\widgets\ActiveForm;
/**
 * PartnerController implements the CRUD actions for Partner model.
 */
class PartnerController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Partner models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PartnerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Partner model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
      $model =$this->findModel($id);
      $query = Worker::find()->where(['created_by'=>$model->user_id]);
      $dataProvider = new ActiveDataProvider([
         'query' => $query,
     ]);
       return $this->render('view', [
           'model' => $model,
           'dataProvider' => $dataProvider
       ]);
    }

    /**
     * Creates a new Partner model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $users = new Signup();
        $model = new Partner();

        if ( $users->load(Yii::$app->getRequest()->post()) && $model->load(Yii::$app->request->post())) {
          if ($user = $users->signup()) {

              $user_id = User::findOne(['username' => $users->username])->id;
              $model->user_id = $user_id;
              $model->email = $users->email;
              $docers = $model;
              $model->upload($docers);
              $model->save();
              if ($model->save()) {
              }else{
                $user = User::findOne(['id' => $model->user_id]);
                $user->delete();
              }
              return $this->redirect(['index']);

          }else{
            return $this->render('create', [
                'model' => $model,
                'users'=> $users,
            ]);
          }
        } else {
            return $this->render('create', [
                'model' => $model,
                'users'=> $users,
            ]);
        }
    }

    /**
     * Updates an existing Partner model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $users = User::findOne(['id' => $model->user_id]);
        if ($model->load(Yii::$app->request->post())) {
          $docers = $model;
          $model->upload($docers);
          $model->save();
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
                'users'=>$users,
            ]);
        }
    }

    /**
     * Deletes an existing Partner model.
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
     * Finds the Partner model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Partner the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Partner::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    public function actionDelDoc($id,$type = null)
    {
      $model = Worker::findOne(['id' =>$id]);
      if ($type==1) {
        $file= substr($model->agreement, 1);
        unlink($file);
        $model->agreement = null;
        $model->update();
        return true;
      }elseif($type==2) {
        $file= substr($model->image, 1);
        unlink($file);
        $model->image = null;
        $model->update();
        return true;
      }else {
        return 'Ошибка  удаления';
      }
    }
    public function actionMassag($id)
      {
        $user = Partner::findOne(['id'=>$id]);
        $model = new Massage();
                // Ajax
         $request = \Yii::$app->getRequest();
         if ($request->isAjax && $model->load($request->post())) {
           Yii::$app->response->format = yii\web\Response::FORMAT_JSON;
           return ActiveForm::validate($model);
         }
         // General use
        if ($model->load($request->post())) {
          $model->admin_id = 1;
          $model->admin_name = 'TIOGROUP';
          $model->user_id = $user->user_id;
          $model->user_name = $user->agency_name;
          $model->tickets_id = 0;
          $model->viewed_admin = 1;
          $model->viewed_user = 0;
          $model->date = date('Y-m-d');
          $model->time = date('H:i:s');
          $model->massage_id = 0;
          $model->users = 1;
          $model->save();
          return $this->redirect([
            'index',
            Yii::$app->session->addFlash('success',Yii::t('app', 'massag_app').' '.$user->agency_name),
          ]);
        } else {
          return $this->renderAjax('massage', [
            'model' => $model,
            'user' => $user,
          ]);
        }
      }


}
