<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property integer $id
 * @property string $name
 * @property string $weight
 * @property string $prize
 * @property string $image
 * @property string $product_url
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'weight', 'prize', 'image', 'product_url'], 'required'],
            [['name', 'weight', 'prize', 'image', 'product_url'], 'string', 'max' => 300],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'weight' => 'Вес',
            'prize' => 'Цена',
            'image' => 'Название картинки',
            'product_url' => 'Ссылка на товар',
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
