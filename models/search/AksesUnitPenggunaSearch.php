<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\sso\AksesUnit;

/**
 * AksesUnitPenggunaSearch represents the model behind the search form of `app\models\sso\AksesUnit`.
 */
class AksesUnitPenggunaSearch extends AksesUnit
{
  public $status;
  /**
   * {@inheritdoc}
   */
  public function rules()
  {
    return [
      [['id', 'unit_id', 'pengguna_id', 'created_by', 'updated_by', 'deleted_by'], 'integer'],
      [['id_aplikasi', 'tanggal_aktif', 'tanggal_nonaktif', 'created_at', 'updated_at', 'deleted_at'], 'safe'],
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
    $query = AksesUnit::find();
    $query->joinWith([
      'aplikasi'
    ])->with(['unit', 'pegawai.pegawai'])->andWhere(['or', [parent::tableName() . '.id_aplikasi' => \Yii::$app->params['app']['id']], [parent::tableName() . '.id_aplikasi' => 23]])->andWhere('deleted_at is null');
    
    // ->with(['unit', 'pegawai.pegawai'])->where([parent::tableName() . '.id_aplikasi' => \Yii::$app->params['app']['id']])->andWhere('deleted_at is null');

    $dataProvider = new ActiveDataProvider([
      'query' => $query,
      'sort' => [
        'defaultOrder' => [
          'created_at' => SORT_DESC
        ]
      ],
      'pagination' => [
        'pageSize' => \Yii::$app->params['setting']['paging']['size']['long']
      ]
    ]);
    // add conditions that should always apply here

    $this->load($params);

    if (!$this->validate()) {
      // uncomment the following line if you do not want to return any records when validation fails
      // $query->where('0=1');
      return $dataProvider;
    }

    // grid filtering conditions
    $query->andFilterWhere([
      'id' => $this->id,
      'unit_id' => $this->unit_id,
      'pengguna_id' => $this->pengguna_id,
      'id_aplikasi' => $this->id_aplikasi,
      'tanggal_aktif' => $this->tanggal_aktif,
      'tanggal_nonaktif' => $this->tanggal_nonaktif,
      'created_at' => $this->created_at,
      'created_by' => $this->created_by,
      'updated_at' => $this->updated_at,
      'updated_by' => $this->updated_by,
      'deleted_at' => $this->deleted_at,
      'deleted_by' => $this->deleted_by,
    ]);

    // $query->andFilterWhere(['ilike', 'id_aplikasi', $this->id_aplikasi]);

    return $dataProvider;
  }
}
