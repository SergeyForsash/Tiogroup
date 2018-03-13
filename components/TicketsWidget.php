<?php
namespace app\components;
use Yii;
use yii\base\Widget;
use yii\data\ActiveDataProvider;
use app\models\crm\Tickets;
use app\models\crm\User;
class TicketsWidget extends Widget
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
      $query = Tickets::find()->where(['viewed_admin'=>0])->orWhere(['=','status','2']);
    }elseif ($type == 2) {
      $query = Tickets::find()->where(['agency_id'=>Yii::$app->user->id])->andWhere(['<','status','3']);
    }elseif ($type == 3) {
      $query = Tickets::find()->where(['user_id'=>Yii::$app->user->id])->andWhere(['<','status','3']);
    }
    else{
      $query = Tickets::find()->where(['user_id'=>Yii::$app->user->id])->andWhere(['<','status','3']);
    }
    $dataProvider = new ActiveDataProvider([
       'query' => $query,
   ]);
    return $this->render('tickets', [
      'dataProvider' => $dataProvider,
   ]);
 }
}
