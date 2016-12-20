<?php

namespace app\modules\product\controllers;

use Yii;
use app\modules\product\models\Product;
use app\modules\product\models\ProductCategory;
use app\modules\product\models\ProductSearch;
use yii\web\NotFoundHttpException;
use app\components\libs\Common;
use app\components\CommonController;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends CommonController
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
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionModalList()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->renderAjax('/modal-list', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Product model.
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
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Product();
        $model->status = 1;

        $data = Yii::$app->request->post();
        if($data)
        {
            $listImgFile = Common::uploadFile('Product[list_img]');
            if($listImgFile) $data['Product']['list_img'] = $listImgFile['path'];
            $proImgFile = Common::uploadFile('Product[pro_img]');
            if($proImgFile) $data['Product']['pro_img'] = $proImgFile['path'];

            if ($model->load($data) && $model->save())
            {
                Yii::$app->session->setFlash('success', ['delay'=>3000,'message'=>'保存成功！']);
                return $this->redirect(['/product/product/view', 'id' => $model->id]);
            }
            else{
                Yii::$app->session->setFlash('error', ['delay'=>3000,'message'=>'保存失败！']);
            }

        }

        return $this->render('/create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $categoryInfo = ProductCategory::find()->where(['id'=>$model->category_id])->asArray()->one();
        $categoryPath = ProductCategory::find()
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
            $data['Product']['list_img'] = $model->list_img;
            $listImgFile = Common::uploadFile('Product[list_img]');
            if($listImgFile)
            {
                $data['Product']['list_img'] = $listImgFile['path'];
                @unlink(\Yii::getAlias('@upPath') . '/' . $model->list_img);
            }
            $data['Product']['pro_img'] = $model->pro_img;
            $proImgFile = Common::uploadFile('Product[list_img]');
            if($proImgFile)
            {
                $data['Product']['pro_img'] = $proImgFile['path'];
                @unlink(\Yii::getAlias('@upPath') . '/' . $model->pro_img);
            }

            if ($model->load($data) && $model->save())
            {
                Yii::$app->session->setFlash('success', ['delay'=>3000,'message'=>'保存成功！']);
            }
            return $this->redirect(['/product/product/view', 'id' => $model->id]);
        } else {
            return $this->render('/update', [
                'model' => $model,
                'categoryPath' => $categoryPath
            ]);
        }
    }

    /**
     * Deletes an existing Product model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if($model->delete())
        {
            @unlink(\Yii::getAlias('@upPath') . '/' . $model->list_img);
            @unlink(\Yii::getAlias('@upPath') . '/' . $model->pro_img);
        }
        return $this->redirect(['index']);
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
