<?php

namespace app\modules\orders\controllers;


use app\modules\staff\models\Staff;
use app\modules\staff\models\StaffSearch;
use backend\modules\service\models\ServiceCategory;
use Yii;
use app\modules\orders\models\Orders;
use app\modules\orders\models\OrdersSearch;
use app\components\CommonController;
use yii\web\NotFoundHttpException;

/**
 * OrdersController implements the CRUD actions for Orders model.
 */
class OrdersController extends CommonController
{

    /**
     * Lists all Orders models.
     * @return mixed
     */
    //托服订单列表
    public function actionIndex()
    {
        /*$category = ServiceCategory::find()
            ->where(['>','lft', '10'])
            ->andWhere(['<','rgt','23'])
            ->andWhere(['level'=>'3'])->asArray()
            ->indexBy('id')
            ->all();*/
        $searchModel = new OrdersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andFilterWhere(['type'=>0]);
        //限制跨校区操作
        $dataProvider = $this->schoolRule($dataProvider);

        return $this->render('/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            //'category' => $category
        ]);
    }

    //活动订单列表
    public function actionAtvIndex()
    {
        $searchModel = new OrdersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andFilterWhere(['type'=>1]);
        //限制跨校区操作
        $dataProvider = $this->schoolRule($dataProvider);

        return $this->render('/atv-index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    //已过期订单列表
    public function actionExpiredIndex()
    {
        $searchModel = new OrdersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['<','etime',time()]);
        //限制跨校区操作
        $dataProvider = $this->schoolRule($dataProvider);

        return $this->render('/expired-index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Orders model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = Orders::find()->joinWith('staff')->where([Orders::tableName().'.'.'id'=>$id])->one();
        return $this->render('/view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Orders model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Orders();
        $data = Yii::$app->request->post();

        if ($model->load($data)) {
            //开始时间不能小于结束时间
            if(strtotime($model->stime) > strtotime($model->etime))
            {
                Yii::$app->session->setFlash('error', ['delay'=>3000,'message'=>'保存失败,服务开始时间必须小于结束时间']);
                return $this->render('/create', [
                    'model' => $model,
                ]);
            }
            $tmp = Orders::find()
                ->where(['student_id'=>$model->student_id])
                ->andWhere(['product_id'=>$model->product_id])
                ->andWhere(['type'=>0])
                ->orderBy('id')
                ->one();
            //如果同一个服务订单的开始时间小于最近一个订单的结束时间，则不允许创建
            if($tmp)
            {
                if(strtotime($model->stime) < $tmp->etime)
                {
                    Yii::$app->session->setFlash('error', ['delay'=>3000,'message'=>'保存失败,服务开始时间必须大于最近订单服务结束时间']);
                    return $this->render('/create', [
                        'model' => $model,
                    ]);
                }
            }

            $model->principal = Yii::$app->user->identity->name;
            $model->stime = strtotime($data['Orders']['stime']);
            $model->etime = strtotime($data['Orders']['etime']);
            //print_r($model);die;
            if($model->save())
            {
                Yii::$app->session->setFlash('success', ['delay'=>3000,'message'=>'保存成功！']);
                return $this->redirect(['index']);
            }
            Yii::$app->session->setFlash('error', ['delay'=>3000,'message'=>'保存失败！']);

        }
        return $this->render('/create', [
            'model' => $model,
        ]);

    }

    //选择服务人员
    public function actionSelectTeacher()
    {
        $searchModel = new StaffSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andFilterWhere(['in','position',['老师','校长']]);
        //限制跨校区操作
        $dataProvider = $this->schoolRule($dataProvider);

        return $this->renderAjax('/teacher-list', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Updates an existing Orders model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $staff = Staff::findOne($model->teacher_id);
        $model->teacher_name = $staff ? $staff->name : '';
        $model->stime = date('Y-m-d', $model->stime);
        $model->etime = date('Y-m-d', $model->etime);
        $data = Yii::$app->request->post();

        if ($model->load($data)) {
            $model->principal = Yii::$app->user->identity->name;
            $model->stime = strtotime($data['Orders']['stime']);
            $model->etime = strtotime($data['Orders']['etime']);
            //print_r($data);
            //print_r($model);die;
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('/update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Orders model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Orders model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Orders the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Orders::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
