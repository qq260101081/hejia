<?php

namespace app\modules\staff\controllers;

use app\modules\users\models\Users;
use Yii;
use app\modules\staff\models\Staff;
use app\modules\staff\models\StaffSearch;
use yii\web\Controller;
use app\components\libs\Common;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * StaffController implements the CRUD actions for Staff model.
 */
class StaffController extends Controller
{
    /**
     * @inheritdoc
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
     * Lists all Staff models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new StaffSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Staff model.
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
     * Creates a new Staff model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Staff();
        $model->sex = '男';

        $data = Yii::$app->request->post();

        if ($data) {
            $listImgFile = Common::uploadFile('Staff[photo]');
            if($listImgFile) $data['Staff']['photo'] = $listImgFile['path'];

            if($model->load($data) && $model->save())
            {
                Yii::$app->session->setFlash('success', ['delay'=>3000,'message'=>'保存成功！']);
                return $this->redirect(['/staff/staff/view', 'id' => $model->id]);
            }
            else{
                Yii::$app->session->setFlash('error', ['delay'=>3000,'message'=>'保存失败！']);
            }
        }
        else
        {
            return $this->render('/create', [
                'model' => $model
            ]);
        }
    }

    //给员工开账号
    public function actionCreateUser($id)
    {
        $model = $this->findModel($id);

        //USER表添加用户
        $user = new Users();
        $user->type = 'staff';
        $user->role = 'backend';
        $user->username = $model->phone;
        $user->password_hash = Yii::$app->security->generatePasswordHash(substr($model->phone, -6));
        $user->auth_key = Yii::$app->security->generateRandomString();
        if($user->save())
        {
            //更新员工表
            $model->userid = $user->id;
            $model->save();
            return $this->redirect(['/users/users/view', 'id' => $user->id]);
        }
    }

    /**
     * Updates an existing Staff model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $data = Yii::$app->request->post();

        if ($data) {
            $listImgFile = Common::uploadFile('Staff[photo]');
            $data['Staff']['photo'] = $model->photo;
            if($listImgFile)
            {
                $data['Staff']['photo'] = $listImgFile['path'];
                @unlink(\Yii::getAlias('@upPath') . '/' . $model->photo);
            }

            if($model->load($data) && $model->save())
            {
                Yii::$app->session->setFlash('success', ['delay'=>3000,'message'=>'保存成功！']);
                return $this->redirect(['/staff/staff/view', 'id' => $model->id]);
            }
            else{
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
     * Deletes an existing Staff model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $user = Users::findOne($model->userid);

        if($user->delete()) $model->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Staff model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Staff the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Staff::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
