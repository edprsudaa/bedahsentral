<?php

namespace app\components;

use Yii;
use app\models\pegawai\DmUnitPenempatan;
use app\models\pendaftaran\KelompokUnitLayanan;
use app\models\pegawai\TbPegawai;
use app\models\AkunAknUser;
use app\models\pegawai\TbRiwayatStr;
use app\models\pegawai\TbRiwayatSipp;
use app\models\pegawai\TbRiwayatSpklinis;
use app\models\pegawai\TbRiwayatPenempatan;
use app\models\pegawai\TbUnitPltPlh;
use app\models\pendaftaran\Layanan;
use app\models\medis\Pjp;
use app\models\medis\PjpRi;
use app\models\Sesi;
use yii\helpers\ArrayHelper;
use app\components\HelperGeneralClass;
use app\components\Api;
//new code
use app\models\medis\Cppt;

class HelperSpesial
{
  const LEVEL_ROOT = 'ROOT';
  const LEVEL_ADMIN = 'ADMIN';
  const LEVEL_PERAWAT = 'PERAWAT';
  const LEVEL_BIDAN = 'BIDAN';
  const LEVEL_DOKTER = 'DOKTER';
  const LEVEL_KETEKNISIAN_MEDIS = 'KETEKNISIAN_MEDIS';
  const LEVEL_ADM = 'ADM';

  const SDM_RUMPUN_MEDIS = '1';
  const SDM_RUMPUN_PERAWAT = '3';
  const SDM_RUMPUN_BIDAN = '4';
  const SDM_RUMPUN_KETEKNISIAN_MEDIS = '10';
  public static function getDataPegawaiByNip($id)
  {
    return TbPegawai::find()->where(['id_nip_nrp' => $id])->one();
  }
  public static function getDataPegawaiByUserID($id)
  {
    return self::getNamaPegawai(AkunAknUser::find()->joinWith(['pegawai'])->where([AkunAknUser::tableName() . '.userid' => $id])->one()->pegawai);
  }
  public static function getLogLogin($id)
  {
    return Sesi::find()->where(['ida' => $id])->orderBy(['tgb' => SORT_DESC])->limit(3)->all();
  }
  public static function getNamaPegawaiLogin()
  {
    return self::getUserLogin()['nama'];
  }
  public static function getNamaPegawai($pegawai)
  {
    return ($pegawai->gelar_sarjana_depan ? $pegawai->gelar_sarjana_depan . ' ' : null) . $pegawai->nama_lengkap . ($pegawai->gelar_sarjana_belakang ? ', ' . $pegawai->gelar_sarjana_belakang : null);
  }
  public static function getNamaPegawaiArray($pegawai)
  {
    //params array
    return ($pegawai['gelar_sarjana_depan'] ? $pegawai['gelar_sarjana_depan'] . ' ' : null) . $pegawai['nama_lengkap'] . ($pegawai['gelar_sarjana_belakang'] ? ', ' . $pegawai['gelar_sarjana_belakang'] : null);
  }
  // =====BY FIKRI======
  // public static function getListPerawat($original=true,$list=false)
  // {
  //     $result=TbPegawai::find()->select([TbPegawai::tableName().'.id_nip_nrp','pegawai_id',new \yii\db\Expression("CONCAT(".TbPegawai::tableName().".id_nip_nrp,' | ',gelar_sarjana_depan, ' ',nama_lengkap,' ',gelar_sarjana_belakang) as nama")])->innerjoinWith([
  //         'riwayatStr',
  //         'riwayatSipp',
  //         'riwayatSpklinis',
  //         'riwayatPenempatan'=>function($q){
  //             $q->where([TbRiwayatPenempatan::tableName().'.sdm_rumpun'=>self::SDM_RUMPUN_PERAWAT])->orderBy([TbRiwayatPenempatan::tableName().'.tanggal'=>SORT_DESC])->limit(1);
  //         }
  //     ])->where(['>=',TbRiwayatStr::tableName().'.tanggal_berlaku',date('Y-m-d')])
  //     ->andWhere(['>=',TbRiwayatSipp::tableName().'.tanggal_berlaku',date('Y-m-d')])
  //     ->andWhere(['>=',TbRiwayatSpklinis::tableName().'.tanggal_berlaku',date('Y-m-d')])
  //     ->active()->asArray()->all();
  //     if($original){
  //         return $result;
  //     }else{
  //         if($list){
  //             return ArrayHelper::map($result, 'pegawai_id', 'nama');
  //         }else{
  //             return ArrayHelper::getColumn($result, 'pegawai_id');
  //         }
  //     }
  // }
  // public static function getListBidan($original=true,$list=false)
  // {
  //     $result=TbPegawai::find()->select([TbPegawai::tableName().'.id_nip_nrp','pegawai_id',new \yii\db\Expression("CONCAT(".TbPegawai::tableName().".id_nip_nrp,' | ',gelar_sarjana_depan, ' ',nama_lengkap,' ',gelar_sarjana_belakang) as nama")])->innerjoinWith([
  //         'riwayatStr',
  //         'riwayatSipp',
  //         'riwayatSpklinis',
  //         'riwayatPenempatan'=>function($q){
  //             $q->where([TbRiwayatPenempatan::tableName().'.sdm_rumpun'=>self::SDM_RUMPUN_BIDAN])->orderBy([TbRiwayatPenempatan::tableName().'.tanggal'=>SORT_DESC])->limit(1);
  //         }
  //     ])->where(['>=',TbRiwayatStr::tableName().'.tanggal_berlaku',date('Y-m-d')])
  //     ->andWhere(['>=',TbRiwayatSipp::tableName().'.tanggal_berlaku',date('Y-m-d')])
  //     ->andWhere(['>=',TbRiwayatSpklinis::tableName().'.tanggal_berlaku',date('Y-m-d')])
  //     ->active()->asArray()->all();
  //     if($original){
  //         return $result;
  //     }else{
  //         if($list){
  //             return ArrayHelper::map($result, 'pegawai_id', 'nama');
  //         }else{
  //             return ArrayHelper::getColumn($result, 'pegawai_id');
  //         }
  //     }
  // }
  // public static function getListDokter($original=true,$list=false)
  // {
  //     //bisa by tb_riwayat_penempatan where sdm_rumpun=1
  //     $result=TbPegawai::find()->select([TbPegawai::tableName().'.id_nip_nrp','pegawai_id',new \yii\db\Expression("CONCAT(".TbPegawai::tableName().".id_nip_nrp,' | ',gelar_sarjana_depan, ' ',nama_lengkap,' ',gelar_sarjana_belakang) as nama")])->innerjoinWith([
  //         'riwayatSipp',
  //         'riwayatSpklinis',
  //         'riwayatPenempatan'=>function($q){
  //             $q->where([TbRiwayatPenempatan::tableName().'.sdm_rumpun'=>self::SDM_RUMPUN_MEDIS])->orderBy([TbRiwayatPenempatan::tableName().'.tanggal'=>SORT_DESC])->limit(1);
  //         }
  //     ])
  //     ->where(['>=',TbRiwayatSipp::tableName().'.tanggal_berlaku',date('Y-m-d')])
  //     ->andWhere(['>=',TbRiwayatSpklinis::tableName().'.tanggal_berlaku',date('Y-m-d')])
  //     ->active()->asArray()->all();
  //     if($original){
  //         return $result;
  //     }else{
  //         if($list){
  //             return ArrayHelper::map($result, 'pegawai_id', 'nama');
  //         }else{
  //             return ArrayHelper::getColumn($result, 'pegawai_id');
  //         }
  //     }
  // }
  public static function getListPerawatBidan($original = true, $list = false)
  {
    $result = TbPegawai::find()->select([TbPegawai::tableName() . '.id_nip_nrp', 'pegawai_id', new \yii\db\Expression("CONCAT(" . TbPegawai::tableName() . ".id_nip_nrp,' | ',gelar_sarjana_depan, ' ',nama_lengkap,' ',gelar_sarjana_belakang) as nama")])->innerjoinWith([
      'riwayatPenempatan' => function ($q) {
        $q->where(['or', [TbRiwayatPenempatan::tableName() . '.sdm_rumpun' => self::SDM_RUMPUN_PERAWAT], [TbRiwayatPenempatan::tableName() . '.sdm_rumpun' => self::SDM_RUMPUN_BIDAN], [TbRiwayatPenempatan::tableName() . '.sdm_rumpun' => self::SDM_RUMPUN_KETEKNISIAN_MEDIS]])->orderBy([TbRiwayatPenempatan::tableName() . '.tanggal' => SORT_DESC])->limit(1);
      }
    ])
      ->active()->asArray()->all();
    if ($original) {
      return $result;
    } else {
      if ($list) {
        return ArrayHelper::map($result, 'pegawai_id', 'nama');
      } else {
        return ArrayHelper::getColumn($result, 'pegawai_id');
      }
    }
  }
  public static function getListPerawat($original = true, $list = false)
  {
    $result = TbPegawai::find()->select([TbPegawai::tableName() . '.id_nip_nrp', 'pegawai_id', new \yii\db\Expression("CONCAT(" . TbPegawai::tableName() . ".id_nip_nrp,' | ',gelar_sarjana_depan, ' ',nama_lengkap,' ',gelar_sarjana_belakang) as nama")])->innerjoinWith([
      'riwayatPenempatan' => function ($q) {
        $q->where([TbRiwayatPenempatan::tableName() . '.sdm_rumpun' => self::SDM_RUMPUN_PERAWAT])->orderBy([TbRiwayatPenempatan::tableName() . '.tanggal' => SORT_DESC])->limit(1);
      }
    ])
      ->active()->asArray()->all();
    if ($original) {
      return $result;
    } else {
      if ($list) {
        return ArrayHelper::map($result, 'pegawai_id', 'nama');
      } else {
        return ArrayHelper::getColumn($result, 'pegawai_id');
      }
    }
  }
  public static function getListBidan($original = true, $list = false)
  {
    $result = TbPegawai::find()->select([TbPegawai::tableName() . '.id_nip_nrp', 'pegawai_id', new \yii\db\Expression("CONCAT(" . TbPegawai::tableName() . ".id_nip_nrp,' | ',gelar_sarjana_depan, ' ',nama_lengkap,' ',gelar_sarjana_belakang) as nama")])->innerjoinWith([
      'riwayatPenempatan' => function ($q) {
        $q->where([TbRiwayatPenempatan::tableName() . '.sdm_rumpun' => self::SDM_RUMPUN_BIDAN])->orderBy([TbRiwayatPenempatan::tableName() . '.tanggal' => SORT_DESC])->limit(1);
      }
    ])
      ->active()->asArray()->all();
    if ($original) {
      return $result;
    } else {
      if ($list) {
        return ArrayHelper::map($result, 'pegawai_id', 'nama');
      } else {
        return ArrayHelper::getColumn($result, 'pegawai_id');
      }
    }
  }
  public static function getListDokter($original = true, $list = false)
  {
    //bisa by tb_riwayat_penempatan where sdm_rumpun=1
    $result = TbPegawai::find()->select([TbPegawai::tableName() . '.id_nip_nrp', 'pegawai_id', new \yii\db\Expression("CONCAT(" . TbPegawai::tableName() . ".id_nip_nrp,' | ',gelar_sarjana_depan, ' ',nama_lengkap,' ',gelar_sarjana_belakang) as nama")])->innerjoinWith([
      'riwayatPenempatan' => function ($q) {
        $q->where([TbRiwayatPenempatan::tableName() . '.sdm_rumpun' => self::SDM_RUMPUN_MEDIS])->orderBy([TbRiwayatPenempatan::tableName() . '.tanggal' => SORT_DESC])->active()->limit(1);
      }
    ])->active()->asArray()->all();
    if (!$result) {
      $result = TbPegawai::find()->select([TbPegawai::tableName() . '.id_nip_nrp', 'pegawai_id', new \yii\db\Expression("CONCAT(" . TbPegawai::tableName() . ".id_nip_nrp,' | ',gelar_sarjana_depan, ' ',nama_lengkap,' ',gelar_sarjana_belakang) as nama")])->innerjoinWith([
        'pltPlh' => function ($q) {
          $q->where([TbUnitPltPlh::tableName() . '.sdm_rumpun' => self::SDM_RUMPUN_MEDIS])->orderBy([TbUnitPltPlh::tableName() . '.tanggal_surat' => SORT_DESC])->active()->limit(1);
        }
      ])->active()->asArray()->all();
    }
    if ($original) {
      return $result;
    } else {
      if ($list) {
        return ArrayHelper::map($result, 'pegawai_id', 'nama');
      } else {
        return ArrayHelper::getColumn($result, 'pegawai_id');
      }
    }
  }
  public static function getListPjp($layanan, $original = true, $list = false)
  {
    //return pjp_id=>pegawai_nama
    $result = array();
    if ($layanan['jenis_layanan'] === Layanan::RI) {
      //RI
      $query = PjpRi::find()
        ->select([PjpRi::tableName() . '.id', PjpRi::tableName() . '.pegawai_id', TbPegawai::tableName() . '.id_nip_nrp', TbPegawai::tableName() . '.pegawai_id', new \yii\db\Expression("CONCAT(gelar_sarjana_depan, ' ',nama_lengkap,' ',gelar_sarjana_belakang) as nama")])
        ->joinWith([
          'pegawai'
        ]);
      $query->andWhere([PjpRi::tableName() . '.registrasi_kode' => $layanan['registrasi_kode']]);
      $result = $query->asArray()->all();
    } else {
      //RJ/IGD/PENUNJANG
      $query = Pjp::find()
        ->select([Pjp::tableName() . '.id', Pjp::tableName() . '.pegawai_id', TbPegawai::tableName() . '.id_nip_nrp', TbPegawai::tableName() . '.pegawai_id', new \yii\db\Expression("CONCAT(gelar_sarjana_depan, ' ',nama_lengkap,' ',gelar_sarjana_belakang) as nama")])
        ->joinWith([
          'pegawai'
        ]);
      $query->andWhere([Pjp::tableName() . '.layanan_id' => $layanan['id']]);
      $result = $query->asArray()->all();
    }
    if ($original) {
      return $result;
    } else {
      if ($list) {
        return ArrayHelper::map($result, 'id', 'nama');
      } else {
        return ArrayHelper::getColumn($result, 'id');
      }
    }
  }
  public static function getListPegawaiPjp($layanan, $original = true, $list = false)
  {
    //return pegawai_id=>pegawai_nama
    $result = array();
    if ($layanan['jenis_layanan'] === Layanan::RI) {
      //RI
      $query = PjpRi::find()
        ->select([PjpRi::tableName() . '.id', PjpRi::tableName() . '.pegawai_id', TbPegawai::tableName() . '.id_nip_nrp', TbPegawai::tableName() . '.pegawai_id', new \yii\db\Expression("CONCAT(gelar_sarjana_depan, ' ',nama_lengkap,' ',gelar_sarjana_belakang) as nama")])
        ->joinWith([
          'pegawai'
        ]);
      $query->andWhere([PjpRi::tableName() . '.registrasi_kode' => $layanan['registrasi_kode']]);
      $result = $query->asArray()->all();
    } else {
      //RJ/IGD/PENUNJANG
      $query = Pjp::find()
        ->select([Pjp::tableName() . '.id', Pjp::tableName() . '.pegawai_id', TbPegawai::tableName() . '.id_nip_nrp', TbPegawai::tableName() . '.pegawai_id', new \yii\db\Expression("CONCAT(gelar_sarjana_depan, ' ',nama_lengkap,' ',gelar_sarjana_belakang) as nama")])
        ->joinWith([
          'pegawai'
        ]);
      $query->andWhere([Pjp::tableName() . '.layanan_id' => $layanan['id']]);
      $result = $query->asArray()->all();
    }
    if ($original) {
      return $result;
    } else {
      if ($list) {
        return ArrayHelper::map($result, 'pegawai_id', 'nama');
      } else {
        return ArrayHelper::getColumn($result, 'pegawai_id');
      }
    }
  }
  public static function getUnitPenempatanPegawai($pegawai_id = null, $original = true, $list = false)
  {
    if (empty($pegawai_id)) {
      $pegawai_id = self::getUserLogin()['pegawai_id'];
    }
    $peg1 = TbRiwayatPenempatan::find()->select(['nama', 'unit_kerja as kode', 'unit_kerja', TbPegawai::tableName() . '.id_nip_nrp'])->joinWith(['unitKerja', 'pegawai' => function ($q) use ($pegawai_id) {
      $q->active()->andWhere([TbPegawai::tableName() . '.pegawai_id' => $pegawai_id]);
    }])->orderBy(['tanggal' => SORT_DESC])->asArray()->limit(1)->active()->all();
    // return $peg1;
    $peg2 = TbUnitPltPlh::find()->select(['nama', 'unit_kerja', TbPegawai::tableName() . '.id_nip_nrp'])->joinWith(['unitKerja', 'pegawai' => function ($q) use ($pegawai_id) {
      $q->active()->andWhere([TbPegawai::tableName() . '.pegawai_id' => $pegawai_id]);
    }])->orderBy(['tgl_berlaku_mulai' => SORT_DESC])->active()->asArray()->all();
    $all_penempatan = array();
    if ($peg1) {
      array_push($all_penempatan, ['nama' => $peg1[0]['nama'], 'unit_kerja' => $peg1[0]['unit_kerja']]);
    }
    foreach ($peg2 as $peg2) {
      array_push($all_penempatan, ['nama' => $peg2['nama'], 'unit_kerja' => $peg2['unit_kerja']]);
    }
    // $peg=$peg1+$peg2;
    // echo'<pre/>';print_r($all_penempatan);die();
    if ($original) {
      return $peg;
    } else {
      if ($list) {
        return ArrayHelper::map($all_penempatan, 'unit_kerja', 'nama');
      } else {
        return ArrayHelper::getColumn($all_penempatan, 'unit_kerja');
      }
    }
    // return (ArrayHelper::map($peg1, 'unit_kerja', 'nama')+ArrayHelper::map($peg2, 'unit_kerja', 'nama'));//merge array
  }
  public function getListIGDAksesPegawai($list = true, $user = [])
  {
    $unit = array();
    if (!$user) {
      $user = self::getUserLogin();
    }
    if (strtoupper($user['akses_level']) == self::LEVEL_ROOT || strtoupper($user['akses_level']) == self::LEVEL_ADMIN) {
      $unit = KelompokUnitLayanan::find()->select([KelompokUnitLayanan::tableName() . '.unit_id', DmUnitPenempatan::tableName() . '.kode', DmUnitPenempatan::tableName() . '.nama',])->joinWith(['unit'])->kel_igd()
        ->orderBy([DmUnitPenempatan::tableName() . '.nama' => SORT_ASC])
        ->asArray()
        ->all();
    } else if (strtoupper($user['akses_level']) == self::LEVEL_PERAWAT  || strtoupper($user['akses_level']) == self::LEVEL_BIDAN || strtoupper($user['akses_level']) == self::LEVEL_KETEKNISIAN_MEDIS) {
      $unit = KelompokUnitLayanan::find()->select([KelompokUnitLayanan::tableName() . '.unit_id', DmUnitPenempatan::tableName() . '.kode', DmUnitPenempatan::tableName() . '.nama',])->joinWith(['unit'])->kel_igd()
        ->andWhere(KelompokUnitLayanan::tableName() . '.unit_id IN (' . implode(',', self::getUnitPenempatanPegawai($user['pegawai_id'], false, false)) . ')')
        ->orderBy([DmUnitPenempatan::tableName() . '.nama' => SORT_ASC])
        ->asArray()
        ->all();
    }
    if ($list) {
      return ['pengguna' => $user, 'unit_akses' => ArrayHelper::map($unit, 'kode', 'nama')];
    } else {
      return ['pengguna' => $user, 'unit_akses' => ArrayHelper::getColumn($unit, 'kode')];
    }
  }
  public function getListRJAksesPegawai($list = true, $user = [])
  {
    $unit = array();
    if (!$user) {
      $user = self::getUserLogin();
    }
    if (strtoupper($user['akses_level']) == self::LEVEL_ROOT || strtoupper($user['akses_level']) == self::LEVEL_ADMIN) {
      $unit = KelompokUnitLayanan::find()->select([KelompokUnitLayanan::tableName() . '.unit_id', DmUnitPenempatan::tableName() . '.kode', DmUnitPenempatan::tableName() . '.nama',])->joinWith(['unit'])->kel_rj_all()
        ->orderBy([DmUnitPenempatan::tableName() . '.nama' => SORT_ASC])
        ->asArray()
        ->all();
    } else if (strtoupper($user['akses_level']) == self::LEVEL_PERAWAT || strtoupper($user['akses_level']) == self::LEVEL_BIDAN || strtoupper($user['akses_level']) == self::LEVEL_KETEKNISIAN_MEDIS) {
      $unit = KelompokUnitLayanan::find()->select([KelompokUnitLayanan::tableName() . '.unit_id', DmUnitPenempatan::tableName() . '.kode', DmUnitPenempatan::tableName() . '.nama',])->joinWith(['unit'])->kel_rj_all()
        ->andWhere(KelompokUnitLayanan::tableName() . '.unit_id IN (' . implode(',', self::getUnitPenempatanPegawai($user['pegawai_id'], false, false)) . ')')
        ->orderBy([DmUnitPenempatan::tableName() . '.nama' => SORT_ASC])
        ->asArray()
        ->all();
      // echo'<pre/>';print_r(self::getUnitPenempatanPegawai($user['pegawai_id'],false,false));die();
    }
    if ($list) {
      return ['pengguna' => $user, 'unit_akses' => ArrayHelper::map($unit, 'kode', 'nama')];
    } else {
      return ['pengguna' => $user, 'unit_akses' => ArrayHelper::getColumn($unit, 'kode')];
    }
  }
  public function getListRIAksesPegawai($list = true, $user = [])
  {
    $unit = array();
    if (!$user) {
      $user = self::getUserLogin();
    }
    if (strtoupper($user['akses_level']) == self::LEVEL_ROOT || strtoupper($user['akses_level']) == self::LEVEL_ADMIN) {
      $unit = KelompokUnitLayanan::find()->select([KelompokUnitLayanan::tableName() . '.unit_id', DmUnitPenempatan::tableName() . '.kode', DmUnitPenempatan::tableName() . '.nama',])->joinWith(['unit'])->kel_ri()
        ->orderBy([DmUnitPenempatan::tableName() . '.nama' => SORT_ASC])
        ->asArray()
        ->all();
    } else if (strtoupper($user['akses_level']) == self::LEVEL_PERAWAT  || strtoupper($user['akses_level']) == self::LEVEL_BIDAN || strtoupper($user['akses_level']) == self::LEVEL_KETEKNISIAN_MEDIS) {
      $unit = KelompokUnitLayanan::find()->select([KelompokUnitLayanan::tableName() . '.unit_id', DmUnitPenempatan::tableName() . '.kode', DmUnitPenempatan::tableName() . '.nama',])->joinWith(['unit'])->kel_ri()
        ->andWhere(KelompokUnitLayanan::tableName() . '.unit_id IN (' . implode(',', self::getUnitPenempatanPegawai($user['pegawai_id'], false, false)) . ')')
        ->orderBy([DmUnitPenempatan::tableName() . '.nama' => SORT_ASC])
        ->asArray()
        ->all();
    }
    //     $unit = self::getUnitPenempatanPegawai($user['pegawai_id'],true);
    if ($list) {
      return ['pengguna' => $user, 'unit_akses' => ArrayHelper::map($unit, 'kode', 'nama')];
    } else {
      return ['pengguna' => $user, 'unit_akses' => ArrayHelper::getColumn($unit, 'kode')];
    }
  }
  public function getListPenunjangAksesPegawai($list = true, $user = [])
  {
    $unit = array();
    if (!$user) {
      $user = self::getUserLogin();
    }
    if (strtoupper($user['akses_level']) == self::LEVEL_ROOT || strtoupper($user['akses_level']) == self::LEVEL_ADMIN) {
      $unit = KelompokUnitLayanan::find()->select([KelompokUnitLayanan::tableName() . '.unit_id', DmUnitPenempatan::tableName() . '.kode', DmUnitPenempatan::tableName() . '.nama',])->joinWith(['unit'])->kel_penunjang()
        ->orderBy([DmUnitPenempatan::tableName() . '.nama' => SORT_ASC])
        ->asArray()
        ->all();
    } else if (strtoupper($user['akses_level']) == self::LEVEL_PERAWAT  || strtoupper($user['akses_level']) == self::LEVEL_BIDAN) {
      $unit = KelompokUnitLayanan::find()->select([KelompokUnitLayanan::tableName() . '.unit_id', DmUnitPenempatan::tableName() . '.kode', DmUnitPenempatan::tableName() . '.nama',])->joinWith(['unit'])->kel_penunjang()
        ->andWhere(KelompokUnitLayanan::tableName() . '.unit_id IN (' . implode(',', self::getUnitPenempatanPegawai($user['pegawai_id'], false, false)) . ')')
        ->orderBy([DmUnitPenempatan::tableName() . '.nama' => SORT_ASC])
        ->asArray()
        ->all();
    }
    if ($list) {
      return ['pengguna' => $user, 'unit_akses' => ArrayHelper::map($unit, 'kode', 'nama')];
    } else {
      return ['pengguna' => $user, 'unit_akses' => ArrayHelper::getColumn($unit, 'kode')];
    }
  }
  public static function getListUnitLayanan($type, $original = true, $list = false)
  {
    $unit = array();
    if ($type == KelompokUnitLayanan::RJ) {
      $unit = KelompokUnitLayanan::find()->select([KelompokUnitLayanan::tableName() . '.unit_id', DmUnitPenempatan::tableName() . '.kode', DmUnitPenempatan::tableName() . '.nama',])->joinWith(['unit'])->kel_rj()
        ->orderBy([DmUnitPenempatan::tableName() . '.nama' => SORT_ASC])
        ->asArray()
        ->all();
    } else if ($type == KelompokUnitLayanan::RI) {
      $unit = KelompokUnitLayanan::find()->select([KelompokUnitLayanan::tableName() . '.unit_id', DmUnitPenempatan::tableName() . '.kode', DmUnitPenempatan::tableName() . '.nama',])->joinWith(['unit'])->kel_ri()
        ->orderBy([DmUnitPenempatan::tableName() . '.nama' => SORT_ASC])
        ->asArray()
        ->all();
    } else if ($type == KelompokUnitLayanan::IGD) {
      $unit = KelompokUnitLayanan::find()->select([KelompokUnitLayanan::tableName() . '.unit_id', DmUnitPenempatan::tableName() . '.kode', DmUnitPenempatan::tableName() . '.nama',])->joinWith(['unit'])->kel_igd()
        ->orderBy([DmUnitPenempatan::tableName() . '.nama' => SORT_ASC])
        ->asArray()
        ->all();
    } else if ($type == KelompokUnitLayanan::PENUNJANG) {
      $unit = KelompokUnitLayanan::find()->select([KelompokUnitLayanan::tableName() . '.unit_id', DmUnitPenempatan::tableName() . '.kode', DmUnitPenempatan::tableName() . '.nama',])->joinWith(['unit'])->kel_penunjang()
        ->orderBy([DmUnitPenempatan::tableName() . '.nama' => SORT_ASC])
        ->asArray()
        ->all();
    }
    if ($original) {
      return $unit;
    } else {
      if ($list) {
        return ArrayHelper::map($unit, 'unit_id', 'nama');
      } else {
        return ArrayHelper::getColumn($unit, 'unit_id');
      }
    }
  }
  public static function getUserLogin()
  {
    $login = Yii::$app->user->identity;
    $akun = $login->akun;
    $level = null;
    $pesannoakses = null;
    $akses = true;
    if (strtoupper($login->roles) == 'MEDIS') {
      if (in_array($login['idData'], self::getListDokter(false))) {
        $level = self::LEVEL_DOKTER;
      } else {
        $akses = false;
        // $pesannoakses='SIP / SP KLINIS TIDAK TERSEDIA/TIDAK BERLAKU';
        $pesannoakses = 'PEGAWAI BUKAN RUMPUN MEDIS';
      }
    } else if (strtoupper($login->roles) == 'KEPERAWATAN') {
      // if(in_array($login['idData'],self::getListPerawat(false))){
      if (in_array($login['idData'], self::getListPerawatBidan(false))) {
        $level = self::LEVEL_PERAWAT;
      } else {
        $akses = false;
        // $pesannoakses='STR / SIP/ SP KLINIS TIDAK TERSEDIA/TIDAK BERLAKU';
        $pesannoakses = 'PEGAWAI BUKAN RUMPUN KEPERAWATAN';
      }
    } else if (strtoupper($login->roles) == 'KEBIDANAN') {
      // if(in_array($login['idData'],self::getListBidan(false))){
      if (in_array($login['idData'], self::getListPerawatBidan(false))) {
        $level = self::LEVEL_BIDAN;
      } else {
        $akses = false;
        // $pesannoakses='STR / SIP/ SP KLINIS TIDAK TERSEDIA/TIDAK BERLAKU';
        $pesannoakses = 'PEGAWAI BUKAN RUMPUN KEBIDANAN';
      }
    } else if (strtoupper($login->roles) == 'ROOT' && in_array($akun->username, Yii::$app->params['other']['username_allow_root'])) {
      $level = self::LEVEL_ROOT;
    } else if (strtoupper($login->roles) == 'ROOT' && in_array($akun->username, Yii::$app->params['other']['username_allow_admin'])) {
      $level = self::LEVEL_ADMIN;
    } else if (strtoupper($login->roles) == 'NONMEDIS') {
      $level = self::LEVEL_ADM;
    }
    return [
      'akses' => $akses,
      'pesannoakses' => $pesannoakses,
      'user_id' => $login['id'],
      'username' => $akun->username,
      'pegawai_id' => $login['idData'],
      'nama' => self::getNamaPegawai($akun->pegawai),
      'akses_level' => $level
    ];
  }
  public static function isRoot($user = [])
  {
    if (!$user) {
      $user = self::getUserLogin();
    }
    if (strtoupper($user['akses_level']) === self::LEVEL_ROOT) {
      return $user;
    }
    return [];
  }
  public static function isAdmin()
  {
    if (!$user) {
      $user = self::getUserLogin($user = []);
    }
    if (strtoupper($user['akses_level']) === self::LEVEL_ADMIN) {
      return $user;
    }
    return [];
  }
  public static function isPerawat($user = [])
  {
    if (!$user) {
      $user = self::getUserLogin();
    }
    if (strtoupper($user['akses_level']) === self::LEVEL_PERAWAT) {
      return $user;
    }
    return [];
  }
  public static function isDokter($user = [])
  {
    if (!$user) {
      $user = self::getUserLogin();
    }
    if (strtoupper($user['akses_level']) === self::LEVEL_DOKTER) {
      return $user;
    }
    return [];
  }
  public static function isAdm($user = [])
  {
    if (!$user) {
      $user = self::getUserLogin();
    }
    if (strtoupper($user['akses_level']) === self::LEVEL_ADM) {
      return $user;
    }
    return [];
  }
  public static function getCheckPasien($id)
  {
    // $id => layanan_id
    // $layanan=array();
    if (!is_numeric($id)) {
      $id = HelperGeneralClass::validateData($id);
    }
    if (!$id) {
      return Api::writeResponse(false, 'Pasien Tidak Valid, Mohon Pilih Lagi');
    }
    $layanan = Layanan::find()->joinWith([
      'unit',
      'registrasi.pasien',
      'registrasi.debiturDetail',
      'registrasi.pjpRi.pegawai',
      'pjp.pegawai',
    ])->where([Layanan::tableName() . '.id' => $id])->asArray()->one();
    if (!$layanan) {
      return Api::writeResponse(false, 'Pasien Tidak Valid, Mohon Pilih Lagi');
    }
    return Api::writeResponse(true, null, $layanan);
  }
  public static function getHitungBiayaTindakan($data, $object = true)
  {
    if ($object) {
      return
        [
          'standar' => intval($data->js_adm) + intval($data->js_sarana) + intval($data->js_bhp) + intval($data->js_dokter_operator) + intval($data->js_dokter_lainya) + intval($data->js_dokter_anastesi) + intval($data->js_penata_anastesi) + intval($data->js_paramedis) + intval($data->js_lainya),
          'cyto' => intval($data->js_adm_cto) + intval($data->js_sarana_cto) + intval($data->js_bhp_cto) + intval($data->js_dokter_operator_cto) + intval($data->js_dokter_lainya_cto) + intval($data->js_dokter_anastesi_cto) + intval($data->js_penata_anastesi_cto) + intval($data->js_paramedis_cto) + intval($data->js_lainya_cto)
        ];
    } else {
      return
        [
          'standar' => intval($data['js_adm']) + intval($data['js_sarana']) + intval($data['js_bhp']) + intval($data['js_dokter_operator']) + intval($data['js_dokter_lainya']) + intval($data['js_dokter_anastesi']) + intval($data['js_penata_anastesi']) + intval($data['js_paramedis']) + intval($data['js_lainya']),
          'cyto' => intval($data['js_adm_cto']) + intval($data['js_sarana_cto']) + intval($data['js_bhp_cto']) + intval($data['js_dokter_operator_cto']) + intval($data['js_dokter_lainya_cto']) + intval($data['js_dokter_anastesi_cto']) + intval($data['js_penata_anastesi_cto']) + intval($data['js_paramedis_cto']) + intval($data['js_lainya_cto'])
        ];
    }
  }
  public static function isPjpDokterRi($layanan, $user)
  {
    if ($layanan['registrasi']['pjpRi']) {
      foreach ($layanan['registrasi']['pjpRi'] as $val) {
        if ($val['pegawai_id'] == $user['pegawai_id']) {
          return true;
          break;
        }
      }
    }
    return false;
  }
  public static function isPjpUtamaDokterRi($layanan, $user)
  {
    if ($layanan['registrasi']['pjpRi']) {
      foreach ($layanan['registrasi']['pjpRi'] as $val) {
        if ($val['pegawai_id'] == $user['pegawai_id'] && $val['status'] == PjpRi::DPJP) {
          return true;
          break;
        }
      }
    }
    return false;
  }
  public static function isPjpPendukungDokterRi($layanan, $user)
  {
    if ($layanan['registrasi']['pjpRi']) {
      foreach ($layanan['registrasi']['pjpRi'] as $val) {
        if ($val['pegawai_id'] == $user['pegawai_id'] && $val['status'] == PjpRi::DPJP_PENDUKUNG) {
          return true;
          break;
        }
      }
    }
    return false;
  }
  public static function isPjpDokterRjIgd($layanan, $user)
  {
    if ($layanan['pjp']) {
      foreach ($layanan['pjp'] as $val) {
        if ($val['pegawai_id'] == $user['pegawai_id']) {
          return true;
          break;
        }
      }
    }
    return false;
  }
  public static function isPjpUtamaDokterRjIgd($layanan, $user)
  {
    if ($layanan['pjp']) {
      foreach ($layanan['pjp'] as $val) {
        if ($val['pegawai_id'] == $user['pegawai_id'] && $val['status'] == Pjp::DPJP) {
          return true;
          break;
        }
      }
    }
    return false;
  }
  public static function isPjpPendukungDokterRjIgd($layanan, $user)
  {
    if ($layanan['pjp']) {
      foreach ($layanan['pjp'] as $val) {
        if ($val['pegawai_id'] == $user['pegawai_id'] && $val['status'] == Pjp::DPJP_PENDUKUNG) {
          return true;
          break;
        }
      }
    }
    return false;
  }
  public static function isPjpPerawatRi($layanan, $user)
  {
    return true;
    //sosialisasi 25/04/2022 gk dipake
    // if($layanan['registrasi']['pjpRi']){
    // foreach($layanan['registrasi']['pjpRi'] as $val){
    // if($val['pegawai_id']==$user['pegawai_id'] && ($val['status']==PjpRi::PPJP || $val['status']==PjpRi::BPJP)){
    // return true;
    // break;
    // }
    // }
    // }
    // return false;
  }
  public static function isPjpPerawatRjIgd($layanan, $user)
  {
    return true;
    //sosialisasi 25/04/2022 gk dipake
    // if($layanan['pjp']){
    // foreach($layanan['pjp'] as $val){
    // if($val['pegawai_id']==$user['pegawai_id'] && ($val['status']==Pjp::PPJP  || $val['status']==Pjp::BPJP)){
    // return true;
    // break;
    // }
    // }
    // }
    // return false;
  }
  //NEW CODE 08/09/2022
  public static function getListPpaJenis($original = true, $list = false)
  {
    $ppa_jenis = Cppt::$cppt_ppa_jenis;
    if ($original) {
      return $ppa_jenis;
    } else {
      if ($list) {
        $ppa_jenis_map = array();
        foreach ($ppa_jenis as $v) {
          $ppa_jenis_map[$v] = $v;
        }
        return $ppa_jenis_map;
      } else {
        return $ppa_jenis;
      }
    }
  }
  //END NEW CODE 08/09/2022
}
