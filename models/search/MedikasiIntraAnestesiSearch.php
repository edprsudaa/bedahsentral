<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\bedahsentral\MedikasiIntraAnestesi;

/**
 * MedikasiIntraAnestesiSearch represents the model behind the search form of `app\models\bedahsentral\MedikasiIntraAnestesi`.
 */
class MedikasiIntraAnestesiSearch extends MedikasiIntraAnestesi
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['mmia_id', 'mmia_intra_anestesi_mia_id', 'mmia_created_by', 'mmia_updated_by', 'mmia_deleted_by'], 'integer'],
            [['mmia_nama_obat', 'mmia_waktu', 'mmia_created_at', 'mmia_updated_at', 'mmia_deleted_at'], 'safe'],
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
        $query = MedikasiIntraAnestesi::find();

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
            'mmia_id' => $this->mmia_id,
            'mmia_intra_anestesi_mia_id' => $this->mmia_intra_anestesi_mia_id,
            'mmia_waktu' => $this->mmia_waktu,
            'mmia_created_at' => $this->mmia_created_at,
            'mmia_created_by' => $this->mmia_created_by,
            'mmia_updated_at' => $this->mmia_updated_at,
            'mmia_updated_by' => $this->mmia_updated_by,
            'mmia_deleted_at' => $this->mmia_deleted_at,
            'mmia_deleted_by' => $this->mmia_deleted_by,
        ]);

        $query->andFilterWhere(['ilike', 'mmia_nama_obat', $this->mmia_nama_obat]);

        return $dataProvider;
    }
}
