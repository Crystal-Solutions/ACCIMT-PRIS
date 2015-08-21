<?php
namespace backend\models;

use common\models\User;
use yii\base\InvalidParamException;
use yii\base\Model;
use Yii;

/**
 * Password reset form
 */
class ChangePasswordForm extends Model
{
    public $password;
    public $newPassword;
    public $repeatPassword;




    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['password','newPassword'], 'required'],
            [['password','newPassword'], 'string', 'min' => 6],
            ['repeatPassword', 'compare', 'compareAttribute'=>'newPassword', 'message'=>"Passwords don't match"]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'password' => 'Current Password',
            'newPassword' => 'New Password',
            'repeatPassword' => 'Repeate New Password',
            ];
    }

    /**
     * Resets password.
     *
     * @return boolean if password was reset.
     */
    public function save()
    {
        $user = User::findOne(Yii::$app->user->id) ;
        if ($this->validate() && $user->validatePassword($this->password)) {
            $user->setPassword($this->newPassword);
            $user->save();
            return true;
        }

        return false;
    }
}
