<?php
/**
 * User: 260101081@qq.com
 * Date: 16/10/17 下午1:57
 */
namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%ad}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $url
 * @property string $path
 * @property integer $created_at
 */
class Ad extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%ad}}';
    }

}