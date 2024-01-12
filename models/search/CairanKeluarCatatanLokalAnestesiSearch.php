<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\bedahsentral\CairanKeluarCatatanLokalAnestesi;

/**
 * CairanKeluarCatatanLokalAnestesiSearch represents the model behind the search form of `app\models\bedahsentral\CairanKeluarCatatanLokalAnestesi`.
 */
class CairanKeluarCatatanLokalAnestesiSearch extends CairanKeluarCatatanLokalAnestesi
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kmcl_id', 'kmcl_cla_id', 'kmcl_jumlah', 'kmcl_created_by', 'kmcl_updated_by', 'kmcl_deleted_by'], 'integer'],
            [['kmcl_cairan_nama', 'kmcl_waktu', 'kmcl_created_at', 'kmcl_updated_at', 'kmcl_deleted_at'], 'safe'],
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
        $query = CairanKeluarCatatanLokalAnestesi::find();

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
            'kmcl_id' => $this->kmcl_id,
            'kmcl_cla_id' => $this->kmcl_cla_id,
            'kmcl_jumlah' => $this->kmcl_jumlah,
            'kmcl_waktu' => $this->kmcl_waktu,
            'kmcl_created_at' => $this->kmcl_created_at,
            'kmcl_created_by' => $this->kmcl_created_by,
            'kmcl_updated_at' => $this->kmcl_updated_at,
            'kmcl_updated_by' => $this->kmcl_updated_by,
            'kmcl_deleted_at' => $this->kmcl_deleted_at,
            'kmcl_deleted_by' => $this->kmcl_deleted_by,
        ]);

        $query->andFilterWhere(['ilike', 'kmcl_cairan_nama', $this->kmcl_cairan_nama]);

        return $dataProvider;
    }
}
