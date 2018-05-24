<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Mtransfer;

use app\models\User;

/**
 * MtransferSearch represents the model behind the search form about `app\models\Mtransfer`.
 */
class MtransferSearch extends Mtransfer
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['amount', 'datetime', 'notification_type', 'operation_id', 'withdraw_amount', 'currency', 'sender', 'codepro', 'label', 'description', 'balance'], 'safe'],
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
        $query = Mtransfer::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
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
        ]);

        if (isset(Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId())['author'])) $query->andFilterWhere(['label' => Yii::$app->user->getId()]);

        $query->joinWith('user');

        $query->andFilterWhere(['like', 'amount', $this->amount])
            ->andFilterWhere(['like', 'notification_type', $this->notification_type])
            ->andFilterWhere(['like', 'operation_id', $this->operation_id])
            ->andFilterWhere(['like', 'withdraw_amount', $this->withdraw_amount])
            ->andFilterWhere(['like', 'currency', $this->currency])
            ->andFilterWhere(['like', 'sender', $this->sender])
            ->andFilterWhere(['like', 'codepro', $this->codepro])
            ->andFilterWhere(['like', 'datetime', $this->datetime]);

        if ($this->label != null) $query->andFilterWhere([ 'like', 'user.username', $this->label ]);

        return $dataProvider;
    }
}
