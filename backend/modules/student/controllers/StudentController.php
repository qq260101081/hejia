<?php

namespace app\modules\student\controllers;


use app\modules\users\models\Users;
use Yii;
use backend\modules\service\models\ServiceCategory;
use app\modules\staff\models\Staff;
use app\modules\student\models\Patriarch;
use app\modules\student\models\Student;
use app\modules\student\models\StudentSearch;
use app\components\CommonController;
use yii\web\NotFoundHttpException;
use app\modules\student\models\PatriarchSearch;

/**
 * PresscentreController implements the CRUD actions for Presscentre model.
 */
class StudentController extends CommonController
{
    /**
     * 学生列表
     */
    public function actionIndex()
    {
        $searchModel = new StudentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        //限制跨校区操作
        $dataProvider = $this->schoolRule($dataProvider,Student::tableName().'.');
        return $this->render('/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    //弹框学生列表
    public function actionModalList()
    {
        $searchModel = new StudentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        //限制跨校区操作
        $dataProvider = $this->schoolRule($dataProvider, Student::tableName().'.');

        return $this->renderAjax('/modal-list', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    /**
     * Displays a single Guarantee model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $patriarch = Patriarch::findOne($model->patriarch_id);
        return $this->render('/view', [
            'model' => $model,
            'patriarch' => $patriarch,
        ]);
    }

    /**
     * Creates a new Guarantee model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Student();
        $patriarch = new Patriarch();
        $model->sex = '男';

        $categoryInfo = ServiceCategory::find()->where(['id'=>137])->asArray()->one();
        $categoryPath = ServiceCategory::find()
            ->where(['<','lft',$categoryInfo['lft']])
            ->andWhere(['>','rgt',$categoryInfo['rgt']])
            ->andWhere(['root' => $categoryInfo['root']])
            ->orderBy('lft')
            ->indexBy('id')
            ->asArray()
            ->all();

        $categoryPath[$categoryInfo['id']] = $categoryInfo;

        $data = Yii::$app->request->post();

        if ($model->load($data)) {
            //如果当前登录的是老师或校长，则默认分类与当前用户对应
            if(Yii::$app->user->identity->role =='principal' || Yii::$app->user->identity->role =='teacher')
            {
                $staff = Staff::find()->where(['userid' => Yii::$app->user->id])->one();
                $model->category_id = $staff->category_id;
                $model->school = $staff->school;
            }
            //如果家长已存在则自动关联，否则创建
            $user = Users::find()->where(['username' => $data['Patriarch']['phone']])->one();
            if(!$user)
            {
                $user = new Users();
                $user->type = 'patriarch';
                $user->username = $data['Patriarch']['phone'];
                $user->name = $data['Patriarch']['name'];
                $user->password_hash = Yii::$app->security->generatePasswordHash(substr($data['Patriarch']['phone'], -6));
                $user->auth_key = Yii::$app->security->generateRandomString();
                $user->save(false);
            }
            $model->patriarch_id = $user->id;
            $oldPatriarch = Patriarch::findOne($user->id);
            if(!$oldPatriarch)
            {
                $patriarch->load($data);
                $patriarch->id = $user->id;
                $patriarch->category_id = $model->category_id;
                $patriarch->save(false);
            }

            if($model->save())
            {
                Yii::$app->session->setFlash('success', ['delay'=>3000,'message'=>'保存成功！']);
                return $this->redirect(['index']);
            }
            Yii::$app->session->setFlash('error', ['delay'=>3000,'message'=>'保存失败！']);
        }

        return $this->render('/create', [
            'model' => $model,
            'patriarch' => $patriarch,
            'categoryPath' => $categoryPath,
        ]);

    }

    /**
     * Updates an existing Guarantee model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $categoryInfo = ServiceCategory::find()->where(['id'=>$model->category_id])->asArray()->one();
        $categoryPath = ServiceCategory::find()
            ->where(['<','lft',$categoryInfo['lft']])
            ->andWhere(['>','rgt',$categoryInfo['rgt']])
            ->andWhere(['root' => $categoryInfo['root']])
            ->orderBy('lft')
            ->indexBy('id')
            ->asArray()
            ->all();

        $categoryPath[$categoryInfo['id']] = $categoryInfo;

        $data = Yii::$app->request->post();

        if ($model->load($data)) {
            //更新学生
            if($model->save())
            {
                Yii::$app->session->setFlash('success', ['delay'=>3000,'message'=>'保存成功！']);
                return $this->redirect(['index']);
            }
            Yii::$app->session->setFlash('error', ['delay'=>3000,'message'=>'保存失败！']);
        }

        return $this->render('/update', [
            'model' => $model,
            'categoryPath' => $categoryPath,
        ]);

    }

    /**
     * Deletes an existing Guarantee model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if($model->delete()) Yii::$app->session->setFlash('success', ['delay'=>3000,'message'=>'删除成功！']);
        return $this->redirect(['index']);
    }

    //ajax 获取家长信息
    public function actionGetPatriarch($phone = '')
    {
        $model = Patriarch::find()->where(['phone' => $phone])->asArray()->one();
        echo json_encode($model);
        exit;
    }

    //选择家长
    /*public function actionPatriarchList()
    {
        $searchModel = new PatriarchSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        //限制跨校区操作
        $dataProvider = $this->schoolRule($dataProvider);

        return $this->renderAjax('/patriarch-list', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }*/

    /**
     * Finds the Guarantee model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Presscentre the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Student::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
