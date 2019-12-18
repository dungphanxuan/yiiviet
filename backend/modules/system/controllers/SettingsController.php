<?php

namespace backend\modules\system\controllers;


use common\components\keyStorage\FormModel;
use Yii;
use yii\web\Controller;

class SettingsController extends Controller
{

    public function actionIndex()
    {
        $model = new FormModel([
            'keys' => [
                'frontend.maintenance' => [
                    'label' => Yii::t('backend', 'Frontend maintenance mode'),
                    'type' => FormModel::TYPE_DROPDOWN,
                    'items' => [
                        'disabled' => Yii::t('backend', 'Disabled'),
                        'enabled' => Yii::t('backend', 'Enabled'),
                    ],
                ],
                'backend.theme-skin' => [
                    'label' => Yii::t('backend', 'Backend theme'),
                    'type' => FormModel::TYPE_DROPDOWN,
                    'items' => [
                        'skin-black' => 'skin-black',
                        'skin-blue' => 'skin-blue',
                        'skin-green' => 'skin-green',
                        'skin-purple' => 'skin-purple',
                        'skin-red' => 'skin-red',
                        'skin-yellow' => 'skin-yellow',
                    ],
                ],
                'backend.layout-fixed' => [
                    'label' => Yii::t('backend', 'Fixed backend layout'),
                    'type' => FormModel::TYPE_CHECKBOX,
                ],
                'backend.dark-theme' => [
                    'label' => Yii::t('backend', 'Dark backend theme'),
                    'type' => FormModel::TYPE_CHECKBOX,
                ],
                'backend.sidebar-lg-show' => [
                    'label' => Yii::t('backend', 'Backend sidebar collapsed'),
                    'type' => FormModel::TYPE_CHECKBOX,
                ],
                'backend.sidebar-minimized' => [
                    'label' => Yii::t('backend', 'Mini Backend Sidebar on Collapse'),
                    'type' => FormModel::TYPE_CHECKBOX,
                ],
            ],
        ]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('alert', [
                'body' => Yii::t('backend', 'Settings was successfully saved'),
                'options' => ['class' => 'alert alert-success'],
            ]);

            return $this->refresh();
        }

        return $this->render('index', ['model' => $model]);
    }

}
