<?php

namespace app\models;

class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    public $passwordrepeat;

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
            // username and password are both required
            [['username', 'password', 'passwordrepeat', 'email', 'firstname', 'lastname'], 'required', 'message' => 'Необходимо заполнить'],
            [['username', 'password', 'passwordrepeat', 'email'], 'trim'],
            [['email'], 'email', 'message' => 'email is not valid'],
            //[['money'], 'safe'],
            [['username', 'password','passwordrepeat'], 'string', 'max'=>600, 'min'=>4, 'tooLong' => 'too long', 'tooShort'=>'tooShort'],
            // password is validated by validatePassword()
            ['password', 'passwordRepeat'],

        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Логин',
            'firstname' => 'Имя',
            'lastname' => 'Фамилия',
            'password' => 'Пароль',
            'passwordrepeat' => 'Повторить пароль',
            'email' => 'Емайл',
            'money' => 'Деньги',
        ];
    }

    /**
     * Finds an identity by the given ID.
     *
     * @param string|integer $id the ID to be looked for
     * @return IdentityInterface|null the identity object that matches the given ID.
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * Finds an identity by the given token.
     *
     * @param string $token the token to be looked for
     * @return IdentityInterface|null the identity object that matches the given token.
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    /**
     * @return int|string current user ID
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);

        return null;
    }

    /**
     * @return string current user auth key
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * @param string $authKey
     * @return boolean if auth key is valid for current user
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password === sha1($password);
    }

    public function setPassword($password){
        return sha1($password);
    }

    public function dataControll($before, $after){
        if ($before->money != $after->money) return false;
        return true;
    }

    public function passwordRepeat()
    {
            if ($this->password != $this->passwordrepeat) {
                $this->addError('passwordrepeat', 'Пароль не совпадает.');
                return false;
            }
            return true;
    }

}
