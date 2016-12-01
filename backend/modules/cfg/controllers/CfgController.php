<?php

namespace app\modules\cfg\controllers;

use Yii;
use app\modules\cfg\models\Cfg;
use app\components\libs;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use app\components\libs\Common;


/**
 * CfgController implements the CRUD actions for Cfg model.
 */
class CfgController extends Controller
{
    /**
     * Lists all Cfg models.
     * @return mixed
     */
    public function actionIndex()
    {
    	$model = Cfg::find()->one();
        $data = Yii::$app->request->post();
        if($data)
        {
        	$logoFile = Common::uploadFile('Cfg[logo]');
        	unset($data['Cfg']['logo']);
        	if($logoFile) $data['Cfg']['logo'] = $logoFile['path'];

        	if($model->load($data) && $model->save())
                Yii::$app->session->setFlash('success', ['delay'=>3000,'message'=>'保存成功！']);
            else
            	Yii::$app->session->setFlash('error', ['delay'=>3000,'message'=>'保存失败！']);
        }

        return $this->render('index', [
            'model' => $model,
        ]);
    }

}
