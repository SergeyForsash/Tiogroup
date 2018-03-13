<?php

namespace app\models\admin;

use Yii;

/**
 * This is the model class for table "driver_category".
 *
 * @property integer $id
 * @property string $title
 */
class DriverCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'driver_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title'], 'string', 'max' => 255],
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
        ];
    }
}
