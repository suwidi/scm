<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "audit_user".
 *
 * @property integer $id
 * @property string $created
 * @property integer $user_id
 * @property string $country_id
 * @property string $ip
 * @property string $mobile
 * @property string $os
 * @property string $browser
 * @property string $mac
 */
class AuditUser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'audit_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created'], 'required'],
            [['created'], 'safe'],
            [['user_id'], 'integer'],
            [['country_id'], 'string', 'max' => 5],
            [['ip', 'mobile', 'os', 'browser', 'mac'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'created' => 'Created',
            'user_id' => 'User ID',
            'country_id' => 'Country ID',
            'ip' => 'Ip',
            'mobile' => 'Mobile',
            'os' => 'Os',
            'browser' => 'Browser',
            'mac' => 'Mac',
        ];
    }
}
