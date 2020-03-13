<?php

/**
 * This is the model class for table "log".
 *
 * The followings are the available columns in table 'log':
 * @property integer $id
 * @property integer $goodId
 * @property integer $userId
 * @property integer $operationId
 * @property string $dateTime
 * @property integer $isUpdate
 * @property integer $value
 *
 * The followings are the available model relations:
 * @property Goods $good
 * @property User $user
 */
class Log extends CActiveRecord
{
    public $dateTime_1;
    public $dateTime_2;

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Log the static model class
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
        return 'log';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return [
            ['goodId, userId, operationId, dateTime', 'required'],
            ['id, goodId, userId, operationId, isUpdate, value', 'numerical', 'integerOnly' => true],
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            ['id, goodId, userId, operationId, dateTime, isUpdate, value, dateTime_1, dateTime_2', 'safe', 'on' => 'search'],
        ];
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return [
            'good' => [self::BELONGS_TO, 'Goods', 'goodId'],
            'user' => [self::BELONGS_TO, 'User', 'userId'],
        ];
    }

    public function getOperation()
    {
        $operations = [
            PlusMinus::OPERATION_PLUS => 'Plus',
            PlusMinus::OPERATION_MINUS => 'Minus',
            PlusMinus::OPERATION_DELETE => 'Delete',
        ];

        return $operations[$this->operationId];
    }

    public function isUpdate()
    {
        if ($this->isUpdate == 1) {
            return 'Yes, update';
        }

        return 'No, new record';
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'goodId' => 'Good',
            'userId' => 'User',
            'operationId' => 'Operation',
            'dateTime' => 'Date Time',
            'isUpdate' => 'Is Update',
            'value' => 'Value',
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
        $criteria->compare('goodId', $this->goodId);
        $criteria->compare('userId', $this->userId);
        $criteria->compare('operationId', $this->operationId);
        if (!empty($this->dateTime_1) && !empty($this->dateTime_2)) {
            $criteria->addBetweenCondition('dateTime', $this->dateTime_1, $this->dateTime_2, 'AND');
        }
        //$criteria->compare('dateTime',$this->dateTime,true);

        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
            'sort' => [
                'defaultOrder' => 'id DESC',
            ],
        ]);
    }
}
