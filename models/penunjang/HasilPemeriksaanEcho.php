<?php

namespace app\models\penunjang;

use Yii;

/**
 * This is the model class for table "hasil_pemeriksaan_echo".
 *
 * @property int $id
 * @property int $layanan_id_penunjang
 * @property string|null $tgl_terima
 * @property string|null $tgl_periksa
 * @property string|null $dimensi
 * @property string|null $katup
 * @property string|null $penemuan
 * @property string|null $kesimpulan
 * @property int|null $root_dimension_aorta
 * @property int|null $dimension_atrium_kiri
 * @property string|null $la_ratio_atrium_kiri
 * @property int|null $dimension_vertikal_kanan
 * @property int|null $ef_jantung
 * @property string|null $ivs_ratio
 * @property int|null $epss_jantung
 * @property int|null $mva_jantung
 * @property int|null $edd
 * @property int|null $esd
 * @property int|null $ivs_diastole
 * @property string|null $ivs_systole
 * @property int|null $ivc_frae
 * @property int|null $pw_diastole
 * @property string|null $pw_systole
 * @property int|null $pw_frae
 * @property int $dokter_id
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property string|null $deleted_at
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property int|null $deleted_by
 * @property int|null $is_save
 */
class HasilPemeriksaanEcho extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'hasil_pemeriksaan_echo';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_penunjang_2');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['layanan_id_penunjang', 'dokter_id'], 'required'],
            [['layanan_id_penunjang', 'root_dimension_aorta', 'dimension_atrium_kiri', 'dimension_vertikal_kanan', 'ef_jantung', 'epss_jantung', 'mva_jantung', 'edd', 'esd', 'ivs_diastole', 'ivc_frae', 'pw_diastole', 'pw_frae', 'dokter_id', 'created_by', 'updated_by', 'deleted_by', 'is_save'], 'default', 'value' => null],
            [['layanan_id_penunjang', 'root_dimension_aorta', 'dimension_atrium_kiri', 'dimension_vertikal_kanan', 'ef_jantung', 'epss_jantung', 'mva_jantung', 'edd', 'esd', 'ivs_diastole', 'ivc_frae', 'pw_diastole', 'pw_frae', 'dokter_id', 'created_by', 'updated_by', 'deleted_by', 'is_save'], 'integer'],
            [['tgl_terima', 'tgl_periksa', 'created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['dimensi', 'katup', 'penemuan', 'kesimpulan', 'la_ratio_atrium_kiri', 'ivs_ratio', 'ivs_systole', 'pw_systole'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'layanan_id_penunjang' => 'Layanan Id Penunjang',
            'tgl_terima' => 'Tgl Terima',
            'tgl_periksa' => 'Tgl Periksa',
            'dimensi' => 'Dimensi',
            'katup' => 'Katup',
            'penemuan' => 'Penemuan',
            'kesimpulan' => 'Kesimpulan',
            'root_dimension_aorta' => 'Root Dimension Aorta',
            'dimension_atrium_kiri' => 'Dimension Atrium Kiri',
            'la_ratio_atrium_kiri' => 'La Ratio Atrium Kiri',
            'dimension_vertikal_kanan' => 'Dimension Vertikal Kanan',
            'ef_jantung' => 'Ef Jantung',
            'ivs_ratio' => 'Ivs Ratio',
            'epss_jantung' => 'Epss Jantung',
            'mva_jantung' => 'Mva Jantung',
            'edd' => 'Edd',
            'esd' => 'Esd',
            'ivs_diastole' => 'Ivs Diastole',
            'ivs_systole' => 'Ivs Systole',
            'ivc_frae' => 'Ivc Frae',
            'pw_diastole' => 'Pw Diastole',
            'pw_systole' => 'Pw Systole',
            'pw_frae' => 'Pw Frae',
            'dokter_id' => 'Dokter ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'deleted_at' => 'Deleted At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'deleted_by' => 'Deleted By',
            'is_save' => 'Is Save',
        ];
    }
}
