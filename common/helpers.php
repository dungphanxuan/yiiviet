<?php
/**
 * Yii2 Shortcuts
 * @author Eugene Terentev <eugene@terentev.net>
 * -----
 * This file is just an example and a place where you can add your own shortcuts,
 * it doesn't pretend to be a full list of available possibilities
 * -----
 */

/**
 * @return int|string
 */
function getMyId()
{
    return Yii::$app->user->getId();
}

/**
 * @param string $view
 * @param array $params
 * @return string
 */
function render($view, $params = [])
{
    return Yii::$app->controller->render($view, $params);
}

/**
 * @param $url
 * @param int $statusCode
 * @return \yii\web\Response
 */
function redirect($url, $statusCode = 302)
{
    return Yii::$app->controller->redirect($url, $statusCode);
}

/**
 * @param string $key
 * @param mixed $default
 * @return mixed
 */
function env($key, $default = null)
{

    $value = getenv($key) ?? $_ENV[$key] ?? $_SERVER[$key];

    if ($value === false) {
        return $default;
    }

    switch (strtolower($value)) {
        case 'true':
        case '(true)':
            return true;

        case 'false':
        case '(false)':
            return false;
    }

    return $value;
}
/*
 * Remove all files, folders and their subfolders
*/
function rrmdir($dir, $type = 1)
{
    if (is_dir($dir)) {
        $objects = scandir($dir);
        foreach ($objects as $object) {

            if ($object != "." && $object != "..") {

                if (filetype($dir . "/" . $object) == "dir") {
                    rrmdir($dir . "/" . $object);
                } else {
                    if ($object != '.gitignore') {
                        unlink($dir . "/" . $object);
                    }

                }
            }
        }
        reset($objects);
        switch ($type) {
            case 1:
                //Check Dir not assets
                if (strpos($dir, 'assets/')) {
                    rmdir($dir);
                }
                break;
            case 2:
                //Check Dir not Cache
                if (strpos($dir, 'cache/')) {
                    rmdir($dir);
                }
                break;
        }


    }
    // return true;
}

function getParam($name, $defaultValue = null)
{
    return Yii::$app->request->get($name, $defaultValue);
}
function postParam($name, $defaultValue = null)
{
    return Yii::$app->request->post($name, $defaultValue);
}

/*
 * The dd function dumps the given variables and ends execution of the script:
 * */
function dd($data)
{
    echo "<pre>";
    var_dump($data);
    echo "</pre>";
    die;
}