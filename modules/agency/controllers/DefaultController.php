<?php

namespace app\modules\agency\controllers;

use Yii;
use yii\web\Controller;
use app\models\crm\User;
use app\models\admin\Partner;
use app\models\crm\Change;
use yii\data\ActiveDataProvider;
/**
 * Default controller for the `agency` module
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
      $model = Partner::findOne(['user_id'=>Yii::$app->user->id]);
      $query = Partner::findOne(['user_id'=>Yii::$app->user->id]);
      if ($model == null) {
        return $this->redirect(['default/create']);
      }else {
        $dataProvider = new ActiveDataProvider([
           'query' => $query,
       ]);
         return $this->render('profile', [
             'model' => $model,
             'dataProvider' => $dataProvider
         ]);

      }

    }
    /**
     * Creates a new Partner model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $users = User::findOne(['id'=>Yii::$app->user->id]);
        $model = new Partner();

        if ( $users->load(Yii::$app->getRequest()->post()) && $model->load(Yii::$app->request->post())) {
          if ($user = $users->signup()) {

              $user_id = User::findOne(['username' => $users->username])->id;
              $model->user_id = $user_id;
              $model->email = $users->email;
              $docers = $model;
              $model->upload($docers);
              $model->save();
              if ($model->save()) {
              }else{
                $user = User::findOne(['id' => $model->user_id]);
                $user->delete();
              }
              return $this->redirect(['index']);

          }else{
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
     * Updates an existing Partner model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate()
    {
        $model = Partner::findOne(['user_id'=>Yii::$app->user->id]);
        $users = User::findOne(['id' => $model->user_id]);
        if ($model->load(Yii::$app->request->post())) {
          $docers = $model;
          $model->upload($docers);
          $model->save();
            return $this->redirect(['/agency/profile']);
        } else {
            return $this->render('update', [
                'model' => $model,
                'users'=>$users,
            ]);
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

    public function actionHistory()
    {
        return $this->render('history');
    }

    public function actionVacancy()
    {
        return $this->render('vacancy');
    }
}
