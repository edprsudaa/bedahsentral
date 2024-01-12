<?php

namespace app\models\medis;

use Yii;
use app\models\pendaftaran\KelasRawat;
/**
 * This is the model class for table "medis.tarif_tindakan".
 *
 * @property int $id
 * @property int $tindakan_id
 * @property string $kelas_rawat_kode
 * @property int $sk_tarif_id
 * @property float $js_adm
 * @property float $js_sarana
 * @property float $js_bhp
 * @property float $js_dokter_operator
 * @property float $js_dokter_lainya
 * @property float $js_dokter_anastesi
 * @property float $js_penata_anastesi
 * @property float $js_paramedis
 * @property float $js_lainya
 * @property float $js_adm_cto
 * @property float $js_sarana_cto
 * @property float $js_bhp_cto
 * @property float $js_dokter_operator_cto
 * @property float $js_dokter_lainya_cto
 * @property float $js_dokter_anastesi_cto
 * @property float $js_penata_anastesi_cto
 * @property float $js_paramedis_cto
 * @property float $js_lainya_cto
 * @property string|null $created_at
 * @property int $created_by
 * @property string|null $updated_at
 * @property int|null $updated_by
 * @property int|null $is_deleted
 */
class TarifTindakan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'medis.tarif_tindakan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tindakan_id', 'kelas_rawat_kode', 'sk_tarif_id', 'created_by'], 'required'],
            [['tindakan_id', 'sk_tarif_id', 'created_by', 'updated_by', 'is_deleted'], 'default', 'value' => null],
            [['tindakan_id', 'sk_tarif_id', 'created_by', 'updated_by', 'is_deleted'], 'integer'],
            [['js_adm', 'js_sarana', 'js_bhp', 'js_dokter_operator', 'js_dokter_lainya', 'js_dokter_anastesi', 'js_penata_anastesi', 'js_paramedis', 'js_lainya', 'js_adm_cto', 'js_sarana_cto', 'js_bhp_cto', 'js_dokter_operator_cto', 'js_dokter_lainya_cto', 'js_dokter_anastesi_cto', 'js_penata_anastesi_cto', 'js_paramedis_cto', 'js_lainya_cto'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['kelas_rawat_kode'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tindakan_id' => 'Tindakan ID',
            'kelas_rawat_kode' => 'Kelas Rawat Kode',
            'sk_tarif_id' => 'Sk Tarif ID',
            'js_adm' => 'Js Adm',
            'js_sarana' => 'Js Sarana',
            'js_bhp' => 'Js Bhp',
            'js_dokter_operator' => 'Js Dokter Operator',
            'js_dokter_lainya' => 'Js Dokter Lainya',
            'js_dokter_anastesi' => 'Js Dokter Anastesi',
            'js_penata_anastesi' => 'Js Penata Anastesi',
            'js_paramedis' => 'Js Paramedis',
            'js_lainya' => 'Js Lainya',
            'js_adm_cto' => 'Js Adm Cto',
            'js_sarana_cto' => 'Js Sarana Cto',
            'js_bhp_cto' => 'Js Bhp Cto',
            'js_dokter_operator_cto' => 'Js Dokter Operator Cto',
            'js_dokter_lainya_cto' => 'Js Dokter Lainya Cto',
            'js_dokter_anastesi_cto' => 'Js Dokter Anastesi Cto',
            'js_penata_anastesi_cto' => 'Js Penata Anastesi Cto',
            'js_paramedis_cto' => 'Js Paramedis Cto',
            'js_lainya_cto' => 'Js Lainya Cto',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
            'is_deleted' => 'Is Deleted',
        ];
    }

    /**
     * {@inheritdoc}
     * @return TarifTindakanQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TarifTindakanQuery(get_called_class());
    }
    function getSkTarif()
    {
        return $this->hasOne(SkTarif::className(),['id'=>'sk_tarif_id']);
    }
    function getTindakan()
    {
        return $this->hasOne(Tindakan::className(),['id'=>'tindakan_id']);
    }
    public function getKelasRawat()
    {
        return $this->hasOne(KelasRawat::className(),['kode'=>'kelas_rawat_kode']);
    }
}
