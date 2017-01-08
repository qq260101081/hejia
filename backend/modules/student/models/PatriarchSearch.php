<?php

namespace app\modules\student\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\student\models\Patriarch;

/**
 * PatriarchSearch represents the model behind the search form about `app\modules\student\models\Patriarch`.
 */
class PatriarchSearch extends Patriarch
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name', 'relation', 'phone', 'urgency_phone', 'urgency_person'], 'safe'],
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
        $query = Patriarch::find()->joinWith('student');

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
            'user_patriarch.id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'user_patriarch.name', $this->name])
            ->andFilterWhere(['like', 'user_patriarch.relation', $this->relation])
            ->andFilterWhere(['like', 'user_patriarch.phone', $this->phone])
            ->andFilterWhere(['like', 'user_patriarch.urgency_phone', $this->urgency_phone])
            ->andFilterWhere(['like', 'user_patriarch.urgency_person', $this->urgency_person]);

        return $dataProvider;
    }
}
