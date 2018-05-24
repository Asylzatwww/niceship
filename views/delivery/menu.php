        <?php
        if (!Yii::$app->user->isGuest){
            $delivery =  \app\models\Delivery::find();
            $delivCount = array();
            for ($i =0;$i < 5;$i++){
                if (isset(Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId())['admin']))
                    $delivCount[$i] = $delivery->where([ 'status' => $i ])->count();
                else $delivCount[$i] = $delivery->where([ 'createdBy' => Yii::$app->user->getId(), 'status' => $i ])->count();
                if ($delivCount[$i] > 0) $delivCount[$i] = '<div class="delivcount delivcount' . $i . '">' . $delivCount[$i] . '</div>';
                else $delivCount[$i] = '';
            }

        if (!isset($step)) $step = false;

        function Step($i, $step){
            if ($i == $step) return 'h';
        }
            ?>
    <section id="main-hiw">

        <ol class="row list-unstyled">
            <li class="col-12 col-xs-12 col-sm-2 col-md-2 col-lg-2"> 
                <a href="/delivery"><img style="display: block;" class="lazy lazydone" src="/img/hiw-v2_4a<?= Step(1, $step) ?>.png" height="83" width="91"></a> 
            </li>
            <li class="col-12 col-xs-12 col-sm-3 col-md-3 col-lg-3"> 
                <a href="/delivery/shop"><img style="display: block;" class="lazy lazydone" src="/img/hiw-v2_1a<?= Step(2, $step) ?>.png" height="83" width="91">
                    <?= $delivCount[0] ?>
                </a> 
                <a href="/delivery/fromshop">
                    <div class="trans trans12 hidden-xs" <?php if (Step(5, $step) == 'h') echo 'style="border-bottom: 1px dashed #FF7300;"'; ?> >
                        <?= $delivCount[1] ?>
                    </div> 
                </a>
            </li>
            <li class="col-12 col-xs-12 col-sm-3 col-md-3 col-lg-3"> 
                <a href="/delivery/ship"><img style="display: block;" class="lazy lazydone" src="/img/hiw-v2_2a<?= Step(3, $step) ?>.png" height="83" width="141">
                    <?= $delivCount[2] ?>
                </a> 
                <a href="/delivery/toaddress">
                    <div class="trans trans23 hidden-xs" <?php if (Step(6, $step) == 'h') echo 'style="border-bottom: 1px dashed #FF7300;"'; ?> >
                        <?= $delivCount[3] ?>
                    </div>
                </a> 
            </li>
            <li class="col-12 col-xs-12 col-sm-3 col-md-3 col-lg-3"> 
                <a href="/delivery/enjoy"><img style="display: block;" class="lazy lazydone" src="/img/hiw-v2_3a<?= Step(4, $step) ?>.png" height="83" width="104">
                    <?= $delivCount[4] ?>
                </a> 
            </li>
        </ol>

    </section>
            <?php
        }
        ?>