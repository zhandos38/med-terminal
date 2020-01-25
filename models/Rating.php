<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rating".
 *
 * @property int $id
 * @property int|null $employee_id
 * @property float|null $value
 * @property string|null $comment
 * @property string|null $iin
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property Employee $employee
 */
class Rating extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rating';
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['employee_id', 'created_at', 'updated_at'], 'integer'],
            [['value'], 'number'],
            [['comment', 'customer_name'], 'string'],
            [['iin'], 'string', 'max' => 255],
            [['employee_id'], 'exist', 'skipOnError' => true, 'targetClass' => Employee::className(), 'targetAttribute' => ['employee_id' => 'id']],
            ['value', 'required']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'employee_id' => 'Врачи',
            'value' => Yii::t('site', 'Оценка'),
            'comment' => Yii::t('site', 'Комментарий'),
            'iin' => Yii::t('site', 'ИИН пациента'),
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'customer_name' => Yii::t('site', 'Ф.И.О пациента'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmployee()
    {
        return $this->hasOne(Employee::className(), ['id' => 'employee_id']);
    }
}
