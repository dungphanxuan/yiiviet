<?php

namespace api\modules\v1\controllers;

use yii\rest\Controller;

class TestController extends Controller
{
    public function actionIndex()
    {
        $a = ['a' =>'a', 'b' =>'b'];
        return $a;
    }
}
