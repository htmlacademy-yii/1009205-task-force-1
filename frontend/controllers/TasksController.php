<?php

namespace frontend\controllers;


use frontend\models\Task;


class TasksController extends \yii\web\Controller
{
    public function actionIndex()
    {

        $model = Task::find();

        $tasks = $model->where(['status' => 'new'])
            ->orderBy(['created_at' => SORT_DESC])
            ->all();
        return $this->render('index', ['tasks' => $tasks]);
    }

}
