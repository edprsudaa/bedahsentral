<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\medis\Pjp;
use app\models\pendaftaran\Layanan;

/**
 * PasienDpjpSearch represents the model behind the search form of `app\models\medis\Dpjp`.
 */
class PasienPjpSearch extends Pjp
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'layanan_id', 'pegawai_id', 'status', 'created_by', 'updated_by', 'is_deleted'], 'integer'],
            [['tanggal', 'keterangan', 'created_at', 'updated_at', 'log_data'], 'safe'],
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
    public function search($params,$layanan)
    {
        $query = Pjp::find();
        $query->joinWith([
            'pegawai',
            'layanan'
            ]);
        if($layanan['jenis_layanan']===Layanan::RI){
            $query->andWhere([Layanan::tableName().'.jenis_layanan'=>Layanan::RI,Layanan::tableName().'.registrasi_kode'=>$layanan['registrasi_kode']]);
        }else{
            //RJ/IGD/PENUNJANG
            $query->andWhere([parent::tableName().'.layanan_id'=>$layanan['id']]);
        }        
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'tanggal' => SORT_ASC
                ]
            ],
            'pagination' => [ 
                'pageSize' => 100
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        return $dataProvider;
    }
}
