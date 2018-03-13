<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\crm\LoginForm as Login;
use app\models\crm\Signup;
use app\models\crm\ContactForm;
use app\models\crm\User;
use app\models\crm\PasswordReset;
use app\models\crm\Reset;
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
      return [
           'access' => [
               'class' => AccessControl::className(),
               'rules' => [
                   [
                       'actions' => ['error'],
                       'allow' => true,
                   ],
                   [
                       'actions' => ['index'],
                       'allow' => true,
                       'roles' => ['@'],
                   ],
               ],
           ],
       ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {

      if (!Yii::$app->getUser()->isGuest) {
        $type = User::getType(['id'=>Yii::$app->user->id]);
        if($type == 1) {
          return $this->redirect('/employer');
        }elseif($type == 2) {
          return $this->redirect('/agency');
        }elseif($type == 3){
          return $this->redirect('/workers');
        }else{
          return $this->redirect('/admin');
        }
      }else{
        return $this->redirect('/login');
      }

    }


    /**
     * Signup new user
     * @return string
     */
    public function actionSignup($lang = null)
    {
      if ($lang == 'en') {
        Yii::$app->language = 'en';
      }elseif ($lang == 'pl') {
        Yii::$app->language = 'pl';
      }
        $model = new Signup();
        if ($model->load(Yii::$app->getRequest()->post())) {
            if ($user = $model->signup()) {
              Yii::$app->getSession()->setFlash('success',
              Yii::t('app', 'Now you can log in using')
              .'<br>'.
              Yii::t('app', 'Your login and password.'));
              if ($lang == 'en') {
                return $this->redirect('/login?lang=en');
              }elseif ($lang == 'pl') {
                return $this->redirect('/login?lang=pl');
              }else {
                return $this->redirect('/login');
              }
            }
        }

        return $this->render('signup', [
                'model' => $model,
        ]);
    }
    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Request reset password
     * @return string
     */
    public function actionRequestPasswordReset($lang = null)
    {
        $model = new PasswordReset();
        if ($lang == 'en') {
          Yii::$app->language = 'en';
        }elseif ($lang == 'pl') {
          Yii::$app->language = 'pl';
        }
        if ($model->load(Yii::$app->getRequest()->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Check your email for further instructions.'));
                if ($lang == 'en') {
                  return $this->redirect('/login?lang=en');
                }elseif ($lang == 'pl') {
                  return $this->redirect('/login?lang=pl');
                }else {
                  return $this->redirect('/login');
                }
            } else {
                Yii::$app->getSession()->setFlash('error', Yii::t('app', 'Sorry, we are unable to reset password for email provided.'));
            }
        }

        return $this->render('requestPasswordResetToken', [
                'model' => $model,
        ]);
    }

    /**
     * Reset password
     * @return string
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new Reset($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->getRequest()->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->getSession()->setFlash('success', 'New password was saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
                'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
