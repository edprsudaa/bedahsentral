<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\medis\PermintaanKonsultasi;
use app\models\pendaftaran\Layanan;
use app\components\HelperSpesial;

/**
 * PasienKonsultasiSearch represents the model behind the search form of `app\models\medis\PermintaanKonsultasi`.
 */
class PasienKonsultasiSearch extends PermintaanKonsultasi
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'layanan_id_minta', 'dokter_id_minta', 'dokter_id_tujuan', 'batal', 'created_by', 'updated_by', 'is_deleted'], 'integer'],
            [['tanggal_minta', 'diagnosa_kerja', 'riwayat_klinik_singkat', 'jenis_konsultasi', 'tanggal_batal', 'created_at', 'updated_at', 'log_data'], 'safe'],
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
        $query = PermintaanKonsultasi::find();

        $query->joinWith([
            'dokterMinta',
            'layananMinta'=>
                function($query) use($layanan){
                    if($layanan['jenis_layanan']===Layanan::RI){
                        $query->andWhere([Layanan::tableName().'.jenis_layanan'=>Layanan::RI,Layanan::tableName().'.registrasi_kode'=>$layanan['registrasi_kode']]);
                    }else{
                        //RJ/IGD/PENUNJANG
                        $query->andWhere([Layanan::tableName().'.id'=>$layanan['id']]);
                    }
                },
            'jawabanKonsultasi'  
            ]);
        // add conditions that should always apply here
        if(HelperSpesial::isDokter($user)){
            $query->andWhere([
                'or',
                [self::tableName().'.dokter_id_minta'=>$user['pegawai_id']],
                [self::tableName().'.dokter_id_tujuan'=>$user['pegawai_id']],
            ]);
        }
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'tanggal_minta' => SORT_DESC
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
