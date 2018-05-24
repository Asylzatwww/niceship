<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;

?>



<div class="col-12 col-xs-12 col-lg-3 col-md-3 col-sm-12 member-small">
	<div class="member-home-mkg">
        <div class="mkg-inner prod">
            <img src="/upload/delivery/<?= $model->image ?>.jpg" />
            <h3><?= $model->prize ?> руб</h3>
            <h4><?= $model->name ?></h4>
            <h4><a href="<?= $model->product_url ?>" target="_blank"> Сайт продовца</a></h4>
            <h4>
                <form method="post" action="/delivery/create">
                    <a><span class="glyphicon glyphicon-usd"></span> 
                        <input type="submit" value="Купите мне этот товар" style="border: none;background: transparent;" name="select" /></a>
                    <input type="hidden" name="name" value="<?= $model->name ?>" />
                    <input type="hidden" name="count" value="1" />
                    <input type="hidden" name="weight" value="<?= $model->weight ?>" />
                    <input type="hidden" name="prize" value="<?= $model->prize ?>" />
                    <input type="hidden" name="product_url" value="<?= $model->product_url ?>" />
                    <input type="hidden" name="image" value="<?= $model->image ?>" />
                </form>
            </h4>
        </div>
    </div>
</div>