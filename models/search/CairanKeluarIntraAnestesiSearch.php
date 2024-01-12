<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\bedahsentral\CairanKeluarIntraAnestesi;

/**
 * CairanKeluarIntraAnestesiSearch represents the model behind the search form of `app\models\bedahsentral\CairanKeluarIntraAnestesi`.
 */
class CairanKeluarIntraAnestesiSearch extends CairanKeluarIntraAnestesi
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ckeluar_id', 'ckeluar_intra_operasi_mia_id', 'ckeluar_jumlah', 'ckeluar_created_by', 'ckeluar_updated_by', 'ckeluar_deleted_by'], 'integer'],
            [['ckeluar_cairan_nama', 'ckeluar_waktu', 'ckeluar_created_at', 'ckeluar_updated_at', 'ckeluar_deleted_at'], 'safe'],
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
        $query = CairanKeluarIntraAnestesi::find();

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
            'ckeluar_id' => $this->ckeluar_id,
            'ckeluar_intra_operasi_mia_id' => $this->ckeluar_intra_operasi_mia_id,
            'ckeluar_jumlah' => $this->ckeluar_jumlah,
            'ckeluar_waktu' => $this->ckeluar_waktu,
            'ckeluar_created_at' => $this->ckeluar_created_at,
            'ckeluar_created_by' => $this->ckeluar_created_by,
            'ckeluar_updated_at' => $this->ckeluar_updated_at,
            'ckeluar_updated_by' => $this->ckeluar_updated_by,
            'ckeluar_deleted_at' => $this->ckeluar_deleted_at,
            'ckeluar_deleted_by' => $this->ckeluar_deleted_by,
        ]);

        $query->andFilterWhere(['ilike', 'ckeluar_cairan_nama', $this->ckeluar_cairan_nama]);

        return $dataProvider;
    }
}
