<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\bedahsentral\AskanIntraAnestesi;

/**
 * AskanIntraAnestesiSearch represents the model behind the search form of `app\models\bedahsentral\AskanIntraAnestesi`.
 */
class AskanIntraAnestesiSearch extends AskanIntraAnestesi
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['aia_id', 'aia_to_id', 'aia_mdcp_id', 'aia_final', 'aia_batal', 'aia_created_by', 'aia_updated_by', 'aia_deleted_by'], 'integer'],
            [['aia_mulai_anestesi', 'aia_mulai_pembedahan', 'aia_selesai_anestesi', 'aia_selesai_pembedahan', 'aia_tehnik_anestesi', 'aia_obat_induksi', 'aia_obat_inhalasi', 'aia_obat_regional', 'aia_cairan_darah', 'aia_darah', 'aia_posisi_operasi', 'aia_masalah_kesehatan', 'aia_intervensi', 'aia_implementasi', 'aia_evaluasi', 'aia_tgl_final', 'aia_tgl_batal', 'aia_created_at', 'aia_updated_at', 'aia_deleted_at', 'aia_obat_lainnya'], 'safe'],
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
        $query = AskanIntraAnestesi::find();

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
            'aia_id' => $this->aia_id,
            'aia_to_id' => $this->aia_to_id,
            'aia_mulai_anestesi' => $this->aia_mulai_anestesi,
            'aia_mulai_pembedahan' => $this->aia_mulai_pembedahan,
            'aia_selesai_anestesi' => $this->aia_selesai_anestesi,
            'aia_selesai_pembedahan' => $this->aia_selesai_pembedahan,
            'aia_mdcp_id' => $this->aia_mdcp_id,
            'aia_final' => $this->aia_final,
            'aia_tgl_final' => $this->aia_tgl_final,
            'aia_batal' => $this->aia_batal,
            'aia_tgl_batal' => $this->aia_tgl_batal,
            'aia_created_at' => $this->aia_created_at,
            'aia_created_by' => $this->aia_created_by,
            'aia_updated_at' => $this->aia_updated_at,
            'aia_updated_by' => $this->aia_updated_by,
            'aia_deleted_at' => $this->aia_deleted_at,
            'aia_deleted_by' => $this->aia_deleted_by,
        ]);

        $query->andFilterWhere(['ilike', 'aia_tehnik_anestesi', $this->aia_tehnik_anestesi])
            ->andFilterWhere(['ilike', 'aia_obat_induksi', $this->aia_obat_induksi])
            ->andFilterWhere(['ilike', 'aia_obat_inhalasi', $this->aia_obat_inhalasi])
            ->andFilterWhere(['ilike', 'aia_obat_regional', $this->aia_obat_regional])
            ->andFilterWhere(['ilike', 'aia_cairan_darah', $this->aia_cairan_darah])
            ->andFilterWhere(['ilike', 'aia_darah', $this->aia_darah])
            ->andFilterWhere(['ilike', 'aia_posisi_operasi', $this->aia_posisi_operasi])
            ->andFilterWhere(['ilike', 'aia_masalah_kesehatan', $this->aia_masalah_kesehatan])
            ->andFilterWhere(['ilike', 'aia_intervensi', $this->aia_intervensi])
            ->andFilterWhere(['ilike', 'aia_implementasi', $this->aia_implementasi])
            ->andFilterWhere(['ilike', 'aia_evaluasi', $this->aia_evaluasi])
            ->andFilterWhere(['ilike', 'aia_obat_lainnya', $this->aia_obat_lainnya]);

        return $dataProvider;
    }
}
