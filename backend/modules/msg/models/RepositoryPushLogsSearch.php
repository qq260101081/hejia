<?php

namespace app\modules\msg\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\msg\models\RepositoryPushLogs;

/**
 * RepositoryPushLogsSearch represents the model behind the search form about `app\modules\msg\models\RepositoryPushLogs`.
 */
class RepositoryPushLogsSearch extends RepositoryPushLogs
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'patriarch_id', 'created_at'], 'integer'],
            [['username', 'type', 'title', 'path'], 'safe'],
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
        $query = RepositoryPushLogs::find();

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
            'patriarch_id' => $this->patriarch_id,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'path', $this->path]);

        return $dataProvider;
    }
}
