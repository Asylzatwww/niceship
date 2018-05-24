<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DeliverySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Добро пожаловать!';
//$this->params['breadcrumbs'][] = $this->title;

echo $this->render('menu', [ 'step' => 1, ]);
?>
<div class="delivery-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-12 col-xs-12 col-lg-5 col-md-5 col-sm-12">
            <div class="qwintry-addr">
                <div class="qwintry-addr-in">

                <br />
                   <h3><span class="glyphicon glyphicon-book"></span> Ваш адрес в <span style="color:red">Москве</span>:</h3>

                    <address>
                    Asylzat Azaev<br>

                    825 Dawson Dr<br>
                    Qwintry Suite 12-274796<br>
                    Newark, DE 19712-0825<br>
                    Phone 858-633-6353</address>
                <br />

                </div>
            </div>

            <div class="member-home-mkg">
                <div class="mkg-inner">
                    <h3><span class="glyphicon glyphicon-user"></span> Мои персональные данные</h3>
                    <p>Имя : <?= Yii::$app->user->identity->firstname ?></p>
                    <p>Фамилия : <?= Yii::$app->user->identity->lastname ?></p>
                    <p><a href="/user/personal?id=<?= Yii::$app->user->identity->id ?>"><span class="glyphicon glyphicon-wrench"></span> Редактировать</a></p>
                    <p><a href="/user/password?id=<?= Yii::$app->user->identity->id ?>"><span class="glyphicon glyphicon-wrench"></span> Изменить пароль</a></p>
                </div>
            </div>
            <div class="member-home-mkg">
                <div class="mkg-inner">
                    <h3><span class="glyphicon glyphicon-envelope"></span> Мой почтовый адрес</h3>
                    <p>Емайл : <?= Yii::$app->user->identity->email ?></p>
                    <p><a href="/user/email?id=<?= Yii::$app->user->identity->id ?>"><span class="glyphicon glyphicon-wrench"></span> Редактировать</a></p>
                </div>
            </div>

            <?php if (isset(Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId())['admin'])) { ?>
                <div class="member-home-mkg">
                    <div class="mkg-inner">
                        <h3><span class="glyphicon glyphicon-list"></span> Зарегистрированные пользователи</h3>
                        <p>Всего : <?= \app\models\User::find()->count() ?> зарегистрированных пользователей</p>
                        <p><a href="/user"><span class="glyphicon glyphicon-eye-open"></span> Просмотреть всех</a></p>
                    </div>
                </div>

            <?php } ?>
        </div>

        <div class="col-12 col-xs-12 col-lg-4 col-md-4 col-sm-12">
            <div class="member-home-mkg">
                <div class="mkg-inner">
                    <h3><a href="/delivery/balance"><span class="glyphicon glyphicon-usd"></span> Баланс <?= Yii::$app->user->identity->money ?> РУБ</a></h3>
                    <h4><a href="/mtransfer/alltransfer"><span class="glyphicon glyphicon-book"></span> Показать все чеки</a></h4>
                </div>
            </div>

            <?php if (isset(Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId())['admin'])) { ?>
                <div class="member-home-mkg">
                    <div class="mkg-inner">
                        <h4><a href="mtransfer"><span class="glyphicon glyphicon-piggy-bank"></span> Снять или положить деньги на счет пользователей</a></h4>
                    </div>
                </div>

            <?php } ?>

            <div class="member-home-mkg"> 
                <a href="/en/pages/shop-usa-brands-ship-globally">
                    <img style="display: block;margin: 0 auto;" alt="Shopping tips and ideas from top US, China, Asian and European brands" src="/img/member_tips.png" 
                    class="lazy img-responsive lazydone" height="450" width="425">
                </a> 
                <div class="mkg-inner"> 
                    <h2> <span class="glyphicon glyphicon-shopping-cart"></span> Акций и распродажи</h2>

                    <?php
                        $sales = \app\models\Sales::find()->orderBy(['id' => SORT_DESC ])->limit(3)->all();
                        foreach($sales as $current){
                            echo '<h3>' . $current->title . '</h3><p>' . $current->description . '<br><a href="' . $current->url . '"  target="_blank">Посмотреть</a></p>';
                        }
                    ?>
                </div> 
                
            </div>

            <?php if (isset(Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId())['admin'])) { ?>
                <div class="member-home-mkg">
                    <div class="mkg-inner">
                        <h4><a href="sales"><span class="glyphicon glyphicon-wrench"></span> Добавить или редактировать акций</a></h4>
                    </div>
                </div>

            <?php } ?>

        </div>

        <div class="col-12 col-xs-12 col-lg-3 col-md-3 col-sm-12 member-small">
            <div class="member-home-mkg">
                <div class="mkg-inner">
                    <h3><a href="/product/all"><span class="glyphicon glyphicon-gift"></span> Популярные товары</a></h3>
                </div>
            </div>


            <?php if (isset(Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId())['admin'])) { ?>
                <div class="member-home-mkg">
                    <div class="mkg-inner">
                        <h4><a href="product"><span class="glyphicon glyphicon-wrench"></span> Добавить или редактировать популярный товар</a></h4>
                    </div>
                </div>

            <?php } ?>


            <?php
                        $product = \app\models\Product::find()->orderBy(['id' => SORT_DESC ])->limit(2)->all();
                        foreach($product as $current){
                            echo '
<div class="member-home-mkg">
                <div class="mkg-inner prod">
                    <img src="/upload/delivery/' . $current->image . '.jpg" />
                    <h3>' . $current->prize . ' руб</h3>
                    <h4>' . $current->name . '</h4>
                    <h4><a href="' . $current->product_url . '" target="_blank"> Сайт продовца</a></h4>
                    <h4>
                        <form method="post" action="/delivery/create">
                            <a><span class="glyphicon glyphicon-usd"></span> 
                                <input type="submit" value="Купите мне этот товар" style="border: none;background: transparent;" name="select" /></a>
                            <input type="hidden" name="name" value="' . $current->name . '" />
                            <input type="hidden" name="count" value="1" />
                            <input type="hidden" name="weight" value="' . $current->weight . '" />
                            <input type="hidden" name="prize" value="' . $current->prize . '" />
                            <input type="hidden" name="product_url" value="' . $current->product_url . '" />
                            <input type="hidden" name="image" value="' . $current->image . '" />
                        </form>
                    </h4>
                </div>
            </div>
                            ';
                        }
                    ?>
        </div>



    </div>

</div>
