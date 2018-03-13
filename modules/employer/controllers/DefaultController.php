<?php

namespace app\modules\employer\controllers;

use Yii;
use yii\web\Controller;
use app\models\crm\User;
use app\models\crm\Change;
use app\models\admin\Company;
/**
 * Default controller for the `employer` module
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
      $model = Company::findOne(['user_id'=>Yii::$app->user->id]);
      $users = User::findOne(['id'=>Yii::$app->user->id]);
      if ($model == null) {
        return $this->redirect(['default/create']);
      }else {
        return $this->render('profile',[
            'model' => $model,
            'users'=>$users,
        ]);
      }

    }

    /**
     * Creates a new Company model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
      $users = User::findOne(['id'=>Yii::$app->user->id]);
      $model = new Company();

      if ( $users->load(Yii::$app->getRequest()->post()) && $model->load(Yii::$app->request->post())) {
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
        return $this->redirect(['/employer/profile']);
      } else {
          return $this->render('create', [
              'model' => $model,
              'users'=> $users,
          ]);
      }
    }

    /**
     * Updates an existing Company model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
      $model = Company::findOne(['user_id'=>Yii::$app->user->id]);
      $users = User::findOne(['id'=>Yii::$app->user->id]);
      if ($model->load(Yii::$app->request->post())) {
        $docers = $model;
        $model->upload($docers);
        $model->save();
          return $this->redirect(['/employer/profile']);
      } else {
          return $this->render('update', [
              'model' => $model,
              'users'=>$users,
          ]);
      }
    }

    public function actionHistory()
    {
        return $this->render('history');
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
