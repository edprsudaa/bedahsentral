<?php

namespace app\controllers;

use Yii;
use yii\helpers\Url;
use app\models\pendaftaran\Layanan;
use app\models\medis\Icd10cm;
use app\models\medis\Icd9cm;
use app\models\medis\MasalahKeperawatan;
use app\models\medis\IntervensiKeperawatan;
use yii\web\Controller;
use yii\helpers\ArrayHelper;
use app\components\HelperSpesial;
use app\components\MakeResponse;
use app\models\medis\Tindakan;
use app\models\pendaftaran\Pasien;

class ReferensiController extends Controller
{
  public function actionRekonItemPemeriksaanPenunjang($items)
  {
    $array_items2 = HelperSpesial::PenunjangKonversiStringKeArray($items);
    if ($array_items2) {
      $list_items = HelperSpesial::RekonItemPemeriksaanPenunjang($array_items2);
      if ($list_items) {
        return MakeResponse::create(true, 'Data Item Pemeriksaan Order Penunjang Tersedia', $list_items);
      }
    }
    return MakeResponse::create(false, 'Data Item Pemeriksaan Order Penunjang Kosong');
  }
  public function actionIcd10($search = null)
  {
    $items = Icd10cm::getListDiagnosa($search);
    if ($items) {
      $items = ArrayHelper::getColumn($items, 'text');
      return MakeResponse::create(true, 'Data Item Pemeriksaan Tersedia', $items);
    }
    return MakeResponse::create(false, 'Data Item Pemeriksaan Tidak Ditemukan');
  }
  public function actionIcd10Select2($search = null, $limit = 100)
  {
    \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
    if (\Yii::$app->request->isAjax) {
      $icd10 = ArrayHelper::getColumn(Icd10cm::getListDiagnosa($search), function ($data) {
        return [
          'status' => true,
          'id' => $data['kode'],
          'text' => $data['deskripsi'],
          'text_full' => $data['keterangan'],
          'kode' => $data['kode'],
          'deskripsi' => $data['deskripsi']
        ];
      });
      return ['results' => $icd10];
    }
    return ['results' => [['status' => false, 'text' => 'Data Tidak Tersedia']]];
  }
  public function actionIcd9Select2($search = null, $limit = 100)
  {
    \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
    if (\Yii::$app->request->isAjax) {
      $icd10 = ArrayHelper::getColumn(Icd9cm::getListProsedur($search), function ($data) {
        return [
          'status' => true,
          'id' => $data['kode'],
          'text' => $data['deskripsi'],
          'text_full' => $data['keterangan'],
          'kode' => $data['kode'],
          'deskripsi' => $data['deskripsi']
        ];
      });
      return ['results' => $icd10];
    }
    return ['results' => [['status' => false, 'text' => 'Data Tidak Tersedia']]];
  }
  public function actionLayananIgdRjRiSelect2($search, $limit = 100)
  {
    $this->response->format = \yii\web\Response::FORMAT_JSON;
    if ($this->request->isAjax) {
      $layanan = ArrayHelper::getColumn(Layanan::getDataSearchIgdRjRi($search), function ($data) {
        return [
          'status' => true,
          'id' => $data['id'],
          'text' => '<b>No.RM</b> : ' . ($data['registrasi'] ? $data['registrasi']['pasien_kode'] : "No.RM Tidak Ada!")
            . ' <b>No.REG</b> : ' . ($data['registrasi'] ? $data['registrasi']['kode'] : "No.REG Tidak Ada!")
            . ' <b>Nama</b> : ' . ($data['registrasi']['pasien'] ? $data['registrasi']['pasien']['nama'] : 'Pasien Tidak Ada!')
            . ' <b>Ruangan</b> : ' . ($data['unit'] ? $data['unit']['nama'] : 'KOSONG')
            . ' <b>Tgl.Masuk</b> : ' . date('d-m-Y H:i', strtotime($data['tgl_masuk']))
        ];
      });
      // echo'<pre/>';print_r($layanan);die();
      return ['results' => $layanan];
    }
    return ['results' => [['status' => false, 'text' => 'Data Tidak Tersedia']]];
  }
  public function actionSearchPasien($search, $limit = 50)
  {
    $this->response->format = \yii\web\Response::FORMAT_JSON;
    if ($this->request->isAjax) {
      $pasien = ArrayHelper::getColumn(Pasien::getDataPasien($search), function ($data) {
        return [
          'status' => true,
          'id' => $data['kode'],
          'text' => '<b>No.RM</b> : ' . ($data['kode'] ? $data['kode'] : "Pasien Tidak Ada!")
            . ' <b>Nama</b> : ' . ($data['nama'] ? $data['nama'] : 'Pasien Tidak Ada!')
        ];
      });
      // echo'<pre/>';print_r($pasien);die();
      return ['results' => $pasien];
    }
    return ['results' => [['status' => false, 'text' => 'Data Tidak Tersedia']]];
  }
  public function actionMasalahKeperawatan($search = null)
  {
    $items = MasalahKeperawatan::getListMasalah($search);
    // echo "<pre>";print_r($items);die;
    if ($items) {
      $items = ArrayHelper::getColumn($items, 'text');
      return MakeResponse::create(true, 'Data Masalah Keperawatan Tersedia', $items);
    }
    return MakeResponse::create(false, 'Data Masalah Keperawatan Tidak Ditemukan');
  }
  public function actionTindakan($search = null)
  {
    $items = Tindakan::getListTindakan($search);
    // echo "<pre>";print_r($items);die;
    if ($items) {
      $items = ArrayHelper::getColumn($items, 'text');
      return MakeResponse::create(true, 'Data Tindakan Tersedia', $items);
    }
    return MakeResponse::create(false, 'Data Tindakan Tidak Ditemukan');
  }
  public function actionIntervensiKeperawatan($search = null)
  {
    $items = IntervensiKeperawatan::getListIntervensi($search);
    if ($items) {
      $items = ArrayHelper::getColumn($items, 'text');
      return MakeResponse::create(true, 'Data Masalah Keperawatan Tersedia', $items);
    }
    return MakeResponse::create(false, 'Data Masalah Keperawatan Tidak Ditemukan');
  }
}
