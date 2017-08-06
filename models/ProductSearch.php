<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Product;

/**
 * ProductSearch represents the model behind the search form about `app\models\Product`.
 */
class ProductSearch extends Product
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'category_id', 'price', 'discount', 'rating'], 'integer'],
            [['sku', 'title', 'description', 'brand', 'pearl_type', 'color', 'base_material', 'precious_artif', 'model_number', 'occasion', 'type', 'ideal_for'], 'safe'],
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
        $query = Product::find();
        


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
            'category_id' => $this->category_id,
            'price' => $this->price,
            'discount' => $this->discount,
            'rating' => $this->rating,
        ]);

        $query->andFilterWhere(['like', 'sku', $this->sku])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'brand', $this->brand])
            ->andFilterWhere(['like', 'pearl_type', $this->pearl_type])
            ->andFilterWhere(['like', 'color', $this->color])
            ->andFilterWhere(['like', 'base_material', $this->base_material])
            ->andFilterWhere(['like', 'precious_artif', $this->precious_artif])
            ->andFilterWhere(['like', 'model_number', $this->model_number])
            ->andFilterWhere(['like', 'occasion', $this->occasion])
            ->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'ideal_for', $this->ideal_for]);

        return $dataProvider;
    }
    
    public function getCategoryTitle() {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }
}
