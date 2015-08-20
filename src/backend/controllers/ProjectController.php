<?php

namespace backend\controllers;

use Yii;
use backend\models\Project;
use backend\models\ProjectSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\ForbiddenHttpException;
use yii\web\NotAcceptableHttpException;
use yii\filters\AccessControl;
use backend\models\TeamMember;

use yii\data\ActiveDataProvider;

/**
 * ProjectController implements the CRUD actions for Project model.
 */
class ProjectController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => [ 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['index','create', 'update','view','approveddg', 'approvedh','delete','printview','printviewall','printviewsearch'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                    'approveDDG'=>['post'],
                    'approveDH'=>['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Project models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProjectSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Project model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        //modified to get team members -not working -S
//        $query1 = Project::FindOne($id)->getUsers();
//        $dataProvider = new ActiveDataProvider([
//            'query' => $query1,
//        ]);

        return $this->render('view', [
            'model' => $this->findModel($id),
            //'dataProvider' => $dataProvider,
        ]);
    }

    //Print View
    public function actionPrintview($id)
    {
        $this->layout = 'print';
        return $this->render('printview', [
            'model' => $this->findModel($id),
            'all'=>false,
        ]);
    }

    //Print View
    public function actionPrintviewall($id)
    {
        $this->layout = 'print';
        return $this->render('printview', [
            'model' => $this->findModel($id),
            'all'=>true,
        ]);
    }

    //Search-Print View
    public function actionPrintviewsearch()
    {
        $this->layout = 'print';
        $searchModel = new ProjectSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('printviewsearch', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            //'all'=>false,
            //'search'=>true,
        ]);
    }

    /**
     * Creates a new Project model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if(Yii::$app->user->can('create-project')){   //access to create project-S
            
            $model = new Project();

            if ($model->load(Yii::$app->request->post())) {
                $model->requested_user_id = Yii::$app->user->id;        //current user id is taken and saved


                if($model->save())                      //only if saved the redirection happens

                    //////////////////////////////////////////////////////////////////

                    //Save all project user connections_________________________________
                    $users = $_POST['Project']['users']['team_members'];

                    //add new relations by DivisionHasUser
                    if($users){
                        foreach($users as $user)
                        {

                            $team = new TeamMember();
                            $team->user_id = $user;
                            $team->project_id = $model->id;
                            $team->save(); 
                        }
                    }
                    ////////////////////////////////////////////////////////////////////
                    Yii::$app->session->setFlash('success', 'A new project is been created');
                    return $this->redirect(['view', 'id' => $model->id]);

            } else {

                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }else{
            throw new ForbiddenHttpException;   //-S
        }
        throw new NotAcceptableHttpException;

    }

    /**
     * Updates an existing Project model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if(Yii::$app->user->can('update-project') || ($this->findModel($id)->requested_user_id==Yii::$app->user->id)){   //access to update project-S
            $model = $this->findModel($id);


            if ($model->load(Yii::$app->request->post()))
            {
                 if($model->save()) {

                    //////////////////////////////////////////////////////////////////

                    //Save all project user connections_________________________________
                    $users = $_POST['Project']['users']['team_members'];
                    //Remove existing relations by DivisionHasUser
                                 $members = $model->getTeamMembers()->all();
                                 if($members)
                                 foreach($members as $member) $member->delete();


                    //add new relations by DivisionHasUser
                    if($users){
                        foreach($users as $user)
                        {

                            $team = new TeamMember();
                            $team->user_id = $user;
                            $team->project_id = $model->id;
                            $team->save(); 
                        }
                    }
                    ////////////////////////////////////////////////////////////////////
                            Yii::$app->session->setFlash('success', 'Project details are updated');
                            return $this->redirect(['view', 'id' => $model->id]);
                }

            } else {

                $members = $model->getTeamMembers()->all();
                 if($members)
                 {
                    $model->users = [];
                    foreach ($members as $value) {
                        array_push($model->users,$value->user_id);
                    };
                }
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }else{
            throw new ForbiddenHttpException;   //-S
        }
    }

    /**
     * Deletes an existing Project model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if($this->findModel($id)->approved_ddg_user_id==NULL && Yii::$app->user->can('delete-project')){   /*access to delete a project:: only dh can 
                                                                                        and only before ddg approval, after ddg approval
                                                                                        cant delete a project, project state can be changed 
                                                                                        to cancelled -S*/
            
            //Find division has users relations and delete
            $project = $this->findModel($id);
            $teamMembers = $project->getTeamMembers()->all();
            if($teamMembers)
            foreach($teamMembers as $relation)
                $relation->delete();

            $this->findModel($id)->delete();

            Yii::$app->session->setFlash('error', 'A project was deleted');
            return $this->redirect(['index']);
        }else{
            throw new ForbiddenHttpException;   //-S
        }
    }

  /**
    *DDG approve method
    *
    */
    public function actionApproveddg($id)
    {

//Janaka -- adding approve actions (Done but have to check with a new project)
        $model = $this->findModel($id);

            //Check whether it's user's division
        $users = $model->getDivision()->one()->getUsers()->all();
          $userId = Yii::$app->user->id;
          $userDivision = false;
          foreach ($users as $user) {
            if($userId==$user->id)
            {
                $userDivision = true;
                break;
            }
          }

        if($userDivision &&$this->findModel($id)->approved_ddg_user_id==NULL && Yii::$app->user->can('mark-ddg-approval')){
            
            $model->approved_ddg_user_id = Yii::$app->user->id;

            if($model->state=='pending') $model->state = 'active';

            $model->save();

            return $this->redirect(['view', 'id' => $model->id]);
        }else{
            throw new ForbiddenHttpException;   //-S
        }
    }


  /**
    *DH approve method
    *
    */
    public function actionApprovedh($id)
    {
         $model = $this->findModel($id);
         $users = $model->getDivision()->one()->getUsers()->all();
          $userId = Yii::$app->user->id;
          $userDivision = false;
          foreach ($users as $user) {
            if($userId==$user->id)
            {
                $userDivision = true;
                break;
            }
          }

        if($userDivision && $this->findModel($id)->approved_dh_user_id==NULL && Yii::$app->user->can('mark-dh-approval')){
            
//Janaka -- adding approve actions (Done but have to check with a new project)
           
            $model->approved_dh_user_id = Yii::$app->user->id;

            //dh approval should not make it active isn't it?
            //if($model->approved_ddg_user_id!=null && $model->state=='pending') $model->state = 'active';

            $model->save();

            //here should we generate an email to ddg?

            return $this->redirect(['view', 'id' => $model->id]);
        }else{
            throw new ForbiddenHttpException;   //-S
        }
    }
    /**
     * Finds the Project model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Project the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Project::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


  
}
