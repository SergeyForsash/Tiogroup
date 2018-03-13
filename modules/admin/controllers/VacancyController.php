<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\crm\Vacancy;
use app\models\crm\search\VacancySearch;
use app\models\crm\Worker;
use app\models\admin\Partner;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use app\models\admin\Company;
use app\models\crm\Tickets;
use yii\widgets\ActiveForm;
/**
 * VacancyController implements the CRUD actions for Vacancy model.
 */
class VacancyController extends Controller
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
     * Lists all Vacancy models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new VacancySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Vacancy model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
       $query = Worker::find()->where(['vacancy_id'=>$id])->andWhere(['<','statusarchive','100']);
       $dataProvider = new ActiveDataProvider([
          'query' => $query,
      ]);
        return $this->render('view', [
            'model' => $this->findModel($id),
            'dataProvider' => $dataProvider
        ]);
    }

    /**
     * Updates an existing Vacancy model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $docers = $this->findModel($id);
        $countWorker = $model->work_add+1;

        if ($model->load(Yii::$app->request->post())) {
          if ($countWorker > $model->worker) {
           Yii::$app->session->addFlash('danger',Yii::t('app', 'Error_Worke').' '.$countWorker);
           return $this->render('update', [
               'model' => $model,
           ]);
          }else{
            if ($model->driver_license == 1) {
             $driver_id= implode(';', $model->driver_id);
             $model->driver_id = $driver_id;
           }else{
             $model->driver_id = null;
           }
           if (empty($model->image)) {
             $model->image = $docers->image;
           }
           $model->upload($docers);
           $model->date_update = date('Y-m-d');

           $model->save();
          }
           return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Vacancy model.
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
     * Finds the Vacancy model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Vacancy the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Vacancy::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    public function actionTicket($id)
      {
        $vacancy = Vacancy::findOne(['id'=>$id]);
        $user = Company::findOne(['user_id'=>$vacancy->company_id]);
        $model = new Tickets();
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
          $model->user_name = $user->firm_name;
          $model->tickets_id = 0;
          $model->agency_id = 0;
          $model->vacancy_id = $vacancy->id;
          $model->viewed_admin = 1;
          $model->viewed_user = 0;
          $model->date = date('Y-m-d');
          $model->time = date('H:i:s');
          $model->users = 1;
          $model->save();
          $vacancy->status='3';
          $vacancy->update();
          return $this->redirect(['index']);
        } else {
          return $this->renderAjax('ticket-form', [
            'model' => $model,
            'vacancy'=>$vacancy
          ]);
        }
      }

      public function actionTickets($id)
        {
          $users = Worker::findOne(['id'=>$id]);
          if ($users->created_by == '66') {
            $agency = '66';
          }else{
            $agency = Partner::findOne(['user_id'=>$users->created_by])->user_id;
          }
          $model = new Tickets();
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
            $model->user_id = $users->user_id;
            $model->user_name = $users->full_name;
            $model->tickets_id = 0;
            $model->agency_id = $agency;
            $model->vacancy_id = 0;
            $model->viewed_admin = 1;
            $model->viewed_user = 0;
            $model->date = date('Y-m-d');
            $model->time = date('H:i:s');
            $model->users = 1;
            //return var_dump( $users->user_id);
            $model->save();
            if ($model->save()) {
              $wid = $users->user_id;
              $this->statusWorkerStatus($wid);
            }
            return $this->redirect(['index']);
          } else {
            return $this->renderAjax('ticket-form', [
              'model' => $model,
            ]);
          }
        }
        public function statusWorkerStatus($wid)
        {
          $model = Worker::findOne(['user_id'=>$wid]);
          $model->statusarchive = 3;
          $model->update();
          Yii::$app->session->addFlash('success',Yii::t('app', 'tickets_app').' по '.$model->full_name);
        }
        public function actionDelDoc($id)
        {
          $model = Vacancy::findOne(['id' =>$id]);
          $file= substr($model->image, 1);
          unlink($file);
          $model->image = null;
          $model->update();
          $models = Vacancy::findOne(['id' =>$id]);
          if ($models->image == null) {
            return true;
          }else {
            return 'Ошибка  удаления';
          }

        }
}
