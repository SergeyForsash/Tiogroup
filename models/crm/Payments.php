<?php

namespace app\models\crm;

use Yii;

/**
 * This is the model class for table "payments".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $company_id
 * @property string $date_for
 * @property string $date_to
 * @property string $hours
 * @property string $rate
 * @property string $total
 */
class Payments extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'payments';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'company_id','month_id', 'hours', 'rate', 'total'], 'required'],
            [['user_id', 'company_id','month_id','status_id','status_pay'], 'integer'],
            [['vacancy_name','vacancy_name_pl','hours', 'rate', 'total'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'company_id' => Yii::t('app', 'Company ID'),
            'vacancy_name'=> Yii::t('app', 'Vacancie'),
            'vacancy_name_pl'=> Yii::t('app', 'Vacancie_Pl'),
            'month_id' => Yii::t('app', 'Month'),
            'hours' => Yii::t('app', 'Кол-во часов'),
            'rate' => Yii::t('app', 'Rate'),
            'total' => Yii::t('app', 'Total'),
            'status_id'=> Yii::t('app', 'Status Pay'),
            'status_pay' => Yii::t('app', 'status_pay'),
        ];
    }
}
