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
            [['id',  'age'], 'integer'],
            [['name', 'sex', 'created_at', 'updated_at','school', 'grade'], 'safe'],
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
        $query = Student::find()->joinWith('patriarch');

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
            'student.id' => $this->id,
            'student.sex' => $this->sex,
            'student.age' => $this->age,
            //'student.created_at' => strtotime($this->created_at),
            //'student.updated_at' => strtotime($this->updated_at),
        ]);
       if($this->created_at) $query->andFilterWhere(['>','student.created_at',strtotime($this->created_at)]);

        $query->andFilterWhere(['like', 'student.name', $this->name])
            ->andFilterWhere(['like', 'student.school', $this->school])
            ->andFilterWhere(['like', 'student.grade', $this->grade]);

        return $dataProvider;
    }
}