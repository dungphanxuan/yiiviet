<?php

namespace common\models\vendor;


class CategoryVendor
{
    public final function getCategory($query = array()) {
        parent::setApiUrl('/api/v1/category/', $query);
        return parent::execute();
    }
}