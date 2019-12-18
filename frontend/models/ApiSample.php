<?php


namespace frontend\models;


class ApiSample extends \hiqdev\hiart\ActiveRecord
{
    public function rules()
    {
        return [
            ['id', 'integer', 'min' => 1],
            ['login', 'string', 'min' => 2, 'max' => 32],
        ];
    }
}