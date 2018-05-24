<?php
$currentUrl = 'http://yii.infogeo-spb.ru';
?>

<div style="background:#fff;font-family:Arial;margin:0;padding:0;">
  
  <table style="width:100%;" border="0" cellpadding="0" cellspacing="0">
   <tbody><tr>
    <td style="background:#333;border-collapse:collapse;color:#333;font-size:13px;height:70px;">
     <center>
      <table style="max-width:600px;width:95%;" border="0" cellpadding="0" cellspacing="0">
       <tbody><tr>
        <td style="border-collapse:collapse;color:#333;font-size:13px;">
          <img src="<?= $currentUrl ?>/img/default4.png" alt="Borderlinx"></td>
       </tr>
      </tbody></table>
     </center>
    </td>
   </tr>
  </tbody>
 </table>
  
  <table style="width:100%;" border="0" cellpadding="0" cellspacing="0">
   <tbody><tr>
    <td style="background:#f0f8ff;border-collapse:collapse;color:#333;font-size:13px;padding:10px 0;text-align:left;width:100%;">
     <center>
      <table style="background:#fff;margin:0 auto;max-width:600px;width:100%;" border="0" cellpadding="0" cellspacing="0">
       <tbody><tr>
        <td style="border-collapse:collapse;color:#333;font-size:13px;text-align:left;">


          <?php

            if (isset($password))
                echo \Yii::$app->view->renderFile('@app/views/user/_mail1.php', [
                'password' => $password, 
                'currentUrl' => $currentUrl,
                ]);
            else if (isset($transfer))
                echo \Yii::$app->view->renderFile('@app/views/user/_mail2.php', [
                'transfer' => $transfer, 
                'currentUrl' => $currentUrl,
                ]);
            else if (isset($deliver))
                echo \Yii::$app->view->renderFile('@app/views/user/_mail2.php', [
                'deliver' => $deliver, 
                'currentUrl' => $currentUrl,
                ]);

          ?>



        </td>
       </tr>
      </tbody></table>
     </center>
    </td>
   </tr>
  </tbody>
</table>

  <table style="width:100%;" border="0" cellpadding="0" cellspacing="0">
   <tbody><tr>
    <td style="background:#f0f8ff;border-collapse:collapse;color:#333;font-size:13px;">
     <center>
      <table style="margin:0 auto;max-width:600px;width:95%;" border="0" cellpadding="0" cellspacing="0">
       <tbody><tr style="background:#71abd7;">
        <td colspan="4" style="border-collapse:collapse;color:#fff;font-size:16px;padding:10px;text-align:center;" valign="middle">
          <b>Будь в курсе событий</b>
        </td>
       </tr>
       <tr style="background:#71abd7;">
        <td style="border-collapse:collapse;color:#333;font-size:13px;padding-bottom:10px;text-align:center;" valign="middle">
          <a href="<?= $currentUrl ?>" style="color:#539ace;text-decoration:none;" target="_blank" title="Facebook">
            <img src="<?= $currentUrl ?>/img/m1.png" alt="" style="margin:0 10px;" height="29" width="29">
          </a> 
          <a href="<?= $currentUrl ?>" style="color:#539ace;text-decoration:none;" target="_blank" title="Twitter">
            <img src="<?= $currentUrl ?>/img/m2.png" alt="" style="margin:0 10px;" height="29" width="29">
          </a> 
          <a href="<?= $currentUrl ?>" style="color:#539ace;text-decoration:none;" target="_blank" title="Pinterest">
            <img src="<?= $currentUrl ?>/img/m3.png" alt="" style="margin:0 10px;" height="" width="">
          </a> 
          <a href="<?= $currentUrl ?>" style="color:#539ace;text-decoration:none;" target="_blank" title="Borderlinx blog">
            <img src="<?= $currentUrl ?>/img/m4.png" alt="" style="margin:0 10px;" height="30" width="29">
          </a>
        </td>
       </tr>
      </tbody></table>
     </center>
    </td>
   </tr>
  </tbody>
</table>

  <table style="background:#f0f8ff;width:100%;" border="0" cellpadding="0" cellspacing="0">
   <tbody><tr>
    <td style="border-collapse:collapse;color:#333;font-size:13px;">
     <center>
      <table style="margin:0 auto;max-width:600px;width:95%;" border="0" cellpadding="0" cellspacing="0">
       <tbody><tr>
        <td style="background:transparent url(<?= $currentUrl ?>/img/m5.png) left 20px no-repeat;border-collapse:collapse;
        color:#666;font-size:12px;padding:20px 20px 35px 45px;text-align:left;">
          <span style="text-transform:uppercase;"><b>Остались вопросы?</b></span><br>
          <a href="<?= $currentUrl ?>/site/contact" style="color:#539ace;text-decoration:none;" target="_blank">Если остались вопросы напишите нам</a> 
          . Наши специалисты 
          <a href="<?= $currentUrl ?>" style="color:#539ace;text-decoration:none;" target="_blank">работают</a> 
          для вас <span style="color:#ff7900;">24/7</span>
        </td>
       </tr>
      </tbody></table>
     </center>
    </td>
   </tr>
  </tbody>
</table>

  <table style="background:#fff;padding:10px 0 20px 0;width:100%;" border="0" cellpadding="0" cellspacing="0">
   <tbody><tr>
    <td style="border-collapse:collapse;color:#333;font-size:12px;">
     <center>
      <table style="margin:0 auto;max-width:600px;width:95%;" border="0" cellpadding="0" cellspacing="0">
       <tbody><tr>
        <td style="border-collapse:collapse;color:#999;font-size:11px;padding:15px 0 0 0;text-align:center;"> 
          NiceShip<br> Москва, ул Текстильщиков<br> 
          Тел. В Москве +79533476144 
Тел. В Бишкеке +79533476144 </td>
       </tr>
      </tbody></table>
     </center>
    </td>
   </tr>
  </tbody></table>
  
 </div>