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
    public function actionView($id,$userid=0)
    {
        if($userid)
            $user = Staff::find()->where(['userid'=>$userid])->one();
        else
            $user = $this->findModel($id);

        return $this->render('/view', [
            'model' => $user,
        ]);
    }

    /**
     * Creates a new Staff model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $position = Yii::$app->params['position'];
        if(Yii::$app->user->identity->role == 'principal' || Yii::$app->user->identity->role == 'teacher') //校长只能开以下职位员工
            $position = ['老师'=>'老师'];
        elseif(Yii::$app->user->identity->role == 'customer') //客服只能开以下职位员工
            $position = ['老师'=>'老师','校长'=>'校长'];
        elseif(Yii::$app->user->identity->role == 'customer_super') //客服主管只能开以下职位员工
            $position = ['老师'=>'老师','校长'=>'校长','客服'=>'客服'];


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
            $allow = false;
            $position = Yii::$app->params['position'];
            if(Yii::$app->user->identity->role == 'principal') //校长只能开以下职位员工
                $position = ['老师'=>'老师'];
            elseif(Yii::$app->user->identity->role == 'customer') //客服只能开以下职位员工
                $position = ['老师'=>'老师','校长'=>'校长'];
            elseif(Yii::$app->user->identity->role == 'customer_super') //客服主管只能开以下职位员工
                $position = ['老师'=>'老师','校长'=>'校长','客服'=>'客服'];

            foreach ($position as $v)
            {
                if($data['Staff']['position'] == $v)
                {
                    $allow = true;
                    break;
                }
            }
            if(!$allow)
            {
                Yii::$app->session->setFlash('error', ['delay'=>3000,'message'=>'保存失败！您不能创建岗位为：'.$data['Staff']['position'].'员工']);
                return $this->render('/create', [
                    'model' => $model,
                    'categoryPath' => $categoryPath,
                ]);
            }

            $listImgFile = Common::uploadFile('Staff[photo]');
            if($listImgFile) $data['Staff']['photo'] = $listImgFile['path'];

            if($model->load($data))
            {
                $user = Users::find()->where(['username'=>$model->phone])->one();
                //如果账号不存在，则开通员工账号
                if(!$user)
                {
                    $user = new Users();
                    $user->type = 'staff';

                    if ($model->position == '校长')
                        $user->role = 'principal';
                    elseif ($model->position == '老师')
                        $user->role = 'teacher';
                    elseif ($model->position == '客服')
                        $user->role = 'customer';
                    elseif ($model->position == '客服主管')
                        $user->role = 'customer_super';

                    $user->name = $model->name;
                    $user->username = $model->phone;
                    $user->password_hash = Yii::$app->security->generatePasswordHash(substr($user->username, -6));
                    $user->auth_key = Yii::$app->security->generateRandomString();
                    if ($user->save()) {
                        $model->userid = $user->id;
                        //分配到权限组
                        $role = Yii::$app->getAuthManager()->createRole($user->role);
                        Yii::$app->getAuthManager()->assign($role, $user->id);
                    }
                }
                else
                {
                    $model->userid = $user->id;
                    if ($model->position == '校长')
                        $user->role = 'principal';
                    elseif ($model->position == '老师')
                        $user->role = 'teacher';
                    elseif ($model->position == '客服')
                        $user->role = 'customer';
                    elseif ($model->position == '客服主管')
                        $user->role = 'customer_super';
                    $user->save(false);
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
            'position' => $position
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
        $position = Yii::$app->params['position'];
        if(Yii::$app->user->identity->role == 'principal' || Yii::$app->user->identity->role == 'teacher') //校长只能开以下职位员工
            $position = ['老师'=>'老师'];
        elseif(Yii::$app->user->identity->role == 'customer') //客服只能开以下职位员工
            $position = ['老师'=>'老师','校长'=>'校长'];
        elseif(Yii::$app->user->identity->role == 'customer_super') //客服主管只能开以下职位员工
            $position = ['老师'=>'老师','校长'=>'校长','客服'=>'客服'];

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

                if(isset($data['Staff']['password']) && $data['Staff']['password'])
                    $model->password_hash = Yii::$app->security->generatePasswordHash($data['Staff']['password']);

                $model->save();
                Yii::$app->session->setFlash('success', ['delay'=>3000,'message'=>'保存成功！']);
                return $this->redirect(['index']);
            }
            Yii::$app->session->setFlash('error', ['delay'=>3000,'message'=>'保存失败！']);
        }
        return $this->render('/update', [
            'model' => $model,
            'categoryPath' => $categoryPath,
            'position' => $position
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
        if($model->delete())
            Yii::$app->session->setFlash('success', ['delay'=>3000,'message'=>'删除成功！']);
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
