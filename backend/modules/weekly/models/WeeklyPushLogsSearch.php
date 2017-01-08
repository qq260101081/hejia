<?php

namespace app\modules\weekly\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\weekly\models\WeeklyPushLogs;

/**
 * WeeklyPushLogsSearch represents the model behind the search form about `app\modules\msg\models\WeeklyPushLogs`.
 */
class WeeklyPushLogsSearch extends WeeklyPushLogs
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'student_id', 'discipline', 'sleep', 'diet', 'study', 'status', 'created_at'], 'integer'],
            [['student_name', 'synthesize', 'username'], 'safe'],
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
        $query = WeeklyPushLogs::find();

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
            'student_id' => $this->student_id,
            'discipline' => $this->discipline,
            'sleep' => $this->sleep,
            'diet' => $this->diet,
            'study' => $this->study,
            'status' => $this->status,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'student_name', $this->student_name])
            ->andFilterWhere(['like', 'synthesize', $this->synthesize])
            ->andFilterWhere(['like', 'username', $this->username]);

        return $dataProvider;
    }
}
