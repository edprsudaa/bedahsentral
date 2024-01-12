<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\medis\AsesmenAwalKebidanan;

/**
 * PasienAsesmenAwalKebidananSearch represents the model behind the search form of `app\models\medis\AsesmenAwalKebidanan`.
 */
class PasienAsesmenAwalKebidananSearch extends AsesmenAwalKebidanan
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'layanan_id', 'perawat_id', 'gcs_e', 'gcs_m', 'gcs_v', 'suhu', 'sato2', 'tinggi_badan', 'berat_badan', 'lila', 'berat_badan_sebelum', 'skor_penurunan_bb', 'kepala_lk', 'palpasi_tbj', 'riwayat_perkawinan_ke', 'riwayat_perkawinan_usia_kawin_thn', 'riwayat_perkawinan_lama_kawin', 'riwayat_haid_menarche_umur_thn', 'riwayat_haid_siklus_haid_hari', 'rhamil_g', 'rhamil_p', 'rhamil_a', 'rhamil_h', 'rhamil_usia_kehamilan_pemeriksaan_awal_minggu', 'rhamil_pemeriksaan_ke', 'rhamil_usia_kehamilan_hpht_minggu', 'rpersalinan_lama_persalinan_kala1', 'rpersalinan_lama_persalinan_kala2', 'rpersalinan_lama_persalinan_kala3', 'rpersalinan_bayi_bb_gram', 'rpersalinan_bayi_pb_cm', 'rpersalinan_bayi_masa_gestasi_minggu', 'rkb_lama_kb', 'batal', 'draf', 'created_by', 'updated_by', 'is_deleted'], 'integer'],
            [['anamnesis_sumber', 'anamnesis_keluhan', 'riwayat_penyakit_sekarang', 'riwayat_penyakit_dahulu', 'riwayat_operasi', 'riwayat_pengobatan_tb', 'riwayat_pengobatan_lain', 'riwayat_penyakit_keluarga', 'alergi', 'status_sosial', 'ekonomi', 'imunisasi', 'status_psikologi', 'status_mental', 'riwayat_perilaku_kekerasan', 'ketergantungan_obat', 'ketergantungan_alkohol', 'permintaan_informasi', 'tingkat_kesadaran', 'nadi', 'darah', 'pernapasan', 'sikap_tubuh', 'kulit_warna', 'kulit_sianosis', 'kulit_kemerahan', 'kulit_dekubitus', 'kulit_turgor_kulit', 'kulit_tumor', 'kulit_luka_bakar', 'kulit_luka_tusuk', 'kulit_luka_memar', 'kulit_luka_robek', 'kepala_rambut', 'kepala_bentuk', 'gigi_palsu', 'fontanel', 'telinga', 'hidung', 'sclera_mata', 'konjungtiva_mata', 'mulut', 'kepala_leher_terpasang_alat', 'respirasi_suara_napas', 'respirasi_pola_napas', 'respirasi_napas_cuping', 'respirasi_otot_bantu', 'respirasi_terpasang_alat', 'kardiovaskular_jantung', 'kardiovaskular_ictus', 'kardiovasular_jvp', 'bentuk_payudara', 'puting_susu', 'areola_mammae', 'pengeluaran_asi', 'abdomen_bekas_operasi', 'palpasi_atas', 'palpasi_samping', 'palpasi_bawah', 'auskultasi_nilai_djj', 'auskultasi_status_djj', 'perkusi_refleks_patela_kanan', 'perkusi_refleks_patela_kiri', 'gastro_mual', 'gastro_muntah', 'gastro_acites', 'gastro_bising_usus', 'gastro_nyeri_tekan', 'gastro_massa_abdomen', 'gastro_nyeri_lepas', 'gastro_pembesaran_hepar', 'gastro_pembesaran_limpa', 'gastro_terpasang_alat', 'persepsi_pendengaran', 'persepsi_penglihatan', 'persepsi_penghiduan', 'neurologi_keluhan', 'neurologi_reflek_fisiologis', 'neurologi_reflek_patologis', 'eleminasi_bab', 'eliminasi_bak', 'genetalia_kelainan', 'genetalia_edema', 'genetalia_simetris', 'genetalia_secret', 'extremitas_edema', 'extremitas_fraktur', 'extremitas_amputasi', 'extremitas_parase', 'extremitas_legi', 'extremitas_defornitas', 'extremitas_tumor', 'gangguan_pertumbuhan', 'gangguan_perkembangan', 'hambatan_dalam_pembelajaran', 'dibutuhkan_penerjamah', 'bahasa_isyarat', 'kebutuhan_edukasi', 'perencanaan_pasien_pulang', 'riwayat_perkawinan_lama_kawin_satuan', 'riwayat_haid_haid', 'riwayat_haid_kelainan_haid', 'riwayat_haid_fluor_albus', 'riwayat_haid_hpht', 'riwayat_haid_perkiraan_partus', 'rhamil_tempat_melahirkan', 'rhamil_masalah_selama_hamil', 'rhamil_tanda_bahaya', 'rpersalinan_tempat_melahirkan', 'rpersalinan_penolong_lahiran', 'rpersalinan_jenis_persalinan', 'rpersalinan_keadaan_kpd', 'rpersalinan_keadaan_spontan', 'rpersalinan_keadaan_dipecahkan', 'rpersalinan_warna_air_ketuban', 'rpersalinan_lama_persalinan_kala1_satuan', 'rpersalinan_lama_persalinan_kala2_satuan', 'rpersalinan_lama_persalinan_kala3_satuan', 'rpersalinan_komplikasi_persalinan', 'rpersalinan_keadaan_perineum', 'rpersalinan_bayi_tanggal', 'rpersalinan_bayi_jk', 'rpersalinan_bayi_anus', 'rpersalinan_bayi_cacat_bawaan', 'rpersalinan_bayi_masalah', 'rkesehatan_reproduksi', 'rkb_pernah_kb', 'rkb_metode_kb', 'rkb_lama_kb_satuan', 'rkb_komplikasi_kb', 'hal_hal_lain', 'kesimpulan', 'penatalaksanaan', 'tanggal_batal', 'tanggal_final', 'created_at', 'updated_at', 'log_data'], 'safe'],
            [['imt'], 'number'],
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
        $query = AsesmenAwalKebidanan::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'layanan_id' => $this->layanan_id,
            'perawat_id' => $this->perawat_id,
            'gcs_e' => $this->gcs_e,
            'gcs_m' => $this->gcs_m,
            'gcs_v' => $this->gcs_v,
            'suhu' => $this->suhu,
            'sato2' => $this->sato2,
            'tinggi_badan' => $this->tinggi_badan,
            'berat_badan' => $this->berat_badan,
            'imt' => $this->imt,
            'lila' => $this->lila,
            'berat_badan_sebelum' => $this->berat_badan_sebelum,
            'skor_penurunan_bb' => $this->skor_penurunan_bb,
            'kepala_lk' => $this->kepala_lk,
            'palpasi_tbj' => $this->palpasi_tbj,
            'riwayat_perkawinan_ke' => $this->riwayat_perkawinan_ke,
            'riwayat_perkawinan_usia_kawin_thn' => $this->riwayat_perkawinan_usia_kawin_thn,
            'riwayat_perkawinan_lama_kawin' => $this->riwayat_perkawinan_lama_kawin,
            'riwayat_haid_menarche_umur_thn' => $this->riwayat_haid_menarche_umur_thn,
            'riwayat_haid_siklus_haid_hari' => $this->riwayat_haid_siklus_haid_hari,
            'riwayat_haid_hpht' => $this->riwayat_haid_hpht,
            'riwayat_haid_perkiraan_partus' => $this->riwayat_haid_perkiraan_partus,
            'rhamil_g' => $this->rhamil_g,
            'rhamil_p' => $this->rhamil_p,
            'rhamil_a' => $this->rhamil_a,
            'rhamil_h' => $this->rhamil_h,
            'rhamil_usia_kehamilan_pemeriksaan_awal_minggu' => $this->rhamil_usia_kehamilan_pemeriksaan_awal_minggu,
            'rhamil_pemeriksaan_ke' => $this->rhamil_pemeriksaan_ke,
            'rhamil_usia_kehamilan_hpht_minggu' => $this->rhamil_usia_kehamilan_hpht_minggu,
            'rpersalinan_lama_persalinan_kala1' => $this->rpersalinan_lama_persalinan_kala1,
            'rpersalinan_lama_persalinan_kala2' => $this->rpersalinan_lama_persalinan_kala2,
            'rpersalinan_lama_persalinan_kala3' => $this->rpersalinan_lama_persalinan_kala3,
            'rpersalinan_bayi_tanggal' => $this->rpersalinan_bayi_tanggal,
            'rpersalinan_bayi_bb_gram' => $this->rpersalinan_bayi_bb_gram,
            'rpersalinan_bayi_pb_cm' => $this->rpersalinan_bayi_pb_cm,
            'rpersalinan_bayi_masa_gestasi_minggu' => $this->rpersalinan_bayi_masa_gestasi_minggu,
            'rkb_lama_kb' => $this->rkb_lama_kb,
            'batal' => $this->batal,
            'tanggal_batal' => $this->tanggal_batal,
            'draf' => $this->draf,
            'tanggal_final' => $this->tanggal_final,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
            'is_deleted' => $this->is_deleted,
        ]);

        $query->andFilterWhere(['ilike', 'anamnesis_sumber', $this->anamnesis_sumber])
            ->andFilterWhere(['ilike', 'anamnesis_keluhan', $this->anamnesis_keluhan])
            ->andFilterWhere(['ilike', 'riwayat_penyakit_sekarang', $this->riwayat_penyakit_sekarang])
            ->andFilterWhere(['ilike', 'riwayat_penyakit_dahulu', $this->riwayat_penyakit_dahulu])
            ->andFilterWhere(['ilike', 'riwayat_operasi', $this->riwayat_operasi])
            ->andFilterWhere(['ilike', 'riwayat_pengobatan_tb', $this->riwayat_pengobatan_tb])
            ->andFilterWhere(['ilike', 'riwayat_pengobatan_lain', $this->riwayat_pengobatan_lain])
            ->andFilterWhere(['ilike', 'riwayat_penyakit_keluarga', $this->riwayat_penyakit_keluarga])
            ->andFilterWhere(['ilike', 'alergi', $this->alergi])
            ->andFilterWhere(['ilike', 'status_sosial', $this->status_sosial])
            ->andFilterWhere(['ilike', 'ekonomi', $this->ekonomi])
            ->andFilterWhere(['ilike', 'imunisasi', $this->imunisasi])
            ->andFilterWhere(['ilike', 'status_psikologi', $this->status_psikologi])
            ->andFilterWhere(['ilike', 'status_mental', $this->status_mental])
            ->andFilterWhere(['ilike', 'riwayat_perilaku_kekerasan', $this->riwayat_perilaku_kekerasan])
            ->andFilterWhere(['ilike', 'ketergantungan_obat', $this->ketergantungan_obat])
            ->andFilterWhere(['ilike', 'ketergantungan_alkohol', $this->ketergantungan_alkohol])
            ->andFilterWhere(['ilike', 'permintaan_informasi', $this->permintaan_informasi])
            ->andFilterWhere(['ilike', 'tingkat_kesadaran', $this->tingkat_kesadaran])
            ->andFilterWhere(['ilike', 'nadi', $this->nadi])
            ->andFilterWhere(['ilike', 'darah', $this->darah])
            ->andFilterWhere(['ilike', 'pernapasan', $this->pernapasan])
            ->andFilterWhere(['ilike', 'sikap_tubuh', $this->sikap_tubuh])
            ->andFilterWhere(['ilike', 'kulit_warna', $this->kulit_warna])
            ->andFilterWhere(['ilike', 'kulit_sianosis', $this->kulit_sianosis])
            ->andFilterWhere(['ilike', 'kulit_kemerahan', $this->kulit_kemerahan])
            ->andFilterWhere(['ilike', 'kulit_dekubitus', $this->kulit_dekubitus])
            ->andFilterWhere(['ilike', 'kulit_turgor_kulit', $this->kulit_turgor_kulit])
            ->andFilterWhere(['ilike', 'kulit_tumor', $this->kulit_tumor])
            ->andFilterWhere(['ilike', 'kulit_luka_bakar', $this->kulit_luka_bakar])
            ->andFilterWhere(['ilike', 'kulit_luka_tusuk', $this->kulit_luka_tusuk])
            ->andFilterWhere(['ilike', 'kulit_luka_memar', $this->kulit_luka_memar])
            ->andFilterWhere(['ilike', 'kulit_luka_robek', $this->kulit_luka_robek])
            ->andFilterWhere(['ilike', 'kepala_rambut', $this->kepala_rambut])
            ->andFilterWhere(['ilike', 'kepala_bentuk', $this->kepala_bentuk])
            ->andFilterWhere(['ilike', 'gigi_palsu', $this->gigi_palsu])
            ->andFilterWhere(['ilike', 'fontanel', $this->fontanel])
            ->andFilterWhere(['ilike', 'telinga', $this->telinga])
            ->andFilterWhere(['ilike', 'hidung', $this->hidung])
            ->andFilterWhere(['ilike', 'sclera_mata', $this->sclera_mata])
            ->andFilterWhere(['ilike', 'konjungtiva_mata', $this->konjungtiva_mata])
            ->andFilterWhere(['ilike', 'mulut', $this->mulut])
            ->andFilterWhere(['ilike', 'kepala_leher_terpasang_alat', $this->kepala_leher_terpasang_alat])
            ->andFilterWhere(['ilike', 'respirasi_suara_napas', $this->respirasi_suara_napas])
            ->andFilterWhere(['ilike', 'respirasi_pola_napas', $this->respirasi_pola_napas])
            ->andFilterWhere(['ilike', 'respirasi_napas_cuping', $this->respirasi_napas_cuping])
            ->andFilterWhere(['ilike', 'respirasi_otot_bantu', $this->respirasi_otot_bantu])
            ->andFilterWhere(['ilike', 'respirasi_terpasang_alat', $this->respirasi_terpasang_alat])
            ->andFilterWhere(['ilike', 'kardiovaskular_jantung', $this->kardiovaskular_jantung])
            ->andFilterWhere(['ilike', 'kardiovaskular_ictus', $this->kardiovaskular_ictus])
            ->andFilterWhere(['ilike', 'kardiovasular_jvp', $this->kardiovasular_jvp])
            ->andFilterWhere(['ilike', 'bentuk_payudara', $this->bentuk_payudara])
            ->andFilterWhere(['ilike', 'puting_susu', $this->puting_susu])
            ->andFilterWhere(['ilike', 'areola_mammae', $this->areola_mammae])
            ->andFilterWhere(['ilike', 'pengeluaran_asi', $this->pengeluaran_asi])
            ->andFilterWhere(['ilike', 'abdomen_bekas_operasi', $this->abdomen_bekas_operasi])
            ->andFilterWhere(['ilike', 'palpasi_atas', $this->palpasi_atas])
            ->andFilterWhere(['ilike', 'palpasi_samping', $this->palpasi_samping])
            ->andFilterWhere(['ilike', 'palpasi_bawah', $this->palpasi_bawah])
            ->andFilterWhere(['ilike', 'auskultasi_nilai_djj', $this->auskultasi_nilai_djj])
            ->andFilterWhere(['ilike', 'auskultasi_status_djj', $this->auskultasi_status_djj])
            ->andFilterWhere(['ilike', 'perkusi_refleks_patela_kanan', $this->perkusi_refleks_patela_kanan])
            ->andFilterWhere(['ilike', 'perkusi_refleks_patela_kiri', $this->perkusi_refleks_patela_kiri])
            ->andFilterWhere(['ilike', 'gastro_mual', $this->gastro_mual])
            ->andFilterWhere(['ilike', 'gastro_muntah', $this->gastro_muntah])
            ->andFilterWhere(['ilike', 'gastro_acites', $this->gastro_acites])
            ->andFilterWhere(['ilike', 'gastro_bising_usus', $this->gastro_bising_usus])
            ->andFilterWhere(['ilike', 'gastro_nyeri_tekan', $this->gastro_nyeri_tekan])
            ->andFilterWhere(['ilike', 'gastro_massa_abdomen', $this->gastro_massa_abdomen])
            ->andFilterWhere(['ilike', 'gastro_nyeri_lepas', $this->gastro_nyeri_lepas])
            ->andFilterWhere(['ilike', 'gastro_pembesaran_hepar', $this->gastro_pembesaran_hepar])
            ->andFilterWhere(['ilike', 'gastro_pembesaran_limpa', $this->gastro_pembesaran_limpa])
            ->andFilterWhere(['ilike', 'gastro_terpasang_alat', $this->gastro_terpasang_alat])
            ->andFilterWhere(['ilike', 'persepsi_pendengaran', $this->persepsi_pendengaran])
            ->andFilterWhere(['ilike', 'persepsi_penglihatan', $this->persepsi_penglihatan])
            ->andFilterWhere(['ilike', 'persepsi_penghiduan', $this->persepsi_penghiduan])
            ->andFilterWhere(['ilike', 'neurologi_keluhan', $this->neurologi_keluhan])
            ->andFilterWhere(['ilike', 'neurologi_reflek_fisiologis', $this->neurologi_reflek_fisiologis])
            ->andFilterWhere(['ilike', 'neurologi_reflek_patologis', $this->neurologi_reflek_patologis])
            ->andFilterWhere(['ilike', 'eleminasi_bab', $this->eleminasi_bab])
            ->andFilterWhere(['ilike', 'eliminasi_bak', $this->eliminasi_bak])
            ->andFilterWhere(['ilike', 'genetalia_kelainan', $this->genetalia_kelainan])
            ->andFilterWhere(['ilike', 'genetalia_edema', $this->genetalia_edema])
            ->andFilterWhere(['ilike', 'genetalia_simetris', $this->genetalia_simetris])
            ->andFilterWhere(['ilike', 'genetalia_secret', $this->genetalia_secret])
            ->andFilterWhere(['ilike', 'extremitas_edema', $this->extremitas_edema])
            ->andFilterWhere(['ilike', 'extremitas_fraktur', $this->extremitas_fraktur])
            ->andFilterWhere(['ilike', 'extremitas_amputasi', $this->extremitas_amputasi])
            ->andFilterWhere(['ilike', 'extremitas_parase', $this->extremitas_parase])
            ->andFilterWhere(['ilike', 'extremitas_legi', $this->extremitas_legi])
            ->andFilterWhere(['ilike', 'extremitas_defornitas', $this->extremitas_defornitas])
            ->andFilterWhere(['ilike', 'extremitas_tumor', $this->extremitas_tumor])
            ->andFilterWhere(['ilike', 'gangguan_pertumbuhan', $this->gangguan_pertumbuhan])
            ->andFilterWhere(['ilike', 'gangguan_perkembangan', $this->gangguan_perkembangan])
            ->andFilterWhere(['ilike', 'hambatan_dalam_pembelajaran', $this->hambatan_dalam_pembelajaran])
            ->andFilterWhere(['ilike', 'dibutuhkan_penerjamah', $this->dibutuhkan_penerjamah])
            ->andFilterWhere(['ilike', 'bahasa_isyarat', $this->bahasa_isyarat])
            ->andFilterWhere(['ilike', 'kebutuhan_edukasi', $this->kebutuhan_edukasi])
            ->andFilterWhere(['ilike', 'perencanaan_pasien_pulang', $this->perencanaan_pasien_pulang])
            ->andFilterWhere(['ilike', 'riwayat_perkawinan_lama_kawin_satuan', $this->riwayat_perkawinan_lama_kawin_satuan])
            ->andFilterWhere(['ilike', 'riwayat_haid_haid', $this->riwayat_haid_haid])
            ->andFilterWhere(['ilike', 'riwayat_haid_kelainan_haid', $this->riwayat_haid_kelainan_haid])
            ->andFilterWhere(['ilike', 'riwayat_haid_fluor_albus', $this->riwayat_haid_fluor_albus])
            ->andFilterWhere(['ilike', 'rhamil_tempat_melahirkan', $this->rhamil_tempat_melahirkan])
            ->andFilterWhere(['ilike', 'rhamil_masalah_selama_hamil', $this->rhamil_masalah_selama_hamil])
            ->andFilterWhere(['ilike', 'rhamil_tanda_bahaya', $this->rhamil_tanda_bahaya])
            ->andFilterWhere(['ilike', 'rpersalinan_tempat_melahirkan', $this->rpersalinan_tempat_melahirkan])
            ->andFilterWhere(['ilike', 'rpersalinan_penolong_lahiran', $this->rpersalinan_penolong_lahiran])
            ->andFilterWhere(['ilike', 'rpersalinan_jenis_persalinan', $this->rpersalinan_jenis_persalinan])
            ->andFilterWhere(['ilike', 'rpersalinan_keadaan_kpd', $this->rpersalinan_keadaan_kpd])
            ->andFilterWhere(['ilike', 'rpersalinan_keadaan_spontan', $this->rpersalinan_keadaan_spontan])
            ->andFilterWhere(['ilike', 'rpersalinan_keadaan_dipecahkan', $this->rpersalinan_keadaan_dipecahkan])
            ->andFilterWhere(['ilike', 'rpersalinan_warna_air_ketuban', $this->rpersalinan_warna_air_ketuban])
            ->andFilterWhere(['ilike', 'rpersalinan_lama_persalinan_kala1_satuan', $this->rpersalinan_lama_persalinan_kala1_satuan])
            ->andFilterWhere(['ilike', 'rpersalinan_lama_persalinan_kala2_satuan', $this->rpersalinan_lama_persalinan_kala2_satuan])
            ->andFilterWhere(['ilike', 'rpersalinan_lama_persalinan_kala3_satuan', $this->rpersalinan_lama_persalinan_kala3_satuan])
            ->andFilterWhere(['ilike', 'rpersalinan_komplikasi_persalinan', $this->rpersalinan_komplikasi_persalinan])
            ->andFilterWhere(['ilike', 'rpersalinan_keadaan_perineum', $this->rpersalinan_keadaan_perineum])
            ->andFilterWhere(['ilike', 'rpersalinan_bayi_jk', $this->rpersalinan_bayi_jk])
            ->andFilterWhere(['ilike', 'rpersalinan_bayi_anus', $this->rpersalinan_bayi_anus])
            ->andFilterWhere(['ilike', 'rpersalinan_bayi_cacat_bawaan', $this->rpersalinan_bayi_cacat_bawaan])
            ->andFilterWhere(['ilike', 'rpersalinan_bayi_masalah', $this->rpersalinan_bayi_masalah])
            ->andFilterWhere(['ilike', 'rkesehatan_reproduksi', $this->rkesehatan_reproduksi])
            ->andFilterWhere(['ilike', 'rkb_pernah_kb', $this->rkb_pernah_kb])
            ->andFilterWhere(['ilike', 'rkb_metode_kb', $this->rkb_metode_kb])
            ->andFilterWhere(['ilike', 'rkb_lama_kb_satuan', $this->rkb_lama_kb_satuan])
            ->andFilterWhere(['ilike', 'rkb_komplikasi_kb', $this->rkb_komplikasi_kb])
            ->andFilterWhere(['ilike', 'hal_hal_lain', $this->hal_hal_lain])
            ->andFilterWhere(['ilike', 'kesimpulan', $this->kesimpulan])
            ->andFilterWhere(['ilike', 'penatalaksanaan', $this->penatalaksanaan])
            ->andFilterWhere(['ilike', 'log_data', $this->log_data]);

        return $dataProvider;
    }
}
