<?php

/* @var $this yii\web\View */

$this->title = 'NiceShip Доставка из Москвы в Бишкек';
$this->registerJsFile('/js/jquery.lazyload.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJs('$("img.lazy").lazyload({ effect : "fadeIn" });');

?>
</div>

    <section id="home-banner">
        <h2>Покупай онлайн в Москве<br>получай в Бишкеке</h2>

        <div class="advantages">
            <ul class="expHP-benefits"> 
                <li>Покупай дешево и качественно</li> 
                <li>Получите товар быстро, от 2 до 5 дней</li> 
                <li>Мы совершим покупку для вас, если не возможно провести оплату и интернет магазине</li> 
            </ul> 
            <?php if (Yii::$app->user->isGuest) { ?>
                <p><a href="/site/signup" class="btn btn-primary btn-lg highlighted">Начать сейчас <span class="glyphicon glyphicon-play"></span></a></p> 
                <p>Легко и просто</p>
            <?php } ?> 
        </div>

    </section>

<div class="container">

    <section id="home-hiw">
        <h2>Как NiceShip работает</h2>

        <ol class="row list-unstyled">
            <li class="col-12 col-xs-12 col-sm-4 col-md-4 col-lg-4"> 
                <img style="display: block;" class="lazy lazydone" src="/img/hiw-v2_1a.png" height="83" width="91"> 
                <h3><a href="/">Магазин</a></h3> 
                <p>Когда вы совершаете покупку в Московских интернет магазин, введите ваш Borderlink адрес для доставки</p> 
                <!--p class="more"><a href="/">Читать дальше</a></p--> 
                <div class="trans trans12 hidden-xs"></div> 
            </li>
            <li class="col-12 col-xs-12 col-sm-4 col-md-4 col-lg-4"> 
                <img style="display: block;" class="lazy lazydone" src="/img/hiw-v2_2a.png" height="83" width="141"> 
                <h3><a href="/">Склад</a></h3> 
                <p>Мы напишем вам как ваша покупка поступит на склад, и подготовим к отправке</p> 
                <!--p class="more"><a href="/">Читать дальше</a></p--> 
                <div class="trans trans23 hidden-xs"></div> 
            </li>
            <li class="col-12 col-xs-12 col-sm-4 col-md-4 col-lg-4"> 
                <img style="display: block;" class="lazy lazydone" src="/img/hiw-v2_3a.png" height="83" width="104"> 
                <h3><a href="/">Доставка</a></h3> 
                <p> Примерно через 2/5 рабочих дней вы сможете получить посылку в Бишкеке. </p> 
                <!--p class="more"><a href="/">Читать дальше</a></p-->
            </li>
        </ol>

    </section>

    <section id="home-benefits">
        <ul class="row list-unstyled"> 
            <li class="col-12 col-xs-12 col-sm-4 col-md-4 col-lg-4 benefit1"> 
                <h3>Низкая стоимость</h3> 
                <p>У нас цены ниже чем в почтовых службах</p> 
            </li> 
            <li class="col-12 col-xs-12 col-sm-4 col-md-4 col-lg-4 benefit2"> 
                <h3>Быстрая доставка</h3> 
                <p>Теперь еще проще совершать покупки</p> 
            </li> 
            <li class="col-12 col-xs-12 col-sm-4 col-md-4 col-lg-4 benefit3"> 
                <h3>Помощь при покупке</h3> 
                <p>Мы совершим покупку для вас, если не возможно провести оплату и интернет магазине</p>
            </li> 
        </ul>
    </section>

</div>
    <section id="home-why-use">
     <div class="container">
        <h2> Почему использовать NiceShip для доставки в Бишкек </h2>
        <ul class="row list-unstyled"> 
            <li class="col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 whyuse1"> 
                <h3>Растаможка все включено</h3> 
                <p> У нас нет скрытых надбавок за тот или иной товар. </p> 
                    <!--p class="more"><a href="/">Ещё</a></p--> 
                </li> 
                <li class="col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 whyuse2"> 
                    <h3>Плати за килограммы</h3> 
                    <p> Вы оплачиваете только за вес товара. </p> 
                    <!--p class="more"><a href="/">Ещё</a></p--> 
                </li> 
                <li class="col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 whyuse3"> 
                    <h3>Сохраниет до 25% за уменьшение веса доставки</h3> 
                    <p>Мы упакуем товары убирая все что не нужно</p> 
                    <!--p class="more"><a href="/">Ещё</a></p--> 
                </li> 
                <li class="col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 whyuse4"> 
                    <h3>Можество твоаров</h3> 
                    <p>Соберите множество товаров и платите за полученные килограммы.</p> 
                    <!--p class="more"><a href="/">Ещё</a></p--> 
                </li> 
                <li class="col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 whyuse5"> 
                    <h3>Помощ в покупке</h3> 
                    <p>Мы совершим покупку для вас, если не возможно провести оплату и интернет магазине.</p> 
                    <!--p class="more"><a href="/">Ещё</a></p--> 
                </li> 
                <li class="col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 whyuse6"> 
                    <h3>Поддержка клиентов 24/7</h3> 
                    <p>Наша поддержка - в онлайне 24 часа в сутки, 7 дней в неделю. Мы решаем ваши проблемы быстро и честно. У нас самый большой процент довольных клиентов. Покупка в США с Бандеролькой - это всегда выгодно и безопасно.</p> 
                    <!--p class="more"><a href="/site/contact">Напишите нам</a></p--> 
                </li> 
        </ul>
     </div>
    </section>
<div class="container">
    <section id="home-where">
        <h2>Где купить</h2>
        <h3>Популярные бренды, доставим вам</h3>
        <ul class="list-unstyled"> 
            <li> 
                <a href="http://ulmart.ru" title="Ulmart"> 
                    <img class="lazy lazydone" src="/img/index.jpg" 
                    alt="Buy Ulmart and ship with NiceShip" height="93" width="230"> 
                </a> 
            </li> 
            <li> 
                <a href="http://dns-shop.ru" title="Asos"> 
                    <img class="lazy lazydone" src="/img/index2.jpg" 
                    alt="Buy DNS-Shop and ship with NiceShip" height="62" width="230"> 
                </a> 
            </li> 
            <li> 
                <a href="http://www.eldorado.ru/" title="Asos"> 
                    <img class="lazy lazydone" src="/img/index3.png" 
                    alt="Buy Eldorado and ship with NiceShip" height="126" width="259"> 
                </a> 
            </li> 
            <li> 
                <a href="/" title="Amazon"> 
                    <img class="lazy lazydone" src="/img/amazon.png" 
                    alt="Buy Amazon and ship with NiceShip" height="30" width="154"> 
                </a> 
            </li> 
            <li> 
                <a href="/" title="Asos"> 
                    <img class="lazy lazydone" src="/img/asos.png" 
                    alt="Buy Asos and ship with NiceShip" height="37" width="98"> 
                </a> 
            </li> 
            <li> 
                <a href="/" title="Best Buy"> 
                    <img class="lazy lazydone" src="/img/bestbuy.png" 
                    alt="Buy Best Buy and ship with NiceShip" height="71" width="104"> 
                </a> 
            </li> 
            <li> 
                <a href="/" title="Carter's"> 
                    <img class="lazy lazydone" src="/img/carters.png" 
                    alt="Buy Carter's and ship with NiceShip" height="25" width="120"> 
                </a> 
            </li> 
            <li> 
                <a href="/" title="Dune"> 
                    <img class="lazy lazydone" src="/img/dune.png" 
                    alt="Buy Dune and ship with NiceShip" height="36" width="121"> 
                </a> 
            </li> 
            <li> 
                <a href="/" title="Ebay"> 
                    <img class="lazy lazydone" src="/img/ebay.png" 
                    alt="Buy Ebay and ship with NiceShip" height="36" width="96"> 
                </a> 
            </li> 
            <li> 
                <a href="/" title="Fab"> 
                    <img class="lazy lazydone" src="/img/fab.png" 
                    alt="Buy Fab and ship with NiceShip" height="29" width="80"> 
                </a> 
            </li> 
            <li> 
                <a href="/" title="Gap"> 
                    <img class="lazy lazydone" src="/img/gap.png" 
                    alt="Buy Gap and ship with NiceShip" height="48" width="58"> 
                </a> 
            </li> 
            <li> 
                <a href="/" title="Harrod's"> 
                    <img class="lazy lazydone" src="/img/harrods.png" 
                    alt="Buy Harrod's and ship with NiceShip" height="43" width="100"> 
                </a> 
            </li> 
            <li> 
                <a href="/" title="HP"> 
                    <img class="lazy lazydone" src="/img/hp.png" 
                    alt="Buy HP and ship with NiceShip" height="64" width="64"> 
                </a> 
            </li> 
            <li> 
                <a href="/" title="Kate Spade"> 
                    <img class="lazy lazydone" src="/img/katespade.png" 
                    alt="Buy Kate Spade and ship with NiceShip" height="65" width="135"> 
                </a> 
            </li> 
            <li> 
                <a href="/" title="Lacoste"> 
                    <img class="lazy lazydone" src="/img/lacoste.png" 
                    alt="Buy Lacoste and ship with NiceShip" height="31" width="206"> 
                </a> 
            </li> 
            <li> 
                <a href="/" title="Levi's"> 
                    <img class="lazy lazydone" src="/img/levis.png" 
                    alt="Buy Levi's and ship with NiceShip" height="55" width="113"> 
                </a> 
            </li> 
            <li> 
                <a href="/" title="ModCloth"> 
                    <img class="lazy lazydone" src="/img/modcloth.png" 
                    alt="Buy ModCloth and ship with NiceShip" height="40" width="154"> 
                </a> 
            </li> 
            <li> 
                <a href="/" title="Nordstrom"> 
                    <img class="lazy lazydone" src="/img/nordstrom.png" 
                    alt="Buy Nordstrom and ship with NiceShip" height="21" width="168"> 
                </a> 
            </li> 
            <li> 
                <a href="/" title="Petit Bateau"> 
                    <img class="lazy lazydone" src="/img/petitbateau.png" 
                    alt="Buy Petit Bateau and ship with NiceShip" height="76" width="76"> 
                </a> 
            </li> 
            <li> 
                <a href="/" title="Rue La La"> 
                    <img class="lazy lazydone" src="/img/ruelala.png" 
                    alt="Buy Rue La La and ship with NiceShip" height="41" width="140"> 
                </a> 
            </li> 
            <li> 
                <a href="/" title="Victora's Secret"> 
                    <img class="lazy lazydone" src="/img/victoriassecret.png" 
                    alt="Buy Victora's Secret and ship with NiceShip" height="17" width="227"> 
                </a> 
            </li> 
        </ul>
    </section>

</div>
    <section id="home-testimonials">
     <div class="container">
        <h2>Они выбрали нас</h2>
        <ul class="list-unstyled row"> 
            <li class="col-12 col-xs-12 col-sm-4 col-md-4 col-lg-4"> 
                <blockquote>Очень легкий и доступный способ получить товары из известных магазинов Москвы, с доставкой до дома.
                </blockquote> 
                <h3>Азим Кадыралиев, Бишкек, 07/2016</h3> 
            </li> 
            <li class="col-12 col-xs-12 col-sm-4 col-md-4 col-lg-4"> 
                <blockquote>NiceShip отличная возможность покупать товары с разных интернет магазинов, поскольку вы платите за общий вес всех товаров.
                </blockquote> 
                <h3>Шакитов Нурсултан, Бишкек, 08/2016</h3> 
            </li> 
            <li class="col-12 col-xs-12 col-sm-4 col-md-4 col-lg-4"> 
                <blockquote>Живя в Бишкеке я часто ищу товары которых не могу найти на местном рынке, и NiceShip помогает мне купить то что мне нужно, по доступной цене.
                </blockquote> 
                <h3>Калмакбаев Улукбек, Бишкек, 05/2016</h3> 
            </li> 
        </ul>
     </div>
    </section>

<div class="container">