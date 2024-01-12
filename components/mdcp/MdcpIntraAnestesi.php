<?php

namespace app\components\mdcp;

use Yii;
use app\components\MakeResponse;
use app\models\medis\DocClinicalPasien;
use app\models\medis\MasterDocClinical;
use app\models\bedahsentral\IntraAnestesi;
use app\models\bedahsentral\Log;
use yii\helpers\ArrayHelper;

class MdcpIntraAnestesi
{
  const kode = 'DM_0000112';
  const data_type = DocClinicalPasien::data_type_html_base64;
  public static function _get()
  {
    //$modelMdcp=DocClinicalPasien::findOne($model->mia_mdcp_id);
    //DECRYPT DATA
    //DATA LZTRING DECOMMPRESS
    // $data=base64_decode($data);
    // return $data;
  }

  public static function _set($id, $layanan = array(), $registrasi = array(), $data, $batal = false)
  {
    $midc_id = Yii::$app->params['setting']['mapping_doc_item_clinical'][self::kode];
    //ENCRIPT DATA
    //DATA LZTRING COMMPRESS
    $data = base64_encode($data);
    $model = IntraAnestesi::find()->where(['mia_id' => $id])->one();
    if ($model->mia_mdcp_id) {
      //1.update mdcp
      $modelMdcp = DocClinicalPasien::findOne($model->mia_mdcp_id);
      $mdcp_data_before = $modelMdcp->data;
      if ($modelMdcp !== null) {
        $modelMdcp->data_type = self::data_type;
        $modelMdcp->data = $data;
        if ($batal) {
          $modelMdcp->batal = 1;
          $modelMdcp->tgl_batal = date('Y-m-d H:i:s');
        }
        if ($modelMdcp->save(false)) {
          //2.create log
          $modelLog = new Log();
          $modelLog->scenario = "mdcp";
          $modelLog->mlog_mdcp_id = $modelMdcp->id_doc_clinical_pasien;
          $modelLog->mlog_type = Log::TYPE_UPDATE;
          $modelLog->mlog_deskripsi = $modelMdcp->doc_clinical_nama;
          $modelLog->mlog_data_type = $modelMdcp->data_type;
          $modelLog->mlog_data_before = $mdcp_data_before;
          $modelLog->mlog_data_after = $modelMdcp->data;
          if ($modelLog->save(false)) {
            return MakeResponse::createNotJson(true, 'Doc Clinical Pasien : ' . $modelMdcp->doc_clinical_nama . ' berhasil diubah');
          }
        }
        return MakeResponse::createNotJson(false, 'Doc Clinical Pasien : ' . $modelMdcp->doc_clinical_nama . ' gagal diubah');
      }
    } else {
      //1.create mdcp
      $modelMdcp = new DocClinicalPasien();
      $midc = MasterDocClinical::find()->where(['id_doc_clinical' => $midc_id])->asArray()->one();
      $modelMdcp->ps_kode = $layanan['ps_kode'];
      $modelMdcp->ps_nama = $layanan['ps_nama'];
      $modelMdcp->ps_tempat_lahir = $layanan['ps_tempat_lahir'];
      $modelMdcp->ps_tgl_lahir = $layanan['ps_tgl_lahir'];
      $modelMdcp->ps_gender = $layanan['ps_gender'];
      $modelMdcp->ps_umur = $layanan['ps_umur'];
      $modelMdcp->reg_kode = $layanan['reg_kode'];
      $modelMdcp->reg_tgl = $layanan['reg_tgl'];
      $modelMdcp->pl_id = $layanan['pl_id'];
      $modelMdcp->pl_tgl = $layanan['pl_tgl'];
      $modelMdcp->unt_id = $layanan['unt_id'];
      $modelMdcp->unt_nama = $layanan['unt_nama'];
      $modelMdcp->doc_clinical_id = $midc['id_doc_clinical'];
      $modelMdcp->doc_clinical_nama = $midc['nama'];
      $modelMdcp->data_type = self::data_type;
      $modelMdcp->data = $data;
      if ($modelMdcp->save(false)) {
        //2.update reg_mdcp_id_dpjp
        $model->mia_mdcp_id = $modelMdcp->id_doc_clinical_pasien;
        if ($model->save(false)) {
          //3.create log
          $modelLog = new Log();
          $modelLog->scenario = "mdcp";
          $modelLog->mlog_mdcp_id = $modelMdcp->id_doc_clinical_pasien;
          $modelLog->mlog_type = Log::TYPE_CREATE;
          $modelLog->mlog_deskripsi = $modelMdcp->doc_clinical_nama;
          $modelLog->mlog_data_type = $modelMdcp->data_type;
          $modelLog->mlog_data_before = null;
          $modelLog->mlog_data_after = $modelMdcp->data;
          if ($modelLog->save(false)) {
            return MakeResponse::createNotJson(true, 'Doc Clinical Pasien : ' . $modelMdcp->doc_clinical_nama . ' berhasil dibuat');
          }
        }
      }
      return MakeResponse::createNotJson(false, 'Doc Clinical Pasien : ' . $modelMdcp->doc_clinical_nama . ' gagal dibuat');
    }
  }
}
