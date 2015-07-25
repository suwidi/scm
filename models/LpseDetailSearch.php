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
        $query->groupBy('id');
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        $this->name = isset($params['q'])?$params['q']:'';
        $this->name = preg_replace("/[^a-zA-Z0-9:\s-\s.]+/", " ", $this->name);
        $this->name = trim($this->name);
        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
       $text = " ";   
       $res_text = array();        
       $rest_list = array('1' => 'inStatus','4'=>'endDate','7'=>'inBudget','9'=>'inLpse','11'=>'inCategory');

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
     
    // status didahulukan untuk mendapat default    
if(!array_key_exists('endDate', $res_text) AND !array_key_exists('inStatus', $res_text)){  
        // tampil data selesai selama date < now    
        $query->andFilterWhere(['>=', 'expired',date("Y-m-d H:i")]);  
        $query->andFilterWhere(['NOT LIKE', 'last_status','%Selesai']);                       
    }      

  if(!empty($res_text)){
        foreach ($res_text as $arr_key => $value) {
          $profile_id = array_keys($rest_list,$arr_key);                           
          switch ($profile_id[0]) {
             case '1':
               if($value[0]!='-'){
                 $query->andFilterWhere(['LIKE', 'last_status',$value]); 
                }else{
                  $value = preg_replace("/-/", "", $value);                
                  $query->andFilterWhere(['LIKE', 'last_status',$value]); 
                }       
              break;
            case '7':           
             if (preg_match("/m/i", $value, $type_val)) {
                  $new_val = explode($type_val[0], $value);
                  $value = ($new_val[0])."000000000";
                }
             if (preg_match("/j/i", $value, $type_val)) {
                  $new_val = explode($type_val[0], $value);
                  $value = ($new_val[0])."000000";
                }   
             $value = floatval(str_replace(".","",$value));
             if($value>0){
                 $query->andFilterWhere(['>=', 'budget',$value]); 
                }else{
                  $value = preg_replace("/-/", "", $value);                
                  $query->andFilterWhere(['<', 'budget',$value]); 
                }       
              break;
            case '4':
              $val_date = explode('-', $value);
              if(empty($val_date[1])){
                $val_date[1]=01;
              }
              if(empty($val_date[2])){
                $val_date[2]=01;
              }
              $date_end = date('Y-m-d',strtotime($val_date[0].'-'.$val_date[1].'-'.$val_date[2]));
              $query->andFilterWhere(['>=', 'expired',$date_end]);       
              break;  
            case '9':     
              if($value[0]!='-'){
                $m_lpse = MLpse::find()->select('id')->where(['LIKE','name',$value]);
              }else{
                $value = preg_replace("/-/", "", $value); 
                $m_lpse = MLpse::find()->select('id')->where(['NOT LIKE','name',$value]);
              }           
              $query->andFilterWhere(['IN', 'lpse_id',$m_lpse]);    
              break;            
            default:
              // belum definisi untuk pencarian di detail_profile
             $query->joinwith('lpseDetailProfiles');
             if($value[0]!='-'){
                  $query->andFilterWhere(['=', 'lpse_detail_profile.profile_id',11]);    
                  $query->andFilterWhere(['LIKE', 'lpse_detail_profile.value',$value]);    
                }else{
                  $value = preg_replace("/-/", "", $value); 
                  $query->andFilterWhere(['=', 'lpse_detail_profile.profile_id',11]);    
                  $query->andFilterWhere(['NOT LIKE', 'lpse_detail_profile.value',$value]);    
              }    
              break;            
            break;
          }                 
             
         }        
        }    
        if($text[0]!='-'){
                  $query->andFilterWhere(['LIKE','lpse_detail.name',$text]);
                }else{
                  $text = preg_replace("/-/", "", $text);   
                  $query->andFilterWhere(['NOT LIKE', 'lpse_detail.name', $text]);     
                }
                  
        // $query->orderBy (['ed' => SORT_DESC,'id' => SORT_DESC,]);
        $query->orderBy (['id' => SORT_DESC,]);
        return $dataProvider;
    }
}
