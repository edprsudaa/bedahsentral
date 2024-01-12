<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\medis\JadwalDokterKlinik;
use app\components\HelperSpesial;
/**
 * JadwalDokterKlinikSearch represents the model behind the search form of `app\models\medis\JadwalDokterKlinik`.
 */
class JadwalDokterKlinikSearch extends JadwalDokterKlinik
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'unit_kode', 'pegawai_id', 'status_datang', 'ganti_pegawai_id', 'created_by', 'updated_by', 'is_deleted'], 'integer'],
            [['tanggal', 'jam_mulai', 'jam_akhir', 'keterangan',  'created_at', 'updated_at', 'log_data'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
    public function search($params,$user)
    {
        $query = JadwalDokterKlinik::find();
        $query->joinWith([
            'unit',
            'dokter'
            ])->with(['dokterGanti']);
        if($user['akses_level']==HelperSpesial::LEVEL_DOKTER){
            $query->andWhere([
                'or',
                [parent::tableName() . '.pegawai_id'=> $user['pegawai_id']],
                [parent::tableName() . '.ganti_pegawai_id'=> $user['pegawai_id']],
                ]);
        }else{
            $akses_pengguna=HelperSpesial::getListRjAksesPegawai(false);
            $query->andWhere(parent::tableName().'.unit_kode IN ('.implode(',',$akses_pengguna['unit_akses']).')');
        }
            // echo'<pre/>';print_r($query->asArray()->all());die();    
        // add conditions that should always apply here
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'tanggal' => SORT_DESC
                ]
            ],
            'pagination' => [ 
                'pageSize' => 10 
            ]
        ]);
        
        $dataProvider->sort->attributes['tanggal'] = [
            'asc' => [parent::tableName() . '.tanggal' => SORT_ASC],
            'desc' => [parent::tableName() . '.tanggal' => SORT_DESC],
        ];
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            parent::tableName().'.unit_kode' => $this->unit_kode,
            parent::tableName().'.pegawai_id' => $this->pegawai_id
        ]);
        if($this->tanggal){
            $query->andFilterWhere(['between', parent::tableName() . '.tanggal', Yii::$app->formatter->asDate($this->tanggal, 'php:Y-m-d'), Yii::$app->formatter->asDate($this->tanggal, 'php:Y-m-d')]);
        }
        return $dataProvider;
    }
}
