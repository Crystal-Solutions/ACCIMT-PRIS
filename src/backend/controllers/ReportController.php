<?php

namespace backend\controllers;

use Yii;
use backend\models\Report;
use backend\models\ReportTemplate;
use backend\models\ReportSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\ForbiddenHttpException;
use yii\filters\AccessControl;

/**
 * ReportController implements the CRUD actions for Report model.
 */
class ReportController extends Controller
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
                        'actions' => ['index','create', 'update','view','createforproject','printview', 'approve'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Report models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ReportSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Report model.
     * @param integer $id
     * @return mixed
     */

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    //Print View
    public function actionPrintview($id)
    {
        $this->layout = 'print';
        return $this->render('printview', [
            'model' => $this->findModel($id),
        ]);
    }


    /**
     * Creates a new Report model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($template=null,$projectid=null)
    {
        if(Yii::$app->user->can('create-report')){   //access to create report-S
            $model = new Report();

            if ($model->load(Yii::$app->request->post()) ) {
                $model->submit_date = date('Y-m-d h:m:s');
                $model->requested_user_id = Yii::$app->user->id;        //current user id is taken and saved
                $model->approved_user_id = null;
                if($model->save())                      //only if saved the redirection happens
                    return $this->redirect(['view', 'id' => $model->id]);
            } else {

                $model->project_id = $projectid;
                if($template)
                {
                    $templateModel =  ReportTemplate::findOne($template);
                    if($templateModel)
                    {
                        $model->title =$templateModel->name;
                        $model->content = $templateModel->content;
                    }

                }

                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }else{
            throw new ForbiddenHttpException;   //-S
        }
    }




    /**
     * Updates an existing Report model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
         $model = $this->findModel($id);
        if($model->approved_user_id==NULL && Yii::$app->user->can('update-report')){   /*access to update report,sectional head 
                                                                                    and sectional user only until approval-S*/
           

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }else{
            throw new ForbiddenHttpException("You cannot update this report. It's already approved.");   //-S
        }
    }

    /**
     * Deletes an existing Report model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if('approved_user_id'==NULL && Yii::$app->user->can('delete-report')){   /*access to delete report,sectional head 
                                                                                    and sectional user only until approval-S*/
            $this->findModel($id)->delete();

            return $this->redirect(['index']);
        }else{
            throw new ForbiddenHttpException;   //-S
        }
    }




  /**
    *DH approve method
    *
    */
    public function actionApprove($id)
    {
        if($this->findModel($id)->approved_user_id==NULL && Yii::$app->user->can('mark-report-approval')){
            
//Janaka -- adding approve actions (Done but have to check with a new project)
            $model = $this->findModel($id);
            $model->approved_user_id = Yii::$app->user->id;

            $model->save();

            return $this->redirect(['view', 'id' => $model->id]);
        }else{
            throw new ForbiddenHttpException("You can't approve this report.");   //-S
        }
    }

    /**
     * Finds the Report model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Report the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Report::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionApproveDDG($id)
    {
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
}
