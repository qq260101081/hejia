<?php

namespace app\modules\student\controllers;


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
        $dataProvider = $this->schoolRule($dataProvider);

        return $this->render('/patriarch_index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    //选择家长单选
    public function actionModalList2()
    {
        $searchModel = new PatriarchSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        //给家长开有账号的才显示
        $dataProvider->query->andFilterWhere(['>', 'userid', '0']);
        //限制跨校区操作
        $dataProvider = $this->schoolRule($dataProvider);

        return $this->renderAjax('/patriarch-modal-list2', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    //选择家长多选
    public function actionModalList()
    {
        $searchModel = new PatriarchSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        //给家长开有账号的才显示
        $dataProvider->query->andFilterWhere(['>', 'userid', '0']);
        //限制跨校区操作
        $dataProvider = $this->schoolRule($dataProvider);


        return $this->renderAjax('/patriarch-modal-list', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

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

    /**
     * Creates a new Patriarch model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed

    public function actionCreate()
    {
        $model = new Patriarch();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }*/

    //给家长开账号
    public function actionCreateUser($id)
    {
        $model = $this->findModel($id);

        //USER表添加用户
        $user = new Users();
        $user->type = 'patriarch';
        $user->username = $model->phone;
        $user->name = $model->name;
        $user->password_hash = Yii::$app->security->generatePasswordHash(substr($model->phone, -6));
        $user->auth_key = Yii::$app->security->generateRandomString();
        if($user->save())
        {
            //更新家长表
            $model->userid = $user->id;
            $model->save();
            return $this->redirect(['/users/users/view', 'id' => $user->id]);
        }
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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('/patriarch_update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Patriarch model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }*/

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