<?php

namespace app\modules\staff\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\staff\models\Staff;

/**
 * StaffSearch represents the model behind the search form about `app\modules\staff\models\Staff`.
 */
class StaffSearch extends Staff
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id','age'], 'integer'],
            [['name', 'diploma', 'position','sex','school', 'phone'], 'safe'],
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
        $query = Staff::find();

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
            'sex' => $this->sex,
            'age' => $this->age,
            'position' => $this->position,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'diploma', $this->diploma])
            ->andFilterWhere(['like', 'school', $this->school])
            ->andFilterWhere(['like', 'phone', $this->phone]);

        return $dataProvider;
    }
}
