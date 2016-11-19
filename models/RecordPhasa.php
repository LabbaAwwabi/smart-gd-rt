<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "record_phasa".
 *
 * @property integer $id_record_phasa
 * @property string $id_gardu
 * @property integer $phasa
 * @property double $v
 * @property double $i
 * @property double $p
 * @property double $loses
 * @property string $date
 *
 * @property Phasa $idPhasa
 * @property Gardu $idGardu
 */
class RecordPhasa extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'record_phasa';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['phasa', 'v', 'i', 'p', 'loses'], 'required'],
            [['phasa'], 'integer'],
            [['v', 'i', 'p', 'loses'], 'number'],
            [['date'], 'safe'],
            [['phasa'], 'exist', 'skipOnError' => true, 'targetClass' => Phasa::className(), 'targetAttribute' => ['phasa' => 'id_phasa']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_record_phasa' => 'Id Record Phasa',
            'phasa' => 'Id Phasa',
            'v' => 'V',
            'i' => 'I',
            'p' => 'P',
            'loses' => 'Loses',
            'date' => 'Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPhasa()
    {
        return $this->hasOne(Phasa::className(), ['id_phasa' => 'phasa']);
    }

    public function getPhasaList() {
        $models = Phasa::find()->asArray()->all();
        return ArrayHelper::map($models, 'id_phasa', 'id_phasa');
    }
}
