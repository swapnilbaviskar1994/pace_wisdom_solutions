<?php

namespace app\controllers;

use app\models\Department;
use app\models\PayableSalaryTaxCharge;
use app\models\TblUser;
use app\models\TblUserSearch;
use app\models\UserAccounts;
use app\models\UserType;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * TblUserController implements the CRUD actions for TblUser model.
 */
class TblUserController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all TblUser models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TblUserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TblUser model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new TblUser model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TblUser();
        if ($model->load(Yii::$app->request->post())) {
            if($model->save()) {
                $UserAccountModel                 = new UserAccounts();
                $UserAccountModel->user_id        = $model->user_id;
                $UserAccountModel->basic_salary   = UserType::userTypeDetails($model->user_type_id);
                $UserAccountModel->payable_salary = Department::departmentDetails($model->department_id,$UserAccountModel->basic_salary);
                $UserAccountModel->tax_value      = $UserAccountModel->payable_salary * PayableSalaryTaxCharge::payableSalaryDetails($UserAccountModel->payable_salary)/100 ;
                $UserAccountModel->save();
            }
            return $this->redirect(['view', 'id' => $model->user_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing TblUser model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            if($model->save()) {
                $UserAccountModel                 = UserAccounts::findOne($model->user_id);
                $UserAccountModel->basic_salary   = UserType::userTypeDetails($model->user_type_id);
                $UserAccountModel->payable_salary = Department::departmentDetails($model->department_id,$UserAccountModel->basic_salary);
                $UserAccountModel->tax_value      = $UserAccountModel->payable_salary * PayableSalaryTaxCharge::payableSalaryDetails($UserAccountModel->payable_salary)/100 ;
                $UserAccountModel->save();
            }
            return $this->redirect(['view', 'id' => $model->user_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing TblUser model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TblUser model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TblUser the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TblUser::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
