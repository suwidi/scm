<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "audit_text".
 *
 * @property integer $id
 * @property string $text
 * @property integer $count
 */
class AuditText extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'audit_text';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['count'], 'integer'],
            [['text'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'text' => 'Text',
            'count' => 'Count',
        ];
    }
}
