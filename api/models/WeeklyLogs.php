<?php
/**
 * Created by 260101081@qq.com
 * User: carl
 * Date: 16/12/3 下午12:21
 */
namespace api\models;

use yii\db\ActiveRecord;

class WeeklyLogs extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%weekly_push_logs}}';
    }
}