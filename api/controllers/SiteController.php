<?php
namespace api\controllers;



use api\models\WebCfg;
use Yii;
use yii\web\Controller;
use api\components\CommonController;
use api\models\Events;
use api\models\LoginForm;


/**
 * Site controller
 */
class SiteController extends Controller
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

    //联系我们
    public function actionContact()
    {
        $model = WebCfg::find()->all();
        return $this->render('contact', [
            'model' => $model
        ]);
    }

    //和家服务
    public function actionServe()
    {
        return $this->render('serve', [
        ]);
    }

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->redirect(['site/login']);
    }

}
