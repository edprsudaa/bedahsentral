<?php

namespace app\models\search;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\medis\PermintaanKonsultasi;
use app\models\pendaftaran\Layanan;
use app\models\pendaftaran\Pasien;
use app\components\HelperSpesial;
/**
 * LayananKonsultasiRiSearch represents the model behind the search form of `app\models\medis\PermintaanKonsultasi`.
 */
class LayananKonsultasiRiSearch extends PermintaanKonsultasi
{
    public $status_jawab;
    public $unit;
    public $pasien;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'layanan_id_minta', 'dokter_id_minta', 'unit_id_poli_tujuan', 'dokter_id_tujuan', 'batal', 'created_by', 'updated_by', 'is_deleted'], 'integer'],
            [['tanggal_minta', 'diagnosa_kerja', 'riwayat_klinik_singkat', 'jenis_konsultasi', 'tanggal_batal', 'created_at', 'updated_at', 'log_data'], 'safe'],
            [['status_jawab','unit','pasien'], 'safe'],
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
    public function search($params,$user)
    {
        $query = PermintaanKonsultasi::find();
        $query->joinWith([
            'layananMinta'=>function($q){
                $q->joinWith(['registrasi.pasien','kamar']);
            },
            'dokterMinta',
            'dokterTujuan',
            'jawabanKonsultasi'
            ]);
            if($user['akses_level']==HelperSpesial::LEVEL_DOKTER){
                $query->andWhere([
                    parent::tableName() . '.dokter_id_tujuan'=> $user['pegawai_id']
                ]);
            }else{
                $akses_pengguna=HelperSpesial::getListRIAksesPegawai(false,$user);
                if(!$akses_pengguna['unit_akses']){
                    $akses_pengguna['unit_akses']=[0];
                }
                $query->andWhere(Layanan::tableName().'.unit_kode IN ('.implode(',',$akses_pengguna['unit_akses']).')');
            }
            $query->andWhere([Layanan::tableName() . '.jenis_layanan' => Layanan::RI]);

        // add conditions that should always apply here
        // echo'<pre/>';print_r($akses_pengguna);die();
        // echo'<pre/>';print_r($query->asArray()->all());die();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                   'tanggal_minta' => SORT_DESC
                ]
            ],
            'pagination' => [ 
                'pageSize' => 20 
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        // $this->jenis_layanan=self::RI;
        // grid filtering conditions
        $query->andFilterWhere([
            Layanan::tableName() . '.unit_kode' => $this->unit,
            parent::tableName().'.dokter_id_minta'=>$this->dokter_id_minta,
            parent::tableName().'.dokter_id_tujuan'=>$this->dokter_id_tujuan,
            ]);
        // grid filtering conditions
        if($this->tanggal_minta){
            $query->andFilterWhere(['between', parent::tableName() . '.tanggal_minta', Yii::$app->formatter->asDate($this->tanggal_minta.' 00:00:01', 'php:Y-m-d H:i:s'), Yii::$app->formatter->asDate($this->tanggal_minta.' 23:59:59', 'php:Y-m-d H:i:s')]);
        }
        $query->andFilterWhere([
            'or',
            ['ilike', Pasien::tableName() . '.kode', $this->pasien],
            ['ilike', Pasien::tableName() . '.nama', $this->pasien],
            ['ilike', Layanan::tableName() . '.registrasi_kode', $this->pasien]
        ]);   
        return $dataProvider;
    }
}
