<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "lpse_detail_profile".
 *
 * @property integer $id
 * @property string $cd
 * @property integer $cb
 * @property string $ed
 * @property integer $eb
 * @property integer $lpse_detail_id
 * @property integer $profile_id
 * @property string $value
 *
 * @property LpseDetail $lpseDetail
 * @property MProfile $profile
 */
class LpseDetailProfile extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lpse_detail_profile';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cd', 'ed'], 'safe'],
            [['cb', 'eb', 'lpse_detail_id', 'profile_id'], 'integer'],
            [['value'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cd' => 'Cd',
            'cb' => 'Cb',
            'ed' => 'Ed',
            'eb' => 'Eb',
            'lpse_detail_id' => 'Lpse Detail ID',
            'profile_id' => 'Profile ID',
            'value' => 'Value',
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
    public function getProfile()
    {
        return $this->hasOne(MProfile::className(), ['id' => 'profile_id']);
    }
}
