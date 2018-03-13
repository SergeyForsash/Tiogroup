<?php

namespace app\modules\workers\controllers;

use Yii;
use app\models\crm\Payments;
use app\models\crm\Worker;
use app\models\crm\Vacancy;
use app\models\crm\search\Payments as PaymentsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PaymentsController implements the CRUD actions for Payments model.
 */
class PaymentsController extends Controller
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
     * Lists all Payments models.
     * @return mixed
     */
    public function actionIndex()
    {

        $user = Yii::$app->user->id;
        $worker = Worker::find()->where(['user_id'=>$user])->one();
        $status= $worker->statusarchive;
        $user_id = $worker->id;
        $vacancy = Vacancy::findOne(['id'=>$worker->vacancy_id]);
        if (!empty($vacancy)) {
          $vac = $vacancy->title;
          $vac_pl = $vacancy->title_pl;
        }else{
          $vac = 'none';
          $vac_pl = 'none';
        }
        $model = new Payments();
        if ($model->load(Yii::$app->request->post()))
        {
            $payments = Payments::find()->where([
              'user_id'=>$user_id,
              'month_id'=>$model->month_id,
              'vacancy_name'=>$model->vacancy_name,
              'hours'=>$model->hours,
              'rate'=>$model->rate,
              ])->one();
            if (empty($payments)){
               $model->save();
               $model = new Payments();
           }else{
             Yii::$app->session->setFlash('info', Yii::t('app', 'Already exists such an account'));
             $model = new Payments();
           }
        }
        $searchModel = new PaymentsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$user_id);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,
            'user_id'=>$user_id,
            'vacancy'=>$vac,
            'vacancy_pl'=>$vac_pl,
            'status'=> $status,
            'company_id'=>$vacancy->company_id,
        ]);
    }

    /**
     * Creates a new Payments model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Payments();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Payments model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
      $model = $this->findModel($id);

      if ($model->status_id >= 2) {
        return $this->redirect(['index']);
      }else {
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }else{
            return $this->render('update', [
                'model' => $model,
            ]);
        }
      }
    }

  /**
     * Finds the Payments model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Payments the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Payments::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionStatuse(){
        if(Yii::$app->request->isAjax){
            $model = Payments::find()->where(['id' => $_POST['id']])->one();
            if($model){
              $model->status_id = $_POST['status_id'];
              $model->save(false);
            }
        }
    }
}
