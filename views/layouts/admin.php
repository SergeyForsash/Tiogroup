<?php
use yii\helpers\Html;
use app\models\crm\User;
/* @var $this \yii\web\View */
/* @var $content string */

$type = User::getType(['id'=>Yii::$app->user->id]);
if (Yii::$app->user->isGuest) {
/**
 * Do not use this code in your template. Remove it.
 * Instead, use the code  $this->layout = '//main-login'; in your controller.
 */
    echo $this->render(
        'main-login',
        ['content' => $content]
    );
} else {

    if (class_exists('backend\assets\AppAsset')) {
        backend\assets\AppAsset::register($this);
    } else {
        app\assets\AppAsset::register($this);
    }

    dmstr\web\AdminLteAsset::register($this);

    $directoryAsset = Yii::$app->assetManager->getPublishedUrl('@vendor/almasaeed2010/adminlte/dist');
    ?>
    <?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>

    </head>
    <body class="hold-transition skin-blue sidebar-mini">
    <?php $this->beginBody() ?>
    <div class="wrapper">

        <?= $this->render(
            'header.php',
            ['directoryAsset' => $directoryAsset]
        ) ?>
        <?php if($type == 1):?>
          <?= $this->render(
              'left-employer.php',
              ['directoryAsset' => $directoryAsset]
          )
          ?>
        <?php elseif($type == 2):?>
          <?= $this->render(
              'left-agency.php',
              ['directoryAsset' => $directoryAsset]
          )
          ?>
        <?php elseif($type == 3):?>
          <?= $this->render(
              'left-workers.php',
              ['directoryAsset' => $directoryAsset]
          )
          ?>
        <?php else :?>
          <?= $this->render(
              'left.php',
              ['directoryAsset' => $directoryAsset]
          )
          ?>
      <?php endif;?>

        <?= $this->render(
            'content.php',
            ['content' => $content, 'directoryAsset' => $directoryAsset]
        ) ?>

    </div>

    <?php $this->endBody() ?>
    </body>
    </html>
    <?php $this->endPage() ?>
<?php } ?>
