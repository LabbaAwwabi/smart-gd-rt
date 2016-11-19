<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "phasa_type".
 *
 * @property integer $id_phasa_type
 * @property string $nama
 *
 * @property Phasa[] $phasas
 */
class PhasaType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'phasa_type';
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
            'id_phasa_type' => 'Id Phasa Type',
            'nama' => 'Nama',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhasas()
    {
        return $this->hasMany(Phasa::className(), ['phasa_type' => 'id_phasa_type']);
    }
}
