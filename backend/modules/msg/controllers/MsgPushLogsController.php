<?php

namespace app\modules\msg\controllers;

use Yii;
use app\modules\msg\models\MsgPushLogs;
use app\modules\student\models\PatriarchSearch;
use app\modules\msg\models\MsgPushLogsSearch;
use app\components\CommonController;
use app\modules\student\models\Patriarch;
use yii\web\NotFoundHttpException;
use common\models\MsgStatus;


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
                'imageUrlPrefix' => Yii::$app->params['imageUrlPrefix'],
                'imagePathFormat' => "/image/{yyyy}{mm}{dd}/{time}{rand:6}"
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

    //选择家长推送 多选
    public function actionModalList()
    {
        $searchModel = new PatriarchSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        //限制跨校区操作
        $dataProvider = $this->schoolRule($dataProvider, Patriarch::tableName().'.');


        return $this->renderAjax('/modal-list', [
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

    //推送消息
    public function actionCreate()
    {
        $model = new MsgPushLogs();
        $data = Yii::$app->request->post();
        if ($data) {
            $rows = [];
            $userids = [];
            $time = time();
            if($userids = $data['MsgPushLogs']['patriarch_id'])
            {
                $userids = explode(',', $userids);
                foreach ($userids as $k => $v)
                {
                    $rows[$k]['id'] = null;
                    $rows[$k]['patriarch_id'] = $v;
                    $rows[$k]['username'] = Yii::$app->user->identity->name;
                    $rows[$k]['title'] = $data['MsgPushLogs']['title'];
                    $rows[$k]['content'] = $data['MsgPushLogs']['content'];
                    $rows[$k]['status'] = 0;
                    $rows[$k]['created_at'] = $time;
                }
            }
            else
            {
                $patriarch = Patriarch::find()->select('id')->all();
                foreach ($patriarch as $k => $v)
                {
                    $userids[$v->id] = $v->id;
                    $rows[$k]['id'] = null;
                    $rows[$k]['patriarch_id'] = $v->id;
                    $rows[$k]['username'] = Yii::$app->user->identity->name;
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
            //更新消息状态
            foreach ($userids as $v)
            {
                $msgStatus = MsgStatus::find()->where(['userid' => $v])->one();
                if(!$msgStatus) {
                    $msgStatus = new MsgStatus();
                    $msgStatus->userid = $v;
                }
                $msgStatus->status = 1;
                $msgStatus->save(false);
            }

            Yii::$app->session->setFlash('success', ['delay'=>3000,'message'=>'保存成功！']);
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
