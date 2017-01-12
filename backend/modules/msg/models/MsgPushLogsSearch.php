<?php

namespace app\modules\msg\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\msg\models\MsgPushLogs;

/**
 * MsgPushLogsSearch represents the model behind the search form about `app\modules\msg\models\MsgPushLogs`.
 */
class MsgPushLogsSearch extends MsgPushLogs
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'patriarch_id', 'status'], 'integer'],
            [['username', 'title', 'content'], 'safe'],
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
        $query = MsgPushLogs::find()->joinWith('patriarch');

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
            'msg_push_logs.id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'msg_push_logs.username', $this->username])
            ->andFilterWhere(['like', 'msg_push_logs.title', $this->title]);

        return $dataProvider;
    }
}
