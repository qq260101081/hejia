<?php

namespace backend\modules\service\models;

use Yii;
use gilek\gtreetable\models\TreeModel;

/**
 * This is the model class for table "product_category".
 *
 * @property string $id
 * @property string $root
 * @property string $lft
 * @property string $rgt
 * @property integer $level
 * @property string $type
 * @property string $name
 */
class ServiceCategory extends TreeModel
{
    /**
     * @inheritdoc
     */

    public static function tableName()
    {
        return '{{%service_category}}';
    }

}
