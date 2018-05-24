<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "mtransfer".
 *
 * @property integer $id
 * @property string $amount
 * @property string $email
 * @property string $datetime
 */
class Mtransfer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mtransfer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['amount', 'datetime'], 'required', 'message' => 'Необходимо заполнить'],
            [['amount'], 'string', 'max' => 100],
            [['balance'], 'safe'],
            [['label'], 'integer'],
            [['datetime', 'notification_type', 'operation_id', 'withdraw_amount', 'currency', 'sender', 'codepro', 'description'], 'string', 'max' => 300],
        ];
    }

    public function checkHash($sha1_hash){

        $notification_secret = Yii::$app->params['adminVerify'];


        $hash = $this->notification_type . '&' . $this->operation_id . '&' . $this->amount . '&' . $this->currency . '&' . $this->datetime . '&' . 
        $this->sender . '&' . $this->codepro . '&' . $notification_secret . '&' . $this->label; //формируем хеш

        $sha1 = hash("sha1", $hash); //кодируем в SHA1

        //Ниже - проверка на валидность
        if ( $sha1 == $sha1_hash ) return true;

        return false;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'label']);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'amount' => 'Переведено',
            'datetime' => 'Дата и время',
            'notification_type' => 'Тип перевода', 
            'operation_id' => 'ID операций', 
            'withdraw_amount' => 'Со счета списано', 
            'currency' => 'Валюта', 
            'sender' => 'Счет отправителя', 
            'codepro' => 'Код протекции', 
            'label' => 'Идентификатор',
            'description' => 'Назначение платежа', 
            'balance' => 'Текущий баланс',
        ];
    }
}
