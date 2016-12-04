<?php

namespace app\controllers;

use Yii;
use app\models\Babysitter;
use app\models\BabysitterSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\components\libs\Common;

/**
 * BabysitterController implements the CRUD actions for Babysitter model.
 */
class BabysitterController extends Controller
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
     * Lists all Babysitter models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BabysitterSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Babysitter model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Babysitter model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Babysitter();
        $data = Yii::$app->request->post();

        if ($data)
        {
            $listImgFile = Common::uploadFile('Babysitter[headimg]');
            if ($listImgFile) $data['Babysitter']['headimg'] = $listImgFile['path'];

            if($model->load($data) && $model->save())
            {
                Yii::$app->session->setFlash('success', ['delay'=>3000,'message'=>'保存成功！']);
                return $this->redirect(['view', 'id' => $model->id]);
            }
            else
            {
                Yii::$app->session->setFlash('error', ['delay'=>3000,'message'=>'保存失败！']);
            }
        }
        else
        {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Babysitter model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $data = Yii::$app->request->post();

        if ($data) {
            $listImgFile = Common::uploadFile('Teacher[headimg]');
            $data['Teacher']['headimg'] = $model->headimg;
            if($listImgFile)
            {
                $data['Teacher']['headimg'] = $listImgFile['path'];
                @unlink(\Yii::getAlias('@upPath') . '/' . $model->headimg);
            }
            if($model->load($data) && $model->save())
            {
                Yii::$app->session->setFlash('success', ['delay'=>3000,'message'=>'保存成功！']);
                return $this->redirect(['view', 'id' => $model->id]);
            }
            else
            {
                Yii::$app->session->setFlash('error', ['delay'=>3000,'message'=>'保存失败！']);
            }
        }
        else
        {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Babysitter model.
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
     * Finds the Babysitter model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Babysitter the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Babysitter::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
