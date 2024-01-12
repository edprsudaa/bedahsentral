<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\medis\LabPaOrder;
use app\models\pendaftaran\Layanan;
use app\components\HelperSpesial;
/**
 * LabPaOrderSearch represents the model behind the search form of `app\models\medis\LabPaOrder`.
 */
class LabPaOrderSearch extends LabPaOrder
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'ird', 'layanan_id',  'dokter_id', 'created_by', 'updated_by', 'is_deleted'], 'integer'],
            [['no_transaksi', 'tgl_pengambilan_spesimen', 'tgl_pemeriksaan', 'lokalis', 'dilakukan_secara', 'spesimen_difikasi', 'cairan_fiksasi', 'pernah_pemeriksaan_pa', 'diagnosa', 'permintaan', 'haid_terakhir_g', 'haid_terakhir_p', 'created_at', 'updated_at', 'log_data'], 'safe'],
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
        $query = LabPaOrder::find();
        $query->joinWith([
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
