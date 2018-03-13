<?php

namespace app\models\admin;

use Yii;

/**
 * This is the model class for table "polish_knowledge".
 *
 * @property integer $id
 * @property string $title
 * @property string $title_pl
 */
class PolishKnowledge extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'polish_knowledge';
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
