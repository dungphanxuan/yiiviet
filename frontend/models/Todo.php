<?php


namespace frontend\models;


use yii\helpers\Inflector;
use yii\helpers\StringHelper;

class Todo extends \hiqdev\hiart\ActiveRecord
{
    public function rules()
    {
        return [
            ['id', 'integer', 'min' => 1],
            ['title', 'string', 'min' => 2, 'max' => 32],
            ['desc', 'string'],
        ];
    }

    /**
     * @return string the name of the entity of this record
     */
    public static function tableName()
    {
        return 'todos';
    }


    public function getSingle($id = null){

    }

    public function getAll(){

    }
}