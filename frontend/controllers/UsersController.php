<?php

namespace frontend\controllers;

use frontend\models\User;
use yii\db\Expression;

class UsersController extends \yii\web\Controller
{
    public function actionIndex()
    {

        $model = User::find()->joinWith('categories c');
        $users = $model->where(['not', ['category_id' => null]])
            ->orderBy(['registered_at'=> SORT_DESC])
            ->all();
        return $this->render('index', ['users' => $users]);
    }

}
