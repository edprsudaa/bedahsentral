<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\medis\IntervensiKeperawatanPasien;
use app\models\medis\IntervensiKeperawatan;
use app\models\pendaftaran\Layanan;
use app\components\HelperSpesial;

/**
 * PasienIntervensiKeperawatanSearch represents the model behind the search form of `app\models\medis\IntervensiKeperawatanPasien`.
 */
class PasienIntervensiKeperawatanSearch extends IntervensiKeperawatanPasien
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'layanan_id', 'perawat_id', 'intervensi_keperawatan_id', 'batal', 'created_by', 'updated_by', 'is_deleted'], 'integer'],
            [['tanggal', 'tanggal_batal', 'created_at', 'updated_at', 'log_data'], 'safe'],
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
        $query = IntervensiKeperawatanPasien::find();

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
                },
            'intervensiKeperawatan'    
            ]);
        $query->orderBy([IntervensiKeperawatan::tableName().'.id'=>SORT_ASC,self::tableName().'.tanggal'=>SORT_ASC]);    
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => false,
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
        //     'intervensi_keperawatan_id' => $this->intervensi_keperawatan_id,
        //     'batal' => $this->batal,
        //     'tanggal_batal' => $this->tanggal_batal,
        //     'created_at' => $this->created_at,
        //     'created_by' => $this->created_by,
        //     'updated_at' => $this->updated_at,
        //     'updated_by' => $this->updated_by,
        //     'is_deleted' => $this->is_deleted,
        // ]);

        // $query->andFilterWhere(['ilike', 'log_data', $this->log_data]);

        return $dataProvider;
    }
}
