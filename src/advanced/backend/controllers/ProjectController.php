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
                        'actions' => ['index','create', 'update','view','approveddg', 'approveddg','delete'],
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
        return $this->render('view', [
            'model' => $this->findModel($id),
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


            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
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
            $this->findModel($id)->delete();

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
         throw new ForbiddenHttpException;  
        if($this->findModel($id)->approved_ddg_user_id==NULL && Yii::$app->user->can('mark-ddg-approval')){   /*access to delete a project:: only dh can 
                                                                                        and only before ddg approval, after ddg approval
                                                                                        cant delete a project, project state can be changed 
                                                                                        to cancelled -S*/
            
//Janaka -- adding approve actions (Done but have to check with a new project)
            $model = $this->findModel($id);
            $model->approved_ddg_user_id = Yii::$app->user->id;

            if($model->approved_dh_user_id!=null && $model->state=='pending') $model->state = 'active';

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
         throw new ForbiddenHttpException;  
        if($this->findModel($id)->approved_ddg_user_id==NULL && Yii::$app->user->can('mark-ddg-approval')){   /*access to delete a project:: only dh can 
                                                                                        and only before ddg approval, after ddg approval
                                                                                        cant delete a project, project state can be changed 
                                                                                        to cancelled -S*/
            
//Janaka -- adding approve actions (Done but have to check with a new project)
            $model = $this->findModel($id);
            $model->approved_ddg_user_id = Yii::$app->user->id;

            if($model->approved_dh_user_id!=null && $model->state=='pending') $model->state = 'active';

            $model->save();

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
