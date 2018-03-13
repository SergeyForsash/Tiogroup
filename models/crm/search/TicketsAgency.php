<?php

namespace app\models\crm\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\crm\Tickets as TicketsModel;

/**
 * Tickets represents the model behind the search form of `app\models\crm\Tickets`.
 */
class TicketsAgency extends TicketsModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'admin_id', 'user_id', 'tickets_id', 'agency_id', 'vacancy_id', 'viewed_admin', 'viewed_user', 'users', 'del','status'], 'integer'],
            [['admin_name', 'user_name', 'subject', 'content', 'date', 'time'], 'safe'],
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
        $query = TicketsModel::find()->where(['agency_id'=>Yii::$app->user->id,'tickets_id'=>'0'])->andWhere(['<','status','3']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                 'pageSize' => 5,
              ],
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
            'admin_id' => $this->admin_id,
            'user_id' => $this->user_id,
            'tickets_id' => $this->tickets_id,
            'agency_id' => $this->agency_id,
            'vacancy_id' => $this->vacancy_id,
            'viewed_admin' => $this->viewed_admin,
            'viewed_user' => $this->viewed_user,
            'date' => $this->date,
            'time' => $this->time,
            'users' => $this->users,
            'del' => $this->del,
            'status'=>$this->status,
        ]);

        $query->andFilterWhere(['like', 'admin_name', $this->admin_name])
            ->andFilterWhere(['like', 'user_name', $this->user_name])
            ->andFilterWhere(['like', 'subject', $this->subject])
            ->andFilterWhere(['like', 'content', $this->content]);

        return $dataProvider;
    }
}
