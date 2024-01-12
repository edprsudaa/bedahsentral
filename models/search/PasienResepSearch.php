<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\medis\Resep;
use app\models\pendaftaran\Layanan;
use app\components\HelperSpesial;
/**
 * ResepSearch represents the model behind the search form of `app\models\medis\Resep`.
 */
class PasienResepSearch extends Resep
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'layanan_id',  'dokter_id', 'depo_id', 'kronis', 'created_by', 'updated_by', 'is_deleted'], 'integer'],
            [['no_transaksi', 'tanggal', 'diagnosa', 'racikan_txt', 'created_at', 'updated_at'], 'safe'],
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
        $query = Resep::find();
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
