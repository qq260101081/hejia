<?php

namespace backend\controllers;

use Yii;
use app\models\Repository;
use app\models\RepositorySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\components\libs\Common;

/**
 * RepositoryController implements the CRUD actions for Repository model.
 */
class RepositoryController extends Controller
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
     * Lists all Repository models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RepositorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Repository model.
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
     * Creates a new Repository model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Repository();
        $model->type = 'image';

        $data = Yii::$app->request->post();

        if ($data)
        {
            $listImgFile = Common::uploadFile('Repository[path]');

            if ($listImgFile) $data['Repository']['path'] = $listImgFile['path'];

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
     * Updates an existing Repository model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $data = Yii::$app->request->post();

        if ($data) {
            $listImgFile = Common::uploadFile('Repository[path]');
            $data['Repository']['path'] = $model->headimg;
            if($listImgFile)
            {
                $data['Repository']['path'] = $listImgFile['path'];
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
     * Deletes an existing Repository model.
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
     * Finds the Repository model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Repository the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Repository::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
