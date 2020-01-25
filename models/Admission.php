<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "admission".
 *
 * @property int $id
 * @property string $full_name
 * @property int $status
 * @property int $type
 * @property int $department
 * @property int $room
 * @property int $is_discharged
 * @property int $updated_at
 * @property int $created_at
 * @property string $iin [varchar(255)]
 * @property int $department_id [int(11)]
 */
class Admission extends \yii\db\ActiveRecord
{
    const STATUS_HOSPITALIZED = 0;
    const STATUS_REFUSE = 1;
    const STATUS_TRANSFER = 2;

    const TYPE_PLANNED = 0;
    const TYPE_EXTREME = 1;
    const TYPE_SUDDEN = 2;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'admission';
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::class
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status', 'type', 'department_id', 'room', 'is_discharged', 'iin' ,'updated_at', 'created_at'], 'integer'],
            [['full_name'], 'string', 'max' => 255],
            [['full_name', 'type', 'status', 'department_id'], 'required']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'full_name' => Yii::t('site', 'Ф.И.О'),
            'status' => Yii::t('site', 'Статус'),
            'type' => Yii::t('site', 'Тип'),
            'department_id' => Yii::t('site', 'Отделение'),
            'room' => Yii::t('site', 'Палата'),
            'is_discharged' => Yii::t('site', 'Выписан'),
            'iin' => Yii::t('site', 'ИИН'),
            'updated_at' => 'Updated At',
            'created_at' => Yii::t('site', 'Дата обращение'),
        ];
    }

    public function getDepartment()
    {
        return $this->hasOne(Department::className(), ['id' => 'department_id']);
    }

    public static function getStatuses()
    {
        return [
            self::STATUS_HOSPITALIZED => 'Госпитализирован',
            self::STATUS_REFUSE => 'Отказ от госпитализации',
            self::STATUS_TRANSFER => 'Переведен',
        ];
    }

    public function getStatusLabel()
    {
        return ArrayHelper::getValue(self::getStatuses(), $this->status);
    }

    public static function getTypes()
    {
        return [
            self::TYPE_PLANNED => 'Плановый',
            self::TYPE_EXTREME => 'Экстренный',
            self::TYPE_SUDDEN => 'Неотложенный',
        ];
    }

    public function getTypeLabel()
    {
        return ArrayHelper::getValue(self::getTypes(), $this->type);
    }
}
