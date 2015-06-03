<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "m_lpse_profile".
 *
 * @property integer $id
 * @property string $cd
 * @property integer $cb
 * @property string $ed
 * @property integer $eb
 * @property integer $lpse_id
 * @property integer $profile_id
 * @property string $value
 *
 * @property MLpse $lpse
 * @property MProfile $profile
 */
class MLpseProfile extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'm_lpse_profile';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cd', 'ed'], 'safe'],
            [['cb', 'eb', 'lpse_id', 'profile_id'], 'integer'],
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
            'lpse_id' => 'Lpse ID',
            'profile_id' => 'Profile ID',
            'value' => 'Value',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLpse()
    {
        return $this->hasOne(MLpse::className(), ['id' => 'lpse_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfile()
    {
        return $this->hasOne(MProfile::className(), ['id' => 'profile_id']);
    }
}
