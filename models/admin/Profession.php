<?php

namespace app\models\admin;

use Yii;

/**
 * This is the model class for table "profession".
 *
 * @property integer $id
 * @property string $spec_id
 * @property string $title
 * @property string $title_pl
 */
class Profession extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'profession';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'title_pl','spec_id'], 'required'],
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
            'spec_id' => Yii::t('app', 'Specialisations'),
            'title' => Yii::t('app', 'title_ru'),
            'title_pl' => Yii::t('app', 'title_pl'),
        ];
    }
}
