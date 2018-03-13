<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\crm\search\Massage */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Сообщения';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="massage">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
<?php Pjax::begin(['id' => 'list-massage']) ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//      'filterModel' => $searchModel,
        'tableOptions' => [
            'class' => 'table table-normal'
        ],
        'columns' => [
            [
              'attribute' => 'id',
              'label'=>'',
              'format' => 'raw',
              'options' => ['style' => 'width: 100px; max-width: 100px;'],
              'contentOptions' => ['style' => 'width: 100px; max-width: 100px;','class'=>'vertical hidden-xs'],
              'value' => function($data){
                $url='/admin/massage/view?id='.$data->id;
                $user_img = '<img src="/uploads/user.png" class="img-circle" alt="User Image" style="
                   width: 50px;">';
                $item = Html::a($user_img, $url,['class'=>'massage-view-url']);
                return $item;
                }
            ],
            //'admin_id',
            //'admin_name',
            //'user_id',

            [
              'attribute' => 'user_name',
              'label'=>'Отправитель',
              'format' => 'raw',
              'options' => ['style' => 'width: 150px; max-width: 150px;'],
              'contentOptions' => ['style' => 'width: 150px; max-width: 150px; vertical-align: top;'],
              'value' => function($data){
                $url='/admin/massage/view?id='.$data->id;
                $type = '<span class="label label-info" style="margin-top:2px">'
                .app\models\crm\User::getUserType(['id'=>$data->user_id]).
                ' </span>';
                $item =Html::a($data->user_name, $url,['class'=>'massage-view-url']).'<br>'.$type;
                return $item;
                }
            ],
            [
              'attribute' => 'id',
              'label'=>'',
              'contentOptions' => ['style' => 'width: 100px; max-width: 100px;'],
              'content'=>function($data){
                $viewed = app\models\crm\Massage::find()->where(['id'=>$data->id])->one();
                $vieweds_n = app\models\crm\Massage::find()->where(['massage_id'=>$data->id])->all();
                $new_m = app\models\crm\Massage::find()->where(['id'=>$data->id,'viewed_admin'=>0])->all();
                $new_m2 = app\models\crm\Massage::find()->where(['massage_id'=>$data->id,'viewed_admin'=>0])->all();
                $v=$viewed->viewed_user;
                  if (!empty($vieweds_n)) {
                  $viewed_n = array_column($vieweds_n, 'viewed_user');
                  $v_n=min($viewed_n);
                }else {
                  $v_n='1';
                }
                if ($v == 0)  {
                  $item = '<img src="/uploads/mail.png" alt="" width="16" height="16" data-toggle="tooltip" title="" data-original-title="Получатель еще не прочитал все ваши сообщения в этой переписке" style="margin-left: 10px;">';
                }elseif($v_n == 0) {
                  $item = '<img src="/uploads/mail.png" alt="" width="16" height="16" data-toggle="tooltip" title="" data-original-title="Получатель еще не прочитал все ваши сообщения в этой переписке" style="margin-left: 10px;">';
                }elseif(!empty($new_m)) {
                  $item =  '<a alt="" width="16" height="16" data-toggle="tooltip" title="" data-original-title="Новое  сообщение"> <span class="label label-success" style="margin-top:2px"><stong>New!</stong></span>  </a>';
                }elseif(!empty($new_m2)) {
                  $item =  '<a alt="" width="16" height="16" data-toggle="tooltip" title="" data-original-title="Новое  сообщение"> <span class="label label-success" style="margin-top:2px"><stong>New!</stong></span>  </a>';
                }else {
                  $item = '<img src="/uploads/mail-open.png" alt="" width="16" height="16" data-toggle="tooltip" title="" data-original-title="Получатель прочитал все сообщения в этой переписке" style="margin-left: 10px;">';
                }
                return $item;
              },

            ],
            [
              'attribute' => 'subject',
              'label'=>'Тема',
              'format' => 'raw',
              'contentOptions' => ['style' => 'vertical-align: top;'],
              'value' => function($data){
                $url='/admin/massage/view?id='.$data->id;
                $item =Html::a($data->subject, $url,['class'=>'massage-view-url']);
                return $item;
                }
            ],

            // 'content:ntext',
            // 'tickets_id',
            // 'viewed_admin',
            // 'viewed_user',
            [
              'attribute' => 'del',
              'label'=>'',
              'format' => 'raw',
              'value' => function($data){
                if ($data->del == 1) {
                  $item = '<p data-toggle="tooltip" title="" data-original-title="Удалено получателем" style="color: #dd4b39;"><i class="fa fa-fw fa-info-circle"></i> Удалено</p>';
                }else {
                  $item = '';
                }
                return $item;
                }
            ],
            [
              'attribute' => 'id',
              'label'=>'Сообщений',
              'format' => 'raw',
              'options' => ['style' => 'width: 50px; max-width: 50px;'],
              'contentOptions' => ['style' => 'width: 50px; max-width: 50px; ','class'=>'text-center hidden-xs'],
              'value' => function($data){
                $mass= app\models\crm\Massage::find()->where(['id'=>$data->id])->orWhere(['massage_id'=>$data->id])->all();
                $url='/admin/massage/view?id='.$data->id;
                $count_mas = '<span class="label label-primary" style="margin-top:2px"><stong>'.count($mass).'</stong></span>';
                $item =Html::a($count_mas, $url,['class'=>'massage-view-url','data-toggle'=>'tooltip' ,'title'=>'', 'data-original-title'=>'Читать']);
                return $item;
                }
            ],

            [
              'attribute' => 'id',
              'label'=>'Отправлен',
              'format' =>  ['date', 'HH:mm:ss dd.MM.YYYY'],
              'options' => ['style' => 'width: 150px; max-width: 150px;'],
              'contentOptions' => ['style' => 'width: 150px; max-width: 150px;'],
              'content'=>function($data){
                $date = $data->date;
                $date_2= date('Y-m-d');
                $time = $data->time;
                Yii::$app->formatter->locale = 'ru-Ru';
                if ($date == $date_2) {
                  $item = Yii::$app->formatter->asDate($time,"php: H:i");
                }else {
                  $item = Yii::$app->formatter->asDate($date,"php:d.F",'long').'<br>'.'в '.Yii::$app->formatter->asDate($time,"php: H:i");
                }
                return $item;
              },

            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{delete}',
                'options' => ['style' => 'width: 50px; max-width: 50px;'],
                'contentOptions' => ['style' => 'width: 50px; max-width: 50px;'],
                'buttons' => [
                  'delete' => function ($url,$model) {
                      return Html::a('<i class="fa fa-trash-o" aria-hidden="true"></i>', ['delete', 'id' => $model->id], [
                          'class' => 'btn btn-danger btn-xs',
                          'title'=>Yii::t('app', 'delete'),
                          'data' => [
                              'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                              'method' => 'post',
                          ],
                      ]);
                  },
              ],
            ],
             //'date:date',
             //'time:time',
        ],
    ]); ?>
  <?php Pjax::end() ?>
</div>
<?php
$js = <<< 'SCRIPT'
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
});
var auto_refresh = setInterval(
function ()
{
$.pjax.reload({container:"#list-massage"});
}, 10000);

SCRIPT;
$this->registerJs($js);
 ?>
