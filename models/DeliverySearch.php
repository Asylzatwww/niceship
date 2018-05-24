<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Delivery;
use app\models\User;

/**
 * DeliverySearch represents the model behind the search form about `app\models\Delivery`.
 */
class DeliverySearch extends Delivery
{
    public $findStatus;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'count'], 'integer'],
            [['name', 'weight', 'prize', 'findStatus', 'createdBy'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Delivery::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'count' => $this->count,
        ]);
        if (isset(Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId())['author'])) $query->andFilterWhere(['createdBy' => Yii::$app->user->getId()]);

        $query->joinWith('user');

        $query->andFilterWhere(['status' => $this->findStatus])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'weight', $this->weight])
            ->andFilterWhere(['like', 'prize', $this->prize]);

        if ($this->createdBy != null) $query->andFilterWhere([ 'like', 'user.username', $this->createdBy ]);

        return $dataProvider;
    }
}
