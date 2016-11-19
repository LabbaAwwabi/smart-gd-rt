<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "pelanggan".
 *
 * @property integer $id_pelanggan
 * @property double $langganan
 * @property double $v
 * @property double $i
 * @property double $p
 * @property integer $phasa
 * @property integer $status
 * @property string $kode_registrasi
 *
 * @property Phasa $phasa0
 */
class Pelanggan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pelanggan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['langganan', 'v', 'i', 'p', 'phasa', 'kode_registrasi'], 'required'],
            [['langganan', 'v', 'i', 'p'], 'number'],
            [['phasa', 'status'], 'integer'],
            [['kode_registrasi'], 'string', 'max' => 50],
            [['phasa'], 'exist', 'skipOnError' => true, 'targetClass' => Phasa::className(), 'targetAttribute' => ['phasa' => 'id_phasa']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_pelanggan' => 'Id Pelanggan',
            'langganan' => 'Langganan',
            'v' => 'V',
            'i' => 'I',
            'p' => 'P',
            'phasa' => 'Phasa',
            'status' => 'Status',
            'kode_registrasi' => 'Kode Registrasi',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhasa0()
    {
        return $this->hasOne(Phasa::className(), ['id_phasa' => 'phasa']);
    }

    public function getStatusLabel()
    {
        return $this->status ? 'Unlock' : 'Lock';
    }

    public function getPhasaList() {
        $models = Phasa::find()->asArray()->all();
        return ArrayHelper::map($models, 'id_phasa', 'id_phasa');
    }
}
