<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>

     <script src="<?php echo Yii::$app->request->baseUrl; ?>/ckeditor/ckeditor.js"></script>
     <link rel="shortcut icon" href="<?php echo Yii::$app->request->baseUrl; ?>/site.ico">
</head>
<body>
<?php $this->beginBody() ?>



<div class="wrap">

    <div class="headerImg">
        <img src="img/header1.jpg" class="img-responsive" alt="Responsive image" width="100%">
    </div>

    <?php
    NavBar::begin([
        'brandLabel' => 'Arthur C Clarke Institute for Modern Technologies',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
        $menuItems = [
            ['label' => 'Home', 'url' => ['/site/index']],
        ];

        if (Yii::$app->user->isGuest) {
            $menuItems[] = [
                'label' => 'Login', 'url' => ['/site/login']
            ];
        } else {//cant we add these menu items in one assignment??-S
            if(Yii::$app->user->can('system-admin'))
            {//only system admin can see users
                $menuItems[] = [
                    'label' => 'Users', 'url' => ['/user/index'],
                ];
            }

            $menuItems[] = [
                'label' => 'Projects', 'url' => ['/project/index'],
            ];

            if(Yii::$app->user->can('sectional-head'))
            {//only sectionl head can see users
                $menuItems[] = [
                    'label' => 'Report Templates', 'url' => ['/report-template/index'],
                ];
            }

            $menuItems[] = [
                'label' => 'Divisions', 'url' => ['/division/index'],
            ];



            $menuItems[] = [
              'label' => Yii::$app->user->identity->username ,
              'items' => [
                //Item1
                [
                    'label' => 'Edit Profile', 'url' => ['/user/edit'],
                ],
                //Item2
                [
                'label' => 'Logout',
                'url' => ['/site/logout'],
                'linkOptions' => ['data-method' => 'post']
                ],
            ],
              'options' => ['class' => 'dropdown-black'],
            ];
        }

        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right'],
            'items' => $menuItems,
        ]);
        NavBar::end();
    ?>



    <div class="container">
        <!--?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?-->
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
<!--         <p class="pull-left">&copy; My Company <!?= date('Y') ?></p>

        <p class="pull-right"><!?= Yii::powered() ?></p> -->

        <p class="pull-right">&copy; Crystal Solutions <!--?= date('Y') ?--></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
