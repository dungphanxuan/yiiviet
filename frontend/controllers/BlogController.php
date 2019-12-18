<?php

namespace frontend\controllers;

class BlogController extends BaseController
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionList()
    {
        return $this->render('list');
    }

    public function actionView()
    {
        return $this->render('view');
    }

}
