<?php

namespace app\modules\staff\controllers;


use Yii;
use app\modules\staff\models\Staff;
use app\modules\staff\models\StaffSearch;
use app\components\CommonController;
use app\modules\users\models\Users;
use app\components\libs\Common;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\modules\service\models\ServiceCategory;

/**
 * StaffController implements the CRUD actions for Staff model.
 */
class StaffController extends CommonController
{

    /**
     * 员工列表
     */
    public function actionIndex()
    {
        $searchModel = new StaffSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        //限制跨校区操作
        $dataProvider = $this->schoolRule($dataProvider);

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

        if ($data)
        {
            $listImgFile = Common::uploadFile('Staff[photo]');
            if($listImgFile) $data['Staff']['photo'] = $listImgFile['path'];

            if($model->load($data))
            {
                //开通员工账号
                $user = new Users();
                $user->type = 'staff';

                if($model->position=='校长')
                    $user->role = 'principal';
                elseif ($model->position=='老师')
                    $user->role = 'teacher';
                elseif ($model->position=='客服')
                    $user->role = 'customer';
                elseif ($model->position=='客服主管')
                    $user->role = 'customer_super';

                $user->name = $model->name;
                $user->username = $model->phone;
                $user->password_hash = Yii::$app->security->generatePasswordHash(substr($user->username, -6));
                $user->auth_key = Yii::$app->security->generateRandomString();
                if($user->save())
                {
                    $model->userid = $user->id;
                    //分配到权限组
                    $role = Yii::$app->getAuthManager()->createRole($user->role);
                    Yii::$app->getAuthManager()->assign($role, $user->id);
                }

                $model->save();

                Yii::$app->session->setFlash('success', ['delay'=>3000,'message'=>'保存成功！']);
                return $this->redirect(['index']);
            }
            Yii::$app->session->setFlash('error', ['delay'=>3000,'message'=>'保存失败！']);
        }
        return $this->render('/create', [
            'model' => $model,
            'categoryPath' => $categoryPath,
        ]);
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

        if ($data) {
            $listImgFile = Common::uploadFile('Staff[photo]');
            $data['Staff']['photo'] = $model->photo;
            if($listImgFile)
            {
                $data['Staff']['photo'] = $listImgFile['path'];
                @unlink(\Yii::getAlias('@upPath') . '/' . $model->photo);
            }

            if($model->load($data))
            {
                //如果电话（用户名有改动）或 岗位有改动则更新用户表
                if($model->phone != $model->oldAttributes['phone'] || $model->position != $model->oldAttributes['position'])
                {
                    $user = Users::findOne($model->userid);
                    $user->username = $model->phone;

                    if($model->position=='校长')
                        $user->role = 'principal';
                    elseif ($model->position=='老师')
                        $user->role = 'teacher';
                    elseif ($model->position=='客服')
                        $user->role = 'customer';
                    elseif ($model->position=='客服主管')
                        $user->role = 'customer_super';
                    //如果岗位发生变化
                    if($model->position != $model->oldAttributes['position'])
                    {
                        //更新用户角色
                        $role = Yii::$app->getAuthManager()->getRolesByUser($user->id);
                        foreach ($role as $v)
                        {
                            Yii::$app->getAuthManager()->revoke($v, $user->id);
                            $role = Yii::$app->getAuthManager()->createRole($user->role);
                            Yii::$app->getAuthManager()->assign($role, $user->id);
                            break;
                        }
                    }
                    $user->save();
                }

                $model->save();
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
     * Deletes an existing Staff model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $user = Users::findOne($model->userid);
        if($user)
        {
            //删除对应的角色
            $role = Yii::$app->getAuthManager()->getRolesByUser($model->userid);
            foreach ($role as $v)
            {
                Yii::$app->getAuthManager()->revoke($v, $model->userid);
                break;
            }
            //删除对应的用户
            $user->delete();
        }
        $model->delete();
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
