<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\pendaftaran\Layanan;

/**
 * PasienPindahKamarSearch represents the model behind the search form of `app\models\pendaftaran\Layanan`.
 */
class PasienPindahKamarSearch extends Layanan
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'jenis_layanan', 'unit_kode', 'nomor_urut', 'panggil_perawat', 'dipanggil_perawat', 'kamar_id', 'created_by', 'updated_by', 'deleted_by', 'panggil_dokter', 'dipanggil_dokter'], 'integer'],
            [['registrasi_kode', 'tgl_masuk', 'tgl_keluar', 'kelas_rawat_kode', 'unit_asal_kode', 'unit_tujuan_kode', 'cara_masuk_unit_kode', 'cara_keluar_kode', 'status_keluar_kode', 'keterangan', 'created_at', 'updated_at', 'deleted_at'], 'safe'],
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
        $query = Layanan::find();
        $query->joinWith([
            'registrasi'=>function($q){
                $q->joinWith(['pjpRi','pasien']);
            }
        ]); 
        // add conditions that should always apply here
        $query->andWhere([
            Layanan::tableName() . '.jenis_layanan' => self::RI,
            Layanan::tableName() . '.registrasi_kode' => $layanan['registrasi_kode']
            // Layanan::tableName() . '.registrasi_kode' => '2102000571'
        ]);
        // echo'<pre/>';print_r($query->asArray()->all());die();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'tgl_masuk' => SORT_ASC
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
