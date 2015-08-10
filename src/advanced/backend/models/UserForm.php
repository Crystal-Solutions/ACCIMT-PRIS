<?php
namespace backend\models;

use common\models\User;
use yii\base\Model;
use Yii;

/**
 * UserForm form
 */
class UserForm extends Model
{
    public $id;
    public $username;
    public $email;
    public $password;

    public $name;
    public $epf_no;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],

            //Extra rules
            ['name', 'required'],
            ['name','filter', 'filter' => 'trim'],
            ['epf_no', 'string', 'max' => 45],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function save()
    {
        if ($this->validate()) {

            $user = new User();
            $user->username = $this->username;
            $user->email = $this->email;
            $user->setPassword($this->password);
            $user->generateAuthKey();

            //Others
            $user ->name = $this -> name;
            $user ->epf_no = $this -> epf_no;
            if ($user->save()) {

                //Save other details

                return $user;
            }
        }

        return null;
    }

    public function isNewRecord()
    {
        return $this->id === "";
    }
}
