<?php

/**
 * This is the model class for table "plus_minus".
 *
 * The followings are the available columns in table 'plus_minus':
 * @property integer $id
 * @property integer $goodId
 * @property integer $operationId
 * @property string $value
 * @property string $dateTime
 *
 * The followings are the available model relations:
 * @property Goods $good
 */
class PlusMinus extends CActiveRecord
{
    const OPERATION_PLUS = 1;
    const OPERATION_MINUS = 2;
    const OPERATION_DELETE = 3;

    protected $_model;

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return PlusMinus the static model class
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
        return 'plus_minus';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return [
            ['value, goodId, operationId, dateTime', 'required'],
            ['id, goodId, operationId, value', 'numerical', 'integerOnly' => true],
            ['value', 'length', 'max' => 20],
            ['dateTime', 'safe'],
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            ['id, goodId, operationId, value, dateTime', 'safe', 'on' => 'search'],
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
        ];
    }

    public function getOperation()
    {
        $operations = [
            self::OPERATION_PLUS => 'Plus',
            self::OPERATION_MINUS => 'Minus',
            self::OPERATION_DELETE => 'DELETE!!!',
        ];

        return $operations[$this->operationId];
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'goodId' => 'Good',
            'operationId' => 'Operation',
            'value' => 'Value',
            'dateTime' => 'Date Time',
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
        $criteria->compare('operationId', $this->operationId);
        $criteria->compare('value', $this->value, true);
        $criteria->compare('dateTime', $this->dateTime, true);

        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
        ]);
    }

    public function checkAccessEdit()
    {
        if (Yii::app()->user->checkAccess('admin') || Yii::app()->user->checkAccess('manager') || Yii::app()->user->checkAccess('staff')) {
            return true;
        }
        return false;
    }

    public function checkAccessDelete()
    {
        if (Yii::app()->user->checkAccess('admin')) {
            return true;
        }
        return false;
    }

    protected function beforeSave()
    {
        $this->_model = $this;
        return parent::beforeSave();
    }

    protected function beforeDelete()
    {
        $log = new Log();
        $log->goodId = $this->goodId;
        $log->operationId = self::OPERATION_DELETE;
        $log->userId = Yii::app()->user->uid;
        $log->value = $this->value;
        $log->isUpdate = 1;
        $log->dateTime = date('Y-m-d H:i:s');
        if (!$log->save()) {
            Yii::log(json_encode($log->errors), CLogger::LEVEL_ERROR);
        }
        return parent::beforeDelete();
    }

    protected function afterSave()
    {
        $log = new Log();
        $log->goodId = $this->goodId;
        $log->operationId = $this->operationId;
        $log->userId = Yii::app()->user->uid;
        $log->value = $this->value;
        $log->isUpdate = (int)!$this->_model->isNewRecord;
        $log->dateTime = date('Y-m-d H:i:s');
        if (!$log->save()) {
            Yii::log(json_encode($log->errors), CLogger::LEVEL_ERROR);
        }

        parent::afterSave();
    }
}
