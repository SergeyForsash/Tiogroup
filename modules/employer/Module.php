<?php

namespace app\modules\employer;

use Yii;
use app\models\crm\User;
/**
 * employer module definition class
 */
class Module extends \yii\base\Module
{
      public function beforeAction($action)
      {
          $type = User::getType(['id'=>Yii::$app->user->id]);
          if (!parent::beforeAction($action))
          {
              return false;
          }
          if ($type == 1)
          {
              return true;
          }
          else
          {
              Yii::$app->getResponse()->redirect(Yii::$app->getHomeUrl());
              //для перестраховки вернем false
              return false;
          }
      }
    /**
     * @inheritdoc
     */
    public $layout ='/admin';
    public $controllerNamespace = 'app\modules\employer\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        \Yii::$app->language = 'pl';
         //$this->registerTranslations();
    }

}
