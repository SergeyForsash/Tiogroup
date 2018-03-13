<?php

namespace app\models\admin\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\admin\Company;

/**
 * CompanySearch represents the model behind the search form about `app\models\admin\Company`.
 */
class CompanySearch extends Company
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'created_at', 'updated_at', 'status'], 'integer'],
            [['firm_name', 'director_name', 'address','actual_address', 'nip', 'regon', 'krs', 'phone_number', 'mobile_number', 'email', 'website', 'file', 'ident'], 'safe'],
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
        $query = Company::find();

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
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'firm_name', $this->firm_name])
            ->andFilterWhere(['like', 'director_name', $this->director_name])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'actual_address', $this->actual_address])
            ->andFilterWhere(['like', 'nip', $this->nip])
            ->andFilterWhere(['like', 'regon', $this->regon])
            ->andFilterWhere(['like', 'krs', $this->krs])
            ->andFilterWhere(['like', 'phone_number', $this->phone_number])
            ->andFilterWhere(['like', 'mobile_number', $this->mobile_number])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'website', $this->website])
            ->andFilterWhere(['like', 'file', $this->file])
            ->andFilterWhere(['like', 'ident', $this->ident]);

        return $dataProvider;
    }
}
