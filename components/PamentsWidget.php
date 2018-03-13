<?php
namespace app\components;
use Yii;
use yii\base\Widget;
use app\models\crm\Payments;
use app\models\crm\Worker;
use app\models\crm\Vacancy;
use app\models\crm\search\Payments as PaymentsSearch;
use yii\data\ActiveDataProvider;

class PamentsWidget extends Widget
{
   public $message;

   public function init()
  {
    parent::init();

  }

  public function run()
 {
   $user_id = $this->message;
   $worker = Worker::find()->where(['id'=>$user_id])->one();
   $status= $worker->statusarchive;
   $vacancy = Vacancy::findOne(['id'=>$worker->vacancy_id]);
   if (!empty($vacancy)) {
     $vac = $vacancy->title;
     $vac_pl = $vacancy->title_pl;
     $vacancy_id = $vacancy->company_id;
   }else{
     $vac = 'none';
     $vac_pl = 'none';
     $vacancy_id = 'none';
   }
   $model = new Payments();
   if ($model->load(Yii::$app->request->post()))
   {
       $payments = Payments::find()->where([
         'user_id'=>$user_id,
         'month_id'=>$model->month_id,
         'vacancy_name'=>$model->vacancy_name,
         'hours'=>$model->hours,
         'rate'=>$model->rate,
         ])->one();
       if (empty($payments)){
          $model->save();
          $model = new Payments();
      }else{
        Yii::$app->session->setFlash('info', Yii::t('app', 'Already exists such an account'));
        $model = new Payments();
      }
   }
   $searchModel = new PaymentsSearch();
   $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$user_id);
   return $this->render('index', [
       'searchModel' => $searchModel,
       'dataProvider' => $dataProvider,
       'model' => $model,
       'user_id'=>$user_id,
       'vacancy'=>$vac,
       'vacancy_pl'=>$vac_pl,
       'status'=> $status,
       'company_id'=>$vacancy_id,
   ]);
 }
}
