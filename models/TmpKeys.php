<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "tmp_keys".
 *
 * @property integer $id
 * @property integer $audit_user_id
 * @property integer $lpse_detail_id
 *
 * @property LpseDetail $lpseDetail
 * @property AuditUser $auditUser
 */
class TmpKeys extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tmp_keys';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['audit_user_id', 'lpse_detail_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'audit_user_id' => 'Audit User ID',
            'lpse_detail_id' => 'Lpse Detail ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLpseDetail()
    {
        return $this->hasOne(LpseDetail::className(), ['id' => 'lpse_detail_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuditUser()
    {
        return $this->hasOne(AuditUser::className(), ['id' => 'audit_user_id']);
    }
}
