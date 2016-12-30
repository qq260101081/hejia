<?php
namespace app\components;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\modules\staff\models\Staff;

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

    //获取员工
    public function getStaff()
    {
        $data = ['staff'=>null, 'shield'=>[]];
        if(Yii::$app->user->identity->type == 'staff')
        {
            $data['staff'] = Staff::find()->select(['id','position','category_id'])->where(['userid'=>Yii::$app->user->identity->id])->one();
            if($data['staff'])
            {
                switch ($data['staff']->position)
                {
                    case '校长':
                        break;
                    case '教师':
                        //教师不能看校长信息，过滤校长
                        $data['shield'][] = '校长';
                        $data['shield'][] = '客服';
                        break;
                    case '客服':
                        //客服不能看校长信息，过滤校长
                        $data['shield'][] = '教师';
                        $data['shield'][] = '校长';
                        break;
                }
            }
        }
        return $data;
    }

}