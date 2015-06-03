<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\LpseDetail;

/**
 * LpseDetailSearch represents the model behind the search form about `app\models\LpseDetail`.
 */
class LpseDetailSearch extends LpseDetail
{
    /**
     * @inheritdoc
     */
    public $lpse;
    public function rules()
    {
        return [
            [['id', 'cb', 'eb', 'lpse_id'], 'integer'],
            [['cd', 'ed', 'name'], 'safe'],
            [['lpse'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = LpseDetail::find();
        $query->joinWith(['lpse']);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

      /*  $query->andFilterWhere([
            'id' => $this->id,
            'cd' => $this->cd,
            'cb' => $this->cb,
            'ed' => $this->ed,
            'eb' => $this->eb,
            'lpse_id' => $this->lpse_id,
        ]);
*/
        $query->andFilterWhere(['like', 'lpse_detail.name', $this->name]);
        // ->orFilterWhere(['like', 'm_lpse.name', $this->name]);
        
    /*    $query->joinWith(['lpseDetailProfiles' => function ($q) {
       // $q->where("lpse_detail_profile.value NOT LIKE '%Selesai' " );
        $q->where("lpse_detail_profile.value NOT LIKE '%selesai' AND lpse_detail_profile.profile_id = '1'" );
        // $q->where(" DATE(lpse_detail_profile.value) > CURDATE() AND lpse_detail_profile.profile_id = 4" );
        } ]);*/

        return $dataProvider;
    }
}
