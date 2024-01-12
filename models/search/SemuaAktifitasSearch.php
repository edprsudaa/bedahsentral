<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\bedahsentral\Log;
use Yii;

/**
 * SemuaAktifitasSearch represents the model behind the search form of `app\models\bedahsentral\Log`.
 */
class SemuaAktifitasSearch extends Log
{
  /**
   * {@inheritdoc}
   */
  public function rules()
  {
    return [
      [['mlog_id', 'mlog_mdcp', 'mlog_mdcp_id', 'mlog_created_by'], 'integer'],
      [['mlog_type', 'mlog_deskripsi', 'mlog_data_type', 'mlog_data_before', 'mlog_data_after', 'mlog_ip', 'mlog_media', 'mlog_created_at'], 'safe'],
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
    $query = Log::find();
    $query->joinWith([
      'pegawai'
    ])->andWhere('mlog_mdcp_id IS NULL');
    // add conditions that should always apply here
    $dataProvider = new ActiveDataProvider([
      'query' => $query,
      'sort' => [
        'defaultOrder' => [
          'mlog_created_at' => SORT_DESC
        ]
        // ,'defaultOrder' => []
      ],
      'pagination' => [
        'pageSize' => \Yii::$app->params['setting']['paging']['size']['long']
      ]
    ]);

    $this->load($params);

    if (!$this->validate()) {
      // uncomment the following line if you do not want to return any records when validation fails
      // $query->where('0=1');
      return $dataProvider;
    }
    if ($this->mlog_created_at) {
      $query->andFilterWhere(['between', parent::tableName() . '.mlog_created_at', Yii::$app->formatter->asDate($this->mlog_created_at . ' 00:00:01', 'php:Y-m-d H:i:s'), Yii::$app->formatter->asDate($this->mlog_created_at . ' 23:59:59', 'php:Y-m-d H:i:s')]);
    }

    // grid filtering conditions
    $query->andFilterWhere([
      'mlog_id' => $this->mlog_id,
      'mlog_mdcp' => $this->mlog_mdcp,
      'mlog_mdcp_id' => $this->mlog_mdcp_id,
      'mlog_created_at' => $this->mlog_created_at,
      'mlog_created_by' => $this->mlog_created_by,
    ]);

    $query->andFilterWhere(['ilike', 'mlog_type', $this->mlog_type])
      ->andFilterWhere(['ilike', 'mlog_deskripsi', $this->mlog_deskripsi])
      ->andFilterWhere(['ilike', 'mlog_data_type', $this->mlog_data_type])
      ->andFilterWhere(['ilike', 'mlog_data_before', $this->mlog_data_before])
      ->andFilterWhere(['ilike', 'mlog_data_after', $this->mlog_data_after])
      ->andFilterWhere(['ilike', 'mlog_ip', $this->mlog_ip])
      ->andFilterWhere(['ilike', 'mlog_media', $this->mlog_media]);

    return $dataProvider;
  }
}
