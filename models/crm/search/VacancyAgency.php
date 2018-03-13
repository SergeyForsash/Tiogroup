<?php

namespace app\models\crm\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\crm\Vacancy;

/**
 * VacancySearch represents the model behind the search form about `app\models\crm\Vacancy`.
 */
class VacancyAgency extends Vacancy
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'company_id', 'industry_id', 'worker', 'city_id', 'education_id', 'polish_id', 'age_f', 'age_t', 'hourinday', 'overtime', 'night_hours', 'working_days', 'number_shifts', 'drive_work', 'individual_means', 'work_clothes', 'work_shoes', 'apartment', 'type_allocation', 'payment_ap', 'number_people', 'bathroom', 'internet', 'kitchen', 'aliment', 'akord', 'hourly_rate', 'month_salary', 'payment_method', 'advance_option', 'billing_period', 'work_status', 'work_add','agreed','status'], 'integer'],
            [['title', 'title_pl', 'duties', 'duties_pl', 'description', 'description_pl', 'sex','driver_license', 'practice', 'practice_pl', 'driver_id', 'o_requirements', 'ot_requirements', 'o_requirements_pl', 'ot_requirements_pl', 'work_other', 'work_other_pl', 'other_expenses', 'other_expenses_pl', 'turn_to', 'cost_living'], 'safe'],
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
        $data_v = 'need translation';
        $query = Vacancy::find()->where(['!=','title',$data_v])
        ->andWhere(['!=','work_status','100'])
        ->andWhere(['!=','worker','0'])
        ->andWhere(['status'=>'4']);

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
            'company_id' => $this->company_id,
            'industry_id' => $this->industry_id,
            'worker' => $this->worker,
            'city_id' => $this->city_id,
            'education_id' => $this->education_id,
            'polish_id' => $this->polish_id,
            'age_f' => $this->age_f,
            'age_t' => $this->age_t,
            'hourinday' => $this->hourinday,
            'overtime' => $this->overtime,
            'night_hours' => $this->night_hours,
            'working_days' => $this->working_days,
            'number_shifts' => $this->number_shifts,
            'drive_work' => $this->drive_work,
            'individual_means' => $this->individual_means,
            'work_clothes' => $this->work_clothes,
            'work_shoes' => $this->work_shoes,
            'turn_to' => $this->turn_to,
            'apartment' => $this->apartment,
            'type_allocation' => $this->type_allocation,
            'payment_ap' => $this->payment_ap,
            'number_people' => $this->number_people,
            'bathroom' => $this->bathroom,
            'internet' => $this->internet,
            'kitchen' => $this->kitchen,
            'aliment' => $this->aliment,
            'akord' => $this->akord,
            'hourly_rate' => $this->hourly_rate,
            'month_salary' => $this->month_salary,
            'payment_method' => $this->payment_method,
            'advance_option' => $this->advance_option,
            'billing_period' => $this->billing_period,
            'work_status' => $this->work_status,
            'work_add' => $this->work_add,
            'agreed'=> $this->agreed,
            'status'=> $this->status,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'title_pl', $this->title_pl])
            ->andFilterWhere(['like', 'duties', $this->duties])
            ->andFilterWhere(['like', 'duties_pl', $this->duties_pl])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'description_pl', $this->description_pl])
            ->andFilterWhere(['like', 'sex', $this->sex])
            ->andFilterWhere(['like', 'driver_license', $this->driver_license])
            ->andFilterWhere(['like', 'practice', $this->practice])
            ->andFilterWhere(['like', 'practice_pl', $this->practice_pl])
            ->andFilterWhere(['like', 'driver_id', $this->driver_id])
            ->andFilterWhere(['like', 'o_requirements', $this->o_requirements])
            ->andFilterWhere(['like', 'ot_requirements', $this->ot_requirements])
            ->andFilterWhere(['like', 'o_requirements_pl', $this->o_requirements_pl])
            ->andFilterWhere(['like', 'ot_requirements_pl', $this->ot_requirements_pl])
            ->andFilterWhere(['like', 'work_other', $this->work_other])
            ->andFilterWhere(['like', 'work_other_pl', $this->work_other_pl])
            ->andFilterWhere(['like', 'other_expenses', $this->other_expenses])
            ->andFilterWhere(['like', 'other_expenses_pl', $this->other_expenses_pl])
            ->andFilterWhere(['like', 'cost_living', $this->cost_living]);

        return $dataProvider;
    }
}
