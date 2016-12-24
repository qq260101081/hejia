<?php
/**
 * Created by 260101081@qq.com
 * User: carl
 * Date: 16/11/25 下午4:56
 */

namespace api\controllers;
use Yii;
use api\models\Guestbook;
use api\components\BaseController;

class GuestbookController extends BaseController
{
    public function actionCreate()
    {
        $model = new Guestbook();
        $data = Yii::$app->request->post();
        if($data)
        {
            $data['Guestbook']['userid'] = Yii::$app->user->identity->id;
            $data['Guestbook']['name'] = Yii::$app->user->identity->name;
            if($model->load($data) && $model->save())
                Yii::$app->session->setFlash('success', '提交成功！');
            else
                Yii::$app->session->setFlash('error', '提交失败！');
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }
}