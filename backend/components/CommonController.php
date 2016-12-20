<?php
namespace app\components;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

class CommonController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['POST'],
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function beforeAction($action) {

        if(Yii::$app->user->isGuest)
        {
            return $this->redirect(['site/login']);
        }

        $route = \Yii::$app->requestedRoute ? \Yii::$app->requestedRoute : \Yii::$app->defaultRoute . '/index';

        if(Yii::$app->user->can($route))
        {
            return true;
        }
        die('<div style="color:red; padding-top:50px;text-align:center;">您没有权限执行此操作</div>');
    }

}