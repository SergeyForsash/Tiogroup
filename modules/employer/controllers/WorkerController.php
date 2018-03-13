<?php

namespace app\modules\employer\controllers;

use Yii;
use app\models\crm\Worker;
use app\models\crm\search\WorkerEmploer;
use app\models\crm\Vacancy;
use app\models\crm\VacancyWorker;
use yii\web\Controller;
use app\models\crm\Signup;
use app\models\crm\User;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
/**
 * WorkerController implements the CRUD actions for employer model.
 */
class WorkerController extends Controller
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
     * Lists all Worker models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new WorkerEmploer();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Worker model.
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
     * Updates an existing Worker model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
     public function actionUpdate($id)
     {
       $model = $this->findModel($id);
     if ($model->load(Yii::$app->request->post())) {
         $docers = $model;
         $model->upload($docers);
         $model->updated_at = date('Y-m-d');
         $model->save();
         // return var_dump($model);
         return $this->redirect(['index']);
       } else {
         //return var_dump($model);
           return $this->render('update', [
               'model' => $model,
           ]);
       }
     }

    protected function findModel($id)
    {
        if (($model = Worker::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionStatuse(){
        if(Yii::$app->request->isAjax){

            $model = Worker::find()->where(['id' => $_POST['worker_id']])->one();
            $wid = $model->vacancy_id;
            if($model){
              $wid = $model->vacancy_id;
              if($_POST['statusarchive'] == 100) {
                $model->statusarchive = 1;
                $model->vacancy_id = 0;
                $model->save(false);
                $this->addWorker($wid);
              }elseif($_POST['statusarchive'] == 5) {
                $model->date_agreeded = date('Y-m-d');
                $model->statusarchive = $_POST['statusarchive'];
                $model->save(false);
              }else {
                $model->statusarchive = $_POST['statusarchive'];
                $model->save(false);
              }

            }


        }
    }

    public function addWorker($wid)
    {
        $model = Vacancy::findOne(['id'=>$wid]);
        $model->work_add = $model->work_add - '1';
        $model->update();
        $this->Dismissed($wid);

    }
    public function Dismissed($wid)
    {
        $model = VacancyWorker::findOne(['vacancy_id'=>$wid]);
        $model->delete();
    }
    public function actionDelDoc($id,$type = null)
    {
      $model = Worker::findOne(['id' =>$id]);
      if($type == 6) {
        $file= substr($model->medical_board, 1);
        unlink($file);
        $model->medical_board = null;
        $model->update();
        return true;
      }elseif($type == 7) {
        $file= substr($model->insurance, 1);
        unlink($file);
        $model->insurance = null;
        $model->update();
        return true;
      }else {
        return 'Ошибка  удаления';
      }
    }
}
