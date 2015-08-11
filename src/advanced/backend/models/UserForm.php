<?php
namespace backend\models;

use common\models\User;
use backend\models\DivisionHasUser;
use yii\base\Model;
use Yii;

/**
 * User form
 */
class UserForm extends Model
{
    public $username;
    public $email;
    public $password;

    //
    public $name;
    public $epf_no;
    public $isNewRecord;
    public $divisions;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            [['username', 'name' , 'epf_no'], 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['epf_no', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This epf_no has already been taken.'],

            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],


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

            //Added
            $user->name = $this->name;
            $user->epf_no = $this->epf_no;



            if ($user->save()) {

                 $divisions = $_POST['UserForm']['divisions'];
                 foreach($divisions as $value)
                 {
                    $div = new DivisionHasUser();
                    $div->division_id = $value;
                    $div->user_id = $user->id;
                    $div->save(); 
                 }

                return $user;
            }
        }

        return null;
    }
}
