<?php
namespace api\controllers;


use Yii;
use yii\web\Controller;
use app\components\BaseController;
use api\models\Events;


/**
 * Site controller
 */
class SiteController extends BaseController
{
    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $activity = Events::find()->select(['id', 'title', 'info'])->where(['category_id' => '146'])->orderBy('id')->limit(3)->all();
        return $this->render('index',[
            'activity' => $activity
        ]);
    }

    public function actionLogin()
    {echo 111;die;
        $model = new User();
        return $this->render('login');
    }

}
