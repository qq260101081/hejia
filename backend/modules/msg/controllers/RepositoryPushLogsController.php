<?php

namespace app\modules\msg\controllers;

use Yii;
use app\modules\repository\models\Repository;
use app\modules\msg\models\RepositoryPushLogs;
use app\modules\msg\models\RepositoryPushLogsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RepositoryPushLogsController implements the CRUD actions for RepositoryPushLogs model.
 */
class RepositoryPushLogsController extends Controller
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
     * Lists all RepositoryPushLogs models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RepositoryPushLogsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('/repository-index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single RepositoryPushLogs model.
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
     * Creates a new RepositoryPushLogs model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new RepositoryPushLogs();

        $data = Yii::$app->request->post();

        if($data)
        {
            $rows = [];
            $time = time();
            $imagesids = explode(',', $data['RepositoryPushLogs']['images_id']);
            foreach($imagesids as $k => $id){
                $repository = Repository::find()->where(['id' => $id])->one();
                $rows[$k]['id'] = null;
                $rows[$k]['patriarch_id'] = $data['RepositoryPushLogs']['patriarch_id'];
                $rows[$k]['username'] = Yii::$app->user->identity->username;
                $rows[$k]['type'] = $repository->type;
                $rows[$k]['title'] = $repository->title;
                $rows[$k]['path'] = $repository->path;
                $rows[$k]['status'] = 0;
                $rows[$k]['created_at'] = $time;
            }
            Yii::$app->db->createCommand()->batchInsert(
                RepositoryPushLogs::tableName(),
                $model->attributes(),
                $rows
            )->execute();
            return $this->redirect(['index']);
        }

        return $this->render('/repository-create', ['model' => $model]);
    }

    /**
     * Updates an existing RepositoryPushLogs model.
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
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing RepositoryPushLogs model.
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
     * Finds the RepositoryPushLogs model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return RepositoryPushLogs the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = RepositoryPushLogs::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
