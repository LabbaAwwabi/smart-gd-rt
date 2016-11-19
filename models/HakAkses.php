<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "hak_akses".
 *
 * @property integer $id_hak_akses
 * @property string $nama
 *
 * @property User[] $users
 */
class HakAkses extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hak_akses';
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
            'id_hak_akses' => 'Id Hak Akses',
            'nama' => 'Nama',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['hak_akses' => 'id_hak_akses']);
    }
}
