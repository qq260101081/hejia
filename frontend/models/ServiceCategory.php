<?php

namespace frontend\models;

use Yii;
use yii\db\ActiveRecord;

class ServiceCategory extends ActiveRecord
{
    /**
     * @inheritdoc
     */

    public static function tableName()
    {
        return '{{%service_category}}';
    }

}
