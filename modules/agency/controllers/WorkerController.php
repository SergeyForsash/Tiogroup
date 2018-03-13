<?php

namespace app\modules\agency\controllers;

use Yii;
use app\models\crm\Worker;
use app\models\crm\VacancyWorker;
use app\models\crm\Vacancy;
use app\models\admin\Profession;
use app\models\crm\search\WorkerAgency;
use yii\web\Controller;
use app\models\crm\Signup;
use app\models\crm\User;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
/**
 * WorkerController implements the CRUD actions for Worker model.
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

        $searchModel = new WorkerAgency();
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
     * Creates a new Worker model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
     public function actionCreate()
     {
       $users = new Signup();
       $model = new Worker();
       if ( $users->load(Yii::$app->getRequest()->post()) && $model->load(Yii::$app->request->post())) {
         if ($user = $users->signup()) {
             $user_id = User::findOne(['username' => $users->username])->id;
             $model->user_id = $user_id;
             $model->created_at = date('Y-m-d');
             $model->updated_at = null;
             $model->created_by = Yii::$app->user->id;
             $model->email = $users->email;
             if ($model->vacancy_id == 0) {
                  $model->statusarchive = '1';
                  $model->vacancy_id = '0';
               }else{
                 $model->statusarchive = '2';
                 $vac_wor = new VacancyWorker;
                 $vac_wor->vacancy_id = $model->vacancy_id;
                 $vac_wor->worker_id = $model->id;
                 $vac_wor->save();
                 $wid = $model->vacancy_id;
                 $this->addWorker($wid);
               }
            if ($model->specialisation == 11) {
                $model->profession = null ;
            }else{
                if (!empty($model->profession)) {
                  $profession = implode(';', $model->profession);
                  $model->profession = $profession ;
                }else {
                 $model->profession = null ;
                }
              }
            if ($model->driver_license == 1) {
               if (!empty($model->driver_category)) {
                   $driver_category = implode(';', $model->driver_category);
                   $model->driver_category = $driver_category;
               }else {
                  $model->driver_category = null;
                 }
            }else{
                $model->driver_category = null;
            }
             $docers = $model;
             $model->upload($docers);
             $model->save();
             if($model->save()) {
               return $this->redirect(['index']);
             }else{
               $user = User::findOne(['id' => $model->user_id]);
               $user->delete();
               return var_dump($model);
               return $this->render('create', [
                   'model' => $model,
                   'users'=> $users,
               ]);
             }
         }else{
           //return  var_dump($users,$model);
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
     * Updates an existing Worker model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
      $model = $this->findModel($id);
      $users = User::findOne(['id' => $model->user_id]);
    if ($model->load(Yii::$app->request->post())) {
        if ($model->specialisation == 11) {
         $model->profession = null ;
        }else{
          if (!empty($model->profession)) {
            $profession = implode(';', $model->profession);
            $model->profession = $profession ;
          }else {
           $model->profession = null ;
          }
        }
        if ($model->driver_license == 1) {
          if (!empty($model->driver_category)) {
            $driver_category = implode(';', $model->driver_category);
            $model->driver_category = $driver_category;
          }else {
           $model->driver_category = null;
          }
        }else{
         $model->driver_category = null;
        }
        if (empty($model->vacancy_id)) {
           $model->vacancy_id = '0';
        }
        if ($model->vacancy_id > 0 ) {
          $vacwor = VacancyWorker::findOne(['worker_id'=>$model->id]);
          if (empty($vacwor)) {
            $model->statusarchive = 2;
            $vac_wor = new VacancyWorker;
            $vac_wor->vacancy_id = $model->vacancy_id;
            $vac_wor->worker_id = $model->id;
            $vac_wor->save();
            $wid = $model->vacancy_id;
            $this->addWorker($wid);
          }else{
            $vacwor->vacancy_id = $model->vacancy_id;
            $vacwor->worker_id = $model->id;
            $vacwor->update();
          }
        }
        $docers = $model;
        $model->upload($docers);
        $model->updated_at = date('Y-m-d');
        $model->update();
        // return var_dump($model);
        return $this->redirect(['index']);
      } else {
        //return var_dump($model);
          return $this->render('update', [
              'model' => $model,
              'users'=>$users,
          ]);
      }
    }

    /**
     * Deletes an existing Worker model.
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
     * Finds the Worker model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Worker the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
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
            if($model){
                $model->statusarchive = $_POST['statusarchive'];
                $model->save(false);
                if ($_POST['statusarchive'] == 4) {
                  $wid = $model->vacancy_id;
                  $this->Agreed($wid);
                }
            }
        }
    }

    public function addWorker($wid)
    {
        $model = Vacancy::findOne(['id'=>$wid]);
        $model->work_add = $model->work_add + '1';
        $model->update();
        $this->statusWorker($wid);
    }
    public function statusWorker($wid)
    {
        $model = Vacancy::findOne(['id'=>$wid]);
        if ($model->worker == $model->work_add ) {
          $model->work_status = '100';
          $model->update();
        }else{
          $model->work_status = '0';
          $model->update();
        }

    }
    public function actionDelDoc($id,$type = null)
    {
      $model = Worker::findOne(['id' =>$id]);
      if ($type==1) {
        $file= substr($model->pass_scan, 1);
        unlink($file);
        $model->pass_scan = null;
        $model->update();
        return true;
      }elseif($type==2) {
        $file= substr($model->visa_scan, 1);
        unlink($file);
        $model->visa_scan = null;
        $model->update();
        return true;
      }
      elseif ($type==3) {
        $file= substr($model->resume, 1);
        unlink($file);
        $model->resume = null;
        $model->update();
        return true;
      }elseif ($type==4) {
        $file= substr($model->addition_certificate, 1);
        unlink($file);
        $model->addition_certificate = null;
        $model->update();
        return true;
      }elseif($type == 5) {
        $file= substr($model->image, 1);
        unlink($file);
        $model->image = null;
        $model->update();
        return true;
      }else {
        return 'Ошибка  удаления';
      }

    }
    public function actionProfList($id)
    {
      $countPoints= Profession::find()
              ->where(['spec_id' => $id])
              ->count();

      $points_cat = Profession::find()
              ->where(['spec_id' => $id])
              ->orderBy('id ASC')
              ->all();

      if($countPoints>0){

          foreach($points_cat as $points){
          echo "<div class='checkbox'><label><input type='checkbox' name='Worker[profession][]' value=".$points->id." >".$points->title."</label></div>";
          }
      }
      else{
          echo "В даной  спецеализации пока нет професий";
      }
    }
}
