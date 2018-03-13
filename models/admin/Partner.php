<?php

namespace app\models\admin;

use Yii;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;
/**
 * This is the model class for table "partner".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $agency_name
 * @property string $first_number
 * @property string $second_number
 * @property string $legal_address
 * @property string $actual_address
 * @property string $email
 * @property string $second_email
 * @property string $director_name
 * @property string $license_number
 * @property string $agreement
 * @property string $image
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 * @property string $ident
 * @property string $contact_name
 * @property string $web_site
 */
class Partner extends \yii\db\ActiveRecord
{
  public $file_agr;
  public $file_img;
  public $fname_agr;
  public $fname_img;
  public $string;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'partner';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'agency_name', 'first_number', 'second_number', 'legal_address', 'actual_address', 'email', 'second_email', 'director_name', 'status', 'created_at', 'ident', 'contact_name', 'web_site'], 'required'],
            [['user_id', 'status'], 'integer'],
            [['email', 'second_email'],'email'],
            [['created_at', 'updated_at'], 'safe'],
            [['agency_name', 'first_number', 'second_number', 'legal_address', 'actual_address', 'email', 'second_email', 'director_name', 'license_number', 'ident', 'contact_name', 'web_site'], 'string', 'max' => 255],

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
            'agency_name' => Yii::t('app', 'agency_name_p'),
            'first_number' => Yii::t('app', 'first_number_p'),
            'second_number' => Yii::t('app', 'second_number_p'),
            'legal_address' => Yii::t('app', 'legal_address_p'),
            'actual_address' => Yii::t('app', 'actual_address_p'),
            'email' => Yii::t('app', 'Email'),
            'second_email' => Yii::t('app', 'second_email_p'),
            'director_name' => Yii::t('app', 'director_name_p'),
            'license_number' => Yii::t('app', 'license_number_p'),
            'agreement' => Yii::t('app', 'agreement_p'),
            'image' => Yii::t('app', 'image_p'),
            'status' => Yii::t('app', 'status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'ident' => Yii::t('app', 'ident_p'),
            'contact_name' => Yii::t('app', 'contact_name_p'),
            'web_site' => Yii::t('app', 'web_site_p'),
        ];
    }

    public function upload($docers)
    {
          $this->string = date("d_m_Y").'_user_id'.$docers->user_id;
        if ($this->validate()) {
          $this->file_agr = UploadedFile::getInstance($this, 'agreement');
          if ($docers->agreement == NULL & !empty($this->file_agr)) {
            $this->fname_agr = 'uploads/dogovor_partner/dog_' . $this->string . '.' . $this->file_agr->extension;
            $this->file_agr->saveAs($this->fname_agr);
            $this->agreement = '/' . $this->fname_agr;
          }else{
            $this->file_agr = UploadedFile::getInstance($this, 'agreement');
                if($this->file_agr){
                  $this->file_agr->saveAs(substr($this->agreement,1));
              }
          }
          $this->file_img = UploadedFile::getInstance($this, 'image');
          if ($docers->image == NULL & !empty($this->file_img)) {
            $this->file_img = UploadedFile::getInstance($this, 'image');
            $this->fname_img = 'uploads/foto_partner/foto_' . $this->string . '.' . $this->file_img->extension;
            $this->file_img->saveAs($this->fname_img);
            $this->image = '/' . $this->fname_img;
          }else{
            $this->file_img = UploadedFile::getInstance($this, 'image');
            if($this->file_img){
                $this->file_img->saveAs(substr($this->image,1));
            }
          }
          return $this->save();
        }else{
            return false;
        }
    }
}
