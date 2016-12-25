<?php

namespace app\modules\msg\controllers;


use Yii;
use app\modules\msg\models\MsgPushLogs;
use app\modules\msg\models\MsgPushLogsSearch;
use app\components\CommonController;
use app\modules\student\models\Patriarch;
use yii\web\NotFoundHttpException;

/**
 * MsgPushLogsController implements the CRUD actions for MsgPushLogs model.
 */
class MsgPushLogsController extends CommonController
{

    public function actions()
    {
        return [
            'upload' => ['class' => 'kucha\ueditor\UEditorAction'],
            'config' => [
                'lang' => 'zh-cn',
                'imageUrlPrefix' => $_SERVER['HTTP_HOST'],
                'imagePathFormat' => "/upload/image/{yyyy}{mm}{dd}/{time}{rand:6}"
            ]
        ];
    }

    /**
     * Lists all MsgPushLogs models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MsgPushLogsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MsgPushLogs model.
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
     * Creates a new MsgPushLogs model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new MsgPushLogs();
        $data = Yii::$app->request->post();
        if ($data) {
            $rows = [];
            $time = time();
            if($userids = $data['MsgPushLogs']['patriarch_id'])
            {
                $userids = explode(',', $userids);
                foreach ($userids as $k => $v)
                {
                    $rows[$k]['id'] = null;
                    $rows[$k]['patriarch_id'] = $v;
                    $rows[$k]['username'] = Yii::$app->user->identity->username;
                    $rows[$k]['title'] = $data['MsgPushLogs']['title'];
                    $rows[$k]['content'] = $data['MsgPushLogs']['content'];
                    $rows[$k]['status'] = 0;
                    $rows[$k]['created_at'] = $time;
                }
            }
            else
            {
                $patriarch = Patriarch::find()->select('userid')->where(['>','userid', '0'])->all();
                foreach ($patriarch as $k => $v)
                {
                    $rows[$k]['id'] = null;
                    $rows[$k]['patriarch_id'] = $v->userid;
                    $rows[$k]['username'] = Yii::$app->user->identity->username;
                    $rows[$k]['title'] = $data['MsgPushLogs']['title'];
                    $rows[$k]['content'] = $data['MsgPushLogs']['content'];
                    $rows[$k]['status'] = 0;
                    $rows[$k]['created_at'] = $time;
                }
            }

            Yii::$app->db->createCommand()->batchInsert(
                MsgPushLogs::tableName(),
                $model->attributes(),
                $rows
            )->execute();

            return $this->redirect(['index']);
        } else {
            return $this->render('/create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing MsgPushLogs model.
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
            return $this->render('/update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing MsgPushLogs model.
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
     * Finds the MsgPushLogs model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MsgPushLogs the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MsgPushLogs::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
