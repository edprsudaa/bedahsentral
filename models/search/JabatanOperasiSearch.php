<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\bedahsentral\JabatanOperasi;

/**
 * JabatanOperasiSearch represents the model behind the search form of `app\models\bedahsentral\JabatanOperasi`.
 */
class JabatanOperasiSearch extends JabatanOperasi
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['jo_id', 'jo_utama'], 'integer'],
            [['jo_jabatan', 'jo_created_at', 'jo_created_by', 'jo_updated_at', 'jo_updated_by', 'jo_deleted_at', 'jo_deleted_by'], 'safe'],
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
        $query = JabatanOperasi::find();

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
            'jo_id' => $this->jo_id,
            'jo_utama' => $this->jo_utama,
            'jo_created_at' => $this->jo_created_at,
            'jo_updated_at' => $this->jo_updated_at,
            'jo_deleted_at' => $this->jo_deleted_at,
        ]);

        $query->andFilterWhere(['ilike', 'jo_jabatan', $this->jo_jabatan])
            ->andFilterWhere(['ilike', 'jo_created_by', $this->jo_created_by])
            ->andFilterWhere(['ilike', 'jo_updated_by', $this->jo_updated_by])
            ->andFilterWhere(['ilike', 'jo_deleted_by', $this->jo_deleted_by]);

        return $dataProvider;
    }
}
