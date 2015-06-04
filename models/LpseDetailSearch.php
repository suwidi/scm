<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\LpseDetail;
use app\models\LpseDetailProfile;
use yii\helpers\ArrayHelper;

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
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

// definisi kata kunci
        $text = "";
        $rest_list = array('status');

        if(!is_null($this->name)){
        $new_text = $this->name;
         while (!empty($new_text)) {
          $text = $new_text;
          $key = explode(' ', $new_text,2);          
          $new_text = "";

          if(!empty($key[1])){
            $res = explode(':',$key[0], 2);    
            if(!empty($res[1])){
              if(in_array($res[0], $rest_list)){
                $res_text[$res[0]]=$res[1];
                $new_text = $key[1];
              }
            }    
          }
         }        
        }
     
      if(!empty($res_text['status'])){
        $searchRes = LpseDetailProfile::find()
            ->select('lpse_detail_id')
            ->where(['LIKE', 'value', $res_text['status'] ])
            ->andWhere(['profile_id' => 1])
            ->all();
          }else {
            $searchRes = LpseDetailProfile::find()
            ->select('lpse_detail_id')
            ->where(['NOT LIKE', 'value', 'selesai'])
            ->andWhere(['profile_id' => 1])
            ->all();
          }
        
        $key_id = ArrayHelper::getColumn($searchRes, 'lpse_detail_id');
        $key_id[] = 0;
        
        $query->andFilterWhere(['in', 'lpse_detail.id', $key_id]);
        $query->andFilterWhere(['like', 'lpse_detail.name', $text]);
        

        return $dataProvider;
    }
}
