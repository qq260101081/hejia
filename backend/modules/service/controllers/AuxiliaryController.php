<?php

namespace app\modules\service\controllers;
/*
*托辅服务
*/

use Yii;
use app\modules\service\models\Auxiliary;
use app\modules\service\models\AuxiliarySearch;
use app\modules\service\models\ServiceCategory;
use app\components\CommonController;
use app\components\libs\Common;
use yii\web\NotFoundHttpException;

/**
 * MenusController implements the CRUD actions for Menus model.
 */
class AuxiliaryController extends CommonController
{

    public function actions()
    {
    	return [
    		'upload' => ['class' => 'kucha\ueditor\UEditorAction'],
    		'config' => [
    		    'lang' => 'zh-cn',
    			'imageUrlPrefix' => $_SERVER['HTTP_HOST'],
    			'imagePathFormat' => "upload/image/{yyyy}{mm}{dd}/{time}{rand:6}"
    		]
    	];
    }
    /**
     * Lists all Menus models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AuxiliarySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('/auxiliary-index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single Menus model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = Auxiliary::find()->with('categoryName')->where(['id' => $id])->one();
       // print_r($model);die;
        //$category = ServiceCategory::find()->select(['id','name'])->indexBy('id')->asArray()->all();
        //$model = $this->findModel($id);

        return $this->render('/auxiliary-view', [
            'model' => $model,
            //'category' => $category
        ]);
    }

    /**
     * Creates a new Menus model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Auxiliary();
        $data = Yii::$app->request->post();

        if ($data) {
            $listImgFile = Common::uploadFile('Auxiliary[list_img]');

            if($listImgFile) $data['Auxiliary']['list_img'] = $listImgFile['path'];

            if($model->load($data) && $model->save())
            {
                Yii::$app->session->setFlash('success', ['delay'=>3000,'message'=>'保存成功！']);
                return $this->redirect(['view', 'id' => $model->id]);
            }
            else{
                Yii::$app->session->setFlash('error', ['delay'=>3000,'message'=>'保存失败！']);
            }
        }
        else
        {
            return $this->render('/auxiliary-create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Menus model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $categoryInfo = ServiceCategory::find()->where(['id'=>$model->category_id])->asArray()->one();
        $categoryPath = ServiceCategory::find()
            ->where(['<','lft',$categoryInfo['lft']])
            ->andWhere(['>','rgt',$categoryInfo['rgt']])
            ->andWhere(['root' => $categoryInfo['root']])
            ->orderBy('lft')
            ->indexBy('id')
            ->asArray()
            ->all();

        $categoryPath[$categoryInfo['id']] = $categoryInfo;

        $data = Yii::$app->request->post();

        if ($data) {
            $listImgFile = Common::uploadFile('Auxiliary[list_img]');
            if($listImgFile)
            {
                $data['Auxiliary']['list_img'] = $listImgFile['path'];
                @unlink(\Yii::getAlias('@upPath') . '/' . $model->list_img);
            }

            if($model->load($data) && $model->save())
            {
                Yii::$app->session->setFlash('success', ['delay'=>3000,'message'=>'保存成功！']);
                return $this->redirect(['view', 'id' => $model->id]);
            }
            else{
                Yii::$app->session->setFlash('error', ['delay'=>3000,'message'=>'保存失败！']);
            }
        }
        else
        {
            return $this->render('/auxiliary-update', [
                'model' => $model,
                'categoryPath' => $categoryPath
            ]);
        }

    }

    /**
     * Deletes an existing Menus model.
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
     * Finds the Menus model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Menus the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Auxiliary::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
