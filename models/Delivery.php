<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "delivery".
 *
 * @property integer $id
 * @property string $name
 * @property integer $count
 * @property string $weight
 * @property string $prize
 */
class Delivery extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'delivery';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'count', 'weight', 'prize'], 'required', 'message' => 'Необходимо заполнить'],
            [['count', 'status', 'createdBy'], 'integer'],
            [['name'], 'string', 'max' => 600],
            [['image', 'product_url'], 'string', 'max' => 300],
            [['weight', 'prize'], 'string', 'max' => 50],
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'createdBy']);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'count' => 'Количество',
            'weight' => 'Вес',
            'prize' => 'Стоимость',
            'createdBy' => 'Пользователь',
            'image' => 'Уникальное название для фото товара',
            'product_url' => 'Ссылка на товар',
            'status' => 'Статус',
        ];
    }

    public function uniqAlias($alias){

        if ($this->id != null) { 
            if (Delivery::find()->select([$alias])->where([$alias => $this->$alias])->count() > 0 && 
                Delivery::find()->select([$alias])->where([$alias => $this->$alias, 'id' => $this->id])->count() == 0) {
                $this->addError($alias, 'alias must be uniq.');
                return false; 
            }
        }
        else
        if (Delivery::find()->select([$alias])->where([$alias => $this->$alias])->count() > 0) {
            $this->addError($alias, 'alias must be uniq.');
            return false; 
        }
        return true;
    }
}
