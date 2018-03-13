<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\web\Controller;
use app\models\crm\Signup;
use app\models\crm\Change;
use app\models\crm\User;
use app\models\crm\Massage;
use yii\widgets\ActiveForm;
use app\models\admin\Partner;
use app\models\admin\Company;
use app\models\crm\Worker;
/**
 * Default controller for the `admin` module
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
    public function actionFmanager()
    {
        return $this->render('fmanager');
    }
    /**
     * Signup new user
     * @return string
     */
    public function actionSignup()
    {
        $model = new Signup();
        if ($model->load(Yii::$app->getRequest()->post())) {
            if ($user = $model->signup()) {
                return $this->goHome();
            }
        }

        return $this->render('signup', [
                'model' => $model,
        ]);
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

    public function actionTest($id)
      {
      return $this->render('index');
      }
    public function actionPmassage($id)
      {
        $user = Partner::findOne(['id'=>$id]);
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
          $model->user_name = $user->agency_name;
          $model->tickets_id = 0;
          $model->viewed_admin = 1;
          $model->viewed_user = 0;
          $model->date = date('Y-m-d');
          $model->time = date('H:i:s');
          $model->massage_id = 0;
          $model->users = 1;
          $model->save();
          return $this->redirect([
            '/admin/partner',
            Yii::$app->session->addFlash('success',Yii::t('app', 'massag_app').' '.$user->agency_name),
          ]);
        } else {
          return $this->renderAjax('massage-p', [
            'model' => $model,
            'user' => $user,
          ]);
        }
      }

      public function actionCmassage($id)
        {
          $user = Company::findOne(['id'=>$id]);
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
            $model->user_name = $user->firm_name;
            $model->tickets_id = 0;
            $model->viewed_admin = 1;
            $model->viewed_user = 0;
            $model->date = date('Y-m-d');
            $model->time = date('H:i:s');
            $model->massage_id = 0;
            $model->users = 1;
            $model->save();
            return $this->redirect([
              '/admin/company',
              Yii::$app->session->addFlash('success',Yii::t('app', 'massag_app').' '.$user->firm_name),
            ]);
          } else {
            return $this->renderAjax('massage-c', [
              'model' => $model,
              'user' => $user,
            ]);
          }
        }
  public function actionWmassage($id)
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
                '/admin/worker/old',
                Yii::$app->session->addFlash('success',Yii::t('app', 'massag_app').' '.$user->full_name),
              ]);
            } else {
              return $this->renderAjax('massage-w', [
                'model' => $model,
                'user' => $user,
              ]);
            }
          }


}
