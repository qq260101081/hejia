<?php

namespace app\modules\student\controllers;


use app\modules\student\models\Student;
use Yii;
use app\modules\student\models\Patriarch;
use app\modules\student\models\PatriarchSearch;
use app\components\CommonController;
use app\modules\users\models\Users;
use yii\web\NotFoundHttpException;

/**
 * PatriarchController implements the CRUD actions for Patriarch model.
 */
class PatriarchController extends CommonController
{

    /**
     * Lists all Patriarch models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PatriarchSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        //限制跨校区操作
        $dataProvider = $this->schoolRule($dataProvider, Patriarch::tableName().'.');

        return $this->render('/patriarch_index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }



    /*选择家长多选
    public function actionModalList()
    {
        $searchModel = new PatriarchSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        //给家长开有账号的才显示
        $dataProvider->query->andFilterWhere(['>', 'userid', '0']);
        //限制跨校区操作
        $dataProvider = $this->schoolRule($dataProvider, Patriarch::tableName().'.');


        return $this->renderAjax('/patriarch-modal-list', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }*/

    /**
     * Displays a single Patriarch model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('/patriarch_view', [
            'model' => $this->findModel($id),
        ]);
    }

    //创建家长
    public function actionCreate()
    {
        $model = new Patriarch();
        $data = Yii::$app->request->post();

        if ($model->load($data)) {
            $user = Users::find()->where(['username' => $model->phone])->one();
            //如果账号不存在
            if(!$user)
            {
                $user = new Users();
                $user->type = 'patriarch';
                $user->username = $model->phone;
                $user->name = $model->name;
                $user->password_hash = Yii::$app->security->generatePasswordHash(substr($model->phone, -6));
                $user->auth_key = Yii::$app->security->generateRandomString();
                $user->save(false);
            }
            $model->id = $user->id;

            if($model->save())
            {
                Yii::$app->session->setFlash('success', ['delay'=>3000,'message'=>'保存成功！']);
                return $this->redirect(['index']);
            }
            Yii::$app->session->setFlash('error', ['delay'=>3000,'message'=>'保存失败！']);
        }

        return $this->render('/patriarch_create', [
            'model' => $model,
        ]);

    }

    /**
     * Updates an existing Patriarch model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $data = Yii::$app->request->post();

        if ($model->load($data)) {
            //如果电话改变了，则更新
            if($model->phone != $model->oldAttributes['phone'] || $model->name != $model->oldAttributes['name'])
            {
                $user = Users::find()->where(['username'=>$model->phone])->one();
                if(!$user)
                {
                    $user = Users::findOne($id);
                    $user->username = $model->phone;
                    $user->name = $model->name;
                    $user->password_hash = Yii::$app->security->generatePasswordHash(substr($model->phone, -6));
                    $user->auth_key = Yii::$app->security->generateRandomString();
                }
                else
                {
                    $user->name = $model->name;
                }
                $user->save(false);
            }
            if($model->save())
            {
                Yii::$app->session->setFlash('success', ['delay'=>3000,'message'=>'保存成功！']);
                return $this->redirect(['index']);
            }
            Yii::$app->session->setFlash('error', ['delay'=>9000,'message'=>'保存失败。']);
        }

        return $this->render('/patriarch_update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Patriarch model.
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
     * Finds the Patriarch model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Patriarch the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Patriarch::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}