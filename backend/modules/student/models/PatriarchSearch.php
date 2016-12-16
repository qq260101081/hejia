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
            [['id', 'userid', 'student_id'], 'integer'],
            [['name', 'relation', 'phone', 'urgency_phone', 'urgency_person', 'address', 'remark'], 'safe'],
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
        $query = Patriarch::find();

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
            'userid' => $this->userid,
            'student_id' => $this->student_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'relation', $this->relation])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'urgency_phone', $this->urgency_phone])
            ->andFilterWhere(['like', 'urgency_person', $this->urgency_person])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'remark', $this->remark]);

        return $dataProvider;
    }
}
