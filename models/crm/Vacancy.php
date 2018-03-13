<?php

namespace app\models\crm;

use Yii;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;
use app\models\admin\Specialisation;
use app\models\admin\City;
use app\models\admin\Company;
/**
 * This is the model class for table "vacancy".
 *
 * @property integer $id
 * @property integer $vacancy_id
 * @property integer $company_id
 * @property integer $industry_id
 * @property string $title
 * @property string $title_pl
 * @property string $duties
 * @property string $duties_pl
 * @property string $description
 * @property string $description_pl
 * @property string $video
 * @property string $image
 * @property integer $worker
 * @property integer $city_id
 * @property string $sex
 * @property integer $education_id
 * @property string $practice
 * @property string $practice_pl
 * @property integer $polish_id
 * @property integer $age_f
 * @property integer $age_t
 * @property string $driver_license
 * @property string $driver_id
 * @property string $o_requirements
 * @property string $ot_requirements
 * @property string $o_requirements_pl
 * @property string $ot_requirements_pl
 * @property integer $hourinday
 * @property integer $overtime
 * @property integer $night_hours
 * @property integer $working_days
 * @property integer $number_shifts
 * @property integer $drive_work
 * @property integer $individual_means
 * @property integer $work_clothes
 * @property integer $work_shoes
 * @property string $work_other
 * @property string $work_other_pl
 * @property string $other_expenses
 * @property string $other_expenses_pl
 * @property string $turn_to
 * @property integer $apartment
 * @property integer $type_allocation
 * @property integer $payment_ap
 * @property string $cost_living
 * @property integer $number_people
 * @property integer $bathroom
 * @property integer $internet
 * @property integer $kitchen
 * @property integer $aliment
 * @property integer $akord
 * @property integer $hourly_rate
 * @property integer $month_salary
 * @property integer $payment_method
 * @property integer $advance_option
 * @property integer $billing_period
 * @property string $date_create
 * @property integer $work_status
 * @property integer $work_add
 * @property integer $agreed
 * @property integer $status
 */
class Vacancy extends \yii\db\ActiveRecord
{
     public $other_permissions;
     public $file_img;
     public $fname_img;
     public $string;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vacancy';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['company_id', 'industry_id', 'title', 'title_pl', 'duties', 'duties_pl', 'description', 'description_pl',
            'worker', 'city_id', 'sex', 'education_id', 'practice', 'practice_pl', 'polish_id', 'age_f', 'age_t', 'hourinday',
            'overtime', 'night_hours', 'working_days', 'number_shifts', 'drive_work', 'individual_means', 'turn_to',
            'apartment', 'akord',   'payment_method', 'advance_option', 'billing_period', 'date_create'], 'required'],
            [['company_id', 'industry_id', 'worker', 'city_id', 'education_id', 'polish_id', 'age_f', 'age_t','driver_license',
            'hourinday', 'overtime', 'night_hours', 'working_days', 'number_shifts', 'drive_work', 'individual_means', 'work_clothes',
            'work_shoes', 'apartment', 'type_allocation', 'payment_ap', 'number_people', 'bathroom', 'internet', 'kitchen', 'aliment',
             'akord','payment_method', 'advance_option', 'billing_period', 'work_status', 'work_add','agreed','status'], 'integer'],
            [['description', 'description_pl', 'ot_requirements', 'ot_requirements_pl', 'work_other', 'work_other_pl', 'other_expenses',
            'other_expenses_pl'], 'string'],
            [['turn_to', 'date_create','video','image'], 'safe'],
            [['hourly_rate', 'month_salary'], 'number'],
            [['title', 'title_pl', 'sex', 'driver_id', 'o_requirements', 'o_requirements_pl', 'cost_living'], 'string', 'max' => 255],
            [['duties', 'duties_pl', 'practice', 'practice_pl'], 'string', 'max' => 512],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'Code'),
            'company_id' => Yii::t('app', 'Company ID'),
            'industry_id' => Yii::t('app', 'Industry ID'),
            'title' => Yii::t('app', 'Title Ru'),
            'title_pl' => Yii::t('app', 'Title Pl'),
            'duties' => Yii::t('app', 'Duties'),
            'duties_pl' => Yii::t('app', 'Duties Pl'),
            'description' => Yii::t('app', 'Description'),
            'description_pl' => Yii::t('app', 'Description Pl'),
            'video' => Yii::t('app', 'Video'),
            'image' => Yii::t('app', 'image_p'),
            'worker' => Yii::t('app', 'Worker'),
            'city_id' => Yii::t('app', 'City'),
            'sex' => Yii::t('app', 'gender_w'),
            'education_id' => Yii::t('app', 'Education ID'),
            'practice' => Yii::t('app', 'Practice'),
            'practice_pl' => Yii::t('app', 'Practice Pl'),
            'polish_id' => Yii::t('app', 'Polish Knowledges'),
            'age_f' => Yii::t('app', 'Age F'),
            'age_t' => Yii::t('app', 'Age T'),
            'driver_id' => Yii::t('app', 'Driver ID'),
            'o_requirements' => Yii::t('app', 'O Requirements'),
            'ot_requirements' => Yii::t('app', 'Ot Requirements'),
            'o_requirements_pl' => Yii::t('app', 'O Requirements Pl'),
            'ot_requirements_pl' => Yii::t('app', 'Ot Requirements Pl'),
            'hourinday' => Yii::t('app', 'Hourinday'),
            'overtime' => Yii::t('app', 'Overtime'),
            'night_hours' => Yii::t('app', 'Night Hours'),
            'working_days' => Yii::t('app', 'Working Days'),
            'number_shifts' => Yii::t('app', 'Number Shifts'),
            'drive_work' => Yii::t('app', 'Drive Work'),
            'individual_means' => Yii::t('app', 'Individual Means'),
            'work_clothes' => Yii::t('app', 'Work Clothes'),
            'work_shoes' => Yii::t('app', 'Work Shoes'),
            'work_other' => Yii::t('app', 'Work Other'),
            'work_other_pl' => Yii::t('app', 'Work Other Pl'),
            'other_expenses' => Yii::t('app', 'Other Expenses'),
            'other_expenses_pl' => Yii::t('app', 'Other Expenses Pl'),
            'turn_to' => Yii::t('app', 'Turn To'),
            'apartment' => Yii::t('app', 'Apartment'),
            'type_allocation' => Yii::t('app', 'Type Allocation'),
            'payment_ap' => Yii::t('app', 'Payment Ap'),
            'cost_living' => Yii::t('app', 'Cost Living'),
            'number_people' => Yii::t('app', 'Number People'),
            'bathroom' => Yii::t('app', 'Bathroom'),
            'internet' => Yii::t('app', 'Internet'),
            'kitchen' => Yii::t('app', 'Kitchen'),
            'aliment' => Yii::t('app', 'Aliment'),
            'akord' => Yii::t('app', 'Akord'),
            'hourly_rate' => Yii::t('app', 'Hourly Rate'),
            'month_salary' => Yii::t('app', 'Month Salary'),
            'payment_method' => Yii::t('app', 'Payment Method'),
            'advance_option' => Yii::t('app', 'Advance Option'),
            'billing_period' => Yii::t('app', 'Billing Period'),
            'driver_license' => Yii::t('app', 'Driver License'),
            'other_permissions' => Yii::t('app', 'Other permissions'),
            'date_create' => Yii::t('app', 'Date Create'),
            'status' => Yii::t('app', 'Статус'),
        ];
    }
    public function getSpecialisation()
    {
        return $this->hasOne(Specialisation::className(), ['id' => 'industry_id']);
    }
    public function getSpecialisationName()
    {
          $specialisation = $this->specialisation;

          return $specialisation ? $specialisation->title: '';
    }
    public static function getSpecialisationList()
    {
          $parents = Specialisation::find()
          ->distinct(true)
          ->all();

          return ArrayHelper::map($parents, 'id', 'title');
    }
    public function getCity()
    {
        return $this->hasOne(City::className(), ['id' => 'city_id']);
    }
    public function getCityName()
    {
          $city = $this->city;

          return $city ? $city->title: '';
    }
    public static function getCityList()
    {
          $parents = City::find()
          ->distinct(true)
          ->all();

          return ArrayHelper::map($parents, 'id', 'title');
    }

    public function getWorkers()
     {
         return $this->hasMany(Worker::className(), ['worker_id' => 'id']);
     }
    public function  getVacancyId()
    {
      $models =  Vacancy::find()->where(['status'=>'4'])->andWhere(['!=','worker','0'])->all();
      foreach ($models as $model)
      if ($model->title !== 'need translation') {
          $data[]=[
            'id'=>$model->id,
            'title'=>$model->id.'. '.$model->title,
          ];
      }
      if (!empty($data)) {
        return ArrayHelper::map($data, 'id', 'title');
      }
    }

    public static function getCompanyList()
    {
          $companys = Company::find()
          ->distinct(true)
          ->all();

          return ArrayHelper::map($companys, 'user_id', 'firm_name');
    }

    public function  getGender()
    {
      return [
        '1'=>Yii::t('app', 'Male'),
        '2'=>Yii::t('app', 'Female'),
        '3'=>Yii::t('app', 'Male/Female'),
        '4'=>Yii::t('app', 'Vapor'),
        '5'=>Yii::t('app', 'Male/Female/Vapor'),
      ];
    }
    public function  getChoose()
    {
      return [
        '1'=>Yii::t('app', 'Yes'),
        '2'=>Yii::t('app', 'No'),
      ];
    }
    public function  getChooses()
    {
      return [
        '1'=>Yii::t('app', 'Not necessary'),
        '2'=>Yii::t('app', 'By the employee'),
        '3'=>Yii::t('app', 'On the employers side'),
      ];
    }
    public function  getApartment()
    {
      return [
        '1'=>Yii::t('app', 'By the employee'),
        '2'=>Yii::t('app', 'On the employers side'),
      ];
    }
    public function  getTypeApartment()
    {
      return [
        '1'=>Yii::t('app', 'Apartment'),
        '2'=>Yii::t('app', 'House'),
        '3'=>Yii::t('app', 'Working hotel'),
      ];
    }
    public function  getPaymentAp()
    {
      return [
        '1'=>Yii::t('app', 'Chargeable'),
        '2'=>Yii::t('app', 'Free'),
      ];
    }
    public function  getNumberPeople()
    {
      return [
        '1'=>'1',
        '2'=>'2',
        '3'=>'3',
        '4'=>'4',
        '5'=>'5',
        '6'=>'6',
      ];
    }
    public function  getPaymentMethod()
    {
      return [
        '1'=>Yii::t('app', 'Bank card'),
        '2'=>Yii::t('app', 'Cash payment'),
      ];
    }
    public function  getBillingPeriod()
    {
      return [
        '1'=>Yii::t('app', 'Week'),
        '2'=>Yii::t('app', 'Two weeks'),
        '3'=>Yii::t('app', 'Month'),
      ];
    }
    public function getWorkingDays()
    {
      return [
        '5'=>'5',
        '6'=>'6',
        '7'=>'7',
      ];
    }
    public function getNumberShifts()
    {
      return [
        '1'=>'1',
        '2'=>'2',
        '3'=>'3',
      ];
    }

    public function  getStatus()
    {
      return [
        '1'=>Yii::t('app', 'Добавлена'),
        '2'=>Yii::t('app', 'На проверке'),
        '3'=>Yii::t('app', 'На корректировке'),
        '4'=>Yii::t('app', 'Опубликована'),
        '5'=>Yii::t('app', 'Скрытая'),
      ];
    }

    public function  getStatusEmploer()
    {
      return [
        '2'=>Yii::t('app', 'Опубликовать'),
        '5'=>Yii::t('app', 'Скрыть'),
      ];
    }

    public function  getStatusName($id)
    {
      if ($id == '1') {
       $data = Yii::t('app', 'Добавлена') ;
      }elseif ($id == '2') {
        $data = Yii::t('app', 'На проверке');
      }elseif ($id == '3') {
        $data = Yii::t('app', 'На корректировке');
      }elseif ($id == '4') {
        $data = Yii::t('app', 'Опубликована');
      }elseif ($id == '5') {
        $data = Yii::t('app', 'Скрытая');
      }
      return $data;
    }

    public function upload($docers)
    {
          $this->string = date("d_m_Y").'_vacancy_id'.$docers->id;
        if ($this->validate()) {
          $this->file_img = UploadedFile::getInstance($this, 'image');
          if ($docers->image == NULL & $this->file_img !== NULL) {
            $this->fname_img = 'uploads/vacancy/img_' . $this->string . '.' . $this->file_img->extension;
            $this->file_img ->saveAs($this->fname_img);
            $this->image = '/' . $this->fname_img;
          }else{
            $this->file_img  = UploadedFile::getInstance($this, 'image');
            if($this->file_img ){
                $this->file_img ->saveAs(substr($this->image, 1));
            }
          }
          return $this->save();
        }else{
            return false;
        }
    }
}
