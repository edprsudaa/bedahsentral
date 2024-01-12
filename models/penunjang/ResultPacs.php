<?php

namespace app\models\penunjang;

use Yii;

/**
 * This is the model class for table "result_pacs".
 *
 * @property string $id_pacsorder
 * @property string $nomor_pasien
 * @property string $nomor_registrasi
 * @property int $jenis_layanan
 * @property string $tanggal_masuk
 * @property string|null $tinggi_pasien
 * @property string|null $berat_pasien
 * @property string|null $priority
 * @property string $dokter_kode
 * @property string|null $dokter_nama
 * @property string|null $dokter_asal_kode
 * @property string|null $dokter_asal_nama
 * @property string $unit_kode
 * @property string|null $unit_nama
 * @property string|null $unit_asal_kode
 * @property string|null $unit_asal_nama
 * @property string $bridging_status
 * @property string $nomor_transaksi
 * @property string|null $kode_jenis
 * @property string|null $nama_tindakan
 * @property string $order_status
 * @property string $order_date
 * @property string $modality
 * @property string|null $clinical_diagnosis
 * @property string|null $report_description
 * @property string|null $report_date
 * @property string $dokter_id
 * @property string|null $dokter_name
 * @property string|null $link
 * @property string|null $result_status
 * @property string|null $serah_hasil_id
 * @property string|null $serah_hasil_date
 * @property string|null $validasi_id
 * @property string|null $validasi_date
 * @property string|null $created_id
 * @property string|null $created_date
 * @property string|null $modified_id
 * @property string|null $modified_date
 * @property string|null $deleted_id
 * @property string|null $deleted_date
 * @property string $status
 * @property string|null $ket
 * @property int|null $status_order
 * @property string|null $no_transaksi_order dulu kertas, kalau sekarang dari elektronik, dia jika ada orderan" dari dokter, kitapindah kan kesini
 */
class ResultPacs extends \yii\db\ActiveRecord
{
  CONST CT_SCAN = 'CT';
  CONST RONTGEN = 'CR';
  CONST USG = 'US';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'result_pacs';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_penunjang');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_pacsorder', 'nomor_pasien', 'nomor_registrasi', 'jenis_layanan', 'tanggal_masuk', 'dokter_kode', 'unit_kode', 'bridging_status', 'nomor_transaksi', 'order_status', 'order_date', 'modality', 'dokter_id', 'status'], 'required'],
            [['jenis_layanan', 'status_order'], 'default', 'value' => null],
            [['jenis_layanan', 'status_order'], 'integer'],
            [['tanggal_masuk', 'order_date', 'report_date', 'serah_hasil_date', 'validasi_date', 'created_date', 'modified_date', 'deleted_date'], 'safe'],
            [['report_description', 'link', 'ket', 'no_transaksi_order'], 'string'],
            [['id_pacsorder'], 'string', 'max' => 15],
            [['nomor_pasien', 'nomor_registrasi', 'unit_kode', 'unit_asal_kode', 'kode_jenis', 'order_status'], 'string', 'max' => 10],
            [['tinggi_pasien', 'berat_pasien', 'nomor_transaksi'], 'string', 'max' => 50],
            [['priority', 'dokter_nama', 'dokter_asal_nama', 'unit_nama', 'unit_asal_nama', 'modality', 'dokter_name', 'serah_hasil_id', 'validasi_id', 'created_id', 'modified_id', 'deleted_id'], 'string', 'max' => 255],
            [['dokter_kode', 'dokter_asal_kode', 'dokter_id'], 'string', 'max' => 100],
            [['bridging_status', 'result_status', 'status'], 'string', 'max' => 2],
            [['nama_tindakan', 'clinical_diagnosis'], 'string', 'max' => 500],
            [['id_pacsorder'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_pacsorder' => 'Id Pacsorder',
            'nomor_pasien' => 'Nomor Pasien',
            'nomor_registrasi' => 'Nomor Registrasi',
            'jenis_layanan' => 'Jenis Layanan',
            'tanggal_masuk' => 'Tanggal Masuk',
            'tinggi_pasien' => 'Tinggi Pasien',
            'berat_pasien' => 'Berat Pasien',
            'priority' => 'Priority',
            'dokter_kode' => 'Dokter Kode',
            'dokter_nama' => 'Dokter Nama',
            'dokter_asal_kode' => 'Dokter Asal Kode',
            'dokter_asal_nama' => 'Dokter Asal Nama',
            'unit_kode' => 'Unit Kode',
            'unit_nama' => 'Unit Nama',
            'unit_asal_kode' => 'Unit Asal Kode',
            'unit_asal_nama' => 'Unit Asal Nama',
            'bridging_status' => 'Bridging Status',
            'nomor_transaksi' => 'Nomor Transaksi',
            'kode_jenis' => 'Kode Jenis',
            'nama_tindakan' => 'Nama Tindakan',
            'order_status' => 'Order Status',
            'order_date' => 'Order Date',
            'modality' => 'Modality',
            'clinical_diagnosis' => 'Clinical Diagnosis',
            'report_description' => 'Report Description',
            'report_date' => 'Report Date',
            'dokter_id' => 'Dokter ID',
            'dokter_name' => 'Dokter Name',
            'link' => 'Link',
            'result_status' => 'Result Status',
            'serah_hasil_id' => 'Serah Hasil ID',
            'serah_hasil_date' => 'Serah Hasil Date',
            'validasi_id' => 'Validasi ID',
            'validasi_date' => 'Validasi Date',
            'created_id' => 'Created ID',
            'created_date' => 'Created Date',
            'modified_id' => 'Modified ID',
            'modified_date' => 'Modified Date',
            'deleted_id' => 'Deleted ID',
            'deleted_date' => 'Deleted Date',
            'status' => 'Status',
            'ket' => 'Ket',
            'status_order' => 'Status Order',
            'no_transaksi_order' => 'No Transaksi Order',
        ];
    }
}
