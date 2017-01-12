<?php

namespace app\modules\weekly\controllers;

use Yii;
use app\modules\weekly\models\Repository;
use app\modules\weekly\models\RepositorySearch;
use app\modules\weekly\models\RepositoryPushLogs;
use app\modules\weekly\models\RepositoryPushLogsSearch;
use app\modules\student\models\PatriarchSearch;
use app\components\CommonController;
use yii\web\NotFoundHttpException;
use common\models\MsgStatus;

/**
 * RepositoryPushLogsController implements the CRUD actions for RepositoryPushLogs model.
 */
class RepositoryPushController extends CommonController
{

    //推送列表
    public function actionIndex()
    {
        $searchModel = new RepositoryPushLogsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    //查看
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

   //影像推送
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
                $rows[$k]['username'] = Yii::$app->user->identity->name;
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

            //更新消息状态
            $msgStatus = MsgStatus::find()->where(['userid' => $data['RepositoryPushLogs']['patriarch_id']])->one();
            if(!$msgStatus) {
                $msgStatus = new MsgStatus();
                $msgStatus->userid = $data['RepositoryPushLogs']['patriarch_id'];
            }
            $msgStatus->status = 1;
            $msgStatus->save(false);
            Yii::$app->session->setFlash('success', ['delay'=>3000,'message'=>'推送成功！']);
            return $this->redirect(['index']);
        }

        return $this->render('create', ['model' => $model]);
    }

    //选择家长单选
    public function actionModalList2()
    {
        $searchModel = new PatriarchSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->renderAjax('modal-list2', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    //推送影像时调用
    public function actionModalList()
    {
        $searchModel = new RepositorySearch();

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->renderAjax('modal-list', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    protected function findModel($id)
    {
        if (($model = RepositoryPushLogs::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
