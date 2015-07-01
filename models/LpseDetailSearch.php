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

        $this->name = isset($params['q'])?$params['q']:'';
        $this->name = preg_replace("/[^a-zA-Z0-9:\s-]+/", " ", $this->name);
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
   
   if(! array_key_exists('endDate', $res_text)){      
       // $searchRes->andFilterWhere(['NOT LIKE','value','selesai']);
      $searchRes = LpseDetailProfile::find();
      $searchRes->select('lpse_detail_id');
      $searchRes->where(['profile_id' => 4]);
      $searchRes->andFilterWhere(['>', 'value', date("Y-m-d")]); 
      $searchRes->groupBy('lpse_detail_id');
      $key_id = (ArrayHelper::getColumn($searchRes->all(), 'lpse_detail_id'));  
      $key_id[]=0;
   }
 
  // filter on status
      $searchRes = LpseDetailProfile::find();
      $searchRes->select('lpse_detail_id');
      $searchRes->where(['profile_id' => 1]);
      $searchRes->groupBy('lpse_detail_id');
      if(!empty($key_id)){
          $searchRes->andFilterWhere(['IN','lpse_detail_id',$key_id]); 
        }  
  if(array_key_exists('inStatus', $res_text)){
     $inStatusText =  $res_text['inStatus'];      
        if($inStatusText[0]!='-'){
          $searchRes->andFilterWhere(['LIKE','value',$inStatusText]);
        }else{
          $inStatusText = preg_replace("/-/", "", $inStatusText);   
          $searchRes->andFilterWhere(['NOT LIKE','value',$inStatusText]);
        }
        
      }else{       
         $searchRes->andFilterWhere(['NOT LIKE','value','selesai']);
     }

    $key_id = array_unique(ArrayHelper::getColumn($searchRes->all(), 'lpse_detail_id'));     
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
              if($value[0]!='-'){
                $m_lpse = MLpse::find()->where(['LIKE','name',$value])->all();
              }else{
                $value = preg_replace("/-/", "", $value); 
                $m_lpse = MLpse::find()->where(['NOT LIKE','name',$value])->all();
              }              
              $arr_lpse_id = ArrayHelper::getColumn($m_lpse,'id');
              $searchRes->andFilterWhere(['IN', 'value', $arr_lpse_id]);
              break;            
            default:
              if($value[0]!='-'){
                  $searchRes->andFilterWhere(['LIKE','value',$value]);
                }else{
                  $value = preg_replace("/-/", "", $value);   
                  $searchRes->andFilterWhere(['NOT LIKE','value',$value]);
                }
            break;
          }                 
          $key_id = array_unique(ArrayHelper::getColumn($searchRes->all(), 'lpse_detail_id'));
          $key_id[]=0;        
         }        
        }
        $key_id[]=0;  
        
        $query->andFilterWhere(['in', 'lpse_detail.id', $key_id]); 
        if(strlen($text)>=7 AND substr($text,0,7)=='getLast'){ 
          $text = preg_replace("/getLast/", "", $text); 
          $text = (strlen($text)==0)?' ':$text;
          $lastRecord = LpseDetail::find()->orderBy(['id' => SORT_DESC])->one();
          $query->andFilterWhere(['>=','lpse_detail.cd',date('Y-m-d',strtotime($lastRecord->cd))]);
          echo $lastRecord->cd;
        }        
        if($text[0]!='-'){
                  $query->andFilterWhere(['LIKE','lpse_detail.name',$text]);
                }else{
                  $text = preg_replace("/-/", "", $text);   
                  $query->andFilterWhere(['NOT LIKE', 'lpse_detail.name', $text]);     
                }
                  
        $query->orderBy (['ed' => SORT_DESC,'id' => SORT_DESC,]);

        return $dataProvider;
    }
}
