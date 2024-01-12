<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\medis\AsesmenAwalKebidananRiwayatKehamilan;
use app\models\pendaftaran\Layanan;
use app\models\pendaftaran\Registrasi;
use app\components\HelperSpesial;
/**
 * PasienAsesmenAwalKebidananRiwayatKehamilanSearch represents the model behind the search form of `app\models\medis\AsesmenAwalKebidananRiwayatKehamilan`.
 */
class PasienAsesmenAwalKebidananRiwayatKehamilanSearch extends AsesmenAwalKebidananRiwayatKehamilan
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'layanan_id', 'perawat_id', 'bb_gram', 'created_by', 'updated_by', 'is_deleted'], 'integer'],
            [['tanggal', 'usia_kehamilan', 'tempat', 'penyulit', 'tindakan', 'penolong', 'jk', 'ket_anak_skrg', 'ket', 'created_at', 'updated_at', 'log_data'], 'safe'],
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
    public function search($params,$layanan,$user)
    {
        $query = AsesmenAwalKebidananRiwayatKehamilan::find();
        $query->joinWith([
            'perawat',
            'layanan'=>
                function($query){
                    $query->joinWith(['registrasi']);
                }
            ]);
        $query->orderBy([AsesmenAwalKebidananRiwayatKehamilan::tableName().'.created_at'=>SORT_ASC])->where([Registrasi::tableName().'.pasien_kode'=>$layanan['registrasi']['pasien_kode']]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => false,
            'pagination' => false
        ]);
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        return $dataProvider;
    }
}
