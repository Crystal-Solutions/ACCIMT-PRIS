<?php
namespace backend\models;

use common\models\User;
use backend\models\DivisionHasUser;
use yii\base\Model;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * User form
 */
class UserForm extends Model
{
    public $id;
    public $username;
    public $email;
    public $password;

    //
    public $name;
    public $epf_no;
    public $isNewRecord;
    public $divisions;
    public $auths;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            [['username', 'name' , 'epf_no'], 'required'],
            ['id', 'unique', 'on' => 'create','targetClass' => '\common\models\User', 'message' => 'This ID has already been taken.'],
          
            ['username', 'unique', 'on' => 'create','targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['epf_no', 'unique', 'on' => 'create', 'targetClass' => '\common\models\User', 'message' => 'This epf_no has already been taken.'],

            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'on' => 'create','targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required','on' => 'create'],
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

            $user = User::findOne($this->id);
            if(!$user) 
                $user = new User();

            $user->username = $this->username;
            $user->email = $this->email;

            if($this->isNewRecord)
            {
                $user->setPassword($this->password);
                $user->generateAuthKey();
            }

            //set username and epf
            $user->name = $this->name;
            $user->epf_no = $this->epf_no;

            if ($user->save()) {

                //Save all division user connections_________________________________
                 $divisions = $_POST['UserForm']['divisions'];

                 //Remove existing relations by DivisionHasUser
                 $relations = $user->getDivisionHasUsers()->all();
                 foreach($relations as $relation) $relation->delete();

                 //add new relations by DivisionHasUser
                 foreach($divisions as $value)
                 {

                    $div = new DivisionHasUser();
                    $div->division_id = $value;
                    $div->user_id = $user->id;
                    $div->save(); 
                 }


                 //Save all auths user connections______________________________
                 $auths = $_POST['UserForm']['auths'];

                 //remove all auths
                 $existingAuths = $user->getAuthAssignments()->all();
                 foreach($existingAuths as $auth) $auth->delete();

                 //Add new ones
                 foreach($auths as $value)
                 {

                    $div = new AuthAssignment();
                    $div->item_name = $value;
                    $div->user_id = $user->id;
                    $div->save(); 
                 }

                return $user;
            }
        }

        return null;
    }

    public function setUser($user)
    {
        $this->id = $user->id;  
        $this->username = $user->username;
        $this->email = $user->email;

        //
        $this->name =  $user->name;
        $this->epf_no =  $user->epf_no;
        $this->isNewRecord = false;



        //Get a list of id of divisions
        $this->divisions = [];
        $divisions = $user->getDivisions()->all();
        foreach($divisions as $div)
        {
            array_push($this->divisions, $div->id);
        }

        //get a list of assigned auths
        $this->auths = [];
        $auths = $user->getAuthAssignments()->all();
        foreach($auths as $auth)
        {
            array_push($this->divisions, $auth->id);
        }
    }
}
