<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\pendaftaran\Layanan;

/**
 * PasienPindahKamarInapSearch represents the model behind the search form of `app\models\pendaftaran\Layanan`.
 */
class PasienPindahKamarInapSearch extends Layanan
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
    public function search($params)
    {
        $query = Layanan::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'jenis_layanan' => $this->jenis_layanan,
            'tgl_masuk' => $this->tgl_masuk,
            'tgl_keluar' => $this->tgl_keluar,
            'unit_kode' => $this->unit_kode,
            'nomor_urut' => $this->nomor_urut,
            'panggil_perawat' => $this->panggil_perawat,
            'dipanggil_perawat' => $this->dipanggil_perawat,
            'kamar_id' => $this->kamar_id,
            'created_by' => $this->created_by,
            'created_at' => $this->created_at,
            'updated_by' => $this->updated_by,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
            'deleted_by' => $this->deleted_by,
            'panggil_dokter' => $this->panggil_dokter,
            'dipanggil_dokter' => $this->dipanggil_dokter,
        ]);

        $query->andFilterWhere(['ilike', 'registrasi_kode', $this->registrasi_kode])
            ->andFilterWhere(['ilike', 'kelas_rawat_kode', $this->kelas_rawat_kode])
            ->andFilterWhere(['ilike', 'unit_asal_kode', $this->unit_asal_kode])
            ->andFilterWhere(['ilike', 'unit_tujuan_kode', $this->unit_tujuan_kode])
            ->andFilterWhere(['ilike', 'cara_masuk_unit_kode', $this->cara_masuk_unit_kode])
            ->andFilterWhere(['ilike', 'cara_keluar_kode', $this->cara_keluar_kode])
            ->andFilterWhere(['ilike', 'status_keluar_kode', $this->status_keluar_kode])
            ->andFilterWhere(['ilike', 'keterangan', $this->keterangan]);

        return $dataProvider;
    }
}
