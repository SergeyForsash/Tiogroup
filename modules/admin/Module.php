<?php

namespace app\modules\admin;

use Yii;
use app\models\crm\User;

/**
 * admin module definition class
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

        if ($type == 0)
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
    public $controllerNamespace = 'app\modules\admin\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        \Yii::$app->language = 'ru';
        // custom initialization code goes here
    }
}
