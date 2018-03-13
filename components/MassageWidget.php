<?php
namespace app\components;
use Yii;
use yii\base\Widget;
use yii\data\ActiveDataProvider;
use app\models\crm\Massage;
use app\models\crm\User;
class MassageWidget extends Widget
{
   public function init()
  {
    parent::init();

  }

  public function run()
 {
    $users = User::find()->where(['id'=> Yii::$app->user->id])->one();
    $type = $users->type;
    if($type == 0) {
      $query = Massage::find()->where(['viewed_admin'=>0]);
    }else{
      $query = Massage::find()->where(['viewed_user'=>0,'user_id'=>Yii::$app->user->id]);
    }
    $dataProvider = new ActiveDataProvider([
       'query' => $query,
   ]);
    return $this->render('massages', [
      'dataProvider' => $dataProvider,
   ]);
 }
}
