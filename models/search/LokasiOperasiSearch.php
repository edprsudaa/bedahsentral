<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\bedahsentral\LokasiOperasi;

/**
 * LokasiOperasiSearch represents the model behind the search form of `app\models\bedahsentral\LokasiOperasi`.
 */
class LokasiOperasiSearch extends LokasiOperasi
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['mlo_id', 'mlo_to_id', 'mlo_dokter_yg_melakukan_pgw_id', 'mlo_final', 'mlo_batal', 'mlo_mdcp_id', 'mlo_created_by', 'mlo_updated_by', 'mlo_deleted_by'], 'integer'],
            [['mlo_gambar_marking', 'mlo_keterangan_marking', 'mlo_catatan', 'mlo_tgl_final', 'mlo_tgl_batal', 'mlo_created_at', 'mlo_updated_at', 'mlo_deleted_at'], 'safe'],
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
        $query = LokasiOperasi::find();

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
            'mlo_id' => $this->mlo_id,
            'mlo_to_id' => $this->mlo_to_id,
            'mlo_dokter_yg_melakukan_pgw_id' => $this->mlo_dokter_yg_melakukan_pgw_id,
            'mlo_final' => $this->mlo_final,
            'mlo_tgl_final' => $this->mlo_tgl_final,
            'mlo_batal' => $this->mlo_batal,
            'mlo_tgl_batal' => $this->mlo_tgl_batal,
            'mlo_mdcp_id' => $this->mlo_mdcp_id,
            'mlo_created_at' => $this->mlo_created_at,
            'mlo_created_by' => $this->mlo_created_by,
            'mlo_updated_at' => $this->mlo_updated_at,
            'mlo_updated_by' => $this->mlo_updated_by,
            'mlo_deleted_at' => $this->mlo_deleted_at,
            'mlo_deleted_by' => $this->mlo_deleted_by,
        ]);

        $query->andFilterWhere(['ilike', 'mlo_gambar_marking', $this->mlo_gambar_marking])
            ->andFilterWhere(['ilike', 'mlo_keterangan_marking', $this->mlo_keterangan_marking])
            ->andFilterWhere(['ilike', 'mlo_catatan', $this->mlo_catatan]);

        return $dataProvider;
    }
}
