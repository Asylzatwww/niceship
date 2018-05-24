<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class ContactForm extends Model
{
    public $name;
    public $email;
    public $subject;
    public $body;
    public $verifyCode;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['name', 'email', 'subject', 'body'], 'required', 'message' => 'Необходимо заполнить'],
            // email has to be a valid email address
            ['email', 'email', 'message' => 'Необходимо ввести формат почты'],
            // verifyCode needs to be entered correctly
            ['verifyCode', 'captcha', 'message' => 'Ошибка верификации'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'verifyCode' => 'Введите надпись',
            'email' => 'Электронная почта',
            'name' => 'Имя',
            'subject' => 'Тема обращения',
            'body' => 'Сообщение',
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     * @param string $email the target email address
     * @return boolean whether the model passes validation
     */
    public function contact($email)
    {
        if ($this->validate()) {
            $this->body = 'Email - ' . $this->email . '<br>' . $this->body;
            $this->email = 'infogeo-spb@infogeo-spb.ru';
            Yii::$app->mailer->compose()
                ->setTo($email)
                ->setFrom([$this->email => $this->name])
                ->setSubject($this->subject)
                ->setHtmlBody($this->body)
                ->send();

            return true;
        }
        return false;
    }
}
