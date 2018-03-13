<?php

namespace app\models\admin;

use Yii;
use app\models\crm\User;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;
/**
 * This is the model class for table "company".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $firm_name
 * @property string $director_name
 * @property string $address
 * @property string $actual_address
 * @property string $nip
 * @property string $regon
 * @property string $krs
 * @property string $phone_number
 * @property string $mobile_number
 * @property string $email
 * @property string $website
 * @property string $file
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $ident
 * @property integer $status
 */
class Company extends \yii\db\ActiveRecord
{
  public $file_agr;
  public $fname_agr;
  public $string;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'company';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'status'], 'integer'],
            [['firm_name', 'director_name', 'address','actual_address', 'nip', 'regon', 'krs', 'phone_number', 'mobile_number', 'email', 'website', 'ident'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['firm_name', 'director_name', 'address','actual_address', 'nip', 'regon', 'krs', 'phone_number', 'mobile_number', 'email', 'website', 'ident'], 'string', 'max' => 255],
            [['email'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => Yii::t('app', 'user_id_p'),
            'firm_name' => Yii::t('app', 'firm_name'),
            'director_name' => Yii::t('app', 'director_name'),
            'address' => Yii::t('app', 'address_c'),
            'actual_address' => Yii::t('app', 'actual_address_p'),
            'nip' => Yii::t('app', 'Nip'),
            'regon' => Yii::t('app', 'Regon'),
            'krs' => Yii::t('app', 'Krs'),
            'phone_number' => Yii::t('app', 'phone_number_c'),
            'mobile_number' => Yii::t('app', 'mobile_number_c'),
            'email' => Yii::t('app', 'Email'),
            'website' => Yii::t('app', 'web_site_p'),
            'file' => Yii::t('app', 'file'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'ident' => Yii::t('app', 'ident_p'),
            'status' => Yii::t('app', 'status'),
        ];
    }
    public function upload($docers)
    {
      $this->string = date("d_m_Y").'_user_id'.$docers->user_id;
      if ($this->validate()) {
        $this->file_agr = UploadedFile::getInstance($this, 'file');
        if ($docers->file == NULL & !empty($this->file_agr)) {
          $this->fname_agr = 'uploads/file_company/file_' . $this->string . '.' . $this->file_agr->extension;
          $this->file_agr->saveAs($this->fname_agr);
          $this->file = '/' . $this->fname_agr;
        }else{
          $this->file_agr = UploadedFile::getInstance($this, 'file');
              if($this->file_agr){
                $this->file_agr->saveAs(substr($this->file,1));
            }
        }
            return $this->save();
        }else{
            return false;
        }
    }

}
