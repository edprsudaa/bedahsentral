<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\bedahsentral\AskanPraAnestesi;

/**
 * AskanPraAnestesiSearch represents the model behind the search form of `app\models\bedahsentral\AskanPraAnestesi`.
 */
class AskanPraAnestesiSearch extends AskanPraAnestesi
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['apa_id', 'apa_to_id', 'apa_mdcp_id', 'apa_final', 'apa_batal', 'apa_created_by', 'apa_updated_by', 'apa_deleted_by'], 'integer'],
            [['apa_tanggal_pukul', 'apa_td', 'apa_nadi', 'apa_suhu', 'apa_frekuensi_nafas', 'apa_bb', 'apa_tb', 'apa_gol_darah', 'apa_hb', 'apa_ht', 'apa_gds', 'apa_inform_consent', 'apa_respirasi', 'apa_renal_endokrin', 'apa_kardiovaskular', 'apa_syaraf_kesadaran', 'apa_hepato', 'apa_neuro', 'apa_lain_lain', 'apa_diagnosa', 'apa_tindakan', 'apa_masalah_kesehatan', 'apa_intervensi', 'apa_implementasi', 'apa_evaluasi', 'apa_tgl_final', 'apa_tgl_batal', 'apa_created_at', 'apa_updated_at', 'apa_deleted_at'], 'safe'],
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
        $query = AskanPraAnestesi::find();

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
            'apa_id' => $this->apa_id,
            'apa_to_id' => $this->apa_to_id,
            'apa_tanggal_pukul' => $this->apa_tanggal_pukul,
            'apa_mdcp_id' => $this->apa_mdcp_id,
            'apa_final' => $this->apa_final,
            'apa_tgl_final' => $this->apa_tgl_final,
            'apa_batal' => $this->apa_batal,
            'apa_tgl_batal' => $this->apa_tgl_batal,
            'apa_created_at' => $this->apa_created_at,
            'apa_created_by' => $this->apa_created_by,
            'apa_updated_at' => $this->apa_updated_at,
            'apa_updated_by' => $this->apa_updated_by,
            'apa_deleted_at' => $this->apa_deleted_at,
            'apa_deleted_by' => $this->apa_deleted_by,
        ]);

        $query->andFilterWhere(['ilike', 'apa_td', $this->apa_td])
            ->andFilterWhere(['ilike', 'apa_nadi', $this->apa_nadi])
            ->andFilterWhere(['ilike', 'apa_suhu', $this->apa_suhu])
            ->andFilterWhere(['ilike', 'apa_frekuensi_nafas', $this->apa_frekuensi_nafas])
            ->andFilterWhere(['ilike', 'apa_bb', $this->apa_bb])
            ->andFilterWhere(['ilike', 'apa_tb', $this->apa_tb])
            ->andFilterWhere(['ilike', 'apa_gol_darah', $this->apa_gol_darah])
            ->andFilterWhere(['ilike', 'apa_hb', $this->apa_hb])
            ->andFilterWhere(['ilike', 'apa_ht', $this->apa_ht])
            ->andFilterWhere(['ilike', 'apa_gds', $this->apa_gds])
            ->andFilterWhere(['ilike', 'apa_inform_consent', $this->apa_inform_consent])
            ->andFilterWhere(['ilike', 'apa_respirasi', $this->apa_respirasi])
            ->andFilterWhere(['ilike', 'apa_renal_endokrin', $this->apa_renal_endokrin])
            ->andFilterWhere(['ilike', 'apa_kardiovaskular', $this->apa_kardiovaskular])
            ->andFilterWhere(['ilike', 'apa_syaraf_kesadaran', $this->apa_syaraf_kesadaran])
            ->andFilterWhere(['ilike', 'apa_hepato', $this->apa_hepato])
            ->andFilterWhere(['ilike', 'apa_neuro', $this->apa_neuro])
            ->andFilterWhere(['ilike', 'apa_lain_lain', $this->apa_lain_lain])
            ->andFilterWhere(['ilike', 'apa_diagnosa', $this->apa_diagnosa])
            ->andFilterWhere(['ilike', 'apa_tindakan', $this->apa_tindakan])
            ->andFilterWhere(['ilike', 'apa_masalah_kesehatan', $this->apa_masalah_kesehatan])
            ->andFilterWhere(['ilike', 'apa_intervensi', $this->apa_intervensi])
            ->andFilterWhere(['ilike', 'apa_implementasi', $this->apa_implementasi])
            ->andFilterWhere(['ilike', 'apa_evaluasi', $this->apa_evaluasi]);

        return $dataProvider;
    }
}
