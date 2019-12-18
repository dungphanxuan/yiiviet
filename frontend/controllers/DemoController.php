<?php

namespace frontend\controllers;

use frontend\models\ApiSample;
use frontend\models\Todo;
use linslin\yii2\curl;

class DemoController extends BaseController
{
    public function actionIndex()
    {

    }

    public function actionUrl()
    {

        $ch = curl_init('http://127.0.0.1:3000/todos/');
# Setup request to send json via POST.
        $payload = json_encode(array("customer" => json_encode(['title' => 1])));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));

# Return response instead of printing.
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
# Send request.
        $result = curl_exec($ch);
        curl_close($ch);
# Print response.
        echo "<pre>$result</pre>";
        die;
    }

    public function actionUrl1()
    {
        $data = array("title" => "Hagrid");
        $data_string = json_encode($data);

        $ch = curl_init('http://127.0.0.1:3000/todos/');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data_string))
        );

        $result = curl_exec($ch);
        echo "<pre>$result</pre>";
        die;
    }

    public function actionApi()
    {
        $todo = Todo::find()->where(['id' => 2])->asArray()->one();
        dd($todo);
        $todo = new Todo();
        $todo->title = "ASSS";
        $todo->save();
        dd('done');

    }

    public function actionUrl12()
    {

        $url = 'http://127.0.0.1:3000/todos/';
        $curl = new curl\Curl();


        $curl = new curl\Curl();
        $curl->setOption(CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        $response = $curl->setRawPostData(
            json_encode(['title' => 'value'
     ]))
     ->post($url);
        dd($response);
    }

    public function actionUploadWidget()
    {
        return $this->render('upload-widget');
    }
    public function actionFroala()
    {
        return $this->render('froala');
    }

}
