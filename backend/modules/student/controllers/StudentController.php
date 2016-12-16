<?php

namespace app\modules\student\controllers;


use Yii;
use app\modules\student\models\Patriarch;
use app\modules\student\models\Student;
use app\modules\student\models\StudentSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * PresscentreController implements the CRUD actions for Presscentre model.
 */
class StudentController extends Controller
{
    /**
     * Lists all Guarantee models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new StudentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionModalList()
    {
        $searchModel = new StudentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

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
        return $this->render('/view', [
            'model' => $this->findModel($id),
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

        $data = Yii::$app->request->post();

        if ($data) {
            if($model->load($data) && $model->save())
            {
                //保存家长信息
                $patriarch->load($data);
                $patriarch->student_id = $model->id;
                $patriarch->save($data);

                Yii::$app->session->setFlash('success', ['delay'=>3000,'message'=>'保存成功！']);
                return $this->redirect(['/student/student/view', 'id' => $model->id]);
            }
            else{
                Yii::$app->session->setFlash('error', ['delay'=>3000,'message'=>'保存失败！']);
            }
        }
        else
        {
            return $this->render('/create', [
                'model' => $model,
                'patriarch' => $patriarch
            ]);
        }
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
        $patriarch = Patriarch::find()->where(['student_id'=>$id])->one();
        $data = Yii::$app->request->post();

        if ($data) {

            if($model->load($data) && $model->save())
            {
                //保存家长信息
                $patriarch->load($data);
                $patriarch->save($data);

                Yii::$app->session->setFlash('success', ['delay'=>3000,'message'=>'保存成功！']);
                return $this->redirect(['/student/student/view', 'id' => $model->id]);
            }
            else{
                Yii::$app->session->setFlash('error', ['delay'=>3000,'message'=>'保存失败！']);
            }
        }
        else
        {
            return $this->render('/update', [
                'model' => $model,
                'patriarch' => $patriarch
            ]);
        }
    }

    /**
     * Deletes an existing Guarantee model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        //删除对应的家长
        Patriarch::find()->where(['student_id'=>$id])->one()->delete();
        return $this->redirect(['index']);
    }

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
