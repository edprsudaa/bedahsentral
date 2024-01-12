<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\medis\PjpRi;

/**
 * PasienPjpRiSearch represents the model behind the search form of `app\models\medis\PjpRi`.
 */
class PasienPjpRiSearch extends PjpRi
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'pegawai_id', 'status', 'created_by', 'updated_by', 'is_deleted'], 'integer'],
            [['registrasi_kode', 'tanggal_mulai', 'tanggal_akhir', 'keterangan', 'created_at', 'updated_at', 'log_data'], 'safe'],
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

    public function search($params,$layanan)
    {
        $query = PjpRi::find();
        $query->joinWith([
            'pegawai',
            'registrasi'
            ]);
        $query->andWhere([self::tableName().'.registrasi_kode'=>$layanan['registrasi_kode']]);
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'tanggal_mulai' => SORT_ASC
                ]
            ],
            'pagination' => [ 
                'pageSize' => 100
            ]
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
