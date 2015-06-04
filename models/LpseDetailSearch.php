<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\LpseDetail;
use app\models\LpseDetailProfile;
use app\models\MLpse;
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
      //  $rest_list= array('status','date_publish','date_start_upload','date_end_upload','lelang_name',
        //  'lelang_agenci','lelang_hps','lelang_url','lelang_lembaga','lelang_id');
        //Status, Vendor, EndDate, Category
       $rest_list = array('1' => 'status','4'=>'endDate','7'=>'budget','9'=>'vendor','11'=>'Category');

        if(!is_null($this->name)){
        $new_text = $this->name;
         while (!empty($new_text)) {
          $text = $new_text;
          $key = explode(' ', $new_text,2);          
          $new_text = "";

        if(empty($key[1])){
          $key[1]=" ";
          }
          $res = explode(':',$key[0], 2);    
          if(!empty($res[1])){
            if(in_array($res[0], $rest_list)){
              $res_text[$res[0]]=$res[1];
              $new_text = $key[1];
            }
          }   
         }        
        }
     
 /*  if(!empty($res_text)){
      foreach ($res_text as $arr_key => $value) {
          $profile_id = array_keys($rest_list,$arr_key);

          $searchRes = LpseDetailProfile::find(); 
          $searchRes->select('lpse_detail_id');
          if(!empty($key_id)) $searchRes->andFilterWhere(['in', 'lpse_detail.id', $key_id]);
          $searchRes->andFilterWhere(['like', 'value', $text]); 
          $searchRes->andFilterWhere(['like', 'profile_id', $profile_id[0]]);    
          $searchRes->all();
          $key_id = ArrayHelper::getColumn($searchRes, 'lpse_detail_id');
           print_r($key_id);

        }

    }  */  
    $key_id=array();
     if(!empty($res_text)){
      
        foreach ($res_text as $arr_key => $value) {
          $profile_id = array_keys($rest_list,$arr_key);
          
          $searchRes = LpseDetailProfile::find();
          $searchRes->select('lpse_detail_id');
          $searchRes->where(['profile_id' => $profile_id[0]]);
          $searchRes->andFilterWhere(['IN','lpse_detail_id',$key_id]);   
          switch ($profile_id[0]) {
             case '4':
              $val_date = explode('-', $value);
              if(empty($val_date[1])){
                $val_date[1]=01;
              }
              if(empty($val_date[2])){
                $val_date[2]=01;
              }
              $date_end = date('Y-m-d',strtotime($val_date[0].'-'.$val_date[1].'-'.$val_date[2]));
              $searchRes->andFilterWhere(['>=', 'value', $date_end]); 
              break;  
            case '9':
              $m_lpse = MLpse::find()->where(['LIKE','name',$value])->all();
              $arr_lpse_id = ArrayHelper::getColumn($m_lpse,'id');
              $searchRes->andFilterWhere(['IN', 'value', $arr_lpse_id]);
              break;            
            default:
             $searchRes->andFilterWhere(['LIKE', 'value', $value ]);
              break;
          }
                 
          //  var_dump($searchRes->all()); 
          $key_id = array_unique(ArrayHelper::getColumn($searchRes->all(), 'lpse_detail_id'));      
          $key_id[]=0;

          }        
        }else {
          $searchRes = LpseDetailProfile::find()
          ->select('lpse_detail_id')
          ->where(['NOT LIKE', 'value', 'selesai'])
          ->andWhere(['profile_id' => 1])
          ->all();
       }
         
        $query->andFilterWhere(['in', 'lpse_detail.id', $key_id]);
        $query->andFilterWhere(['like', 'lpse_detail.name', $text]);        

        return $dataProvider;
    }
}
