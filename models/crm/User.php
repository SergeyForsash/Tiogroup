<?php

namespace app\models\crm;

use Yii;
use yii\helpers\ArrayHelper;
use mdm\admin\models\User as UserModel;
use app\models\admin\Company;
use app\models\admin\Partner;
use app\models\crm\Worker;
class User extends UserModel

{
  public function attributeLabels()
  {
      return [
          'id' => 'ID',
          'username' => Yii::t('app', 'user_id_p'),
          'password' => Yii::t('app', 'Pass'),
      ];
  }

  public function getUsersC()
  {
    $models = User::find()->where(['type'=> '1'])->all();
    $date =ArrayHelper::map($models,'id','username');
        return $date;
  }
  public function getUsersP()
  {
    $models = User::find()->where(['type'=> '2'])->all();
    $date =ArrayHelper::map($models,'id','username');
        return $date;
  }
  public function getUsersW()
  {
    $models = User::find()->where(['type'=> '3'])->all();
    $date =ArrayHelper::map($models,'id','username');
        return $date;
  }
  public function getUserName($id)
  {
    $model = User::find()->where(['id'=> $id])->one();
    if($model->type == 0) {
      $data = $model->username;
    }elseif($model->type == 1) {
      $users = Company::findOne(['user_id'=> $id]);
      if ($users == null) {
        $data = $model->username;
      }else {
        $data = Company::find()->where(['user_id'=> $id])->one()->firm_name;
      }
    }elseif($model->type == 2) {
      $users = Partner::findOne(['user_id'=> $id]);
      if ($users == null) {
        $data =  $model->username;
      }else {
        $data = Partner::find()->where(['user_id'=> $id])->one()->agency_name;
      }
    }else{
      $users = Worker::findOne(['user_id'=> $id]);
      if ($users == null) {
        $data =  $model->username;
      }else {
        $data = Worker::find()->where(['user_id'=> $id])->one()->full_name;
      }
    }
    return $data;
  }
  public function getUserDate($id)
  {
    $model = User::find()->where(['id'=> $id])->one();
    $data = Yii::$app->formatter->asDatetime($model->created_at, "php:d.m.Y");
    return $data;
  }
  public function getUserLogin($id)
  {
    $model = User::find()->where(['id'=> $id])->one();
    $data = $model->username;
    return $data;
  }
  public function getUserType($id)
  {
    $model = User::find()->where(['id'=> $id])->one();
    if($model->type == 0) {
      $data = Yii::t('app', 'admin');
    }elseif($model->type == 1) {
      $data = Yii::t('app', 'employer');
    }elseif($model->type == 2) {
      $data = Yii::t('app', 'agency');
    }else{
      $data = Yii::t('app', 'workers');
    }
  return $data;
  }
  public function getType($id)
  {
    $model = User::find()->where(['id'=> $id])->one();
    if (Yii::$app->user->isGuest ) {

    }else {
      $data = $model->type;
      //$item= 'Admin';
      //return $item;
      return $data;
    }

  }

}
