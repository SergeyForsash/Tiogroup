<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\crm\Tickets;
use app\models\crm\Worker;
use app\models\crm\Vacancy;
use app\models\crm\search\TicketsWAdmin as SearchWorker;
use app\models\crm\search\TicketsVAdmin as SearchVacancy;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\widgets\ActiveForm;
use yii\data\ActiveDataProvider;

/**
 * TicketsController implements the CRUD actions for Tickets model.
 */
class TicketsController extends Controller
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
     * Lists all Tickets models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchWorker = new SearchWorker();
        $dataWorker = $searchWorker->search(Yii::$app->request->queryParams);
        $searchVacancy = new SearchVacancy();
        $dataVacancy = $searchVacancy->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchWorker' => $searchWorker,
            'dataWorker' => $dataWorker,
            'searchVacancy' => $searchVacancy,
            'dataVacancy' => $dataVacancy,
        ]);
    }
    /**
     * Updates an existing Tickets model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
     /**
      * Updates an existing Tickets model.
      * If update is successful, the browser will be redirected to the 'view' page.
      * @param integer $id
      * @return mixed
      * @throws NotFoundHttpException if the model cannot be found
      */
     public function actionViewWorker($id)
     {
       $models = $this->findModel($id);
       $model = new Tickets();

       $query = Tickets::find()->where(['id' => $id])->orWhere(['tickets_id'=>$id]);

       $dataProvider = new ActiveDataProvider([
           'query' => $query,
           'pagination' => [
               'pageSize' => 6,
             ],
           ]);

       $request = \Yii::$app->getRequest();
       if ($request->isAjax && $model->load($request->post())) {
         Yii::$app->response->format = yii\web\Response::FORMAT_JSON;
         return ActiveForm::validate($model);
       }

       // General use
       if ($model->load($request->post())) {
         $model->admin_id = $models->admin_id;
         $model->admin_name = $models->admin_name;
         $model->user_id = $models->user_id;
         $model->user_name = $models->user_name;
         $model->subject = $models->subject;
         $model->tickets_id = $models->id;
         $model->agency_id = $models->agency_id;
         $model->vacancy_id = 0;
         $model->viewed_admin = 1;
         $model->viewed_user = 0;
         $model->date = date('Y-m-d');
         $model->time = date('H:i:s');
         $model->users = 1;
         //return var_dump($model);
         $model->save();
         $models->status = '1';
         $models->update();
         return $this->redirect(['index']);
       } else {
         return $this->renderAjax('view-worker', [
           'dataProvider'=>$dataProvider,
           'model' => $model,
           'models' => $models,
         ]);
       }
     }

     public function actionCloseTicketsWorker($id)
     {
         $model = $this->findModel($id);
         $model->status = '3';
         $model->update();
         $this->WorkerStatus(['id'=>$model->user_id]);
         return $this->redirect(['index']);
     }

     public function WorkerStatus($id)
     {   $model = Worker::findOne(['user_id'=>$id]);
         $model->statusarchive = '2';
         $model->update();
     }

    public function actionViewVacancy($id)
    {
      $models  = $this->findModel($id);
      $model  = new Tickets;
      $query = Tickets::find()->where(['id' => $id])->orWhere(['tickets_id'=>$id]);

      $dataProvider = new ActiveDataProvider([
          'query' => $query,
          'pagination' => [
              'pageSize' => 6,
            ],
          ]);
      $request = \Yii::$app->getRequest();
      if ($request->isAjax && $model->load($request->post())) {
        Yii::$app->response->format = yii\web\Response::FORMAT_JSON;
        return ActiveForm::validate($model);
      }
      // General use
      if ($model->load($request->post())) {
        $model->admin_id = $models->admin_id;
        $model->admin_name = $models->admin_name;
        $model->user_id = $models->user_id;
        $model->subject = $models->subject;
        $model->user_name = $models->user_name;
        $model->tickets_id = $models->id;
        $model->agency_id = 0;
        $model->vacancy_id = $models->vacancy_id;
        $model->viewed_admin = $models->viewed_admin;
        $model->viewed_user = $models->viewed_user;
        $model->date = date('Y-m-d');
        $model->time = date('H:i:s');
        $model->users = 1;
        $model->save();
        return $this->redirect(['index']);
      } else {
        return $this->renderAjax('view-vacancy', [
          'dataProvider'=>$dataProvider,
          'model' => $model,
          'models' => $models,
        ]);
      }
    }

    public function actionCloseTicketsVacancy($id)
    {
        $model = $this->findModel($id);
        $model->status = '3';
        $model->update();
        $this->WorkerVacancy(['id'=>$model->vacancy_id]);
        return $this->redirect(['index']);
    }

    public function WorkerVacancy($id)
    {   $model = Vacancy::findOne(['id'=>$id]);
        $model->status = '4';
        $model->update();
    }
    /**
     * Deletes an existing Tickets model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the Tickets model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Tickets the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Tickets::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
