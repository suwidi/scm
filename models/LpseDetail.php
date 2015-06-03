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
 *
 * @property MLpse $lpse
 * @property LpseDetailProfile[] $lpseDetailProfiles
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
            [['cd', 'ed'], 'safe'],
            [['cb', 'eb', 'lpse_id'], 'integer'],
            [['name'], 'string']
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
}
