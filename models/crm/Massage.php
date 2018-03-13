<?php

namespace app\models\crm;

use Yii;

/**
 * This is the model class for table "massage".
 *
 * @property integer $id
 * @property integer $admin_id
 * @property string $admin_name
 * @property integer $user_id
 * @property string $user_name
 * @property string $subject
 * @property string $content
 * @property integer $tickets_id
 * @property integer $viewed_admin
 * @property integer $viewed_user
 * @property string $date
 * @property string $time
 */
class Massage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'massage';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['admin_id', 'user_id', 'tickets_id', 'viewed_admin', 'viewed_user','massage_id','users'], 'integer'],
            [['user_id', 'user_name', 'subject', 'content', 'date', 'time'], 'required'],
            [['content'], 'string'],
            [['date', 'time'], 'safe'],
            [['admin_name', 'user_name'], 'string', 'max' => 255],
            [['subject'], 'string', 'max' => 512],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'admin_id' => 'Admin ID',
            'admin_name' => 'Admin Name',
            'user_id' => 'User ID',
            'user_name' => 'User Name',
            'subject' => 'Subject',
            'content' => 'Content',
            'tickets_id' => 'Tickets ID',
            'viewed_admin' => 'Viewed Admin',
            'viewed_user' => 'Viewed User',
            'date' => 'Date',
            'time' => 'Time',
        ];
    }
    public function viewedUserCounter()
    {
         if ($this->viewed_user == 0) {
           $this->viewed_user += 1;
           return $this->save(false);
         }

    }

    public function viewedAdminCounter()
    {
      if ($this->viewed_admin == 0) {
        $this->viewed_admin += 1;
        return $this->save(false);
      }
    }

}
