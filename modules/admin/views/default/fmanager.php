<?php

/* @var $this yii\web\View */
/* @var $searchModel app\models\InformSearhc */
/* @var $dataProvider yii\data\ActiveDataProvider */

use mihaildev\elfinder\InputFile;
use mihaildev\elfinder\ElFinder;
use yii\web\JsExpression;

$this->title = 'Файловый Менеджер';
$this->params['breadcrumbs'][] = ['label' => 'Admin', 'url' => ['/admin']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div style="height: 590px;">
<?php  echo ElFinder::widget([
    'language'         => 'ru',
    'controller'       => 'elfinder', // вставляем название контроллера, по умолчанию равен elfinder
    'filter'           => 'image',
    'frameOptions'     => ['style'=>['width'=> '100%', 'height' => '500px']],
    'callbackFunction' => new JsExpression('function(file, id){}') // id - id виджета
]);?>
</div>
