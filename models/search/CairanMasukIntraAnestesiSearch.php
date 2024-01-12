<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\bedahsentral\CairanMasukIntraAnestesi;

/**
 * CairanMasukIntraAnestesiSearch represents the model behind the search form of `app\models\bedahsentral\CairanMasukIntraAnestesi`.
 */
class CairanMasukIntraAnestesiSearch extends CairanMasukIntraAnestesi
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cmasuk_id', 'cmasuk_intra_operasi_mia_id', 'cmasuk_jumlah', 'cmasuk_created_by', 'cmasuk_updated_by', 'cmasuk_deleted_by'], 'integer'],
            [['cmasuk_cairan_nama', 'cmasuk_waktu', 'cmasuk_created_at', 'cmasuk_updated_at', 'cmasuk_deleted_at'], 'safe'],
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
        $query = CairanMasukIntraAnestesi::find();

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
            'cmasuk_id' => $this->cmasuk_id,
            'cmasuk_intra_operasi_mia_id' => $this->cmasuk_intra_operasi_mia_id,
            'cmasuk_jumlah' => $this->cmasuk_jumlah,
            'cmasuk_waktu' => $this->cmasuk_waktu,
            'cmasuk_created_at' => $this->cmasuk_created_at,
            'cmasuk_created_by' => $this->cmasuk_created_by,
            'cmasuk_updated_at' => $this->cmasuk_updated_at,
            'cmasuk_updated_by' => $this->cmasuk_updated_by,
            'cmasuk_deleted_at' => $this->cmasuk_deleted_at,
            'cmasuk_deleted_by' => $this->cmasuk_deleted_by,
        ]);

        $query->andFilterWhere(['ilike', 'cmasuk_cairan_nama', $this->cmasuk_cairan_nama]);

        return $dataProvider;
    }
}
