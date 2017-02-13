<?php

namespace app\modules\student\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\student\models\Student;

/**
 * StudentSearch represents the model behind the search form about `app\modules\student\models\Student`.
 */
class StudentSearch extends Student
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name', 'classes', 'sex','type',  'updated_at','school'], 'safe'],
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
        $query = Student::find();

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
            'type' => $this->type,
            //'student.created_at' => strtotime($this->created_at),
            //'student.updated_at' => strtotime($this->updated_at),
        ]);
       if($this->created_at) $query->andFilterWhere(['>','created_at',strtotime($this->created_at)]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'school', $this->school])
            ->andFilterWhere(['like', 'grade', $this->grade]);

        return $dataProvider;
    }
}