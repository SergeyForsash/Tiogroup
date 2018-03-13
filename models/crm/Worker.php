<?php

namespace app\models\crm;

use Yii;
use yii\web\UploadedFile;
use yii\helpers\ArrayHelper;
use yii\helpers\BaseStringHelper;
use app\models\admin\StatusWorker;
use app\models\admin\Partner;
use app\models\crm\User;
/**
 * This is the model class for table "worker".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $vacancy_id
 * @property string $full_name
 * @property string $gender
 * @property string $birth_date
 * @property integer $citizenship
 * @property string $legal_location
 * @property string $polish_location
 * @property string $pass_number
 * @property string $date_of_issue
 * @property string $date_of_expiration
 * @property string $pass_supplier
 * @property string $have_visa
 * @property integer $visa_type
 * @property string $visa_expiration
 * @property string $visa_expiration_to
 * @property string $visa_days
 * @property string $resident_certificate
 * @property integer $degree
 * @property integer $profession
 * @property integer $specialisation
 * @property string $mobile_number
 * @property string $email
 * @property integer $polish_knowledge
 * @property integer $driver_license
 * @property string $driver_category
 * @property integer $active
 * @property string $pass_scan
 * @property string $visa_scan
 * @property string $resume
 * @property string $addition_certificate
 * @property string $image
 * @property string $created_at
 * @property string $updated_at
 * @property string $created_by
 * @property integer $smoke
 * @property integer $steal
 * @property integer $team_work
 * @property integer $punctuality
 * @property string $work_behave
 * @property string $employer_opinion
 * @property integer $alcohol
 * @property integer $drugs
 * @property string $is_healthy
 * @property string $medical_board
 * @property string $insurance
 * @property string $number_period
 * @property string $is_working
 * @property string $working_status
 * @property string $working_agreement_start
 * @property string $working_agreement
 * @property string $employer
 * @property string $polish_number
 * @property integer $ident
 * @property integer $agency_name
 * @property string $statusarchive
 * @property string $date_agreeded
 * @property string $date_start
 * @property string $date_finish
 * @property integer $type_pay
 * @property double $rate
 * @property integer $payed
 * @property integer $summaagency
 * @property integer $payedagency
 */
class Worker extends \yii\db\ActiveRecord
{ 
  public $file_pass;
  public $file_visa;
  public $file_resum;
  public $file_certi;
  public $file_img;
  public $file_med;
  public $file_ins;
  public $fname_pass;
  public $fname_visa;
  public $fname_resum;
  public $fname_certi;
  public $fname_img;
  public $fname_med;
  public $fname_ins;
  public $string;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'worker';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id','full_name','email', 'polish_knowledge', 'created_at', 'statusarchive'], 'required'],
            [['user_id','birth_date', 'date_of_issue', 'date_of_expiration', 'visa_expiration','visa_expiration_to',
             'created_at', 'updated_at', 'created_by', 'date_agreeded', 'date_start', 'date_finish'], 'safe'],
            [['vacancy_id','citizenship', 'visa_type', 'degree', 'specialisation', 'polish_knowledge', 'driver_license',
            'active', 'smoke', 'steal', 'team_work', 'punctuality', 'alcohol', 'drugs', 'ident', 'agency_name', 'type_pay', 'payed', 'summaagency', 'payedagency','statusarchive'], 'integer'],
            [['rate'], 'number'],
            [['email'],'email'],
            [['full_name', 'gender', 'legal_location','pass_number', 'polish_location', 'pass_supplier',
            'have_visa', 'visa_days', 'resident_certificate', 'mobile_number', 'email', 'driver_category',
            'work_behave', 'employer_opinion', 'is_healthy', 'number_period', 'is_working', 'working_status',
            'working_agreement_start', 'working_agreement', 'employer', 'polish_number', 'profession'], 'string', 'max' => 255],
            //[['file_pass','file_visa','file_resume','file_certif','file_image'], 'file'],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id'=>'user_id',
            'full_name' => Yii::t('app', 'full_name_w'),
            'gender' => Yii::t('app', 'gender_w'),
            'birth_date' => Yii::t('app', 'birth_date_w'),
            'citizenship' => Yii::t('app', 'citizenship_w'),
            'legal_location' => Yii::t('app', 'legal_location_w'),
            'polish_location' => Yii::t('app', 'polish_location_w'),
            'pass_number' => Yii::t('app', 'pass_number_w'),
            'date_of_issue' => Yii::t('app', 'date_of_issue_w'),
            'date_of_expiration' => Yii::t('app', 'date_of_expiration_w'),
            'pass_supplier' => Yii::t('app', 'pass_supplier_w'),
            'have_visa' => Yii::t('app', 'have_visa_w'),
            'visa_type' => Yii::t('app', 'visa_type_w'),
            'visa_expiration' => Yii::t('app', 'visa_expiration_w'),
            'visa_expiration_to' => Yii::t('app', 'visa_expiration_w'),
            'visa_days' => Yii::t('app', 'visa_days_w'),
            'resident_certificate' => Yii::t('app', 'resident_certificate_w'),
            'degree' => Yii::t('app', 'degree_w'),
            'profession' => Yii::t('app', 'profession_w'),
            'specialisation' => Yii::t('app', 'specialisation_w'),
            'mobile_number' => Yii::t('app', 'mobile_number_w'),
            'email' =>Yii::t('app', 'Email'),
            'polish_knowledge' => Yii::t('app', 'polish_knowledge_w'),
            'driver_license' => Yii::t('app', 'driver_license_w'),
            'driver_category' => Yii::t('app', 'driver_category_w'),
            'active' => Yii::t('app', 'status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_by' => Yii::t('app', 'Created By'),
            'smoke' => Yii::t('app', 'smoke_w'),
            'steal' => Yii::t('app', 'steal_w'),
            'team_work' => Yii::t('app', 'team_work_w'),
            'punctuality' => Yii::t('app', 'punctuality_w'),
            'work_behave' => Yii::t('app', 'work_behave_w'),
            'employer_opinion' => Yii::t('app', 'employer_opinion_w'),
            'alcohol' => Yii::t('app', 'alcohol_w'),
            'drugs' => Yii::t('app', 'drugs_w'),
            'is_healthy' => Yii::t('app', 'is_healthy_w'),
            'medical_board' => Yii::t('app', 'medical_board_w'),
            'insurance' => Yii::t('app', 'insurance_w'),
            'number_period' => Yii::t('app', 'number_period_w'),
            'is_working' => Yii::t('app', 'is_working_w'),
            'working_status' => Yii::t('app', 'working_status_w'),
            'working_agreement_start' => Yii::t('app', 'working_agreement_start_w'),
            'working_agreement' => Yii::t('app', 'working_agreement_w'),
            'employer' => Yii::t('app', 'employer_w'),
            'polish_number' => Yii::t('app', 'polish_number_w'),
            'ident' => Yii::t('app', 'ident_w'),
            'agency_name' => Yii::t('app', 'agency_name_p'),
            'statusarchive' => Yii::t('app', 'statusarchive_w'),
            'date_agreeded' => Yii::t('app', 'date_agreeded_w'),
            'date_start' => Yii::t('app', 'date_start_w'),
            'date_finish' => Yii::t('app', 'date_finish_w'),
            'type_pay' => Yii::t('app', 'type_pay_w'),
            'rate' => Yii::t('app', 'rate_w'),
            'payed' => Yii::t('app', 'payed_w'),
            'summaagency' => Yii::t('app', 'summaagency_w'),
            'payedagency' => Yii::t('app', 'payedagency_w'),
            'pass_scan' => Yii::t('app', 'pass_scan_w'),
            'visa_scan' => Yii::t('app', 'visa_scan_w'),
            'resume' => Yii::t('app', 'resume_w'),
            'addition_certificate' => Yii::t('app', 'addition_certificate_w'),
            'image' => Yii::t('app', 'image_w'),
        ];
    }

    public function getStatus()
    {
        return $this->hasOne(StatusWorker::className(), ['id' => 'statusarchive']);
    }
    public function getStatusName()
    {
          $status = $this->status;

          return $status ? $status->title: '';
    }
    public static function getStatusList()
    {
          $type = User::getType(['id'=>Yii::$app->user->id]);
          if($type == 2) {
            $parents = StatusWorker::find()
            ->where(['agency' => 1])
            ->distinct(true)
            ->all();
          }elseif($type == 0) {
            $parents = StatusWorker::find()
            ->where(['admin' => 1])
            ->distinct(true)
            ->all();
          }

          return ArrayHelper::map($parents, 'id', 'title');
    }
    public function getStatusNamePl()
    {
          $status = $this->status;

          return $status ? $status->title_pl: '';
    }
    public static function getStatusListPl()
    {
          $parents = StatusWorker::find()
          ->where(['employer' => 1])
          ->distinct(true)
          ->all();

          return ArrayHelper::map($parents, 'id', 'title_pl');
    }

    public function getAgency()
    {
        return $this->hasOne(Partner::className(), ['user_id' => 'created_by']);
    }
    public function getAgencyName()
    {
          $agency = $this->agency;

          return $agency ? $agency->agency_name : '';
    }
    public static function getAgencyList()
    {
          $parents = Partner::find()
          ->distinct(true)
          ->all();

          return ArrayHelper::map($parents, 'user_id', 'agency_name');
    }
    public function getVacancys()
      {
        return $this->hasMany(Vacancy::className(), ['id'=> 'vacancy_id'])
            ->viaTable('vacancy_worker', ['worker_id' => 'id']);
      }

    public function  getGender()
    {
      return [
        '1'=>Yii::t('app', 'Male'),
        '2'=>Yii::t('app', 'Female'),
      ];
    }
    public function  getChoose()
    {
      return [
        '1'=>Yii::t('app', 'Yes'),
        '2'=>Yii::t('app', 'No'),
      ];
    }
    public function upload($docers)
    {
          $this->string = date("d_m_Y").'_user_id'.$docers->user_id;
        if ($this->validate()) {
          $this->file_pass = UploadedFile::getInstance($this, 'pass_scan');
          if ($docers->pass_scan == NULL & !empty($this->file_pass)) {
            $this->fname_pass = 'uploads/doc/pass_' . $this->string . '.' . $this->file_pass->extension;
            $this->file_pass->saveAs($this->fname_pass);
            $this->pass_scan = '/' . $this->fname_pass;
          }else{
            $this->file_pass = UploadedFile::getInstance($this, 'pass_scan');
                if($this->file_pass){
                  $this->file_pass->saveAs(substr($this->pass_scan,1));
              }
          }
          $this->file_visa = UploadedFile::getInstance($this, 'visa_scan');
          if ($docers->visa_scan == NULL & !empty($this->file_visa)) {
            $this->file_visa = UploadedFile::getInstance($this, 'visa_scan');
            $this->fname_visa = 'uploads/doc/visa_' . $this->string . '.' . $this->file_visa->extension;
            $this->file_visa->saveAs($this->fname_visa);
            $this->visa_scan = '/' . $this->fname_visa;
          }else{
            $this->file_visa = UploadedFile::getInstance($this, 'visa_scan');
            if($this->file_visa){
                $this->file_visa->saveAs(substr($this->visa_scan,1));
            }
          }
          $this->file_resum = UploadedFile::getInstance($this, 'resume');
          if ($docers->resume == NULL & !empty($this->file_resum)) {
            $this->fname_resum = 'uploads/doc/resum_' . $this->string . '.' . $this->file_resum->extension;
            $this->file_resum->saveAs($this->fname_resum);
            $this->resume = '/' . $this->fname_resum;
          }else{
            $this->file_resum  = UploadedFile::getInstance($this, 'resume');
            if($this->file_resum ){
                $this->file_resum ->saveAs(substr($this->resume,1));
            }
          }
          $this->file_certi = UploadedFile::getInstance($this, 'addition_certificate');
          if ($docers->addition_certificate == NULL & !empty($this->file_certi)) {
            $this->fname_certi = 'uploads/doc/certi_' . $this->string . '.' . $this->file_certi->extension;
            $this->file_certi->saveAs($this->fname_certi);
            $this->addition_certificate = '/' . $this->fname_certi;
          }else{
            $this->file_certi  = UploadedFile::getInstance($this, 'addition_certificate');
            if($this->file_certi ){
                $this->file_certi ->saveAs(substr($this->addition_certificate,1));
            }
          }
          $this->file_img = UploadedFile::getInstance($this, 'image');
          if ($docers->image== NULL & !empty($this->file_img)) {
            $this->fname_img = 'uploads/doc/img_' . $this->string . '.' . $this->file_img->extension;
            $this->file_img ->saveAs($this->fname_img);
            $this->image = '/' . $this->fname_img;
          }else{
            $this->file_img  = UploadedFile::getInstance($this, 'image');
            if($this->file_img ){
                $this->file_img ->saveAs(substr($this->image,1));
            }
          }
          $this->file_med = UploadedFile::getInstance($this, 'medical_board');
          if ($docers->medical_board == NULL & !empty($this->file_med)) {
            $this->fname_med = 'uploads/doc/med_' . $this->string . '.' . $this->file_med->extension;
            $this->file_med ->saveAs($this->fname_med);
            $this->medical_board = '/' . $this->fname_med;
          }else{
            $this->file_med = UploadedFile::getInstance($this, 'medical_board');
            if($this->file_med ){
                $this->file_med ->saveAs(substr($this->medical_board,1));
            }
          }
          $this->file_ins = UploadedFile::getInstance($this, 'insurance');
          if ($docers->insurance == NULL & !empty($this->file_ins)) {
            $this->fname_ins = 'uploads/doc/ins_' . $this->string . '.' . $this->file_ins->extension;
            $this->file_ins ->saveAs($this->fname_ins);
            $this->insurance = '/' . $this->fname_ins;
          }else{
            $this->file_ins = UploadedFile::getInstance($this, 'insurance');
            if($this->file_ins ){
                $this->file_ins ->saveAs(substr($this->insurance,1));
            }
          }
          return $this->save();
        }else{
            return false;
        }
    }
}
