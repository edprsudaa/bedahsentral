<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\medis\Cppt;
use app\models\pendaftaran\Registrasi;

/**
 * PasienCpptSearch represents the model behind the search form of `app\models\medis\Cppt`.
 */
class PasienCpptSearch extends Cppt
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'layanan_id', 'dokter_perawat_id', 'dokter_id_verifikasi', 'draf', 'batal', 'created_by', 'updated_by', 'is_deleted'], 'integer'],
            [['s', 'o', 'a', 'p', 'intruksi_ppa', 'tanggal_verifikasi', 'created_at', 'updated_at', 'log_data'], 'safe'],
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
        $query = Cppt::find();
        $query->joinWith([
            'dokter',
            'layanan'=>function($q) use ($layanan){
                $q->joinWith(['registrasi']);
                $q->andWhere([Registrasi::tableName().'.pasien_kode'=>$layanan['registrasi']['pasien_kode']]);
            },
            'dokterVerif'])->nodraf();
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'tanggal_final' => SORT_DESC
                ]
            ],
            'pagination' => [ 
                'pageSize' => 10 
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        // $query->andFilterWhere([
        //     'id' => $this->id,
        //     'layanan_id' => $this->layanan_id,
        //     'dokter_perawat_id' => $this->dokter_perawat_id,
        //     'dokter_id_verifikasi' => $this->dokter_id_verifikasi,
        //     'tanggal_verifikasi' => $this->tanggal_verifikasi,
        //     'draf' => $this->draf,
        //     'batal' => $this->batal,
        //     'created_at' => $this->created_at,
        //     'created_by' => $this->created_by,
        //     'updated_at' => $this->updated_at,
        //     'updated_by' => $this->updated_by,
        //     'is_deleted' => $this->is_deleted,
        // ]);

        // $query->andFilterWhere(['ilike', 's', $this->s])
        //     ->andFilterWhere(['ilike', 'o', $this->o])
        //     ->andFilterWhere(['ilike', 'a', $this->a])
        //     ->andFilterWhere(['ilike', 'p', $this->p])
        //     ->andFilterWhere(['ilike', 'intruksi_ppa', $this->intruksi_ppa])
        //     ->andFilterWhere(['ilike', 'log_data', $this->log_data]);

        return $dataProvider;
    }
}
