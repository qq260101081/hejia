<?php
/**
 * Created by 260101081@qq.com
 * User: carl
 * Date: 16/11/25 下午4:56
 * 托辅中心
 */

namespace api\controllers;

use Yii;
use api\components\BaseController;
use api\models\MsgLogs;
use api\models\WeeklyLogs;
use api\models\RepositoryLogs;

class MsgController extends BaseController
{
    //消息列表页面
    function actionIndex()
    {
        $start = date(mktime(0,0,0,date("m"),date("d")-date("w")+1,date("Y")));
        //官方消息
        $msg = MsgLogs::find()
            ->select(['id', 'title', 'created_at'])
            ->where(['patriarch_id'=>Yii::$app->user->id])
            ->andWhere(['>', 'created_at', $start])
            ->all();
        //周报消息
        $weekly = WeeklyLogs::find()
            ->where(['patriarch_id'=>Yii::$app->user->id])
            ->andWhere(['>', 'created_at', $start])
            ->all();
        //影像消息
        $repository = RepositoryLogs::find()
            ->select(['id','title', 'type', 'path', 'created_at'])
            ->where(['patriarch_id'=>Yii::$app->user->id])
            ->andWhere(['>', 'created_at', $start])
            ->all();
        return $this->render('index',[
            'msg' => $msg,
            'weekly' => $weekly,
            'repository' => $repository,
        ]);
    }

    //官方消息内容页面
    public function actionMsgView($id)
    {
        $model = MsgLogs::findOne($id);

        return $this->render('msg-view', [
            'model' => $model
        ]);
    }
    //周报内容页面
    public function actionWeeklyView($id)
    {
        $model = WeeklyLogs::findOne($id);
        return $this->render('weekly-view', [
            'model' => $model
        ]);
    }
}