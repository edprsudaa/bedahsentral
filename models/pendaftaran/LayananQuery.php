<?php

namespace app\models\pendaftaran;

class LayananQuery extends \yii\db\ActiveQuery
{
  public function deleted()
  {
    return $this->andWhere('deleted_at is not null');
  }
  public function notDeleted()
  {
    return $this->andWhere(Layanan::tableName() . '.deleted_at is null');
  }
  public function active()
  {
    return $this->andWhere("aktif=1");
  }
  public function notActive()
  {
    return $this->andWhere("aktif=0");
  }
  public function init()
  {
    $this->andOnCondition(Layanan::tableName() . '.deleted_at is null');
    parent::init();
  }
  // public function all($db = null)
  // {
  //   return parent::all($db);
  // }
  // public function one($db = null)
  // {
  //   return parent::one($db);
  // }
}
