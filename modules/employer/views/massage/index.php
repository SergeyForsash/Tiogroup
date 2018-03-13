<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\crm\search\Massage */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Korespondencja';
$this->params['breadcrumbs'][] = $this->title;
?>
<div id="list-massage" class="massage">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
<?php Pjax::begin(['id' => 'list-massage']) ?>
    <p>
        <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal"><i class="fa fa-life-buoy"></i> Zadaj pytanie dotyczące pomocy technicznej</a></button>
    </p>

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
                if ($data->users == 1) {
                  $img='/uploads/admin.png';
                }else {
                  $img='/uploads/user.png';
                }
                $url='/employer/massage/view?id='.$data->id;
                $user_img = '<img src="'.$img.'" class="img-circle" alt="User Image" style="
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
              'label'=>'Nadawca',
              'format' => 'raw',
              'options' => ['style' => 'width: 150px; max-width: 150px;'],
              'contentOptions' => ['style' => 'width: 150px; max-width: 150px; vertical-align: top;'],
              'value' => function($data){
                $url='/employer/massage/view?id='.$data->id;
                if ($data->users == 1) {
                  $type = '<span class="label label-info" style="margin-top:2px"> Administrator </span>';
                  $item =Html::a($data->admin_name, $url,['class'=>'massage-view-url']).'<br>'.$type;
                }else {
                  $type = '<span class="label label-info" style="margin-top:2px">'
                  .app\models\crm\User::getUserType(['id'=>$data->user_id]).
                  ' </span>';
                  $item =Html::a($data->user_name, $url,['class'=>'massage-view-url']).'<br>'.$type;
                }

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
                $new_m = app\models\crm\Massage::find()->where(['id'=>$data->id,'viewed_user'=>0])->all();
                $new_m2 = app\models\crm\Massage::find()->where(['massage_id'=>$data->id,'viewed_user'=>0])->all();
                $v=$viewed->viewed_admin;
                if (!empty($vieweds_n)) {
                $viewed_n = array_column($vieweds_n, 'viewed_admin');
                $v_n=min($viewed_n);
                }else {
                  $v_n='1';
                }
                if ($v == 0)  {
                  $item = '<img src="/uploads/mail.png" alt="" width="16" height="16" data-toggle="tooltip" title="" data-original-title="Odbiorca nie przeczytał jeszcze wszystkich wiadomości w tej korespondencji"style="margin-left: 10px;">';
                }elseif($v_n == 0) {
                  $item = '<img src="/uploads/mail.png" alt="" width="16" height="16" data-toggle="tooltip" title="" data-original-title="Odbiorca nie przeczytał jeszcze wszystkich wiadomości w tej korespondencji" style="margin-left: 10px;">';
                }elseif(!empty($new_m)) {
                  $item =  '<a alt="" width="16" height="16" data-toggle="tooltip" title="" data-original-title="Nowa wiadomość"> <span class="label label-success" style="margin-top:2px"><stong>New!</stong></span>  </a>';
                }elseif(!empty($new_m2)) {
                  $item =  '<a alt="" width="16" height="16" data-toggle="tooltip" title="" data-original-title="Nowa wiadomość"> <span class="label label-success" style="margin-top:2px"><stong>New!</stong></span>  </a>';
                }else {
                  $item = '<img src="/uploads/mail-open.png" alt="" width="16" height="16" data-toggle="tooltip" title="" data-original-title="Odbiorca odczytuje wszystkie wiadomości w tej korespondencji" style="margin-left: 10px;>"';
                }
                return $item;
              },
            ],
            [
              'attribute' => 'subject',
              'label'=>'Motyw',
              'format' => 'raw',
              'contentOptions' => ['style' => 'vertical-align: top;'],
              'value' => function($data){
                $url='/employer/massage/view?id='.$data->id;
                $item =Html::a($data->subject, $url,['class'=>'massage-view-url']);
                return $item;
                }
            ],

            // 'content:ntext',
            // 'tickets_id',
            // 'viewed_admin',
            // 'viewed_user',
            [
              'attribute' => 'id',
              'label'=>'Posty',
              'format' => 'raw',
              'options' => ['style' => 'width: 50px; max-width: 50px;'],
              'contentOptions' => ['style' => 'width: 50px; max-width: 50px; ','class'=>'text-center hidden-xs'],
              'value' => function($data){
                $mass= app\models\crm\Massage::find()->where(['id'=>$data->id])->orWhere(['massage_id'=>$data->id])->all();
                $url='/employer/massage/view?id='.$data->id;
                $count_mas = '<span class="label label-primary" style="margin-top:2px"><stong>'.count($mass).'</stong></span>';
                $item =Html::a($count_mas, $url,['class'=>'massage-view-url','data-toggle'=>'tooltip' ,'title'=>'', 'data-original-title'=>'Czytaj']);
                return $item;
                }
            ],
            [
              'attribute' => 'id',
              'label'=>'Wysłane',
              'format' =>  ['date', 'HH:mm:ss dd.MM.YYYY'],
              'options' => ['style' => 'width: 150px; max-width: 150px;'],
              'contentOptions' => ['style' => 'width: 150px; max-width: 150px;'],
              'content'=>function($data){
                $date = $data->date;
                $date_2= date('Y-m-d');
                $time = $data->time;
                Yii::$app->formatter->locale = 'pl-Pl';
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
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Prośba o wsparcie  <img src="/uploads/logo.png" width="170" ></h4>
      </div>
      <div class="modal-body">
        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
      </div>
    </div>

  </div>
</div>
<?php
$js = <<< 'SCRIPT'
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
});
var auto_refresh = setInterval(
function ()
{
$.pjax.reload({container:"#list-massage"});;
}, 10000);
SCRIPT;
$this->registerJs($js);
 ?>
