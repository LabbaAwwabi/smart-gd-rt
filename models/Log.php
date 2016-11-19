<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "log".
 *
 * @property integer $id_log
 * @property integer $user
 * @property string $activity
 * @property string $date
 *
 * @property User $user0
 */
class Log extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user', 'activity'], 'required'],
            [['user'], 'integer'],
            [['date'], 'safe'],
            [['activity'], 'string'],
            [['user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user' => 'id_user']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_log' => 'Id Log',
            'user' => 'User',
            'activity' => 'Activity',
            'date' => 'Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser0()
    {
        return $this->hasOne(User::className(), ['id_user' => 'user']);
    }
}
