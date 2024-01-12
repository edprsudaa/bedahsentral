<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%asesmen_pra_induksi}}`.
 */
class m220509_070320_create_asesmen_pra_induksi_table extends Migration
{

  // public function init()
  // {
  //   $this->db = 'db_bedah_sentral';
  //   parent::init();
  // }

  public function safeUp()
  {
    $this->createTable('{{%asesmen_pra_induksi}}', [
      'api_id' => $this->primaryKey()->notNull(),
      'api_to_id' => $this->bigInteger(20)->notNull(),
      'api_waktu' => $this->time(),
      'api_riwayat_anestesi' => $this->text(),
      'api_riwayat_merokok' => $this->text(),
      'api_alkoholic' => $this->text(),
      'api_riwayat_alergi' => $this->text(),
      'api_persiapan_transfusi' => $this->text(),
      'api_puasa' => $this->text(),
      'api_pvs_sens' => $this->text(),
      'api_pvs_td_sistole' => $this->text(),
      'api_pvs_td_diastole' => $this->text(),
      'api_pvs_nadi' => $this->text(),
      'api_pvs_rr' => $this->text(),
      'api_pvs_suhu' => $this->text(),
      'api_klasifikasi_asa' => $this->text(),
      'api_rencana_anestesi' => $this->text(),
      'api_rencana_pemulihan_pasca_anestesi' => $this->text(),
      'api_rencana_manajemen_nyeri' => $this->text(),
      'api_obat_premedikasi_nama' => $this->text(),
      'api_obat_premedikasi_dosis' => $this->text(),
      'api_obat_premedikasi_jam' => $this->time(),
      'api_obat_premedikasi_pelaksana' => $this->text(),
      'api_final' => $this->tinyInteger(4),
      'api_tgl_final' => $this->timestamp(),
      'api_batal' => $this->tinyInteger(4),
      'api_tgl_batal' => $this->timestamp(),
      'api_mdcp_id' => $this->bigInteger(20),
      'api_created_at' => $this->timestamp(),
      'api_created_by' => $this->bigInteger(20),
      'api_updated_at' => $this->timestamp(),
      'api_updated_by' => $this->bigInteger(20),
      'api_deleted_at' => $this->timestamp(),
      'api_deleted_by' => $this->bigInteger(20),
    ]);
  }

  /**
   * {@inheritdoc}
   */
  public function safeDown()
  {
    $this->dropTable('{{%asesmen_pra_induksi}}');
  }
}
