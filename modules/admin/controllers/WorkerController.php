<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\crm\Worker;
use app\models\admin\DocWorker;
use app\models\crm\VacancyWorker;
use app\models\crm\search\WorkerAdmin;
use app\models\crm\search\WorkerSearch;
use app\models\crm\Payments;
use app\models\crm\search\Payments as PaymentsSearch;
use app\models\crm\Vacancy;
use app\models\admin\Partner;
use app\models\admin\Profession;
use yii\web\Controller;
use app\models\crm\User;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use app\models\crm\Massage;
use app\models\crm\Tickets;
use yii\widgets\ActiveForm;
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
        $searchModel = new WorkerAdmin();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionOld()
    {
        $searchModel = new WorkerSearch();
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
      return $this->redirect(['index']);
     }


     public function actionUpdate($id)
     {
       $model = $this->findModel($id);
       $scan = $this->findModel($id);
       $docers = $model;
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
         if ($model->vacancy_id > 0) {
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
         $model->save();
         return $this->redirect(['index']);
       }else {
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
              $wid = $model->vacancy_id;
              if($_POST['statusarchive'] == 10) {
                $model->statusarchive = 1;
                $model->vacancy_id = 0;
                $model->date_agreeded = NULL;
                $model->date_start = NULL;
                $model->date_finish = date('Y-m-d');
                $model->save(false);
                $this->Dismissed($wid);
              }elseif($_POST['statusarchive'] == 7) {
                $model->date_start = date('Y-m-d');
                $model->statusarchive = $_POST['statusarchive'];
                $model->save(false);
              }else {
                $model->statusarchive = $_POST['statusarchive'];
                $model->save(false);
              }
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
        $model->work_add =$model->work_add + '1';
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
    public function Dismissed($wid)
    {
        $model = VacancyWorker::findOne(['vacancy_id'=>$wid]);
        $model->delete();
    }
    public function Agreed($wid)
    {
      $model = Vacancy::findOne(['id'=>$wid]);
      $model->agreed = $model->agreed + '1';
      $model->update();
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
      }elseif($type == 6) {
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

    public function actionMassag($id)
      {
        $user = Worker::findOne(['id'=>$id]);
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
          $model->user_name = $user->full_name;
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
            Yii::$app->session->addFlash('success',Yii::t('app', 'massag_app').' '.$user->full_name),
          ]);
        } else {
          return $this->renderAjax('massage', [
            'model' => $model,
            'user' => $user,
          ]);
        }
      }
      public function actionTicket($id)
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
              'users'=>$users
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

}
