<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $id
 * @property string $email
 * @property string $password
 * @property string $name
 * @property integer $date
 * @property integer $status
 * @property string $role
 */
class User extends CActiveRecord
{
    const DEFAULT_STATUS = 0;
    const DEFAULT_ROLE = 'user';

    /**
     * Подтверждение пароля
     *
     * @var string
     */
    public $password2 = '';

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return User the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'user';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return [
            ['email, password, name, date, status, role', 'required'],
            ['email', 'email'],
            ['email', 'unique'],
            ['date, status', 'numerical', 'integerOnly' => true],
            ['email, password, name, role', 'length', 'max' => 255],
            ['password2', 'compare', 'compareAttribute' => 'password', 'on' => 'signUp'],
            ['password2', 'required', 'on' => 'signUp'],
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            ['id, email, password, name, date, status, role', 'safe', 'on' => 'search'],
        ];
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return [];
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'Email',
            'password' => 'Password',
            'name' => 'Name',
            'date' => 'Date',
            'status' => 'Status',
            'role' => 'Role',
            'password2' => 'Repeat password',
        ];
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('password', $this->password, true);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('date', $this->date);
        $criteria->compare('status', $this->status);
        $criteria->compare('role', $this->role, true);

        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
        ]);
    }

    public function beforeValidate()
    {
        if ($this->isNewRecord) {
            $this->date = time();
            $this->status = self::DEFAULT_STATUS;
            $this->role = self::DEFAULT_ROLE;
        }
        return parent::beforeValidate();
    }

    public function beforeSave()
    {
        if ($this->isNewRecord) {
            $this->password = md5($this->password);
        }
        return parent::beforeSave();
    }
}
