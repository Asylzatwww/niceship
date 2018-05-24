<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

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
    <link rel="shortcut icon" href="/favicon.ico">
    <?php $this->head() ?>

</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">

    <?php

    $this->registerJs("
        $('.scrollTop').click(function(){
            $('body,html').animate({ scrollTop : 0 }, 500);
        });

        var bodyHeight = document.body.scrollHeight, pageScroll = 0;
        window.onscroll = function(){ 
            pageScroll = $(window).scrollTop();
            var shNavbar = $('.sh-navbar').offset();
            shNavbar = shNavbar.top + $('.sh-navbar').height();
            if ($(window).scrollTop() > 100) $('.scrollTop').show(); else $('.scrollTop').hide();
            if ($(window).scrollTop() > shNavbar && bodyHeight > window.innerHeight + shNavbar +100) { 
                $('.sh-navbar-fixed').addClass('navbar-fixed-top');
                $('.sh-navbar').css({ marginBottom : $('.sh-navbar-fixed').height() });
            } else { 
                $('.sh-navbar-fixed').removeClass('navbar-fixed-top');
                $('.sh-navbar').css({ marginBottom : 0 });
            }
        }"
        );

    NavBar::begin([
        'options' => [
            'class' => 'navbar-inverse sh-navbar',
        ],
    ]);


    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-left'],
        'items' => [
            ['label' => 'Главная', 'url' => ['/site/index']],
            ['label' => 'О нас', 'url' => ['/site/about']],
            ['label' => 'Контакты', 'url' => ['/site/contact']],

        ],
    ]);
    NavBar::end();

    NavBar::begin([
        'brandLabel' => '<img src="/img/default4.png" />',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse dl-nav sh-navbar-fixed',
        ],
    ]);


    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'Как это работает', 'url' => ['/site/howit']],
            Yii::$app->user->isGuest ? (
                ['label' => 'Войти', 'url' => ['/site/login']]
            ) : (
                '
<ul class="navbar-nav navbar-left nav">
        

        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
            <span class="glyphicon glyphicon-user"></span>
            <span class="caret"></span>
        </a>
          <ul class="dropdown-menu">
            <li><a href="/delivery">Профиль ' . Yii::$app->user->identity->username . '</a></li>
            <li><a href="/delivery/shop">Купить в интернете</a></li>
            <li><a href="/delivery/fromshop">Доставка на склад</a></li>
            <li><a href="/delivery/ship">На складе</a></li>
            <li><a href="/delivery/toaddress">Отправлено получателю</a></li>
            <li><a href="/delivery/enjoy">Доставленно</a></li>
            <li role="separator" class="divider"></li>
            <li style="background: rgb(27, 39, 50) none repeat scroll 0% 0%;">'
                . Html::beginForm(['/site/logout'], 'post', ['class' => 'navbar-form'])
                . Html::submitButton(
                    '<span class="glyphicon glyphicon-log-out"></span> Выход (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link']
                ) 
                . Html::endForm() . '</li>
          </ul>
        </li>
        
    </ul>
                '
            ),
            Yii::$app->user->isGuest ? (
                        ['label' => 'Регистрация', 'url' => ['site/signup'], 'options' => ['class' => 'dl-register'] ]
                    ) : ( '' ),
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container">

        <?= Breadcrumbs::widget([
            'homeLink'=>[ 'label' => 'Главная', 'url' => '/', ],
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>

        <?= $content ?>

        <div class="scrollTop"><span class="glyphicon glyphicon-menu-up"></span></div>
    </div>
</div>



<footer class="footer">
    <div id="footer-social">
        <div class="row"> 
            <div class="col-12"> 
                <h2>Присоединяйтесь</h2> 
                <ul class="list-unstyled"> 
                    <li>
                        <a href="/" target="_blank">
                            <img style="display: inline-block;" class="lazy lazydone" src="/img/follow-instagram.png" 
                            alt="Instagram" title="Instagram" height="55" width="55">
                        </a>
                    </li> 
                    <li>
                        <a href="/" target="_blank">
                            <img style="display: inline-block;" class="lazy lazydone" src="/img/follow-pinterest.png" 
                            alt="Pinterest" title="Pinterest" height="55" width="55">
                        </a>
                    </li> 
                    <li>
                        <a href="/" target="_blank">
                            <img style="display: inline-block;" class="lazy lazydone" src="/img/follow-twitter.png" 
                            alt="Twitter" title="Twitter" height="55" width="55">
                        </a>
                    </li> 
                    <li class="xs-break">
                        <a href="/" target="_blank">
                            <img style="display: inline-block;" class="lazy lazydone" src="/img/follow-blog.png" 
                            alt="Blog" title="Blog" height="55" width="55">
                        </a>
                    </li> 
                    <li>
                        <a href="/" target="_blank">
                            <img style="display: inline-block;" class="lazy lazydone" src="/img/follow-google+.png" 
                            alt="Google+" title="Google+" height="55" width="55">
                        </a>
                    </li> 
                    <li>
                        <a href="/">
                            <img style="display: inline-block;" class="lazy lazydone" src="/img/follow-newsletter.png" 
                            alt="Newsletter" title="Newsletter" height="55" width="55">
                        </a>
                    </li> 
                    <li>
                        <a href="/" target="_blank">
                            <img style="display: inline-block;" class="lazy lazydone" src="/img/follow-facebook.png" 
                            alt="Facebook" title="Facebook" height="55" width="55">
                        </a>
                    </li> 
                    <li>
                        <a href="/" target="_blank">
                            <img style="display: inline-block;" class="lazy lazydone" src="/img/follow-youtube.png" 
                            alt="YouTube" title="YouTube" height="55" width="55">
                        </a>
                    </li> 
                </ul> 
            </div> 
        </div>
    </div>

<div id="footer-categories"> 
    <div class="container"> 
        <div class="row"> 
            <div class="col-12 col-sm-12 col-md-8 col-lg-8 col-md-offset-2 col-lg-offset-2"> 
                <div class="row"> 
                    <div class="col-12 col-sm-4 col-md-4 col-lg-4"> 
                        <h2>Компания NiceShip</h2> 
                        <ul class="list-unstyled"> 
                            <li><a href="/site/about">О нас</a></li> 
                            <li><a href="/site/howit">Как это работает</a></li> 
                            <li><a href="/site/contact">Контакты</a></li> 
                        </ul> 
                    </div> 
                    <div class="col-12 col-sm-4 col-md-4 col-lg-4"> 
                        <h2>Доставка</h2> 
                        <ul class="list-unstyled"> 
                            <li><a>Из Москвы в Бишкек</a></li> 
                            <li><a>Теперь еще проще</a></li> 
                        </ul> 
                    </div> 
                    <div class="col-12 col-sm-4 col-md-4 col-lg-4"> 
                        <h2>Обслуживание пользователей</h2> 
                        <ul class="list-unstyled"> 
                            <li><a>Поддержка 24/7</a></li> 
                            <li><a>Тел. В Москве +79533476144</a></li> 
                            <li><a>Тел. В Бишкеке +79533476144</a></li> 
                        </ul> 
                    </div>
                </div> 
            </div> 
        </div> 
    </div> 
</div>    
    <div class="container">
        <div class="row"> 
            <div class="col-xs-`12" id="footer-partners"> 
                <h2>Наши партнеры</h2> 
                <ul class="list-unstyled flat-image-list"> 
                    <li><img src="http://a.bximg.net/images/ui/partner-logos/dhl.png" alt="DHL" height="32" width="70"></li> 
                </ul> 
                <h2>Мы принимаем</h2> 
                <ul class="list-unstyled"> 
                    <li> <img src="/img/visa4.png" alt="VISA" height="32" width="70"> </li> 
                    <li> <img src="/img/mc.jpg" alt="MasterCard" height="32" width="53"> </li> 
                    <li> <img src="/img/yandex-money2.png" alt="Yandex Money" height="32" width="90"> </li>  
                </ul> 
            </div> 
            <div class="col-xs-12 col-md-6 footer-copyright"> 
                <p><cite>Copyright © NiceShip <?= date('Y') ?>. Все права защищены.</cite></p> 
            </div> 
            <?php /*<div class="col-xs-12 col-md-6 footer-copyright"> 
                <ul class="list-unstyled"> 
                    <li><a href="/en/pages/privacy">Privacy Policy</a></li> 
                    <li><a href="/en/pages/terms-and-conditions">Terms &amp; Conditions</a></li> 
                    <li><a href="/en/pages/sitemap">Sitemap</a></li> </ul> </div> */ ?>
        </div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
