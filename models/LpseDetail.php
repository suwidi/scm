<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "lpse_detail".
 *
 * @property integer $id
 * @property string $cd
 * @property integer $cb
 * @property string $ed
 * @property integer $eb
 * @property integer $lpse_id
 * @property string $name
 * @property integer $orig_lpse_id
 * @property integer $orig_lelang_id
 * @property string $last_status
 * @property string $expired
 * @property string $budget
 *
 * @property MLpse $lpse
 * @property LpseDetailProfile[] $lpseDetailProfiles
 * @property TmpKeys[] $tmpKeys
 */
class LpseDetail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lpse_detail';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cd', 'ed', 'expired'], 'safe'],
            [['cb', 'eb', 'lpse_id', 'orig_lpse_id', 'orig_lelang_id', 'budget'], 'integer'],
            [['name'], 'string'],
            [['budget'], 'required'],
            [['last_status'], 'string', 'max' => 255]
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
            'name' => 'Name',
            'orig_lpse_id' => 'Orig Lpse ID',
            'orig_lelang_id' => 'Orig Lelang ID',
            'last_status' => 'Last Status',
            'expired' => 'Expired',
            'budget' => 'Budget',
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
    public function getLpseDetailProfiles()
    {
        return $this->hasMany(LpseDetailProfile::className(), ['lpse_detail_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTmpKeys()
    {
        return $this->hasMany(TmpKeys::className(), ['lpse_detail_id' => 'id']);
    }
}
