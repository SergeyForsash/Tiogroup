<?php

namespace app\modules\agency\controllers;

use Yii;
use app\models\crm\Vacancy;
use app\models\crm\search\VacancyAgency;
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
        $searchModel = new VacancyAgency();
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
      $query = Worker::find()->where(['vacancy_id'=>$id,'created_by'=>Yii::$app->user->id])
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
