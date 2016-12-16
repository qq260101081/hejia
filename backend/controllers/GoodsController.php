<?php

namespace backend\controllers;

use Yii;
use backend\models\Goods;
use backend\models\GoodsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\components\libs\Common;
use app\modules\product\models\ProductCategory;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class GoodsController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

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
     * Lists all Article models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new GoodsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $category = ProductCategory::find()->select(['id','name'])->asArray()->all();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'category' => $category
        ]);
    }

    /**
     * Displays a single Article model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Article model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Goods();

        $data = Yii::$app->request->post();

        if ($data)
        {
            $listImgFile = Common::uploadFile('Goods[list_img]');

            if ($listImgFile) $data['Goods']['list_img'] = $listImgFile['path'];

            if($model->load($data) && $model->save())
            {
                Yii::$app->session->setFlash('success', ['delay'=>3000,'message'=>'保存成功！']);
                return $this->redirect(['view', 'id' => $model->id]);
            }
            else
            {
                Yii::$app->session->setFlash('error', ['delay'=>3000,'message'=>'保存失败！']);
            }
        }
        else
        {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Article model.
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
            $listImgFile = Common::uploadFile('Goods[list_img]');
            $data['Goods']['list_img'] = $model->list_img;
            if($listImgFile)
            {
                $data['Goods']['list_img'] = $listImgFile['path'];
                @unlink(\Yii::getAlias('@upPath') . '/' . $model->list_img);
            }
            if($model->load($data) && $model->save())
            {
                Yii::$app->session->setFlash('success', ['delay'=>3000,'message'=>'保存成功！']);
                return $this->redirect(['view', 'id' => $model->id]);
            }
            else
            {
                Yii::$app->session->setFlash('error', ['delay'=>3000,'message'=>'保存失败！']);
            }
        }
        else
        {
            return $this->render('update', [
                'model' => $model,
                'categoryPath' => $categoryPath
            ]);
        }
    }

    /**
     * Deletes an existing Article model.
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
     * Finds the Article model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Goods::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
