<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class SignupForm extends Model
{
    public $username;
    public $firstname;
    public $lastname;
    public $password;
    public $passwordrepeat;
    public $email;

    private $_user = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password', 'passwordrepeat', 'email', 'firstname', 'lastname'], 'required', 'message' => 'Необходимо заполнить'],
            [['username', 'password', 'passwordrepeat', 'email'], 'trim'],
            [['email'], 'email', 'message' => 'email is not valid'],
            [['username', 'password','passwordrepeat'], 'string', 'max'=>60, 'min'=>4, 'tooLong' => 'too long', 'tooShort'=>'tooShort'],
            // password is validated by validatePassword()
            ['password', 'passwordRepeat'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function passwordRepeat()
    {
            if ($this->password != $this->passwordrepeat) {
                $this->addError('passwordrepeat', 'Пароль не совпадает.');
                return false;
            }
            return true;
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
        ];
    }

    public function uniqUsername(){
        if (User::find()->select(['username'])->where(['username' => $this->username])->count() > 0) {
            $this->addError('username', 'Имя пользователя должно быть уникально.');
            return false; 
        }
        return true;
    }

    public function randomString($length = 6) {
        $str = "";
        $characters = array_merge(range('A','Z'), range('a','z'), range('0','9'));
        $max = count($characters) - 1;
        for ($i = 0; $i < $length; $i++) {
            $rand = mt_rand(0, $max);
            $str .= $characters[$rand];
        }
        return $str;
    }

}
