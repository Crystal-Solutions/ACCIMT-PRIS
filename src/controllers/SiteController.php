<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\UserForm;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    public function actionAbout()
    {
        return $this->render('about');
    }
	
	//my code
	public function actionSay($message = 'Hello')
	{
		return $this -> render('say',['message' => $message]);
	}
	
	/*public function actionUser()
	{
		$model= new UserForm;
		
		if($model->load(Yii::$app->request->post()) && $model->validate())
		{
			Yii::$app->session->setFlash('success','You have entered the data correctly!');
		    return $this->render('userForm-confirm', ['model' => $model]);  
        }
        else
        {
            Yii::$app->session->setFlash('failure','You have entered the data incorrectly!');
		    return $this->render('userForm',['model'=>$model]);
        }	
    }*/

    public function actionUser()
    {
        $model= new UserForm;
        
        if($model->load(Yii::$app->request->post()) )
        {
            if($model->validate()){
                Yii::$app->session->setFlash('success','You have entered the data correctly!');
                return $this->render('userForm-confirm', ['model' => $model]);  
            }
            else{
                Yii::$app->session->setFlash('failure','You have entered the data incorrectly!');//flash for failure not working
                return $this->render('userForm',['model'=>$model]);
            }
        }
        else
        {
            return $this->render('userForm',['model'=>$model]);
        }   
    }

}

?>