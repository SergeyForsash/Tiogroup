<?php

namespace app\models\crm;

use Yii;

/**
 * This is the model class for table "vacancy_worker".
 *
 * @property integer $id
 * @property integer $vacancy_id
 * @property integer $worker_id
 */
class VacancyWorker extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vacancy_worker';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['vacancy_id', 'worker_id'], 'required'],
            [['vacancy_id', 'worker_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'vacancy_id' => 'Vacancy ID',
            'worker_id' => 'Worker ID',
        ];
    }
}
