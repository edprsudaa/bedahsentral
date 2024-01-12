<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\medis\DocClinicalPasien;

/**
 * DocClinicalPasienSearch represents the model behind the search form of `app\models\medis\DocClinicalPasien`.
 */
class DocClinicalPasienSearch extends DocClinicalPasien
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_doc_clinical_pasien', 'manual', 'pl_id', 'unt_id', 'doc_clinical_id', 'batal', 'created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['ps_kode', 'ps_nama', 'ps_tempat_lahir', 'ps_tgl_lahir', 'ps_gender', 'ps_umur', 'reg_kode', 'reg_tgl', 'pl_tgl', 'unt_nama', 'doc_clinical_nama', 'data', 'tgl_batal', 'created_at', 'updated_at', 'deleted_at'], 'safe'],
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
        $query = DocClinicalPasien::find();

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
            'id_doc_clinical_pasien' => $this->id_doc_clinical_pasien,
            'manual' => $this->manual,
            'ps_tgl_lahir' => $this->ps_tgl_lahir,
            'reg_tgl' => $this->reg_tgl,
            'pl_id' => $this->pl_id,
            'pl_tgl' => $this->pl_tgl,
            'unt_id' => $this->unt_id,
            'doc_clinical_id' => $this->doc_clinical_id,
            'batal' => $this->batal,
            'tgl_batal' => $this->tgl_batal,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
            'deleted_at' => $this->deleted_at,
            'deleted_by' => $this->deleted_by,
        ]);

        $query->andFilterWhere(['ilike', 'ps_kode', $this->ps_kode])
            ->andFilterWhere(['ilike', 'ps_nama', $this->ps_nama])
            ->andFilterWhere(['ilike', 'ps_tempat_lahir', $this->ps_tempat_lahir])
            ->andFilterWhere(['ilike', 'ps_gender', $this->ps_gender])
            ->andFilterWhere(['ilike', 'ps_umur', $this->ps_umur])
            ->andFilterWhere(['ilike', 'reg_kode', $this->reg_kode])
            ->andFilterWhere(['ilike', 'unt_nama', $this->unt_nama])
            ->andFilterWhere(['ilike', 'doc_clinical_nama', $this->doc_clinical_nama])
            ->andFilterWhere(['ilike', 'data', $this->data]);

        return $dataProvider;
    }
}
