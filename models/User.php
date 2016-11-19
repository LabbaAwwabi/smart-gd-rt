<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "user".
 *
 * @property integer $id_user
 * @property string $nama
 * @property string $username
 * @property string $email
 * @property string $password
 * @property string $authKey
 * @property string $accessToken
 * @property integer $user_type
 * @property integer $hak_akses
 *
 * @property Log[] $logs
 * @property HakAkses $hakAkses
 * @property UserType $userType
 */
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nama', 'username', 'email', 'password', 'user_type', 'hak_akses'], 'required'],
            [['user_type', 'hak_akses'], 'integer'],
            [['nama', 'authKey', 'accessToken'], 'string', 'max' => 100],
            [['username', 'email', 'password'], 'string', 'max' => 50],
            [['hak_akses'], 'exist', 'skipOnError' => true, 'targetClass' => HakAkses::className(), 'targetAttribute' => ['hak_akses' => 'id_hak_akses']],
            [['user_type'], 'exist', 'skipOnError' => true, 'targetClass' => UserType::className(), 'targetAttribute' => ['user_type' => 'id_user_type']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_user' => 'Id User',
            'nama' => 'Nama',
            'username' => 'Username',
            'email' => 'Email',
            'password' => 'Password',
            'authKey' => 'Auth Key',
            'accessToken' => 'Access Token',
            'user_type' => 'User Type',
            'hak_akses' => 'Hak Akses',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLogs()
    {
        return $this->hasMany(Log::className(), ['user' => 'id_user']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHakAkses()
    {
        return $this->hasOne(HakAkses::className(), ['id_hak_akses' => 'hak_akses']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserType()
    {
        return $this->hasOne(UserType::className(), ['id_user_type' => 'user_type']);
    }

    /**
     * Finds user by username
     *
     * @param  string      $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        $result = self::find()->where(['username'=>$username])->one();
        return new static($result);
    }

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    public function getId()
    {
        return $this->id_user;
    }

    public function getAuthKey()
    {
        return $this->authKey;
    }

    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password === md5($password);
    }

    public function getHakAksesList() {
        $models = HakAkses::find()->asArray()->all();
        return ArrayHelper::map($models, 'id_hak_akses', 'nama');
    }

    public function getUserTypeList() {
        $models = UserType::find()->asArray()->all();
        return ArrayHelper::map($models, 'id_user_type', 'nama');
    }
}
