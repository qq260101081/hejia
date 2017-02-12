<?php

namespace api\models;

use Yii;

/**
 * This is the model class for table "{{%web_cfg}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $value
 */
class WebCfg extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%web_cfg}}';
    }
}
