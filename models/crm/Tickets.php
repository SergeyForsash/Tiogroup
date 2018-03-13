<?php

namespace app\models\crm;

use Yii;

/**
 * This is the model class for table "tickets".
 *
 * @property int $id
 * @property int $admin_id
 * @property string $admin_name
 * @property int $user_id
 * @property string $user_name
 * @property string $subject
 * @property string $content
 * @property int $tickets_id
 * @property int $agency_id
 * @property int $vacancy_id
 * @property int $viewed_admin
 * @property int $viewed_user
 * @property string $date
 * @property string $time
 * @property int $users
 * @property int $del
 * @property int $status
 */
class Tickets extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tickets';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['admin_id', 'user_id', 'tickets_id', 'agency_id', 'vacancy_id', 'viewed_admin', 'viewed_user', 'users', 'del','status'], 'integer'],
            [['user_id', 'user_name', 'subject', 'content', 'date', 'time', 'users'], 'required'],
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
            'agency_id' => 'Agency ID',
            'vacancy_id' => 'Vacancy ID',
            'viewed_admin' => 'Viewed Admin',
            'viewed_user' => 'Viewed User',
            'date' => 'Date',
            'time' => 'Time',
            'users' => 'Users',
            'del' => 'Del',
            'status'=>'Status',
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
