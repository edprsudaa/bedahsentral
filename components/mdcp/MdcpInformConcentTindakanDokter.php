<?php

namespace app\components\mdcp;

use Yii;
use app\components\MakeResponse;
use app\models\medis\DocClinicalPasien;
use app\models\medis\MasterDocClinical;
use app\models\bedahsentral\InformConcentTindakanDokter;
use app\models\bedahsentral\Log;
use yii\helpers\ArrayHelper;

class MdcpInformConcentTindakanDokter
{
  const kode = 'DM_0000107';
  const data_type = DocClinicalPasien::data_type_html_base64;
  public static function _get()
  {
    // $modelMdcp=DocClinicalPasien::findOne($model->incon_mdcp_id);
    // //DECRYPT DATA
    // //DATA LZTRING DECOMMPRESS
    // $data=base64_decode($data);
    // return $data;
  }

  public static function _set($id, $layanan = array(), $registrasi = array(), $data, $batal = false)
  {
    $midc_id = Yii::$app->params['setting']['mapping_doc_item_clinical'][self::kode];
    //ENCRIPT DATA
    //DATA LZTRING COMMPRESS
    $data = base64_encode($data);
    $model = InformConcentTindakanDokter::find()->where(['incon_id' => $id])->one();
    if ($model->incon_mdcp_id) {
      //1.update mdcp
      $modelMdcp = DocClinicalPasien::findOne($model->incon_mdcp_id);
      $mdcp_data_before = $modelMdcp->mdcp_data;
      if ($modelMdcp !== null) {
        $modelMdcp->mdcp_data_type = self::data_type;
        $modelMdcp->mdcp_data = $data;
        if ($batal) {
          $modelMdcp->mdcp_batal = 1;
          $modelMdcp->mdcp_tgl_batal = date('Y-m-d H:i:s');
        }
        if ($modelMdcp->save(false)) {
          //2.create log
          $modelLog = new Log();
          $modelLog->scenario = "mdcp";
          $modelLog->mlog_mdcp_id = $modelMdcp->mdcp_id;
          $modelLog->mlog_type = Log::TYPE_UPDATE;
          $modelLog->mlog_deskripsi = $modelMdcp->mdcp_midc_nama;
          $modelLog->mlog_data_type = $modelMdcp->mdcp_data_type;
          $modelLog->mlog_data_before = $mdcp_data_before;
          $modelLog->mlog_data_after = $modelMdcp->mdcp_data;
          if ($modelLog->save(false)) {
            return MakeResponse::createNotJson(true, 'Doc Clinical Pasien : ' . $modelMdcp->mdcp_midc_nama . ' berhasil diubah');
          }
        }
        return MakeResponse::createNotJson(false, 'Doc Clinical Pasien : ' . $modelMdcp->mdcp_midc_nama . ' gagal diubah');
      }
    } else {
      //1.create mdcp
      $modelMdcp = new DocClinicalPasien();
      $midc = MasterDocClinical::find()->where(['midc_id' => $midc_id])->asArray()->one();
      $modelMdcp->mdcp_ps_kode = $layanan['mdcp_ps_kode'];
      $modelMdcp->mdcp_ps_nama = $layanan['mdcp_ps_nama'];
      $modelMdcp->mdcp_ps_tempat_lahir = $layanan['mdcp_ps_tempat_lahir'];
      $modelMdcp->mdcp_ps_tgl_lahir = $layanan['mdcp_ps_tgl_lahir'];
      $modelMdcp->mdcp_ps_gender = $layanan['mdcp_ps_gender'];
      $modelMdcp->mdcp_ps_umur = $layanan['mdcp_ps_umur'];
      $modelMdcp->mdcp_reg_kode = $layanan['mdcp_reg_kode'];
      $modelMdcp->mdcp_reg_tgl = $layanan['mdcp_reg_tgl'];
      $modelMdcp->mdcp_pl_id = $layanan['mdcp_pl_id'];
      $modelMdcp->mdcp_pl_tgl = $layanan['mdcp_pl_tgl'];
      $modelMdcp->mdcp_unt_id = $layanan['mdcp_unt_id'];
      $modelMdcp->mdcp_unt_nama = $layanan['mdcp_unt_nama'];
      $modelMdcp->mdcp_midc_id = $midc['midc_id'];
      $modelMdcp->mdcp_midc_nama = $midc['midc_nama'];
      $modelMdcp->mdcp_data_type = self::data_type;
      $modelMdcp->mdcp_data = $data;
      if ($modelMdcp->save(false)) {
        //2.update reg_mdcp_id_dpjp
        $model->incon_mdcp_id = $modelMdcp->mdcp_id;
        if ($model->save(false)) {
          //3.create log
          $modelLog = new Log();
          $modelLog->scenario = "mdcp";
          $modelLog->mlog_mdcp_id = $modelMdcp->mdcp_id;
          $modelLog->mlog_type = Log::TYPE_CREATE;
          $modelLog->mlog_deskripsi = $modelMdcp->mdcp_midc_nama;
          $modelLog->mlog_data_type = $modelMdcp->mdcp_data_type;
          $modelLog->mlog_data_before = null;
          $modelLog->mlog_data_after = $modelMdcp->mdcp_data;
          if ($modelLog->save(false)) {
            return MakeResponse::createNotJson(true, 'Doc Clinical Pasien : ' . $modelMdcp->mdcp_midc_nama . ' berhasil dibuat');
          }
        }
      }
      return MakeResponse::createNotJson(false, 'Doc Clinical Pasien : ' . $modelMdcp->mdcp_midc_nama . ' gagal dibuat');
    }
  }
}
