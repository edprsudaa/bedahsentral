<?php

namespace app\models\medis;

use app\models\pendaftaran\KelasRawat;
use yii\helpers\ArrayHelper;
use app\models\pegawai\DmUnitPenempatan;
use app\components\HelperSpesial;

/**
 * This is the ActiveQuery class for [[TarifTindakanUnit]].
 *
 * @see TarifTindakanUnit
 */
class TarifTindakanUnitQuery extends \yii\db\ActiveQuery
{
  // public function init()
  // {
  //     $this->andOnCondition([TarifTindakanUnit::tableName().'.is_deleted'=>0]);
  //     parent::init();
  // }
  public function active()
  {
    return $this->andWhere([TarifTindakanUnit::tableName() . '.aktif' => 1]);
  }
  /**
   * {@inheritdoc}
   * @return TarifTindakanUnit[]|array
   */
  public function all($db = null)
  {
    return parent::all($db);
  }

  /**
   * {@inheritdoc}
   * @return TarifTindakanUnit|array|null
   */
  public function one($db = null)
  {
    return parent::one($db);
  }
  public function getListTarifTindakanUnit($original = true, $search = null, $unit_id = null, $kelas_rawat = null)
  {
    $q = $this->innerjoinWith([
      'tarifTindakan' => function ($q) {
        $q->innerjoinWith([
          'tindakan' => function ($q) {
            $q->active();
          },
          'skTarif' => function ($q) {
            $q->active();
          },
          'kelasRawat' => function ($q) {
            // $q->active();
          },
        ]);
      },
      'unit'
    ]);
    if ($search) $q->andWhere(['ilike', Tindakan::tableName() . '.deskripsi', $search]);
    if ($kelas_rawat) $q->andWhere([KelasRawat::tableName() . '.kode' => $kelas_rawat]);
    if ($unit_id) $q->andWhere([TarifTindakanUnit::tableName() . '.unit_id' => $unit_id]);

    $q->select([
      TarifTindakanUnit::tableName() . '.tarif_tindakan_id as id',
      TarifTindakanUnit::tableName() . '.tarif_tindakan_id',
      Tindakan::tableName() . '.id as tindakan_id',
      Tindakan::tableName() . '.deskripsi as tindakan_nama',
      SkTarif::tableName() . '.id as sk_tarif_id',
      KelasRawat::tableName() . '.kode as kelas_rawat_kode',
      KelasRawat::tableName() . '.nama as kelas_rawat_nama',
      DmUnitPenempatan::tableName() . '.kode as unit_id',
      DmUnitPenempatan::tableName() . '.nama as unit_nama'
    ]);
    if ($original) {
      return $q->asArray()->all();
    } else {
      $items = ArrayHelper::getColumn($q->asArray()->all(), function ($data) {
        $biaya = HelperSpesial::getHitungBiayaTindakan($data['tarifTindakan'], false);
        $text = $data['tindakan_nama'] . ' [KODE : ' . $data['tindakan_id'] . ' | ' . $data['kelas_rawat_nama'] . ' | Standar:Rp. ' . number_format($biaya['standar']) . ']';

        if ($biaya['cyto'] > 0) {
          $text = $data['tindakan_nama'] . ' [KODE : ' . $data['tindakan_id'] . ' | ' . $data['kelas_rawat_nama'] . ' | Standar:Rp. ' . number_format($biaya['standar']) . ' / Cyto:Rp. ' . number_format($biaya['cyto']) . ']';
        }

        return [
          'id' => $data['id'],
          'text' => $text
        ];
      });

      return ArrayHelper::map($items, 'id', 'text');
    }
  }
}
