<?php

namespace app\modules\product\models;

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
class ProductCategory extends TreeModel
{
    /**
     * @inheritdoc
     */

    public static function tableName()
    {
        return '{{%product_category}}';
    }

}
