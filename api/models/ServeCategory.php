<?php

namespace api\models;

use Yii;
use yii\db\ActiveRecord;

class ServeCategory extends ActiveRecord
{
    /**
     * @inheritdoc
     */

    public static function tableName()
    {
        return '{{%service_category}}';
    }

}
