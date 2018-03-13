<?php

namespace app\models\crm\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\crm\Worker;
use app\models\crm\Vacancy;

/**
 * WorkerSearch represents the model behind the search form about `app\models\crm\Worker`.
 */
class WorkerEmploer extends Worker
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id','vacancy_id', 'user_id','citizenship', 'visa_type', 'degree', 'specialisation', 'polish_knowledge', 'driver_license', 'active', 'smoke', 'steal', 'team_work', 'punctuality', 'alcohol', 'drugs', 'ident', 'agency_name', 'type_pay', 'payed', 'summaagency', 'payedagency', 'statusarchive'], 'integer'],
            [['full_name', 'gender', 'birth_date', 'legal_location', 'polish_location', 'pass_number', 'date_of_issue', 'date_of_expiration', 'pass_supplier', 'have_visa', 'visa_expiration', 'visa_days', 'resident_certificate', 'mobile_number', 'email', 'driver_category', 'pass_scan', 'visa_scan', 'resume', 'addition_certificate', 'image', 'created_at', 'updated_at', 'created_by', 'work_behave', 'employer_opinion', 'is_healthy', 'medical_board', 'insurance', 'number_period', 'is_working', 'working_status', 'working_agreement_start', 'working_agreement', 'employer', 'polish_number', 'date_agreeded', 'date_start', 'date_finish', 'profession'], 'safe'],
            [['rate'], 'number'],
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
        $id = Yii::$app->user->id;
        $vacancy = Vacancy::find()->where(['company_id'=>$id])->all();
        $vacancy_id = array_column($vacancy, 'id');
        $query =Worker::find()
          ->where(['vacancy_id'=>$vacancy_id])
          ->andWhere(['>=','statusarchive','4'])
          ->andWhere(['<','statusarchive','100']);

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
            'vacancy_id' => $this->vacancy_id,
            'birth_date' => $this->birth_date,
            'citizenship' => $this->citizenship,
            'date_of_issue' => $this->date_of_issue,
            'date_of_expiration' => $this->date_of_expiration,
            'visa_type' => $this->visa_type,
            'visa_expiration' => $this->visa_expiration,
            'degree' => $this->degree,
            'specialisation' => $this->specialisation,
            'polish_knowledge' => $this->polish_knowledge,
            'driver_license' => $this->driver_license,
            'active' => $this->active,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'smoke' => $this->smoke,
            'steal' => $this->steal,
            'team_work' => $this->team_work,
            'punctuality' => $this->punctuality,
            'alcohol' => $this->alcohol,
            'drugs' => $this->drugs,
            'ident' => $this->ident,
            'agency_name' => $this->agency_name,
            'date_agreeded' => $this->date_agreeded,
            'date_start' => $this->date_start,
            'date_finish' => $this->date_finish,
            'type_pay' => $this->type_pay,
            'rate' => $this->rate,
            'payed' => $this->payed,
            'statusarchive'=> $this->statusarchive,
            'summaagency' => $this->summaagency,
            'payedagency' => $this->payedagency,
        ]);

        $query->andFilterWhere(['like', 'full_name', $this->full_name])
            ->andFilterWhere(['like', 'gender', $this->gender])
            ->andFilterWhere(['like', 'legal_location', $this->legal_location])
            ->andFilterWhere(['like', 'polish_location', $this->polish_location])
            ->andFilterWhere(['like', 'pass_number', $this->pass_number])
            ->andFilterWhere(['like', 'pass_supplier', $this->pass_supplier])
            ->andFilterWhere(['like', 'have_visa', $this->have_visa])
            ->andFilterWhere(['like', 'visa_days', $this->visa_days])
            ->andFilterWhere(['like', 'profession', $this->profession])
            ->andFilterWhere(['like', 'resident_certificate', $this->resident_certificate])
            ->andFilterWhere(['like', 'mobile_number', $this->mobile_number])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'driver_category', $this->driver_category])
            ->andFilterWhere(['like', 'pass_scan', $this->pass_scan])
            ->andFilterWhere(['like', 'visa_scan', $this->visa_scan])
            ->andFilterWhere(['like', 'resume', $this->resume])
            ->andFilterWhere(['like', 'addition_certificate', $this->addition_certificate])
            ->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'work_behave', $this->work_behave])
            ->andFilterWhere(['like', 'employer_opinion', $this->employer_opinion])
            ->andFilterWhere(['like', 'is_healthy', $this->is_healthy])
            ->andFilterWhere(['like', 'medical_board', $this->medical_board])
            ->andFilterWhere(['like', 'insurance', $this->insurance])
            ->andFilterWhere(['like', 'number_period', $this->number_period])
            ->andFilterWhere(['like', 'is_working', $this->is_working])
            ->andFilterWhere(['like', 'working_status', $this->working_status])
            ->andFilterWhere(['like', 'working_agreement_start', $this->working_agreement_start])
            ->andFilterWhere(['like', 'working_agreement', $this->working_agreement])
            ->andFilterWhere(['like', 'employer', $this->employer])
            ->andFilterWhere(['like', 'polish_number', $this->polish_number]);

        return $dataProvider;
    }
}
