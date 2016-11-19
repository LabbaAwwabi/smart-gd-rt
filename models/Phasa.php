<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "phasa".
 *
 * @property integer $id_phasa
 * @property string $gardu
 * @property double $v
 * @property double $i
 * @property double $p
 * @property double $loses
 * @property integer $phasa_type
 * @property integer $status_voltage
 *
 * @property Pelanggan[] $pelanggans
 * @property Gardu $gardu0
 * @property PhasaType $phasaType
 * @property StatusVoltage $statusVoltage
 */
class Phasa extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'phasa';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['gardu', 'v', 'phasa_type'], 'required'],
            [['v', 'i', 'p', 'loses'], 'number'],
            [['phasa_type', 'status_voltage'], 'integer'],
            [['gardu'], 'string', 'max' => 25],
            [['status_voltage', 'loses', 'i', 'p'], 'safe'],
            [['gardu'], 'exist', 'skipOnError' => true, 'targetClass' => Gardu::className(), 'targetAttribute' => ['gardu' => 'id_gardu']],
            [['phasa_type'], 'exist', 'skipOnError' => true, 'targetClass' => PhasaType::className(), 'targetAttribute' => ['phasa_type' => 'id_phasa_type']],
            [['status_voltage'], 'exist', 'skipOnError' => true, 'targetClass' => StatusVoltage::className(), 'targetAttribute' => ['status_voltage' => 'id_status_voltage']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_phasa' => 'Id Phasa',
            'gardu' => 'Gardu',
            'v' => 'V',
            'i' => 'I',
            'p' => 'P',
            'loses' => 'Loses',
            'phasa_type' => 'Phasa Type',
            'status_voltage' => 'Status Voltage',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPelanggans()
    {
        return $this->hasMany(Pelanggan::className(), ['phasa' => 'id_phasa']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGardu0()
    {
        return $this->hasOne(Gardu::className(), ['id_gardu' => 'gardu']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhasaType()
    {
        return $this->hasOne(PhasaType::className(), ['id_phasa_type' => 'phasa_type']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatusVoltage()
    {
        return $this->hasOne(StatusVoltage::className(), ['id_status_voltage' => 'status_voltage']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGarduList()
    {
        $models = Gardu::find()->asArray()->all();
        return ArrayHelper::map($models, 'id_gardu', 'id_gardu');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhasaTypeList()
    {
        $models = PhasaType::find()->asArray()->all();
        return ArrayHelper::map($models, 'id_phasa_type', 'nama');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVoltageList()
    {
        $models = StatusVoltage::find()->asArray()->all();
        return ArrayHelper::map($models, 'id_status_voltage', 'nama');
    }
}
