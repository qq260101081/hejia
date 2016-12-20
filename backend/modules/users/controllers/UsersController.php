<?php

namespace app\modules\users\controllers;


use Yii;
use app\modules\users\models\Users;
use app\modules\users\models\UsersSearch;
use app\components\CommonController;
use app\modules\staff\models\Staff;
use app\modules\student\models\Patriarch;
use yii\web\NotFoundHttpException;

/**
 * UsersController implements the CRUD actions for Users model.
 */
class UsersController extends CommonController
{

    /**
     * Lists all Users models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UsersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionModalList()
    {
        $searchModel = new UsersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->renderAjax('/modal-list', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Users model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('/view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Users model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Users();
        $model->role = 'frontend';

        $dada = Yii::$app->request->post();
        if($dada)
        {
            $dada['Users']['password_hash'] = Yii::$app->security->generatePasswordHash($dada['Users']['password']);
            $dada['Users']['auth_key'] = Yii::$app->security->generateRandomString();
            if ($model->load($dada) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
            else
            {
                Yii::$app->session->setFlash('error', ['delay'=>3000,'message'=>'保存失败！']);
            }
        }
        else
        {
            return $this->render('/create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Users model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $dada = Yii::$app->request->post();
        if($dada)
        {
            if($dada['Users']['password'])
                $dada['Users']['password_hash'] = Yii::$app->security->generatePasswordHash($dada['Users']['password']);

            $dada['Users']['auth_key'] = Yii::$app->security->generateRandomString();
            if ($model->load($dada) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
            else
            {
                Yii::$app->session->setFlash('error', ['delay'=>3000,'message'=>'保存失败！']);
            }
        }
        else
        {
            return $this->render('/update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Users model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        //删除对应员工
        if($model->type == 'staff')
        {
            Staff::find()->where(['userid' => $model->id])->one()->delete();
        }
        //更新对应家长表
        elseif ($model->type == 'patriarch')
        {
            $patriarch = Patriarch::find()->where(['userid' => $model->id])->one();
            $patriarch->userid = 0;
            $patriarch->save();
        }

        $model->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the Users model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Users the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Users::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
