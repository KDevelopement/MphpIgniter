<?php
/**
 * User: k7brasil
 * Date: 30/07/2022
 * Time: 8:43 PM
 */
namespace app\models;

use k7brasil\microphp\Application;
use k7brasil\microphp\Model;

/**
 * Class LoginForm
 *
 * @author  K7 <@k7brasil>
 * @package app\models
 */
class LoginForm extends Model
{
    public string $email = '';
    public string $password = '';

    public function rules()
    {
        return [
            'email' => [self::RULE_REQUIRED],
            'password' => [self::RULE_REQUIRED],
        ];
    }

    public function labels()
    {
        return [
            'email' => 'Your Email address',
            'password' => 'Password'
        ];
    }

    public function login()
    {
        $user = User::findOne(['email' => $this->email]);
        if (!$user) {
            $this->addError('email', 'User does not exist with this email address');
            return false;
        }
        if (!password_verify($this->password, $user->password)) {
            $this->addError('password', 'Password is incorrect');
            return false;
        }

        return Application::$app->login($user);
    }
}