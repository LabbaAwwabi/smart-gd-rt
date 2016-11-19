<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "status_unbalance".
 *
 * @property integer $id_status_unbalance
 * @property string $nama
 *
 * @property Gardu[] $gardus
 */
class StatusUnbalance extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'status_unbalance';
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
            'id_status_unbalance' => 'Id Status Unbalance',
            'nama' => 'Nama',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGardus()
    {
        return $this->hasMany(Gardu::className(), ['status_unbalance' => 'id_status_unbalance']);
    }
}
