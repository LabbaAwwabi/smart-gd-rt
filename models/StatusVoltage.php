<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "status_voltage".
 *
 * @property integer $id_status_voltage
 * @property string $nama
 *
 * @property Phasa[] $phasas
 */
class StatusVoltage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'status_voltage';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nama'], 'required'],
            [['nama'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_status_voltage' => 'Id Status Voltage',
            'nama' => 'Nama',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhasas()
    {
        return $this->hasMany(Phasa::className(), ['status_voltage' => 'id_status_voltage']);
    }
}
