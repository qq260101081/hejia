<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;


/**
 * ArticleSearch represents the model behind the search form about `app\models\Article`.
 */
class GoodsSearch extends Goods
{
    public $category_name;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id','created_at'], 'integer'],
            [['name', 'category_id','list_img', 'info', 'content'], 'safe'],
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
        $query = Goods::find();
        $query->joinWith('categoryName');
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->setSort([
            'attributes' => [
                'category_name' => [
                    'asc' => ['categoryName.name' => SORT_ASC],
                    'desc' => ['categoryName.name' => SORT_DESC],
                    'label' => '分类'
                ],
            ]
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
            'category_id' => $this->category_id,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'list_img', $this->list_img])
            ->andFilterWhere(['like', 'info', $this->info])
            ->andFilterWhere(['like', 'content', $this->content]);

        return $dataProvider;
    }
}
