<?php

namespace backend\controllers;

use Yii;

use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\data\ActiveDataProvider;

use common\models\User;
use backend\models\UserSearch;
use backend\models\UserForm;
use backend\models\DivisionHasUser;
use backend\models\Division;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\ForbiddenHttpException; 
use yii\web\NotAcceptableHttpException; 
/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => [ 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['index','create','edit', 'update','view', 'delete'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        if(!Yii::$app->user->can('system-admin')) throw new ForbiddenHttpException;

        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $query = User::FindOne($id)->getDivisions();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $authsQ = User::FindOne($id)->getAuthAssignments();
        $auths = new ActiveDataProvider([
            'query' => $authsQ,
        ]);

        return $this->render('view', [
            'model' => $this->findModel($id),
            'dataProvider' => $dataProvider,
            'dataProviderAuths' => $auths,
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {

        if(Yii::$app->user->can('create-user'))
        {   //access to create user-S


            $model = new UserForm();

            $model->isNewRecord = true;
            $model->divisions = [];     
            $model->setScenario('create');
            if ($model->load(Yii::$app->request->post()) && $model->validate() ) {
                //Generate Authkey and set the password
                $user = $model->save();
                if($user)
                    return $this->redirect(['view', 'id' => $user->id]);
            } else {

                //$model->divisions = ArrayHelper::map(Division::find()->all(),'id','name');
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }else{
            throw new ForbiddenHttpException;   
        }
        //throw new NotAcceptableHttpException;
     
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if(Yii::$app->user->can('update-user'))
        {                                           //access to update user-S
        $user = $this->findModel($id);

        $model = new UserForm();
        $model->setUser($user);



        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            return $this->redirect(['view', 'id' => $user->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
        }else{
            throw new ForbiddenHttpException;
        }
        //throw new NotAcceptableHttpException;
    }


    public function actionEdit()
    {
        $model = $this->findModel(Yii::$app->getUser()->id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('edit', [
                'model' => $model,
            ]);
        }

    }
    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if(Yii::$app->user->can('system-admin')){   //system admin can delete user-S    

            //You can't delete your own
           if(Yii::$app->user->id==$id) throw new ForbiddenHttpException("You can't delete your own account!");
  
            //Find division has users relations and delete
            $user = $this->findModel($id);
            $divisionRelations = $user->getDivisionHasUsers()->all();
            if($divisionRelations)
            foreach($divisionRelations as $relation)
                $relation->delete();

            //Delete auth assigntments
            $authAssignments = $user->getAuthAssignments()->all();
            if($authAssignments)
            foreach($authAssignments as $assignment)
                $assignment->delete();

            //delete user
            $user->delete();

            return $this->redirect(['index']);
        }else{
            throw new ForbiddenHttpException;   //are we going to keep this as forbidden exeption-S
        }
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


}
