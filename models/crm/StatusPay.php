<?php

namespace app\models\crm;

use Yii;

/**
 * This is the model class for table "status_pay".
 *
 * @property integer $id
 * @property string $title
 * @property string $title_pl
 */
class StatusPay extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'status_pay';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'title_pl'], 'required'],
            [['title', 'title_pl'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => Yii::t('app', 'title_ru'),
            'title_pl' => Yii::t('app', 'title_pl'),
        ];
    }
}
