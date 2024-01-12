<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\medis\Icd9cmPasien;
use app\models\pendaftaran\Layanan;
use app\components\HelperSpesial;
/**
 * Icd9cmPasienSearch represents the model behind the search form of `app\models\medis\Icd9cmPasien`.
 */
class Icd9cmPasienSearch extends Icd9cmPasien
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'layanan_id',  'dokter_id', 'batal', 'created_by', 'updated_by', 'is_deleted'], 'integer'],
            [['icd9cm_kode', 'icd9cm_deskripsi', 'created_at', 'updated_at', 'log_data'], 'safe'],
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
    public function search($params,$layanan,$user)
    {
        $query = Icd9cmPasien::find();
        $query->joinWith([
            'icd9cm',
            'dokter',
            'layanan'=>
                function($query) use($layanan){
                    if($layanan['jenis_layanan']===Layanan::RI){
                        $query->andWhere([Layanan::tableName().'.jenis_layanan'=>Layanan::RI,Layanan::tableName().'.registrasi_kode'=>$layanan['registrasi_kode']]);
                    }else{
                        //RJ/IGD/PENUNJANG
                        $query->andWhere([Layanan::tableName().'.id'=>$layanan['id']]);
                    }
                }
            ]);
        // add conditions that should always apply here
        if(HelperSpesial::isDokter($user)){
            $query->andWhere([self::tableName().'.dokter_id'=>$user['pegawai_id']]);
        } 
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'created_at' => SORT_DESC
                ]
            ],
            'pagination' => false
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
