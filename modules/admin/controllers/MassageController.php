<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\crm\Massage;
use app\models\crm\search\Massage as MassageSearch;
use app\models\crm\search\MassageViews;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MassageController implements the CRUD actions for Massage model.
 */
class MassageController extends Controller
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
     * Lists all Massage models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MassageSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Massage model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
      $new_model = new Massage();
      $model = $this->findModel($id);
      if ($new_model->load(Yii::$app->request->post()))
        {
          $new_model->admin_id = $model->admin_id;
          $new_model->admin_name = $model->admin_name;
          $new_model->user_id = $model->user_id;
          $new_model->user_name = $model->user_name;
          $new_model->subject = $model->subject;
          $new_model->tickets_id = $model->tickets_id;
          $new_model->viewed_admin = 1;
          $new_model->viewed_user = 0;
          $new_model->date = date('Y-m-d');
          $new_model->time = date('H:i:s');
          if ($model->massage_id == 0) {
            $new_model->massage_id = $model->id;
          }else {
            $new_model->massage_id = $model->massage_id;
          }
          $new_model->users = 1;
          $new_model->save();
          if ($new_model->save()) {
            $this->refresh(); 
            $new_model= new Massage();
          }
        }
      $searchModel = new MassageViews();
      $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$id);
        return $this->render('view', [
            'dataProvider' => $dataProvider,
            'model' => $model,
            'new_model'=>$new_model,
        ]);
    }

    /**
     * Creates a new Massage model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Massage();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Massage model.
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
     * Deletes an existing Massage model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        $this->DellAllMassage($id);
        return $this->redirect(['index']);
    }

    public function DellAllMassage($id)
    {
        $models = Massage::find()->where(['massage_id'=>$id])->all();
        foreach ($models as $model) {
        $model->delete();
        }
        return false;
    }

    /**
     * Finds the Massage model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Massage the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Massage::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
