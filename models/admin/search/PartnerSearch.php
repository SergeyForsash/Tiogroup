<?php

namespace app\models\admin\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\admin\Partner;

/**
 * PartnerSearch represents the model behind the search form about `app\models\Partner`.
 */
class PartnerSearch extends Partner
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'status'], 'integer'],
            [['agency_name', 'first_number', 'second_number', 'legal_address', 'actual_address', 'email', 'second_email', 'director_name', 'license_number', 'agreement', 'image', 'created_at', 'updated_at', 'ident', 'contact_name', 'web_site'], 'safe'],
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
        $query = Partner::find();

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
            'user_id' => $this->user_id,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'agency_name', $this->agency_name])
            ->andFilterWhere(['like', 'first_number', $this->first_number])
            ->andFilterWhere(['like', 'second_number', $this->second_number])
            ->andFilterWhere(['like', 'legal_address', $this->legal_address])
            ->andFilterWhere(['like', 'actual_address', $this->actual_address])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'second_email', $this->second_email])
            ->andFilterWhere(['like', 'director_name', $this->director_name])
            ->andFilterWhere(['like', 'license_number', $this->license_number])
            ->andFilterWhere(['like', 'agreement', $this->agreement])
            ->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'ident', $this->ident])
            ->andFilterWhere(['like', 'contact_name', $this->contact_name])
            ->andFilterWhere(['like', 'web_site', $this->web_site]);

        return $dataProvider;
    }
}
