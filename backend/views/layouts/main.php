<?php

/**
 * @var string $content
 * @var \yii\web\View $this
 */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use yiister\gentelella\widgets\FlashAlert;
use yii\bootstrap\Modal;
use yii\helpers\Url;

$bundle = yiister\gentelella\assets\Asset::register($this);
AppAsset::register($this);

$js = <<<JS
$('body').on('click', '.modal-button', function(e){
	e.preventDefault();
	$('#modal').modal('show')
		.find('#modalContent')
		.load($(this).attr('href'));
});
JS;
$this->registerJs($js);
?>
<?php $this->beginPage(); ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<style>
    .nav-md .container.body .col-md-3.left_col {
        min-height: 100%;
        width: 230px;
        padding: 0;
        position: fixed;
        display: -ms-flexbox;
        display: flex;
        z-index: 1;
    }

    .nav-sm .container.body .col-md-3.left_col {
        min-height: 100%;
        width: 70px;
        padding: 0;
        z-index: 9999;
        position: fixed;
    }

    @media only screen and (max-width: 991px) {

        .main_container .left_col {
            left: -230px;
            height: 100% !important;
            overflow-y: auto !important;
        }

        .main_container .left_col.view {
            left: 0;
        }

    }
</style>
<body class="nav-<?= !empty($_COOKIE['menuIsCollapsed']) && $_COOKIE['menuIsCollapsed'] == 'true' ? 'sm' : 'md' ?>">
<?php $this->beginBody(); ?>

<div class="container body">

    <div class="main_container">
        <?php $user = Yii::$app->user->identity; ?>

        <?php if (Yii::$app->user->can('manager')): ?>
            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">

                    <div class="navbar nav_title" style="border: 0;">
                        <a href="/" class="site_title">
                             <span>Админ панель</span>
                            <!--                            <img src="/lending/img/d1-logo.png" alt="" class=" lazyloaded">-->
                        </a>
                    </div>
                    <div class="clearfix"></div>


                    <br/>

                    <!-- sidebar menu -->
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

                        <div class="menu_section">
                            <h3>Меню</h3>
                            <?=
                            \yiister\gentelella\widgets\Menu::widget(
                                [
                                    "items" => [
                                        [
                                            "label" => "Главная",
                                            "url" => ['site/'],
                                            "icon" => "table",
                                        ],
                                        [
                                            "label" => "Товары",
                                            "url" => ['product/'],
                                            "icon" => "table",
                                        ],
                                        [
                                            "label" => "Категории",
                                            "url" => ['category/'],
                                            "icon" => "table",
                                        ],
                                    ],
                                ]
                            )
                            ?>
                        </div>

                    </div>
                    <!-- /sidebar menu -->

                </div>
            </div>

            <!-- top navigation -->
            <div class="top_nav">

                <div class="nav_menu">
                    <nav class="" role="navigation">
                        <div class="nav toggle">
                            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                        </div>

                        <ul class="nav navbar-nav navbar-right">
                            <li class="">
                                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown"
                                   aria-expanded="false">
                                    <?php echo $user->username; ?>
                                    <span class=" fa fa-angle-down"></span>
                                </a>
                                <ul class="dropdown-menu dropdown-usermenu pull-right">
                                    <li>
                                        <a href="<?= Url::to(['user/logout'])?>"><i class="fa fa-sign-out pull-right"></i>
                                            Выйти
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>

            </div>
            <!-- /top navigation -->
        <?php endif; ?>


        <!-- page content -->
        <div class="right_col" role="main">
            <?php if (isset($this->params['h1'])): ?>
                <div class="page-title">
                    <div class="title_left">
                        <h1><?= $this->params['h1'] ?></h1>
                    </div>
                    <div class="title_right">
                        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search for...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">Go!</button>
                            </span>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <div class="clearfix"></div>

            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= FlashAlert::widget(); ?>

            <?php Modal::begin([
                'id' => 'modal',
                'size' => Modal::SIZE_LARGE,
            ]);

            echo '<div id="modalContent"></div>';

            Modal::end(); ?>

            <div class="row"><?= $content ?></div>
        </div>
        <!-- /page content -->

    </div>

</div>

<div id="custom_notifications" class="custom-notifications dsp_none">
    <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
    </ul>
    <div class="clearfix"></div>
    <div id="notif-group" class="tabbed_notifications"></div>
</div>
<!-- /footer content -->


<?php $this->endBody(); ?>
<script>
    $(document).ready(function () {
        var scrollHeight = Math.max(
            document.body.scrollHeight, document.documentElement.scrollHeight,
            document.body.offsetHeight, document.documentElement.offsetHeight,
            document.body.clientHeight, document.documentElement.clientHeight
        );

        $('.col-md-3.left_col').height(scrollHeight + 'px');

        if ($('body').hasClass('nav-sm')) {
            $('.site_title').css('display', 'none');
        }
        $('#menu_toggle').click(function () {
            $('body').find('.left_col').toggleClass('view');

            if ($('body').hasClass('nav-sm')) {
                $('.site_title').css('display', 'none');
            } else {
                $('.site_title').css('display', 'block');
            }
            return false;
        });
    });
</script>
</body>
</html>
<?php $this->endPage(); ?>
