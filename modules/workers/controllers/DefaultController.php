<?php

namespace app\modules\workers\controllers;

use yii;
use yii\web\Controller;
use app\models\crm\Worker;
use app\models\crm\User;
use app\models\crm\Change;
use app\models\crm\Vacancy;
use app\models\crm\VacancyWorker;
/**
 * Default controller for the `workers` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionProfile()
    {
      $users = User::findOne(['id'=>Yii::$app->user->id]);
      $model = Worker::findOne(['user_id'=>Yii::$app->user->id]);
      if ($model == null) {
        return $this->redirect(['default/create']);
      }else {
        return $this->render('profile',[
          'model'=>$model,
          'users'=> $users,
        ]);
      }


    }

    public function actionHistory()
    {
        return $this->render('history');
    }
    public function actionStatuse($id){
        $model = Worker::findOne(['user_id'=>Yii::$app->user->id]);
        $model->statusarchive = $id;
        $model->update();
    }
    /**
     * Creates a new Worker model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
     public function actionCreate()
     {
       $users = User::findOne(['id'=>Yii::$app->user->id]);
       $model = new Worker();
       if ( $users->load(Yii::$app->getRequest()->post()) && $model->load(Yii::$app->request->post())) {
         $user_id = User::findOne(['username' => $users->username])->id;
         $model->user_id = $user_id;
         $model->created_at = date('Y-m-d');
         $model->updated_at = null;
         $model->created_by = '66';
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
           //return var_dump($model);
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
     public function actionUpdate()
     {
       $model = Worker::findOne(['user_id' => Yii::$app->user->identity->id]);
       $users = User::findOne(['id' => Yii::$app->user->identity->id]);
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
         $model->update();
         // return var_dump($model);
         return $this->redirect(['default/profile']);
       } else {
         //return var_dump($model);
           return $this->render('update', [
               'model' => $model,
               'users'=>$users,
           ]);
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
    /**
     * Reset password
     * @return string
     */
    public function actionChangePassword()
    {
        $model = new Change();
        if ($model->load(Yii::$app->getRequest()->post()) && $model->change()) {
            return $this->goHome();
        }

        return $this->render('change-password', [
                'model' => $model,
        ]);
    }
}
