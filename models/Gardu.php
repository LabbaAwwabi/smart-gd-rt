<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;
/**
 * This is the model class for table "gardu".
 *
 * @property string $id_gardu
 * @property double $loses
 * @property integer $status_unbalance
 *
 * @property StatusUnbalance $statusUnbalance
 * @property Phasa[] $phasas
 */
class Gardu extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gardu';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_gardu', 'loses'], 'required'],
            [['loses'], 'number'],
            [['status_unbalance'], 'safe'],
            [['status_unbalance'], 'integer'],
            [['id_gardu'], 'string', 'max' => 25],
            [['status_unbalance'], 'exist', 'skipOnError' => true, 'targetClass' => StatusUnbalance::className(), 'targetAttribute' => ['status_unbalance' => 'id_status_unbalance']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_gardu' => 'Id Gardu',
            'loses' => 'Loses',
            'status_unbalance' => 'Status Unbalance',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatusUnbalance()
    {
        return $this->hasOne(StatusUnbalance::className(), ['id_status_unbalance' => 'status_unbalance']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhasas()
    {
        return $this->hasMany(Phasa::className(), ['gardu' => 'id_gardu']);
    }

    public function getUnbalanceList() {
        $models = StatusUnbalance::find()->asArray()->all();
        return ArrayHelper::map($models, 'id_status_unbalance', 'nama');
    }
}
