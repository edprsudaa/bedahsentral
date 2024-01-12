<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\medis\TarifTindakanPasien;
use app\models\pendaftaran\Layanan;
use app\components\HelperSpesial;

/**
 * TarifTindakanPasienSearch represents the model behind the search form of `app\models\medis\TarifTindakanPasien`.
 */
class TarifTindakanPasienSearch extends TarifTindakanPasien
{
  /**
   * {@inheritdoc}
   */
  public function rules()
  {
    return [
      [['id', 'tarif_tindakan_id', 'layanan_id',  'pelaksana_id', 'cyto', 'created_by', 'updated_by', 'is_deleted'], 'integer'],
      [['keterangan', 'created_at', 'updated_at'], 'safe'],
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
  public function search($params, $layanan, $user)
  {
    // echo "<pre>";
    // print_r($layanan);
    // die;
    $query = TarifTindakanPasien::find();
    $query->joinWith([
      'tarifTindakan.tindakan',
      'pelaksana',
      'layanan' =>
      function ($query) use ($layanan) {
        if ($layanan['jenis_layanan'] === Layanan::OK) {
          $query->andWhere([Layanan::tableName() . '.jenis_layanan' => Layanan::OK, Layanan::tableName() . '.registrasi_kode' => $layanan['registrasi_kode']]);
        } else {
          //RJ/IGD/PENUNJANG
          $query->andWhere([Layanan::tableName() . '.id' => $layanan['id']]);
        }
      }
    ]);
    if (HelperSpesial::isDokter($user)) {
      $query->andWhere([self::tableName() . '.pelaksana_id' => $user['pegawai_id']]);
    }
    $dataProvider = new ActiveDataProvider([
      'query' => $query,
      'sort' => [
        'defaultOrder' => [
          'tanggal' => SORT_DESC
        ]
      ],
      'pagination' => false
    ]);
    // $dataProvider = new ActiveDataProvider([
    //   'query' => $query,
    //   'pagination' => [
    //     'pageSize' => \Yii::$app->params['setting']['paging']['size']['medium']
    //   ]
    // ]);

    $this->load($params);

    if (!$this->validate()) {
      // uncomment the following line if you do not want to return any records when validation fails
      // $query->where('0=1');
      return $dataProvider;
    }

    return $dataProvider;
  }
}
