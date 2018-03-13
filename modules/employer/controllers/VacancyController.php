<?php

namespace app\modules\employer\controllers;

use Yii;
use app\models\crm\Vacancy;
use app\models\crm\search\VacancyEmploeyr;
use app\models\crm\Worker;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;

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
        $searchModel = new VacancyEmploeyr();
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
      $query = Worker::find()->where(['vacancy_id'=>$id])
              ->andWhere(['>=','statusarchive','4'])
              ->andWhere(['<','statusarchive','100']);
      $dataProvider = new ActiveDataProvider([
         'query' => $query,
     ]);
       return $this->render('view', [
           'model' => $this->findModel($id),
           'dataProvider' => $dataProvider
       ]);
    }

    /**
     * Creates a new Vacancy model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Vacancy();

        if ($model->load(Yii::$app->request->post())) {
              if ($model->driver_license == 1) {
               $driver_id= implode(';', $model->driver_id);
               $model->driver_id = $driver_id;
             }else{
               $model->driver_id = null;
             }
            $model->title = 'need translation';
            $model->duties = 'need translation';
            $model->description = 'need translation';
            $model->practice = 'need translation';
            $model->other_expenses = 'need translation';
            $model->company_id = Yii::$app->user->id;
            $model->date_create = date('Y-m-d');
            $docers = $model;
            $model->upload($docers);
            $model->save();
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
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
           $model->date_update = date('Y-m-d');
           if (empty($model->image)) {
             $model->image = $docers->image;
           }
           $model->upload($docers);
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
}
