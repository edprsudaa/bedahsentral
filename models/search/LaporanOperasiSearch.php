<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\bedahsentral\LaporanOperasi;

/**
 * LaporanOperasiSearch represents the model behind the search form of `app\models\bedahsentral\LaporanOperasi`.
 */
class LaporanOperasiSearch extends LaporanOperasi
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['lap_op_id', 'lap_op_to_id', 'lap_op_final', 'lap_op_batal', 'lap_op_mdcp_id', 'lap_op_created_by', 'lap_op_updated_by', 'lap_op_deleted_by'], 'integer'],
            [['lap_op_tanggal', 'lap_op_ruangan', 'lap_op_kelas', 'lap_op_jenis_operasi', 'lap_op_jam_mulai', 'lap_op_jam_selesai', 'lap_op_lama_operasi', 'lap_op_diagnosis_pre_operasi', 'lap_op_diagnosis_pasca_operasi', 'lap_op_nama_jenis_operasi', 'lap_op_jaringan_operasi_dikirim', 'lap_op_jenis_jaringan', 'lap_op_label_implant', 'lap_op_instruksi_prwt_pasca_operasi', 'lap_op_kompikasi', 'lap_op_prosedur', 'lap_op_tgl_final', 'lap_op_tgl_batal', 'lap_op_created_at', 'lap_op_updated_at', 'lap_op_deleted_at'], 'safe'],
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
        $query = LaporanOperasi::find();

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
            'lap_op_id' => $this->lap_op_id,
            'lap_op_to_id' => $this->lap_op_to_id,
            'lap_op_tanggal' => $this->lap_op_tanggal,
            'lap_op_jam_mulai' => $this->lap_op_jam_mulai,
            'lap_op_jam_selesai' => $this->lap_op_jam_selesai,
            'lap_op_final' => $this->lap_op_final,
            'lap_op_tgl_final' => $this->lap_op_tgl_final,
            'lap_op_batal' => $this->lap_op_batal,
            'lap_op_tgl_batal' => $this->lap_op_tgl_batal,
            'lap_op_mdcp_id' => $this->lap_op_mdcp_id,
            'lap_op_created_at' => $this->lap_op_created_at,
            'lap_op_created_by' => $this->lap_op_created_by,
            'lap_op_updated_at' => $this->lap_op_updated_at,
            'lap_op_updated_by' => $this->lap_op_updated_by,
            'lap_op_deleted_at' => $this->lap_op_deleted_at,
            'lap_op_deleted_by' => $this->lap_op_deleted_by,
        ]);

        $query->andFilterWhere(['ilike', 'lap_op_ruangan', $this->lap_op_ruangan])
            ->andFilterWhere(['ilike', 'lap_op_kelas', $this->lap_op_kelas])
            ->andFilterWhere(['ilike', 'lap_op_jenis_operasi', $this->lap_op_jenis_operasi])
            ->andFilterWhere(['ilike', 'lap_op_lama_operasi', $this->lap_op_lama_operasi])
            ->andFilterWhere(['ilike', 'lap_op_diagnosis_pre_operasi', $this->lap_op_diagnosis_pre_operasi])
            ->andFilterWhere(['ilike', 'lap_op_diagnosis_pasca_operasi', $this->lap_op_diagnosis_pasca_operasi])
            ->andFilterWhere(['ilike', 'lap_op_nama_jenis_operasi', $this->lap_op_nama_jenis_operasi])
            ->andFilterWhere(['ilike', 'lap_op_jaringan_operasi_dikirim', $this->lap_op_jaringan_operasi_dikirim])
            ->andFilterWhere(['ilike', 'lap_op_jenis_jaringan', $this->lap_op_jenis_jaringan])
            ->andFilterWhere(['ilike', 'lap_op_label_implant', $this->lap_op_label_implant])
            ->andFilterWhere(['ilike', 'lap_op_instruksi_prwt_pasca_operasi', $this->lap_op_instruksi_prwt_pasca_operasi])
            ->andFilterWhere(['ilike', 'lap_op_kompikasi', $this->lap_op_kompikasi])
            ->andFilterWhere(['ilike', 'lap_op_prosedur', $this->lap_op_prosedur]);

        return $dataProvider;
    }
}
