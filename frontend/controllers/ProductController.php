<?php

namespace frontend\controllers;

use frontend\controllers\behaviors\AccessBehavior;
use yii\web\Controller;
use common\models\Category;
use common\models\Product;
use yii\web\NotFoundHttpException;

class ProductController extends Controller
{
    public function behaviors()
    {
        return [
            AccessBehavior::className(),
        ];
    }

    /**
     * Action для страницы просмотра товара
     * @param integer $id <p>id товара</p>
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionView($id)
    {
        $categories = Category::getCategoriesList();
        $product = Product::getProductById($id);

        return $this->render('view', [
            'categories' => $categories,
            'product' => $product,
        ]);
    }

}
