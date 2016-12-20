<?php

namespace app\modules\interesting\controllers;


use Yii;
use app\modules\interesting\models\Interesting;
use app\modules\interesting\models\InterestingSearch;
use app\components\CommonController;
use app\components\libs\Common;
use yii\web\NotFoundHttpException;

/**
 * PresscentreController implements the CRUD actions for Presscentre model.
 */
class InterestingController extends CommonController
{
    public function actions()
    {
        return [
            'upload' => ['class' => 'kucha\ueditor\UEditorAction'],
            'config' => [
                'imageUrlPrefix' => $_SERVER['HTTP_HOST'],
                'imagePathFormat' => "/upload/image/{yyyy}{mm}{dd}/{time}{rand:6}"
            ]
        ];
    }
    /**
     * Lists all Guarantee models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new InterestingSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Guarantee model.
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
     * Creates a new Guarantee model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Interesting();

        $data = Yii::$app->request->post();

        if ($data) {
            $listImgFile = Common::uploadFile('Interesting[list_img]');
            if($listImgFile) $data['Interesting']['list_img'] = $listImgFile['path'];

            if($model->load($data) && $model->save())
            {
                Yii::$app->session->setFlash('success', ['delay'=>3000,'message'=>'保存成功！']);
                return $this->redirect(['/interesting/interesting/view', 'id' => $model->id]);
            }
            else{
                Yii::$app->session->setFlash('error', ['delay'=>3000,'message'=>'保存失败！']);
            }
        }
        else
        {
            return $this->render('/create', [
                'model' => $model
            ]);
        }
    }

    /**
     * Updates an existing Guarantee model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $data = Yii::$app->request->post();

        if ($data) {
            $listImgFile = Common::uploadFile('Interesting[list_img]');
            $data['Interesting']['list_img'] = $model->list_img;
            if($listImgFile)
            {
                $data['Interesting']['list_img'] = $listImgFile['path'];
                @unlink(\Yii::getAlias('@upPath') . '/' . $model->list_img);
            }

            if($model->load($data) && $model->save())
            {
                Yii::$app->session->setFlash('success', ['delay'=>3000,'message'=>'保存成功！']);
                return $this->redirect(['/interesting/interesting/view', 'id' => $model->id]);
            }
            else{
                Yii::$app->session->setFlash('error', ['delay'=>3000,'message'=>'保存失败！']);
            }
        }
        else
        {
            return $this->render('/update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Guarantee model.
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
     * Finds the Guarantee model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Presscentre the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Interesting::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
