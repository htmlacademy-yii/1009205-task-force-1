<?php


namespace frontend\controllers;

use frontend\models\Category;
use yii\web\Controller;

class CategoryController extends Controller
{

    public function actionIndex()
    {
        $categories = Category::find()->all();
        return $this->render('index', [
            'categories' => $categories
        ]);
    }
}

