<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\medis\DietPasien;
use app\models\pendaftaran\Layanan;
use app\components\HelperSpesial;
/**
 * PasienDietSearch represents the model behind the search form of `app\models\medis\DietPasien`.
 */
class PasienDietSearch extends DietPasien
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'layanan_id', 'perawat_id', 'batal', 'created_by', 'updated_by', 'is_deleted'], 'integer'],
            [['tanggal', 'jenis_diet', 'catatan_diet', 'tanggal_batal', 'created_at', 'updated_at', 'log_data'], 'safe'],
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
        $query = DietPasien::find();

        // add conditions that should always apply here

        $query->joinWith([
            'perawat',
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

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'tanggal' => SORT_DESC
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

        // grid filtering conditions
        // $query->andFilterWhere([
        //     'id' => $this->id,
        //     'layanan_id' => $this->layanan_id,
        //     'perawat_id' => $this->perawat_id,
        //     'tanggal' => $this->tanggal,
        //     'batal' => $this->batal,
        //     'tanggal_batal' => $this->tanggal_batal,
        //     'created_at' => $this->created_at,
        //     'created_by' => $this->created_by,
        //     'updated_at' => $this->updated_at,
        //     'updated_by' => $this->updated_by,
        //     'is_deleted' => $this->is_deleted,
        // ]);

        // $query->andFilterWhere(['ilike', 'jenis_diet', $this->jenis_diet])
        //     ->andFilterWhere(['ilike', 'catatan_diet', $this->catatan_diet])
        //     ->andFilterWhere(['ilike', 'log_data', $this->log_data]);

        return $dataProvider;
    }
}
