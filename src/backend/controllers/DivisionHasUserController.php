<?php

namespace backend\controllers;

use Yii;
use backend\models\DivisionHasUser;
use backend\models\DivisionHasUserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * DivisionHasUserController implements the CRUD actions for DivisionHasUser model.
 */
class DivisionHasUserController extends Controller
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
                        'actions' => [''],
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
     * Lists all DivisionHasUser models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DivisionHasUserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single DivisionHasUser model.
     * @param integer $division_id
     * @param integer $user_id
     * @return mixed
     */
    public function actionView($division_id, $user_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($division_id, $user_id),
        ]);
    }

    /**
     * Creates a new DivisionHasUser model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new DivisionHasUser();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'division_id' => $model->division_id, 'user_id' => $model->user_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing DivisionHasUser model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $division_id
     * @param integer $user_id
     * @return mixed
     */
    public function actionUpdate($division_id, $user_id)
    {
        $model = $this->findModel($division_id, $user_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'division_id' => $model->division_id, 'user_id' => $model->user_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing DivisionHasUser model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $division_id
     * @param integer $user_id
     * @return mixed
     */
    public function actionDelete($division_id, $user_id)
    {
        $this->findModel($division_id, $user_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the DivisionHasUser model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $division_id
     * @param integer $user_id
     * @return DivisionHasUser the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($division_id, $user_id)
    {
        if (($model = DivisionHasUser::findOne(['division_id' => $division_id, 'user_id' => $user_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
