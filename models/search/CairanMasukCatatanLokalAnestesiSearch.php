<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\bedahsentral\CairanMasukCatatanLokalAnestesi;

/**
 * CairanMasukCatatanLokalAnestesiSearch represents the model behind the search form of `app\models\bedahsentral\CairanMasukCatatanLokalAnestesi`.
 */
class CairanMasukCatatanLokalAnestesiSearch extends CairanMasukCatatanLokalAnestesi
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['mmcl_id', 'mmcl_cla_id', 'mmcl_jumlah', 'mmcl_created_by', 'mmcl_updated_by', 'mmcl_deleted_by'], 'integer'],
            [['mmcl_cairan_nama', 'mmcl_waktu', 'mmcl_created_at', 'mmcl_updated_at', 'mmcl_deleted_at'], 'safe'],
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
        $query = CairanMasukCatatanLokalAnestesi::find();

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
            'mmcl_id' => $this->mmcl_id,
            'mmcl_cla_id' => $this->mmcl_cla_id,
            'mmcl_jumlah' => $this->mmcl_jumlah,
            'mmcl_waktu' => $this->mmcl_waktu,
            'mmcl_created_at' => $this->mmcl_created_at,
            'mmcl_created_by' => $this->mmcl_created_by,
            'mmcl_updated_at' => $this->mmcl_updated_at,
            'mmcl_updated_by' => $this->mmcl_updated_by,
            'mmcl_deleted_at' => $this->mmcl_deleted_at,
            'mmcl_deleted_by' => $this->mmcl_deleted_by,
        ]);

        $query->andFilterWhere(['ilike', 'mmcl_cairan_nama', $this->mmcl_cairan_nama]);

        return $dataProvider;
    }
}
