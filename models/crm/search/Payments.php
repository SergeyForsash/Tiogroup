<?php

namespace app\models\crm\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\crm\Payments as PaymentsModel;

/**
 * Payments represents the model behind the search form about `app\models\crm\Payments`.
 */
class Payments extends PaymentsModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'company_id','month_id','status_id','status_pay'], 'integer'],
            [['vacancy_name','vacancy_name_pl','hours', 'rate', 'total'], 'safe'],
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
    public function search($params,$user_id)
    {
        $query = PaymentsModel::find()->where(['user_id'=>$user_id])->orderBy(['id'=>SORT_DESC]);

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
            'company_id' => $this->company_id,
            'month_id' => $this->month_id,
            'status_id' => $this->status_id,
            'status_pay' => $this->status_pay,
        ]);

        $query->andFilterWhere(['vacancy_name', 'rate', $this->vacancy_name])
            ->andFilterWhere(['vacancy_name_pl', 'rate', $this->vacancy_name_pl])
            ->andFilterWhere(['like', 'hours', $this->hours])
            ->andFilterWhere(['like', 'rate', $this->rate])
            ->andFilterWhere(['like', 'total', $this->total]);

        return $dataProvider;
    }
}
